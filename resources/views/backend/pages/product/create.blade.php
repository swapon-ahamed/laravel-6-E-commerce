@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Add Product
			</div>
			<div class="card-body">
				<form action="{{ route('admin.product.store') }}" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">Title</label>
						<input type="text" name="title" class="form-control" id="title" aria-describedby="emailHelp" placeholder="Title">
					</div>
					<div class="form-group">
						<label for="exampleInputPassword1">Description</label>
						<textarea name="description" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="Price">Price</label>
						<input type="number" name="price" class="form-control" id="price" aria-describedby="emailHelp" placeholder="Price">
					</div>

					<div class="form-group">
						<label for="quantity">Quantity</label>
						<input type="number" name="quantity" class="form-control" id="quantity" aria-describedby="emailHelp" placeholder="Quantity">
					</div>

					<div class="form-group">
						<label for="quantity">Category</label>
						<select name="category_id" class="form-control">
							<option value="">Please Select Product Category</option>
							@foreach(App\Models\Category::orderBy('name', 'asc' )->where('parent_id', NULL)->get() as $parent )
								<option value="{{ $parent->id}}"> {{ $parent->name}}</option>

								@foreach(App\Models\Category::orderBy('name', 'asc' )->where('parent_id', $parent->id)->get() as $child )
									<option value="{{ $child->id}}"> --- {{ $child->name}}</option>
								@endforeach


							@endforeach
						</select>
					</div>

					<div class="form-group">
						<label for="quantity">Brand</label>
						<select name="brand_id" class="form-control">
							<option value="">Please Select Brand</option>
							@foreach(App\Models\Brand::orderBy('name', 'asc' )->get() as $brand )
								<option value="{{ $brand->id}}"> {{ $brand->name}}</option>
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

					<button type="submit" class="btn btn-primary">Add Product</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
