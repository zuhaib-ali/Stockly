<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CredientialController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AccountantController;
use App\Http\Controllers\InvesterController;
use App\Http\Controllers\TransactionController;


use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Company;
use App\Models\Product;
use App\Models\Setting;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'admin', "middleware" => "adminAuth"], function(){
    
    // Index
    Route::get('/', function () {
        return view('admin.index',[
            'categories' => Category::all(),
            'sub_categories' => SubCategory::all(),
            'companies' => Company::all(),
            'products' => Product::all(),
            'settings' => Setting::all(),
            'accountants' => User::where('role', 'accountant')->get()
        ]);
    })->name("admin");

    // Accountant 
    Route::get('/accountants', [AccountantController::class, 'accountants'])->name('admin.accountants');
    Route::post('/add-accountant', [AccountantController::class, 'add'])->name('admin.add-accountant');
    Route::get('/get-accountant-by-id/{id}', [AccountantController::class, 'getAccountantById']);
    Route::post('/accountant/delete', [AccountantController::class, 'delete'])->name('admin.delete-accountant');

    // Company
    Route::get('/companies', [CompanyController::class, "index"])->name("admin.companies");
    Route::post('/company/add', [CompanyController::class, "add"])->name('admin.add-company');
    Route::post('/company/update', [CompanyController::class, "update"])->name('admin.update-company');
    Route::get('/get-company-by-id/{id}', [CompanyController::class, 'getCompanyById']);
    Route::post('/company/delete', [CompanyController::class, 'delete'])->name('admin.delete-company');

    // Category
    Route::get('/categories', [CategoryController::class, "index"])->name("admin.categories");
    Route::post('/category/add', [CategoryController::class, "add"])->name('admin.add-category');
    Route::post('/category/update', [CategoryController::class, "update"])->name('admin.update-category');
    Route::get('/get-category-by-id/{id}', [CategoryController::class, 'getCategoryById']);
    Route::post('/cateogry/delete', [CategoryController::class, 'delete'])->name('admin.delete-category');

    // Investors
    Route::get('/investors', [InvesterController::class, 'investors'])->name('admin.investors');
    Route::get('/add_investor_view', [InvesterController::class, 'addInvestor'])->name('admin.add-investor-view');
    Route::post('/submit/investor', [InvesterController::class, 'create'])->name('admin.submit-investor');
    Route::get('/investor/view', [InvesterController::class, 'view'])->name('admin.view_investor');
    Route::get('/investor/edit', [InvesterController::class, 'edit'])->name('admin.edit-investor');
    Route::post('/investor/update', [InvesterController::class, 'update'])->name('admin.update-investor');

    // Sub Category
    Route::get('/sub-categories', [SubCategoryController::class, 'index'])->name('admin.sub_categories');
    Route::post('/sub-category/add', [SubCategoryController::class, "add"])->name('admin.add-sub-category');
    Route::get('/get-sub-category-by-id/{id}', [SubCategoryController::class, 'getSubCategoryById']);
    Route::post('/sub-category/update', [SubCategoryController::class, 'update'])->name('admin.update-sub-category');
    Route::post('/sub-category/delete', [SubCategoryController::class, 'delete'])->name('admin.delete-sub-category');

    // Product
    Route::get('/products', [ProductController::class, "index"])->name("admin.products");
    Route::post('/product/add', [ProductController::class, "add"])->name('admin.add-product');
    Route::get('/get-product-by-id/{id}', [ProductController::class, 'getProductById']);
    Route::post('/product/update', [ProductController::class, 'update'])->name('admin.update-product');
    Route::get('/edit-get-product-by-id/{id}', [ProductController::class, 'editGetProductById']);
    Route::post('/product/delete', [ProductController::class, 'delete'])->name('admin.delete-product');
    Route::get('/get-sub-category-by-category-id/{id}', [ProductController::class, 'getSubCategoryByCategoryId']);
    Route::get('/get-categories-by-company-id-in-product/{id}', [ProductController::class, 'getCategoriesByCompanyId']);
    Route::get('/get-categories-by-company-id-in-edit-product-modal/{id}', [ProductController::class, 'getCategoriesByCompanyIdInEditProductModal']);

    // Settings
    Route::post('/update-fillers', [SettingController::class, 'update'])->name('update-fillers');

    // Transactions
    Route::get('/transactions', [TransactionController::class, 'show'])->name('admin.transactions');

    
});

// Prefix
Route::group(['prefix'=>'accountant', "middleware" => "accountantAuth"], function(){
    Route::get('/', function(){
        return view('accountant.index');
    })->name('accountant'); 

    // investors
    Route::get('/investors', [InvesterController::class, 'investors'])->name('accountant.investors');
    Route::get('/add_investor_view', [InvesterController::class, 'addInvestor'])->name('accountant.add-investor-view');
    Route::post('/submit/investor', [InvesterController::class, 'create'])->name('accountant.submit-investor');
    Route::get('/investor/view', [InvesterController::class, 'view'])->name('accountant.view_investor');
    

    // Transaction
    Route::get('/transaction', [TransactionController::class, 'addTransactionView'])->name('accountant.transaction');
    Route::get('/get-products-in-add-transaction', [TransactionController::class, 'getProducts'])->name('accountant.get-products-in-add-transaction');
    Route::get('/get-product-by-id-in-add-transaction/{id}', [TransactionController::class, 'getProductById']);
    Route::post('/create-transaction', [TransactionController::class, 'create'])->name('accountant.create-transaction');
});

// Unseen Transactions notifications.
Route::get('/get-unseen-transactions', [TransactionController::class, 'getUnseenTransactions'])->name('getUnseenTransactions');
Route::get('/seen/{id}', [TransactionController::class, 'seen']);

// Invester - GET, DLETE.
Route::get('/investor/get-investor-by-id/{id}', [InvesterController::class, 'getInvestorById']);
Route::post('/investor/delete', [InvesterController::class, 'delete'])->name('delete-investor');


// Login
Route::get('/', function(){
    if(Session::has("user")){
        return back();
    }
    return view("login");
})->name("login");
Route::post("/authenticate", [CredientialController::class, "authenticate"])->name("authenticate");

// Signup
Route::get('/signup', function(){
    if(Session::has("user")){
        return back();
    }
    return view("signup");
})->name("signup");

// Logout
Route::get("/logout", function(){
    Session::forget("user");
    return redirect()->route("login");
})->name("signOut");