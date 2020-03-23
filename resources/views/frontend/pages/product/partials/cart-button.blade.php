<form method="post" class="form-inline" action="{{ route('carts.store')}}" >
	@csrf
	<input type="hidden" name="product_id" value="{{ $product->id }}">
	<button type="button" class="btn btn-warning" onclick="addToCart({{ $product->id }})"> <i class="fa fa-plus"></i> Add to Cart</button>
</form>