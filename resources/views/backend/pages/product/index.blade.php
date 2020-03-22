@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Manage Products
			</div>
			<div class="card-body">
				@include('backend.partials.message')
				<table class="table table-hover table-stripe">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Title</th>
							<th scope="col">Price</th>
							<th scope="col">Quantity</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($products as $product)
						<tr>
							<th scope="row">{{ $i }}</th>
							<td>{{ $product->title}}</td>
							<td>{{ $product->price}}</td>
							<td>{{ $product->quantity}}</td>
							<td> <a class="btn btn-success" href="{{ route('admin.product.edit',$product->id) }}">Edit</a>
							<a class="btn btn-danger" href="#deleteModal{{ $product->id}}" data-toggle="modal">Delete</a>
							
							<!-- Delete Modal -->
							<div class="modal fade" id="deleteModal{{ $product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Are you sure to delete? </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form  action="{!! route('admin.product.delete', $product->id) !!}" method="post">
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
