@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Add Division
			</div>
			<div class="card-body">
				<form action="{{ route('admin.division.store') }}" enctype="multipart/form-data" method="post">
					@csrf
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">Name</label>
						<input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter division name">
					</div>
					<div class="form-group">
						<label for="title">Priority</label>
						<input type="text" name="priority" class="form-control" id="priority" aria-describedby="emailHelp" placeholder="Enter division priority">
					</div>

					<button type="submit" class="btn btn-primary">Add Division</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
