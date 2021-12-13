<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Invester;
use App\Models\Product;
use App\Models\Transaction;

class TransactionController extends Controller
{
    // Add transaction view
    public function addTransactionView(){
        return view('accountant.add_transaction', [
            'investors' => Invester::all(),
            'products' => Product::all(),
        ]);
    }

    // Get products
    public function getProducts(){
        return Product::all();
    }

    // Get product by id
    public function getProductById($id){
        return Product::find($id);
    }

    // Creating trasaction.
    public function create(Request $request){
        $index = 0;
        $products_purchased = array();
        $prices  = array();
        $quantities = array();
        $delivered_quantity = array();
        $deposited_quantity = array();
        $deposited_amount = 0;
        $is_deposited = false;

        $request->validate([
            'investor' => 'required',
            'product' => 'required',
            'price' => 'required',
            'quantity' => 'required',
            'total' => 'required',
            'payment_type' => 'required',
            'transaction_id' => 'required'
        ]);

        
        $products = Product::whereIn('id', $request->product)->get();
        $investor = Invester::find($request->investor);

        foreach($products as $product){
            if($product->stock < $request->quantity[$index]){
                return back()->with('transaction_error', $product->name." ammount must be in range of ".$product->stock);
            }

            $product->stock = $product->stock - ($request->quantity[$index]/2);
            $product->update();
            $index = $index + 1;
        }

        // Pushing values to arrays.
        for($i=0; $i<count($request->product); $i++){
            array_push($products_purchased, (int)$request->product[$i]);
            array_push($prices, (int)$request->price[$i]);
            array_push($quantities, (int)$request->quantity[$i]);
            array_push($delivered_quantity, $request->quantity[$i]/2);
            array_push($deposited_quantity, $request->quantity[$i]/2);
        }

        $deposited_amount = ($request->total/2);
        if($deposited_amount != 0 || $deposited_amount != 0.0){
            $is_deposited = true;
        }

        $transaction_created = Transaction::create([
            'investor' => $request->investor,
            'product' => json_encode($products_purchased),
            'price' => json_encode($prices),
            'quantity' => json_encode($quantities),
            'total' => $request->total,
            'payment_type' => $request->payment_type,
            'payment' => true,
            'accountant_id' => $request->session()->get('user')->id,
            'delivered' => json_encode($delivered_quantity),
            'deposited' => json_encode($deposited_quantity),
            'deposited_amount' => $deposited_amount,
            'is_deposited' => $is_deposited,
            'transaction_id' => $request->transaction_id
        ]);

        if($transaction_created != null){
            // Updating point in investors by 10 percent
            $investor->points = ($request->total/10)+$investor->points;
            $investor->update();

            return back()->with("transaction_success", "Transaction Added.");
        }
    }

    // Get all unseen transactions
    public function getUnseenTransactions(){
        return Transaction::leftJoin("investers", "transactions.investor", 'investers.id')
        ->select(
            'transactions.*',
            'investers.username as investor_name'
        )
        ->where('transactions.seen', false)
        ->get();
    }

    // Update unseen transaction to TURE.
    public function seen($id){
        $transaction = Transaction::find($id);
        $transaction->seen = true;
        $transaction->update();
        return back();
    }
}
