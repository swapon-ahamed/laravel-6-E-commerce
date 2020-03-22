@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card card-body">
			<h3>Welcome to Admin panel</h3>
			<br>
			<br>
			<br>
			<p><a href="{{route('index')}}" class="btn btn-primary btn-success" target="_blank">Visit Main Site</a></p>
		</div>
	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
