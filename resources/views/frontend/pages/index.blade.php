@extends('frontend.layouts.master')
@section('content')
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