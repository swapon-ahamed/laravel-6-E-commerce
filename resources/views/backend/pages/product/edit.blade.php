@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Edit Product
			</div>
			<div class="card-body">
				<form action="{{ route('admin.product.update',$product->id) }}" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" name="title" class="form-control" id="title" value="{{ $product->title}}">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Description</label>
						<textarea name="description" class="form-control">{{ $product->description}}</textarea>
					</div>

					<div class="form-group">
						<label for="Price">Price</label>
						<input type="number" name="price" value="{{ $product->price}}" class="form-control" id="price" >
					</div>

					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="number" name="quantity" class="form-control" id="quantity" value="{{ $product->quantity}}">
					</div>

					<div class="form-group">
						<label for="quantity">Category</label>
						<select name="category_id" class="form-control">
							<option value="">Please Select Product Category</option>
							@foreach(App\Models\Category::orderBy('name', 'asc' )->where('parent_id', NULL)->get() as $parent )
								<option value="{{ $parent->id}}"

									{{ $parent->id == $product->category->id ? "selected" : '' }}
									> {{ $parent->name}}</option>

								@foreach(App\Models\Category::orderBy('name', 'asc' )->where('parent_id', $parent->id)->get() as $child )
									<option value="{{ $child->id}}"

								{{ $child->id == $product->category->id ? "selected" : '' }}
								> --- {{ $child->name}}
									</option>
								@endforeach


							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="quantity">Brand</label>
						<select name="brand_id" class="form-control">
							<option value="">Please Select Brand</option>
							@foreach(App\Models\Brand::orderBy('name', 'asc' )->get() as $brnd )
								<option value="{{ $brnd->id}}" {{ $product->brand_id == $brnd->id ? 'selected': ''}} > {{ $brnd->name}}</option>
							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="Product Image">Product Image</label>
						
						<div class="row">
							<div class="col-md-4"><input type="file" name="product_image[]" class="form-control" id="product_image"></div>
						</div>
						<div class="row">
							<div class="col-md-4"><input type="file" name="product_image[]" class="form-control" id="product_image"></div>
						</div>
						<div class="row">
							<div class="col-md-4"><input type="file" name="product_image[]" class="form-control" id="product_image"></div>
						</div>
						<div class="row">
							<div class="col-md-4"><input type="file" name="product_image[]" class="form-control" id="product_image"></div>
						</div>

					</div>

					<button type="submit" class="btn btn-primary">Update Product</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
