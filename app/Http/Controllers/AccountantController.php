<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Accountant;

class AccountantController extends Controller
{
    public function accountants(){
        return view('admin.accountants', [
            'accountants' => Accountant::all(),
        ]);
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:accountants',
            'phone' => 'required',
            'address' => 'required',
            'password' => 'required',
        ]);

        Accountant::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'password' => Hash::make($request->password)
        ]);
        return back()->with('accountant_success', $request->name.' Added.');
    }

    // Get accountant by id.
    public function getAccountantById($id){
        return Accountant::find($id);
    }

    // Delete accountant
    public function delete(Request $request){
        $accountant = Accountant::find($request->id);
        $accountant_name = $accountant->name;
        $accountant->delete();
        return back()->with('accountant_error', 'Accountant '.$accountant_name.' deleted');
    }
}
