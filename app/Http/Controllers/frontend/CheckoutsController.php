<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Payment;
use App\Models\Order;
use App\Models\Cart;
use Auth;

class CheckoutsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        // payment method
        $payments =  Payment::OrderBy('priority', 'asc')->get(); 
       return view('frontend.pages.checkouts', compact('payments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,
            [
                'name' => 'required',
                'phone_no' => 'required',
                'shippint_address' => 'required',
                'payment_method_id' => 'required'
            ]
        );

        $order = new Order;

        if($request->payment_method_id != 'cash_in'){
            if($request->transaction_id == NULL || empty($request->transaction_id)){
                session()->flash('sticky_error', 'Please give your transaction ID to complete your payment.');
                return back();
            }
            
        }

        $order->name = $request->name;
        $order->email = $request->email;
        $order->phone_no = $request->phone_no;
        $order->shipping_address = $request->shippint_address;
        $order->message = $request->message;
        $order->ip_address = request()->ip();
        $order->transaction_id = $request->transaction_id;

        if(Auth::check()){
            $order->user_id = Auth::id();
        }

        $order->payment_id = Payment::where('short_name', $request->payment_method_id)->first()->id; 
        $order->save();

        // $cart = new Cart();
        foreach (Cart::totalCarts() as $cart) {
           $cart->order_id = $order->id;
           $cart->save();
        }

        session()->flash('success', 'Your order completed. We will contact with you within two or three business days.');
        return redirect()->route('index');

    }

    
}
