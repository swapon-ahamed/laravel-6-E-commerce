@extends('frontend.layouts.master')
@section('content')
<div class="container">
	<h2>My Cart Items</h2>
  @if( App\Models\Cart::totalItems() > 0)
    <table class="table">
  <thead class="thead-dark">
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Image</th>
      <th scope="col">Quantity</th>
      <th scope="col">Unit Price</th>
      <th scope="col">Sub Total Price</th>
      <th scope="col"></th>
      <th scope="col"></th>
    </tr>
  </thead>
  <tbody>
  @php
    $total_amount = 0;
  @endphp

    @foreach(App\Models\Cart::totalCarts() as $cart)
    <tr>
      <th scope="row">{{ $loop->index +1 }}</th>
      <td><a href="{!! route('products.show', $cart->product->slug) !!}">{{ $cart->product->title}}</a></td>
      <td>
        
        
    @if( count( $cart->product->images) >0 )

    <img src="{!! asset('images/products/'.$cart->product->images->first()->image) !!}" alt="" width="50px">

    @endif


      </td>
      <td>
        <form class="form-inline" method="post" action="{{ route('carts.update', $cart->id )}}" >
          @csrf
          <input type="text" name="product_quantity" class="form-control" value="{{ $cart->product_quantity }}">
          <button type="submit" class="btn btn-success ml-2">Update</button>
        </form>

      </td>
      <td>{{ $cart->product->price }} Taka</td>
      @php
        $total_amount += $cart->product->price *  $cart->product_quantity;
      @endphp
      <td>{{ $cart->product->price *  $cart->product_quantity }} Taka</td>
      <td>
        
        <form class="form-inline" method="post" action="{{ route('carts.delete', $cart->id )}}" >
          @csrf
          <button type="submit" class="btn btn-danger">Delete</button>
        </form>
      </td>
    </tr>
  @endforeach

  <tr>
    <td colspan="4"></td>
    <td> Total Price: </td>
    <td> {{ $total_amount }} Tk.</td>

  </tr>
  </tbody>
</table>  

<div class="float-right">
  <a href="{{ route('products') }}" class="btn btn-info btn-lg">Continue</a>
  <a href="{{ route('checkouts') }}" class="btn btn-warning btn-lg">Checkout</a>
</div>
  @else
  <div class="alert alert-warning">There is no items in your cart</div>
  <div class="float-right">
  <a href="{{ route('products') }}" class="btn btn-info btn-lg">Continue</a>
</div>
  @endif



</div>

@endsection