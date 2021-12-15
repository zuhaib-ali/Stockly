<?php

namespace App\Http\Controllers;

use App\Models\Invester;
use App\Models\Product;
use App\Models\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InvesterController extends Controller
{
    // Show
    public function investors(Request $request){
        if($request->session()->get('user')->role == "admin"){
            return view('admin.investors', [
                'investors' => Invester::all()
            ]);
        }elseif($request->session()->get('user')->role == "accountant"){
            return view('accountant.investors', [
                'investors' => Invester::where('accountant_id', $request->session()->get('user')->id)->get()
            ]);
        }
        
    }

    // Add investor module
    public function addInvestor(){
        return view('accountant.add_investor', [
            'investors' => Invester::all()
        ]);
    }
    

    // Create
    public function create(Request $request){
        $image_name = null;
        $front_cnic_name = null;
        $back_cnic_name = null;

        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:investers',
            'phone' => 'required',
            'cnic' => 'required|unique:investers',
            'address' => 'required',
            'password' => 'required',
            'nominee_name' => 'required',
            'nominee_cnic' => 'required',
            'nominee' => 'required',
            'cnic_front' => 'required',
            'cnic_back' => 'required',
            'terms_and_conditions' => 'required',
            'accountant_id' => 'required'
        ]);

        if($request->investor_profile_image != null){
            $image_name = time().'_'.$request->investor_profile_image->getClientOriginalName();
        }
        $front_cnic_name = time().'_'.$request->cnic_front->getClientOriginalName();
        $back_cnic_name = time().'_'.$request->cnic_back->getClientOriginalName();
        
        $investor_created = Invester::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'username' => $request->first_name.' '.$request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'cnic' => $request->cnic,
            'address' => $request->address,
            'password' => Hash::make($request->password),
            'nominee_name' => $request->nominee_name,
            'nominee_cnic' => $request->nominee_cnic,
            'nominee_relationship' => $request->nominee,
            'image' => $image_name,
            'cnic_front' => $front_cnic_name,
            'cnic_back' => $back_cnic_name,
            'referral_code' => $request->referral_code,
            'terms_conditions' => (int)$request->terms_and_conditions,
            'accountant_id' => $request->accountant_id
        ]);

        if($investor_created){
            if($image_name != null){
                $request->investor_profile_image->move(public_path('investors_images/'.$investor_created->id), $image_name);
            }
            $request->cnic_front->move(public_path('investors_images/'.$investor_created->id), $front_cnic_name);
            $request->cnic_back->move(public_path('investors_images/'.$investor_created->id), $back_cnic_name);
            return back()->with('investor_success', $investor_created->username.' Added.');
        }
    }

    // View investor
    public function view(Request $request){
        $investor = Invester::find($request->id);
        return view('view_investor', [
            'investor' => $investor,
            'referral' => Invester::find($investor->referral_code),
            'transactions' => Transaction::where("investor", $investor->id)->get(),
            'products' => Product::all(),
        ]);
    }

    // Edit investor
    public function edit(Request $request){
        return view("admin.edit_investor", [
            'investor' => Invester::find($request->id),
            'investors' => Invester::all()
        ]);
    }

    public function update(Request $request){

        $investor = Invester::find($request->id);
        $investor->first_name = $request->first_name;
        $investor->last_name = $request->last_name;
        $investor->username = $request->first_name." ".$request->last_name;
        $investor->email = $request->email;
        $investor->phone = $request->phone;
        $investor->cnic = $request->cnic;
        $investor->address = $request->address;
        $investor->nominee_name = $request->nominee_name;
        $investor->nominee_cnic = $request->nominee_cnic;
        $investor->nominee_relationship = $request->nominee;
        $investor->referral_code = $request->referral_code;
        if($investor->update()){
            return back()->with("investor_info", 'Investor '.$investor->username." updated.");
        }
    }

    // Get investor by id.
    public function getInvestorById(Request $request, $id){
        if($request->session()->has('user')){
            return Invester::find($id);
        }
    }

    // Delete investor
    public function delete(Request $request){
        if($request->session()->has('user')){
            $investor = Invester::find($request->id);
            $investor_name = $investor->username;
            if($investor->delete()){
                return back()->with('investor_error', $investor_name." deleted.");
            }
        }
    }
}
