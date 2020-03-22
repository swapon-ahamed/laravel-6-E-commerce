@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Edit District
			</div>
			<div class="card-body">
				<form action="{{ route('admin.district.update',$district->id) }}" enctype="multipart/form-data" method="post">
					{{ csrf_field() }}
					@include('backend.partials.message')
					<div class="form-group">
						<label for="title">District Name</label>
						<input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" value="{{ $district->name}}">
					</div>
					<div class="form-group">
						<label for="title">Division</label>
						<select class="form-control" name="division_id" id="division_id">
							<option value="">Please select division</option>
							@foreach ($divisions as $division)
								<option value="{{ $division->id }}"
								{{ $district->division->id == $division->id ? 'selected':'' }}

									>{{ $division->name }}</option>
							@endforeach
						</select>
					</div>

				

					<button type="submit" class="btn btn-primary">Update District</button>
				</form>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
