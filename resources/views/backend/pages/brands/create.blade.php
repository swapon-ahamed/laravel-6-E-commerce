@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Add Product
			</div>
			<div class="card-body">
				<form action="{{ route('admin.brand.store') }}" enctype="multipart/form-data" method="post">
					@csrf
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">Brand Name</label>
						<input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Brand name">
					</div>
					<div class="form-group">
						<label for="Description">Description</label>
						<textarea name="description" placeholder="Enter Brand description" class="form-control"></textarea>
					</div>

					<div class="form-group">
						<label for="Product Image">Image</label>
						<input type="file" name="image" class="form-control" id="image">
					</div>

					<button type="submit" class="btn btn-primary">Add Brand</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
