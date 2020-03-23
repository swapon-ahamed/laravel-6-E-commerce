@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Edit Division
			</div>
			<div class="card-body">
				<form action="{{ route('admin.division.update',$division->id) }}" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">Division Name</label>
						<input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{ $division->name}}">
					</div>
					<div class="form-group">
						<label for="title">Priority</label>
						<input type="text" name="priority" class="form-control" id="priority" aria-describedby="emailHelp" value="{{ $division->priority}}">
					</div>

				

					<button type="submit" class="btn btn-primary">Update Division</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
