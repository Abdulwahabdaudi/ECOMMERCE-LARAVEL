<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $totalProducts = Product::get()->count();
        $totalOrders = Order::get()->count();
        $totalCustomers = Customer::get()->count();
        $totalSales = Order::get();

        $date = Carbon::now()->subDays(7);
        $orderData = Order::latest()->where('created_at', '>=', $date)->get();

        $salesData = array();
        foreach ($orderData as $data) {

            $day = substr($data['day'], 0, 3);
            $amount = $data['amount'];

            if (isset($salesData[$day])) {
                $salesData[$day]['amount'] += $amount;
            } else {
                $salesData[$day] = ['day' => $day, 'amount' => $amount];
            }
        }

        return Inertia::render('admin/Dashboard', [
            'totalProducts' => $totalProducts,
            'totalOrders' => $totalOrders,
            'totalCustomers' => $totalCustomers,
            'totalSales' => $totalSales,
            'salesData' => array_values($salesData),
            'pos' => route('admin.pos')
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
        //
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
        //
    }
}
