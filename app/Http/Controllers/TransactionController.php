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

            if($investor->points <= 65){
                $investor->level = 1;
                $investor->level_name = 'sales officer';

            }elseif($investor->points > 65 && $investor->points <= 650){
                $investor->level = 2;
                $investor->level_name = 'asst. sales manager';
    
            }elseif($investor->points > 650 && $investor->points <= 6500){
                $investor->level = 3;
                $investor->level_name = 'deputy sales manager';
    
            }elseif($investor->points > 6500 && $investor->points <= 65000){
                $investor->level = 4;
                $investor->level_name = 'sales manager';
    
            }elseif($investor->points > 65000 && $investor->points <= 650000){
                $investor->level = 5;
                $investor->level_name = 'executive sales manager';
    
            }elseif($investor->points > 650000 && $investor->points <= 6500000){
                $investor->level = 6;
                $investor->level_name = 'asst. general manager';
    
            }elseif($investor->points > 6500000 && $investor->points <= 65000000){
                $investor->level = 7;
                $investor->level_name = 'deputy general manager';
    
            }elseif($investor->points > 65000000){
                $investor->level = 8;
                $investor->level_name = 'general manager';
            }


            // If investor has referral code.
            if($investor->referral_code != null){
                // Current investor referral code.
                $referral = $investor->referral_code;

                // While current invetor referral id not null.
                while($referral != null){
                    // Getting investor by referral code/id.
                    $investors = Invester::find($referral);

                    // Adding points.
                    $investors->points = ($request->total/10)+$investors->points;

                    if($investors->points <= 65){
                        $investors->level = 1;
                        $investors->level_name = 'sales officer';
        
                    }elseif($investors->points > 65 && $investor->points <= 650){
                        $investors->level = 2;
                        $investors->level_name = 'asst. sales manager';
            
                    }elseif($investors->points > 650 && $investor->points <= 6500){
                        $investors->level = 3;
                        $investors->level_name = 'deputy sales manager';
            
                    }elseif($investors->points > 6500 && $investor->points <= 65000){
                        $investors->level = 4;
                        $investors->level_name = 'sales manager';
            
                    }elseif($investors->points > 65000 && $investor->points <= 650000){
                        $investors->level = 5;
                        $investors->level_name = 'executive sales manager';
            
                    }elseif($investors->points > 650000 && $investor->points <= 6500000){
                        $investors->level = 6;
                        $investors->level_name = 'asst. general manager';
            
                    }elseif($investors->points > 6500000 && $investor->points <= 65000000){
                        $investors->level = 7;
                        $investors->level_name = 'deputy general manager';
            
                    }elseif($investors->points > 65000000){
                        $investors->level = 8;
                        $investors->level_name = 'general manager';
                    }
                    // Update investor
                    $investors->update();

                    // Assign referral code of this investor.
                    $referral = $investors->referral_code;
                }
                
            }
            $investor->update();

            return back()->with("transaction_success", "Transaction Added.");
        }
    }

    // Get all unseen transactions
    public function getUnseenTransactions(Request $request){
        if($request->session()->has('user')){
            return Transaction::leftJoin("investers", "transactions.investor", 'investers.id')
            ->select(
                'transactions.*',
                'investers.username as investor_name'
            )
            ->where('transactions.seen', false)
            ->get();
        }
    }

    // Update unseen transaction to TURE.
    public function seen(Request $request, $id){
        if($request->session()->has('user')){
            $product = null;
            $transaction = Transaction::find($id);
            $transaction->seen = true;
            $transaction->update();

            $t = Transaction::leftJoin('investers', 'transactions.investor', 'investers.id')
                ->select(
                    'transactions.investor',
                    'transactions.product',
                    'transactions.price',
                    'transactions.quantity',
                    'transactions.payment',
                    'transactions.payment_type',
                    'transactions.total',
                    'transactions.deposited_amount',
                    'transactions.is_deposited',
                    'transactions.delivered',
                    'transactions.deposited',
                    'investers.*'
                )
                ->where('transactions.id', $id)
                ->first();
            
            $product = Product::whereIn('id', json_decode($t->product))->get();
            
            return view('admin.showTransaction', [
                'transaction' => $t,
                'products' => $product,
            ]);
        }
    }

    public function show(){
        return view('admin.transactions', [
            'products' => Product::all(),
            'transactions' => Transaction::leftJoin('investers', 'transactions.investor', 'investers.id')
            ->select(
                'transactions.*',
                'investers.id as investor_id',
                'investers.username as investor_name',
                'investers.image',
            )
            ->get()
        ]);
    }
}
