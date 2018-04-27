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
use Excel;

class ProductController extends Controller
{
    public function __construct()
    {
        // $this->middleware('guest');
    }
    
    public function list($slug, $category, $page) {
        $currentPage = 3;
        \Illuminate\Pagination\AbstractPaginator::currentPageResolver(function() use ($currentPage) {
            return $currentPage;
        });        
        $products = Product::paginate(15);
        return view('products.list', ['products' => $products]);
    }

    public function admin_product_list(Request $request) {
        if ($request->input('title')) {
            $title = $request->old('title');
        }
        if ($request->input('code')) {
            $code = $request->old('code');
        }
        if ($request->input('category')) {
            $products = Product::join('products_in_categories', 'products.id', '=', 'products_in_categories.product_id')
                            ->where(function($query) use ($request) {
                                if ($request->input('title')) {
                                    $query->orWhere('products.title', 'like', '%'.$request->input('title').'%');
                                }
                                if ($request->input('code')) {
                                    $query->orWhere('products.code', 'like', '%'.$request->input('code').'%');
                                }
                                if ($request->input('category')) {
                                    $query->orWhere('products_in_categories.category_id', '=', $request->input('category'));
                                }
                            })->orderBy('products.id', 'desc')->paginate(15);
        } else {
            $products = Product::where(function($query) use ($request) {
                                if ($request->input('title')) {
                                    $query->orWhere('products.title', 'like', '%'.$request->input('title').'%');
                                }
                                if ($request->input('code')) {
                                    $query->orWhere('products.code', 'like', '%'.$request->input('code').'%');
                                }
                            })->orderBy('products.id', 'desc')->select('id as product_id', 'title', 'price', 'summary', 'thumbnail', 'created_at', 'type', 'color', 'material', 'code', 'sex')->paginate(15);
        }
        foreach($products as $key => $product) {
            $products[$key]['categories'] = Product::categories($product->product_id);
            $products[$key]['packages'] = Product::packages($product->product_id);
        }
        $categories = Category::all();
        return view('products.admin_list', ["products" => $products, 'categories' => $categories]);
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
            'summary' => 'required',
            'categories' => 'required',
            'file' => 'required|image',
            'code' => 'required',
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
        ProductInCategory::where('product_id', '=', $id)->delete();
        return back()->with('success', 'Xóa thành công !!!');
    }
    public function admin_items($product_id) {
        $items = Item::where('product_id', $product_id)->orderBy('id', 'desc')->paginate(15);
        $array_total = array(
            Item::total_item_by_status(0),
            Item::total_item_by_status(1),
            Item::total_item_by_status(2),
        );
        return view('products.admin_items', ['items' => $items, 'array_total' => $array_total]);
    }
    public function store_items(Request $request) {
        // dd($request->file('file'));
        $validator = Validator::make($request->all(), [
            'file' => 'required|mimetypes:application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel',
        ]);

        if ($validator->fails()) {
            return redirect('admin/items')->withErrors($validator)->withInput();
        }
        if ($request->file('file')) {
            $path = $request->file('file')->store('excel');
            $rows = Excel::load('storage/app/'.$path, function($reader) {
               $reader->takeColumns(2)->toArray();
            })->get();

            foreach ($rows as $item) {
                if ($item->product_id && $item->size) {
                    $save = new Item();
                    $save->product_id = $item->product_id;
                    $save->size = $item->size;
                    $save->status = 0;
                    $save->save();
                }
            }
        }
        return redirect('admin/items')->with('success', 'Upload thành công !!!'); 
    }
    public function change_status_item(Request $request) {
        // dd($request->query('query'));
        $validator = Validator::make($request->all(), [
            'id' => 'required|numeric',
            'status' => 'required|numeric',
        ]);

        if ($validator->fails()) {
            return redirect('admin/items')->withErrors($validator)->withInput();
        }

        $item = Item::where('id', '=', $request->query('id'))->first();
        if (!$item) {
            return back()->with('fail', 'Sản phẩm không tồn tại !!!');
        }
        $check = [0, 1, 2];
        if (!in_array($request->query('status'), $check)) {
            return back()->with('fail', 'Trạng thái không tồn tại !!!');
        }
        $item->status = $request->query('status');
        $item->save();
        return back()->with('success', 'Đổi trạng thái của sản phẩm thành công !!!');
    }
}
