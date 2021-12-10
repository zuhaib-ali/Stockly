<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Company;
use App\Models\Product;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function index(){
        return view("admin.products", [
            "products" => Product::all(),
            "categories" => Category::all(),
            "sub_categories" => SubCategory::all(),
            "companies" => Company::all(),
            "proudct_images" => ProductImage::all()
        ]);
    }
    
    // Add
    public function add(Request $request){        
        $request->validate([
            "name" => "required",
            "price" => "required",
            "company" => "required",
            "category" => "required"
        ]);

        $product = Product::create([
            "name" => $request->name,
            "price" => $request->price,
            "tax" => $request->tax,
            "category_id" => $request->category,
            "company_id" => $request->company,
            "description" => $request->description,
            "stock" => $request->stock
        ]);
                
        if($request->images != null){
            $image_name = null;
            foreach($request->images as $image){
                $image_name = time()."_".$image->getClientOriginalName();
                ProductImage::create([
                    "product_id" => $product->id,
                    "image_name" => $image_name
                ]);
                $image->move(public_path("product_images"), $image_name);
            }
        }

        return back()->with("product_success", $request->name." created");
    }

    // get product by id
    public function getProductById($id){
        return Product::find($id);
    }

    public function editGetProductById($id){
        $product = Product::find($id);
        
        return [
            'product' => $product,
            'companies' => Company::all(),
            'categories'  => Category::whereIn('id', json_decode(Company::find($product->company_id)->category_id))->get(),
        ];
    }

    // Update
    public function update(Request $request){
        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'category' => 'required',
            'company' => 'required',
            'description' => 'required',
            'id' => 'required'
        ]);

        $product = Product::find($request->id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->tax = $request->tax;
        $product->category_id = $request->category;
        $product->company_id = $request->company;
        $product->description = $request->description;
        $product->stock = $request->stock;

        if($product->update()){
            return back()->with('product_info', $request->name.' updated.');
        }
    }

    // Get categories by company id
    public function getCategoriesByCompanyId($id){
        $company = Company::find($id);
        return Category::whereIn('id', json_decode($company->category_id))->get();
    }

    public function getCategoriesByCompanyIdInEditProductModal($id){
        return Category::whereIn('id', json_decode(Company::find($id)->category_id))->get();
    }


    public function getSubCategoryByCategoryId($id){
        return SubCategory::where('category_id', $id)->get();
    }

    // Delete product
    public function delete(Request $request){
        if(Product::find($request->id)->delete()){
            return back()->with("product_error", "Product deleted.");
        }
    }
}
