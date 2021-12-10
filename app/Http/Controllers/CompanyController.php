<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{
    public function index(){
        return view("admin.companies",[
            "companies" => Company::all(),
        ]);
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:companies',
            'address' => 'required',
            'phone' => 'required',
        ]);
        $company = Company::create([
            "name" => $request->name,
            "email" => $request->email,
            "address" => $request->address,
            "phone" => $request->phone,
        ]);

        if($company){
            return back()->with("company_success", $request->name." added.");
        }
    }

    public function getCompanyById($id){
        return Company::find($id);
    }

    public function update(Request $request){
        $request->validate([
            "name" => 'required',
            "address" => 'required',
            "phone" => 'required'
        ]);

        $company = Company::find($request->id);
        $company_name = $company->name;
        $company->name = $request->name;
        $company->address = $request->address;
        $company->phone = $request->phone;
        if($company->update()){
            return back()->with("company_info", $company_name." updated.");
        }
    }

    // Delete company
    public function delete(Request $request){
        if(Company::find($request->id)->delete()){
            return back()->with("comapny_error", "Company deleted.");
        }
    }
}
