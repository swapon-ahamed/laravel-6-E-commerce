@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Manage Brands
			</div>
			<div class="card-body">
				@include('backend.partials.message')
				<table class="table table-hover table-stripe">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Brand Name</th>
							<th scope="col">Brand Image</th>
							
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($brands as $brand)
						<tr>
							<th scope="row">{{ $i }}</th>
							<td>{{ $brand->name}}</td>
							<td> <img src="{{ asset('images/brands/'.$brand->image)}}" alt="" width="200"> </td>
		
							<td> <a class="btn btn-success" href="{{ route('admin.brand.edit',$brand->id) }}">Edit</a>
							<a class="btn btn-danger" href="#deleteModal{{ $brand->id}}" data-toggle="modal">Delete</a>
							
							<!-- Delete Modal -->
							<div class="modal fade" id="deleteModal{{ $brand->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Are you sure to delete? </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form  action="{!! route('admin.brand.delete', $brand->id) !!}" method="post">
											{{ csrf_field()}}	

											<button type="submit" class="btn btn-danger">Permanent Delete</button>
											</form>
											
										</div>
										<div class="modal-footer">
											
											<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
										</div>
									</div>
								</div>
							</div>

						</td>
						</tr>
						@php $i++ @endphp
						@endforeach
					</tbody>
				</table>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
