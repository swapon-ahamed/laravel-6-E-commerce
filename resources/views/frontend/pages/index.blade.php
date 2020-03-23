@extends('frontend.layouts.master')
@section('content')

    <!-- slider -->
    <div class="main-slider mt-0">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators">
             @foreach($sliders as $slider)
            <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->index}}" class="{{ $loop->index == 0 ? 'active' : '' }}"></li>

             @endforeach
          </ol>
          <div class="carousel-inner">
            @foreach($sliders as $slider)
            <div class="carousel-item {{ $loop->index == 0 ? 'active' : '' }}">
              <img class="d-block w-100" src="{{ asset('images/sliders/'.$slider->image) }}" style="height:450px;" alt="{{ $slider->title }}">

              <div class="carousel-caption d-none d-md-block">
                  <h5>{{ $slider->title }}</h5>
                  @if( $slider->button_text)
                  <p>
                    <a class="btn btn-danger" href="{{ $slider->button_linke}}" target="_blank">{{ $slider->button_text }}</a>
                  </p>
                  @endif
                </div>
              
            </div>
            @endforeach
          </div>
          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
    </div>

<div class="cotainer margin-top-20">
    <div class="row">
        @include('frontend.partials.product-side-bar')
        <div class="col-md-8">
            <div class="widget">
                <h3>All Products</h3>
                @include('frontend.pages.product.partials.all_products')
            </div>

            <div class="widget"></div>
        </div>
    </div>
</div>
@endsection