<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    
  /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->get();

        return Inertia::render('admin/Customer', ['customers' => $customers]);
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
        $order = Customer::create([
          
        ]);

      
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $order)
    {
        $customers = Customer::latest()->get();

        return Inertia::render('admin/Customer', ['customers' => $customers]);//
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($request, Customer $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return to_route('admin.customer',);
    }

}
