<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $fillable = [
    	'user_id',
    	'name',
    	'ip_address',
    	'phone_no',
    	'shipping_address',
    	'message',
    	'email',
    	'is_paid',
    	'is_completed',
    	'is_seen_by_admin'
    ];

    public function user(){
    	$this->belongsTo(User::class);
    }

    public function carts(){
    	$this->belongsTo(Cart::class);
    }
}
