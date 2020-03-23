@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				View OrderId# {{ $order->id }}
			</div>
			<div class="card-body">
				@include('backend.partials.message')
				<div class="row">
					<div class="col-md-6 border-right">
						<h3>Order Information</h3>
						<p><strong>Order ID: </strong>{{ $order->id }}</p>
						<p><strong>Orderer Name: </strong>{{ $order->name }}</p>
						<p><strong>Orderer Pnone No:  </strong>{{ $order->phone_no }}</p>
						<p><strong>Shipping Address: </strong>{{ $order->shipping_address }}</p>
						<p><strong>Email: </strong>{{ $order->email }}</p>
						
					</div>
					<div class="col-md-6">
						<p><strong>Payment Method: </strong>{{ $order->payment->name }}</p>
						<p><strong>Message: </strong>{{ $order->message }}</p>
						<p><strong>Transaction ID: </strong>{{ $order->transaction_id }}</p>
						<p><strong>Date: </strong>{{ $order->created_at }}</p>
					</div>
					<hr/>
					<h3>Order Items</h3>
					@if($order->carts->count() > 0)
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

					    @foreach($order->carts as $cart)
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

					@endif
					
					<hr/>

					
					<form method="post" action="{{ route('admin.order.charge',$order->id ) }}" class="" style="display: inline-block !important;">
					@csrf
						<label for="">Shipping Cost</label>	
						<input type="number" id="shipping_cost" name="shipping_cost" value="{{ $order->shipping_cost }}">
						<br/>
						<label for="">Custom Discount</label>		
						<input type="number" id="custom_discount" value="{{ $order->custom_discount }}" name="custom_discount">	
						<br/>	
						<input type="submit" class="btn btn-success" value="Submit">	
					</form>

					<hr/>
					<form method="post" action="{{ route('admin.order.completed',$order->id ) }}" class="form-inline mr-2" style="display: inline-block !important;">
						@csrf
					@if($order->is_completed)	
						<input type="submit" class="btn btn-danger" value="Cancel Order">
					@else
						<input type="submit" class="btn btn-success" value="Coplete Order">
					@endif	
							
					<a href="{{ route('admin.order.invoice', $order->id)}}" class="btn btn-info ml-2">Generate Invoice</a>
					</form>

					<form method="post" action="{{ route('admin.order.paid',$order->id ) }}" class="form-inline" style="display: inline-block !important;">
						@csrf	
					@if($order->is_paid)	
						<input type="submit" class="btn btn-danger" value="Cancel Paymen Order">
					@else
						<input type="submit" class="btn btn-success" value="Paid Order">
					@endif		
						

					</form>
				</div>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
