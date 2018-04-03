<?php

namespace App\Http\Controllers;

use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Category;
use App\ProductInCategory;

class CategoryController extends Controller
{
    public function admin_list() {
        $categories = Category::orderBy('created_at', 'desc')->paginate(15);
        foreach($categories as $key => $category) {
            $categories[$key]->totalProduct = ProductInCategory::where('category_id', '=', $category->id)->count();
        }
        return view('categories.admin_list', ["categories" => $categories]);
    }
    public function create() {
        return view('categories.create');
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'summary' => 'required',
            'file' => 'required|image'
        ]);

        if ($validator->fails()) {
            return redirect('admin/categories/create')->withErrors($validator)->withInput();
        }

        $category = new Category();
        $category->title = $request->input('title');
        $category->summary = $request->input('summary');

        $path = $request->file('file')->store('public/images');
        $category->thumbnail = 'http://localhost/storage/'.str_replace('public/', '', $path);
        $category->save();

        return redirect('admin/categories')->with('success', 'Tạo thành công !!!');  
    }
    public function edit($id) {
        $category = Category::findOrFail($id);
        return view('categories.edit', ['category' => $category]);
    }
    public function store_edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'summary' => 'required',
        ]); 

        if ($validator->fails()) {
            return redirect('admin/categories/create')->withErrors($validator)->withInput();
        }

        $category = Category::findOrFail($request->input('id'));
        $category->title = $request->input('title');
        $category->summary = $request->input('summary');
        if ($request->file('file')) {
            $path = $request->file('file')->store('public/images');
            $category->thumbnail = 'http://localhost/storage/'.str_replace('public/', '', $path);
        }
        
        $category->save();

        return redirect('admin/categories')->with('success', 'Update thành công !!!');  
    }
}
