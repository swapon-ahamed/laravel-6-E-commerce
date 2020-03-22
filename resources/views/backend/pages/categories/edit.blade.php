@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Edit Category
			</div>
			<div class="card-body">
				<form action="{{ route('admin.categories.update',$category->id) }}" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">Category Name</label>
						<input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{ $category->name}}">
					</div>
					<div class="form-group">
						<label for="Description">Description</label>
						<textarea name="description" placeholder="Enter category description" class="form-control">{!! $category->name !!}</textarea>
					</div>

					<div class="form-group">
						<label for="Description">Parent Category</label>
						<select class="form-control" name="parent_id" id="parent_id">
						<option value="">Please Select Primary Category</option>	
						@foreach($main_categories as $cat)
						<option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected':'' }}> {{ $cat->name }}</option>
						@endforeach	
						</select>
					</div>

					<div class="form-group">
						<label for="Product Image">Old Image</label><br>
						<img src="{{ asset('images/categories/'.$category->image)}}" alt="" width="200"><br>
						<label for="Product Image">New Image</label>
						<input type="file" name="image" class="form-control" id="image">
					</div>

					<button type="submit" class="btn btn-primary">Update Category</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
