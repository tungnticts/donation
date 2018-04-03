<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

use App\Product;
use App\Category;
use App\ProductInCategory;
use App\Item;
use DB;
class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }
    
    public function products_list(Request $request) {
        return view('product.list');
    }

    public function admin_product_list() {
        $products = Product::orderBy('created_at', 'desc')->paginate(15);
        foreach($products as $key => $product) {
            $products[$key]['categories'] = Product::categories($product->id);
            $products[$key]['packages'] = Product::packages($product->id);
        }
        return view('products.admin_list', ["products" => $products]);
    }
    // public function admin_search()
    public function admin_create_product(Request $request) {
        $size = array(
            "XS",
            "S",
            "M",
            "L",
            "XL",
            "XXL",
            "XXXL"
        );
        $sex = array(
            'Unisex',
            'Female',
            'Male',
        );
        $types = array(
            'Quần',
            'Áo'
        );
        $categories = Category::all();
        return view('products.create', ['categories' => $categories, 'size' => $size, 'sex' => $sex, 'types' => $types]);
    }
    public function admin_store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|numeric',
            // 'quantity' => 'required|numeric',
            'summary' => 'required',
            'categories' => 'required',
            'file' => 'required|image',
            'code' => 'required',
           // 'type' => 'required|numeric',
            // 'size' => 'required|numeric',
           // 'color' => 'required',
           // 'material' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/products/create')->withErrors($validator)->withInput();
        }
        $product = new Product();
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->summary = $request->input('summary');
        $product->code = $request->input('code');
        $product->type = $request->input('type');
        $product->color = $request->input('color');
        $product->material = $request->input('material');
        // $product->size = $request->input('size');
        $product->user_id = Auth::id();

        $path = $request->file('file')->store('public/images');
        $product->thumbnail = 'http://localhost/storage/'.str_replace('public/', '', $path);
        $product->save();

        $id = $product->id;
        foreach($request->input('categories') as $category) {
            $save = new ProductInCategory();
            $save->product_id = $id;
            $save->category_id = $category;
            $save->save();
        }

        return redirect('admin/products')->with('success', 'Tạo thành công !!!');   
    }
    public function edit($id) {
        $product = Product::findOrFail($id);
        $product->categories = Product::categories($id);
        $val_categories = array();
        foreach($product->categories as $category) {
            array_push($val_categories, $category->id);
        }
        $categories = Category::all();
        return view('products.edit', ['product' => $product, 'categories' => $categories, 'val_categories' => $val_categories]);
    }
    public function save_edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'price' => 'required|numeric',
            'summary' => 'required',
            'categories' => 'required',
            'code' => 'required',
        ]);

        if ($validator->fails()) {
            $ret_url = 'admin/products/edit/'.$request->input('id');
            return redirect($ret_url)->withErrors($validator)->withInput();
        }
        // $product = new Product();
        $product = Product::findOrFail($request->input('id'));
        $product->title = $request->input('title');
        $product->price = $request->input('price');
        $product->quantity = $request->input('quantity');
        $product->summary = $request->input('summary');
        $product->user_id = Auth::id();
        if ($request->file('file')) {
            $path = $request->file('file')->store('public/images');
            $product->thumbnail = 'http://localhost/'.'storage/'.str_replace('public/', '', $path);
        }
        
        $product->save();
        DB::table('products_in_categories')->where('product_id', '=', $request->input('id'))->delete();

        foreach($request->input('categories') as $category) {
            $save = new ProductInCategory();
            $save->product_id = $request->input('id');
            $save->category_id = $category;
            $save->save();
        }

        return redirect('admin/products')->with('success', 'Update thành công !!!'); 
    }
    public function delete($id) {
        $product = Product::find($id);
        if (!$product) {
            return back()->with('fail', 'Sản phẩm không tồn tại !!!');
        }
        $product->delete();
        return back()->with('success', 'Xóa thành công !!!');
    }
    public function admin_items() {
        $items = Item::orderBy('created_at', 'desc')->paginate(15);
        $array_total = array(
            Item::total_item_by_status(0),
            Item::total_item_by_status(1),
            Item::total_item_by_status(2),
        );
        return view('products.admin_items', ['items' => $items, 'array_total' => $array_total]);
    }
}
