<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use Exception;

// use GuzzleHttp\Psr7\Request;

class ProductController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $products = Product::latest()->filter(request(['search']))->paginate(2);

       
        return Inertia::render('admin/Product', ['products' => $products]);
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
        $formFields = $request->validate([
            'name' => 'required|unique:products,name',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required'

        ]);

        $isCreated = Product::create($formFields);
        if (!$isCreated) {
            return to_route('admin.product',);
        }
        return to_route('admin.product',);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $formFields = $request->validate([
            'name' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'description' => 'required',
            'status' => 'required'

        ]);

        $isCreated = $product->update($formFields);
        if (!$isCreated) {
            return to_route('admin.product',);
        }
        return to_route('admin.product',);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {

            $done =  $product->delete();
            return to_route('admin.product',);
        } catch (Exception $e) {
            //throw $th;
            // return response()->json([(error) => $e->getMessage()],500);
            if (!$done) {
                return to_route('admin.product',);
            }
        }
    }
}
