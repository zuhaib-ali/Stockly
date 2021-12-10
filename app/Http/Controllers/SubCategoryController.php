<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;

class SubCategoryController extends Controller
{
    // subcategories
    public function index(){
        return view('category.sub_categories', [
            'sub_categories' => SubCategory::leftJoin('categories', 'sub_categories.category_id', '=', 'categories.id')
                ->select(
                    'sub_categories.*',
                    'categories.name as category'
                )
                ->get(),
            'categories' => Category::all()
        ]);
    }

    // add sub categories
    public function add(Request $request){
        $request->validate([
            'name' => 'required|unique:sub_categories',
            'category' => 'required'
        ]);

        SubCategory::create([
            "name" => $request->name,
            'category_id' => $request->category
        ]);

        return back()->with('sub_category_success', $request->name.' created.');
    }

    //  Get sub cateogry by id
    public function getSubCategoryById($id){
        return ['sub_category'=>SubCategory::find($id), 'categories'=>Category::all()];
    }

    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'id' => 'required'
        ]);
        $sub_category = SubCategory::find($request->id);
        $name = $sub_category->name;
        $sub_category->category_id = $request->category;
        $sub_category->name = $request->name;
        if($sub_category->update()){
            return back()->with('sub_category_info', $name.' updated.');
        }
    }

    public function delete(Request $request){
        SubCategory::find($request->id)->delete();
        return back()->with('sub_category_error', 'Sub cateogry deleted.');
    }
}
