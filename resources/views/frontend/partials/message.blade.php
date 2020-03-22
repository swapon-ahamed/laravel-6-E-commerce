<div class="text-center mt-2">
@if ($errors->any())
	<div class="alert alert-danger">
	<a href="#" class="close" data-dismiss="alert" aria-label="Close">&times;</a>
	@foreach ($errors->all() as $error)
		<p>{{ $error }}</p>
	@endforeach

	</div>
@endif

@if (Session::has('success') )
	<div class="alert alert-success">
		{{ Session::get('success') }}
	</div>
@endif

@if (Session::has('sticky_error') )
	<div class="alert alert-danger mt-2">
		{{ Session::get('sticky_error') }}
	</div>
@endif
</div>