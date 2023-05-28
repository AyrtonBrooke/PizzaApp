<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\User;
use App\Models\Checkout;
use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'DESC')->get();
        return view('order.index', compact('orders'));
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
    public function destroy($id)
    {
        Order::find($id)->delete();
        return redirect()->route('user.order')->with('message', 'Order deleted');

    }

    public function customers()
    {
        $customers = User::where('is_admin', 0)->get();
        return view('customers', compact('customers'));
    }
    function checkout(Request $request)
    {
        $deliveryChoice = $request->input('delivery_choice');

        $orders = Order::all();
        foreach ($orders as $order) {
            // Create a new checkout record
            $checkout = new Checkout();
            $checkout->user_id = $order->user_id;
            $checkout->pizza_id = $order->pizza_id;
            $checkout->pizza_price = $order->pizza_price;
            $checkout->pizza_size = $order->pizza_size;
            $checkout->body = $order->body;
            $checkout->phone = $request->phone;
            $checkout->total = $request->total;
            $checkout->delivery_choice = $deliveryChoice; // Set the default value for delivery_choice if it is not provided
            $checkout->save();
        }

        // Redirect or perform additional actions as needed
        Order::truncate();
        // For example:
        return redirect()->back()->with('success', 'Checkout successful!');
    }
}
