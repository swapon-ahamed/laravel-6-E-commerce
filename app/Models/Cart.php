<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;
use App\Models\Order;
use App\Models\Product;

class Cart extends Model
{
        public $fillable = [
    	'user_id',
    	'product_id',
    	'order_id',
    	'ip_address',
    	'product_quantity'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }

    public function order(){
    	return $this->belongsTo(Order::class);
    }

    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public static function totalItems(){
    	if(Auth::check()){
    		$carts = Cart::where('user_id', Auth::id())
    		->orWhere('ip_address', request()->ip())
    		->where('order_id', NULL)
    		->get();
    	}else{
    		$carts = Cart::where('ip_address', request()->ip())->where('order_id', NULL)
    				->get();

    	}

    	$total = 0;

    	foreach ($carts as $cart) {
    		$total += $cart->product_quantity;
    	}

    	return $total;
    }
    /**
	* Total cart items
	*@param return object 
    */
    public static function totalCarts(){
    	if(Auth::check()){
    		$carts = Cart::where('user_id', Auth::id())
            ->orWhere('ip_address', request()->ip())
    		->where('order_id', NULL)
    		->get();
    	}else{
    		$carts = Cart::where('ip_address', request()->ip())->where('order_id', NULL)
    				->get();

    	}

    	return $carts;
    }
}
