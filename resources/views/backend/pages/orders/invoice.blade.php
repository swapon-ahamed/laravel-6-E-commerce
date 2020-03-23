<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Invoice - {{ $order->id}}</title>
	<style>
		.content-wrapper{
			background: #fff;
		}
		.invoice-header{
			background: #f7f7f7;
			padding: 10px 20px 10px 20px;
			border-bottom: 1px solid gray;
		}
		.invoice-right-top h3 {
			padding-right: 20px;
			margin-top: 20px;
			color: #ec5d01;
			font-size: 50px !important;
			font-family: serif;
		}
		.invoice-left-top{
			border-left: 4px solid #ec5400;
			padding-left: 20px;
			padding-top: 20px;
		}
		.float-left{
			float: left; 
			width:50%; 
			height: 200px;
		}
		thead{
			background: #ec5d01;
			color: #FFF;
		}
		.authority h5{
			margin-top: -10px;
			color: #ec5401;
		}
		.thanks h4{
			color: #ec5401;
			font-size: 25px;
			font-weight: normal;
			font-family: serif;
			margin-top: 20px;
		}
		.site-address{
			line-height: 6px;
			font-weight: 300;
		}
	</style>
</head>
<body>
	
	<div class="content-wrapper">
		<div class="invoice-header">
			<div class="float-left site-logo" style="float: left; width:50%; height: 200px;">
				<img src="{{ asset('images/favicon.png')}}" width="100" alt="">
			</div>

			<div class="float-right site-address" style="float: right; width:50%">
				<h4>Ecommerce</h4>
				<p>House: #, Road: #, Nikunja-2, </p>
				<p>Email: <a href="mailto:info@example.com">info@example.com</a></p>
				<p>Phone: 880434343434</p>
			</div>
		</div>
		<div class="clearfix" style="clear: both;"></div>
		
		<div class="invoice-description">
			<div class="invoice-left-top float-left" >
				<h3>Invoice To</h3>
				<h3>{{ $order->name }}</h3>
				<div class="address">
					<p>
						<strong>Address:</strong>
						{{ $order->shipping_address }}
					</p>
					<p><strong>Phone: </strong>{{ $order->phone_no }}</p>
					<p><strong>Email: </strong><a href="mailto:{{ $order->email}}">{{ $order->email}}</a></p>
				</div>
			</div>
			<div class="invoice-right-top float-right">
				<h3>Invoice # {{ $order->id }} </h3>
				<p>{{ $order->created_at }}</p>
			</div>
			<div class="clearfix" style="clear: both;"></div>
		</div>


		<div class="">
				<h3>Products </h3>
				@if($order->carts->count() > 0)
				<table class="table">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Title</th>
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

							{{ $cart->product_quantity }}
							</td>
							<td>{{ $cart->product->price }} Taka</td>
							@php
							$total_amount += $cart->product->price *  $cart->product_quantity;
							@endphp
							<td>{{ $cart->product->price *  $cart->product_quantity }} Taka</td>
							<td>
							</td>
						</tr>
						@endforeach

						<tr>
							<td colspan="3"></td>
							<td> <strong>Discount:</strong> </td>
							<td> {{ $order->custom_discount }} Tk.</td>

						</tr>

						<tr>
							<td colspan="3"></td>
							<td> <strong>Shipping Charge :</strong> </td>
							<td> {{ $order->shipping_cost }} Tk.</td>

						</tr>

						<tr>
							<td colspan="3"></td>
							<td> <strong>Total Price: </strong> </td>
							<td> {{ $total_amount  +  $order->shipping_cost - $order->custom_discount }} Tk.</td>

						</tr>
					</tbody>
				</table> 

				@endif
				<div class="thanks mt-3" style="float: left">
					<h4>Thank you for your business !!</h4>
				</div>
				<div class="authority" style="float: right;">
					<p>-------------------------------------------</p>
					<h5>Authority Signature</h5>

				</div>
				<div style="clear:both;"></div>
			</div>
</body>
</html>