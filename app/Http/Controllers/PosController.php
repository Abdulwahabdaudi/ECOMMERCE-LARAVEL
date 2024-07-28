<?php

namespace App\Http\Controllers;

use App\Models\User;
use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;

class PosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()

    {
        $products = Product::all();
        $user = User::find(1);
        $cartProducts = $user->products()->get();
        return Inertia::render('admin/Pos', [
            'products' => $products,
            'cartProducts' => $cartProducts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $user = User::find(1);
        $product = Product::where('id',$request->id)->first();
        $cart = $user->products()->where('id',$request->id)->first();
        if ($cart) {
            // check product quantity
            if($product->quantity <= $cart->pivot->quantity) {
                 return redirect()->back()->withErrors(
                     [
                            'message' => 'Product available only: '. $product->quantity,
                      ]  
                     );
            
            }
            // update only quantity
            $cart->pivot->quantity = $cart->pivot->quantity + 1;
            $cart->pivot->price = $cart->pivot->quantity * $product->price;
            $cart->pivot->save();
        } else {
            if($product->quantity < 1) {
                return redirect()->back()->withErrors(
                    [
                        'message' => 'Product out of stock',
                     ]  
                    );
           
            }
            $user->products()->attach($product->id, ['quantity' => 1, 'name' => $product->name, 'price' => $product->price]);
        }


    }




    public function change(Request $request)
    {
        $user = User::find(1);
        $product = Product::where('id',$request->product_id)->first();

        $cart = $user->products()->where('id', $request->product_id)->first();

        if ($cart) {
            if($product->quantity <= $request->quantity - 1) {
                return redirect()->back()->withErrors(
                    [
                           'message' => 'Product available only: '. $product->quantity,
                     ]  
                    );
          
        }
        $cart->pivot->quantity = $request->quantity;
        $cart->pivot->price = $request->quantity * $product->price;
        $cart->pivot->save();
    }
}


    

    public function deleteOne (Request $request)
    {
        $user = User::find(1);
        $user->products()->detach($request->products_id);


  
    }
    public function empty ()
    {
        $user = User::find(1);

       $user->products()->detach();
    }



    

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find(1);
                $user->products()->detach($id);
    }
}
