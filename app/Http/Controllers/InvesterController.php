<?php

namespace App\Http\Controllers;

use App\Models\Invester;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class InvesterController extends Controller
{
    // investors
    public function investors(Request $request){
        return view('accountant.investors', [
            'investors' => Invester::where('accountant_id', $request->session()->get('user')->id)->get()
        ]);
    }

    // Add investor view
    public function addInvestor(){
        return view('accountant.add_investor', [
            'investors' => Invester::all()
        ]);
    }
    

    // create
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
}
