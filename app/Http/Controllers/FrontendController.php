<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use App\Models\Pizza;
use App\Models\Order;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index(Request $request)
    {
        if (!$request->category){
            $pizzas = Pizza::latest()->get();
            return view('frontpage',compact('pizzas'));
        }
        $pizzas = Pizza::where('category',$request->category)->get();
        return view('frontpage',compact('pizzas'));
    }
    public function show($id)
    {
        $pizza = Pizza::find($id);
        return view('show',compact('pizza'));
    }

    public function store(Request $request)
    {
        Order::create([
            'user_id' => auth()->user()->id,
            'pizza_id' => $request->pizza_id,
            'pizza_size' => $request->input('pizza_size'), // Retrieve the selected pizza size
            'pizza_price' => floatval($request->input('pizza_price')), // Convert the price value to float
            'body' => $request->body,
        ]);
        return back()->with('message','Your order has been placed');
    }

    public function history() {
        $checkouts = Checkout::all();
        return view('order.history', compact('checkouts'));
    }
}
