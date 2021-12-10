<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Company;

class CategoryController extends Controller
{
    public function index(){
        return view("admin.categories", [
            "categories" => Category::all(),
            'companies' => Company::all()
        ]);
    }

    // Add Category
    public function add(Request $request){
        $request->validate([
            'name' => 'required',
            'company' => 'required',
        ]);
        
        if(Category::where('name', strtolower($request->name))->first()){
            //dd('true');
            $categories = array();
            // Category by id
            $category = Category::where('name', $request->name)->first();

            // Company by id.
            $company = Company::find($request->company);
            if($company->category_id!=NULL){
                if(in_array($category->id, json_decode($company->category_id), $strict = false)){
                    return back()->with("category_info", $request->name." already added.");
                }
                $categories = json_decode($company->category_id);
            }

            // push category ids.
            array_push($categories, $category->id);

            // Update category ids in company.
            $company->category_id = $categories;
            $company->update();

        }else{
           // dd('false');
           
           $categories = array();
            // Create category.
            $category = Category::create(["name" => strtolower($request->name)]);

            // Company by category id.
            $company = Company::find($request->company);
            if($company->category_id!=NULL)
                $categories = json_decode($company->category_id);

            //dd($category->id);
            array_push($categories, $category->id);
            $company->category_id = json_encode($categories);
            $company->update();
        }

        return back()->with("category_success", $request->name." added.");
    }


    // Get category by id.
    public function getcategoryById($id){
        return Category::find($id);
    }

    public function update(Request $request){
        // Validation
        $request->validate(["name" => "required",]);

        // Category by id.
        $category = Category::find($request->id);

        // Category name
        $category_name = $category->name;
        $category->name = strtolower($request->name);
        if($category->update()){
            return back()->with("category_info", $category_name." updated");
        }
    }

    // Delete category
    public function delete(Request $request){
        if(Category::find($request->id)->delete()){
            return back()->with("category_error", "category deleted.");
        }
    }
}
