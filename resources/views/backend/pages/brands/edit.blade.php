@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Edit Brand
			</div>
			<div class="card-body">
				<form action="{{ route('admin.brand.update',$brand->id) }}" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">Brand Name</label>
						<input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{ $brand->name}}">
					</div>
					<div class="form-group">
						<label for="Description">Description</label>
						<textarea name="description" placeholder="Enter brand description" class="form-control">{!! $brand->name !!}</textarea>
					</div>

					<div class="form-group">
						<label for="Product Image">Old Image</label><br>
						<img src="{{ asset('images/brands/'.$brand->image)}}" alt="" width="200"><br>
						<label for="Product Image">New Image</label>
						<input type="file" name="image" class="form-control" id="image">
					</div>

					<button type="submit" class="btn btn-primary">Update Brabd</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
