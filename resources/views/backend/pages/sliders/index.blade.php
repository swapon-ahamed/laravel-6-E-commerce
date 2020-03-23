@extends('backend.layouts.master')

@section('content')
<div class="main-panel">
	<div class="content-wrapper">
		<div class="card">
			<div class="card-header">
				Manage Sliders
			</div>
			<div class="card-body">
				@include('backend.partials.message')

				<a href="#addSliderModal" data-toggle="modal" class="btn btn-info float-right mb-2">
					<i class="fa fa-plus"></i>Add New Slider
				</a>
				<div class="clearfix"></div>
				
				<!-- Slider Modal -->
				<div class="modal fade" id="addSliderModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
					<div class="modal-dialog" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLabel">Add New Slider</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<form  enctype="multipart/form-data" action="{!! route('admin.slider.store') !!}" method="post">
								@csrf	
								
								<div class="form-group">
								  <label for="slider-title">Slider Title</label>
								  <input type="text" name="title" class="form-control" id="slider-title" aria-describedby="sliderHelp" placeholder="Enter slider title">
								  <small id="sliderHelp" class="form-text text-muted"></small>
								</div>

								<div class="form-group">
								    <label for="">Image</label>
								    <input type="file" name="image" class="form-control-file" id="">
								  </div>


								<div class="form-group">
								  <label for="slider-button-text">Slider Button Text</label>
								  <input type="text" name="button_text" class="form-control" id="slider-button-text" aria-describedby="" placeholder="Enter slider button text">
								  <small id="" class="form-text text-muted"></small>
								</div> 

								<div class="form-group">
								  <label for="slider-button-link">Slider Button Link</label>
								  <input type="text" name="button_link" class="form-control" id="slider-button-link" aria-describedby="" placeholder="Enter slider button link">
								  <small id="" class="form-text text-muted"></small>
								</div> 

								<div class="form-group">
								  <label for="slider-button-link">Priority</label>
								  <input type="number" name="prioriy" class="form-control" id="slider-button-link" aria-describedby="" placeholder="10">
								  <small id="" class="form-text text-muted"></small>
								</div> 

								<button type="submit" class="btn btn-success">Add New</button>
								<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
								</form>
								
							</div>
							<div class="modal-footer">
								
								
							</div>
						</div>
					</div>
				</div>




				<table class="table table-hover table-stripe">
					<thead class="thead-dark">
						<tr>
							<th scope="col">#</th>
							<th scope="col">Slider Title</th>
							<th scope="col">Image</th>
							<th scope="col">Priority</th>
							
							<th scope="col">Actions</th>
						</tr>
					</thead>
					<tbody>
						@php $i = 1; @endphp
						@foreach($sliders as $slider)
						<tr>
							<th scope="row">{{ $i }}</th>
							<td>{{ $slider->title}}</td>
							<td><img src="{{ asset('images/sliders/'.$slider->image) }}" width="40"></td>
							<td>{{ $slider->prioriy}} </td>
		
							<td> <a class="btn btn-success" href="#editModal{{$slider->id}}"  data-toggle="modal" >Edit</a>
							<a class="btn btn-danger" href="#deleteModal{{ $slider->id}}" data-toggle="modal">Delete</a>
							

							<!-- edit Modal -->
							<div class="modal fade" id="editModal{{ $slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Edit Slide</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
										
										<form  enctype="multipart/form-data" action="{!! route('admin.slider.update', $slider->id) !!}" method="post">
										@csrf	
										
										<div class="form-group">
										  <label for="slider-title">Slider Title</label>
										  <input type="text" size="20" value="{{ $slider->title}}" name="title" class="" id="slider-title" aria-describedby="sliderHelp" placeholder="Enter slider title">
										  <small id="sliderHelp" class="form-text text-muted"></small>
										</div>

										<div class="form-group">
										    <label for="">Image</label>
										    <a href="{{ asset('images/sliders/'.$slider->image) }}">Previous Image</a>
										    <input type="file" name="image" class="form-control-file" id="">
										  </div>


										<div class="form-group">
										  <label for="slider-button-text">Slider Button Text</label>
										  <input type="text" size="20" value="{{ $slider->button_text}}" name="button_text" class="" id="slider-button-text" aria-describedby="" placeholder="Enter slider button text">
										  <small id="" class="form-text text-muted"></small>
										</div> 

										<div class="form-group">
										  <label for="slider-button-link">Slider Button Link</label>
										  <input type="text" value="{{ $slider->button_linke}}" name="button_link" size="20" class="" id="slider-button-link" aria-describedby="" placeholder="Enter slider button link">
										  <small id="" class="form-text text-muted"></small>
										</div> 

										<div class="form-group">
										  <label for="slider-button-link">Priority</label>
										  <input type="number" size="20" value="{{ $slider->prioriy}}" name="prioriy" class="" id="slider-button-link" aria-describedby="" placeholder="10">
										  <small id="" class="form-text text-muted"></small>
										</div> 

										<button type="submit" class="btn btn-success">Save</button>
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
										</form>
											
										</div>
										<div class="modal-footer">
										</div>
									</div>
								</div>
							</div>


							<!-- Delete Modal -->
							<div class="modal fade" id="deleteModal{{ $slider->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
								<div class="modal-dialog" role="document">
									<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Are you sure to delete? </h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<form  action="{!! route('admin.slider.delete', $slider->id) !!}" method="post">
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
