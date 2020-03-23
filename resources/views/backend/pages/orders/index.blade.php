@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Manage Orders
			</div>
			<div class="card-body">
				@include('backend.partials.message')
				<table id="dataTable" class="table table-hover table-stripe">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Order ID</th>
							<th scope="col">Orderer Name</th>
							<th scope="col">Orderer Pnone No.</th>
							<th scope="col">Order  Status</th>
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						
						@foreach($orders as $order)
						<tr>
							<th scope="row">{{ $loop->index + 1 }}</th>
							<td>OrderId#{{ $order->id}}</td>
							<td>{{ $order->name}}</td>
							<td>{{ $order->phone_no}}</td>
							<td>
							<p>
							@if($order->is_seen_by_admin)
								<button type="button" class="btn btn-success btn-sm">Seen</button>
							@else
								<button type="button" class="btn btn-warning btn-sm">Unseen</button>
							@endif	
							</p>
							<p>
							@if($order->is_completed)
								<button type="button" class="btn btn-success btn-sm">Completed</button>
							@else
								<button type="button" class="btn btn-warning btn-sm">Not Completed</button>
							@endif	
							</p>
							<p>
								@if($order->is_paid)
									<button type="button" class="btn btn-success btn-sm">Paid</button>
								@else
									<button type="button" class="btn btn-danger btn-sm">Unpaid</button>
								@endif
							</p>	

							</td>
							<td>

								<a class="btn btn-info" href="{{ route('admin.order.show', $order->id)}}" >View Order</a>

								<a class="btn btn-danger" href="#deleteModal{{ $order->id}}" data-toggle="modal">Delete</a>
							</td>
							
							<!-- Delete Modal -->
							<div class="modal fade" id="deleteModal{{ $order->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Are you sure to delete? </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form  action="{!! route('admin.order.delete', $order->id) !!}" method="post">
											@csrf

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
						
						@endforeach
					</tbody>
					<tfoot>
			            <tr>
			                <th>#</th>
			                <th>Order ID</th>
			                <th>Orderer Name</th>
			                <th>Orderer Pnone No.</th>
			                <th>Order  Status</th>
			                <th>Actions</th>
			            </tr>

			        </tfoot>
				</table>
			</div>
		</div>

	</div>
	<!-- page-body-wrapper ends -->
</div>
@endsection
