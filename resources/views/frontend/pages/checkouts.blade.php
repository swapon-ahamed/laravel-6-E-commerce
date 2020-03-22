@extends('frontend.layouts.master')
@section('content')
<div class="container margin-top-20">
	<div class="card card-body">
		<h2>Confirm Items</h2>
		<hr>
		
		<div class="row">
			<div class="col-md-7 border-right">
				@foreach(App\Models\Cart::totalCarts() as $cart )
					<p>
						{{ $cart->product->title}} - 
						<strong>{{ $cart->product->price}} Taka </strong>
						{{ $cart->product_quantity }} - Items

					</p>
				@endforeach
			</div>

			<div class="col-md-5">
				@php
					$total_price = 0;
				@endphp

				@foreach(App\Models\Cart::totalCarts() as $cart )
					@php
						$total_price += $cart->product->price * $cart->product_quantity;
					@endphp

				@endforeach

				<p>
					Total Price: <strong>{{ $total_price }} Taka</strong>
				</p>
				<p>Total Price with shipping cost: <strong>{{ $total_price + App\Models\Setting::first()->shipping_cost }}</strong> Taka</p>
			</div>

		</div>

		<p>
			<a href="{{ route('carts')}}">Change Cart </a>
		</p>

	</div>

	<div class="card card-body mt-2">
		<h2>Shipping Address </h2>
		<hr>
		<form method="POST" action="{{ route('checkouts.store') }}">
		    @csrf

		    <div class="form-group row">
		        <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Reciever Name') }}</label>

		        <div class="col-md-6">
		            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::check() ? Auth::user()->first_name . ' '.Auth::user()->last_name :  '' }}" required autocomplete="name" autofocus>

		            @error('name')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		            @enderror
		        </div>
		    </div>

		    <div class="form-group row">
		        <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

		        <div class="col-md-6">
		            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::check() ? Auth::user()->email : '' }}" required autocomplete="email">

		            @error('email')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		            @enderror
		        </div>
		    </div>

		    <div class="form-group row">
		        <label for="phone_no" class="col-md-4 col-form-label text-md-right">{{ __('Phone No.') }}</label>

		        <div class="col-phone_no-6">
		            <input id="phone_no" type="text" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no" value="{{ Auth::check() ? Auth::user()->phone_no : '' }}" required autocomplete="phone_no">

		            @error('phone_no')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		            @enderror
		        </div>
		    </div>

		    <div class="form-group row ">
		        <label for="shippint_address" class="col-md-4 col-form-label text-md-right">{{ __('Shipping Address') }} </label>

		        <div class="col-shippint_address-6">
		            <textarea name="shippint_address" id="shippint_address" class="form-control @error('shippint_address') is-invalid @enderror" required autocomplete="shippint_address" >{{ Auth::check() ? Auth::user()->shippint_address : '' }}</textarea>

		            @error('shippint_address')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		            @enderror
		        </div>
		    </div>


		    <div class="form-group row ">
		        <label for="message" class="col-md-4 col-form-label text-md-right">{{ __('Additional Message') }} </label>

		        <div class="col-message-6">
		            <textarea name="message" id="message" class="form-control @error('message') is-invalid @enderror" autocomplete="message" ></textarea>

		            @error('message')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		            @enderror
		        </div>
		    </div>

			
		    <div class="form-group row">

		        <label for="payment_method" class="col-md-4 col-form-label text-md-right">{{ __('Select Payment Method') }}</label>

		        <div class="col-payment_method-6">

		            <select name="payment_method_id" id="payments" class="form-control @error('payment_method_id') is-invalid @enderror" required autocomplete="shippint_address">
		            	<option value="">Please Select Payment</option>
		            	@foreach($payments as $payment )
						<option value="{{ $payment->short_name }}">{{ $payment->name }}</option>
		            	@endforeach
		            </select>

		            @error('payment_method')
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $message }}</strong>
		            </span>
		            @enderror
		        </div>
		    </div>

			@foreach($payments as $payment )
				@if( $payment->short_name == 'cash_in')
				<div id="payments-{{ $payment->short_name }}" class=" alert alert-success text-center hidden">		
					<h3>For cash on delivery, just order now.</h3>					
				</div>
				@else
				
				<div class="row">
					<duv class="col-md-4"></duv>
					<div class="col-md-4">
						<div id="payments-{{ $payment->short_name }}" class="alert alert-success hidden">
							<h3>{{ $payment->name}} Payment</h3>
							<br>
							<p>
								<strong>{{ $payment->name}} no: {{ $payment->no}}</strong>
								
								<br>
								<strong>Account Type: {{ $payment->type }}</strong>
							</p>
							<div class="alert alert-success">
								Please send the above money.
							</div>
							
						</div>
					</div>

					<duv class="col-md-4"></duv>
				</div>

				@endif
		    @endforeach

		    <input type="text" id="transaction_id" placeholder="Please enter Transacton code" name="transaction_id" class="form-control hidden">

		    <div class="form-group row mb-0">
		        <div class="col-md-6 offset-md-4">
		            <button type="submit" class="btn btn-primary">
		                {{ __('Order Now') }}
		            </button>
		        </div>
		    </div>
		</form>

	</div>

</div>

@endsection

@section('scripts')

<script  type="text/javascript" charset="utf-8">
	$("#payments").change(function(){
		var payment_method = $(this).val();
		if(payment_method == 'cash_in'){
			$("#payments-cash_in").removeClass('hidden');
			$("#payments-bkash").addClass('hidden');
			$("#payments-rocket").addClass('hidden');
			$("#transaction_id").addClass('hidden');
		}else if(payment_method == 'bkash'){
			$("#payments-cash_in").addClass('hidden');
			$("#payments-bkash").removeClass('hidden');
			$("#payments-rocket").addClass('hidden');
			$("#transaction_id").removeClass('hidden');
		}else if(payment_method == 'rocket'){
			$("#payments-cash_in").addClass('hidden');
			$("#payments-bkash").addClass('hidden');
			$("#payments-rocket").removeClass('hidden');
			$("#transaction_id").removeClass('hidden');
		}

	});
</script>

@endsection