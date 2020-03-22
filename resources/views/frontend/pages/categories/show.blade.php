@extends('frontend.layouts.master')
@section('content')
<div class="cotainer margin-top-20">
    <div class="row">
        <div class="col-md-4">
          @include('frontend.partials.product-side-bar')
        </div>
        <div class="col-md-8">
            <div class="widget">
                <h3>All Products in <span class="badge badge-info">{{ $category->name }}</span> </h3>

                @php
                $products = $category->products()->paginate(3);
                @endphp
                    
                @if(count($products) > 0)
                    @include('frontend.pages.product.partials.all_products')
                @else
                    <div class="alert alert-warning">No product available.</div>
                @endif

                
                </div>
            </div>

            <div class="widget"></div>
        </div>
    </div>
</div>
@endsection