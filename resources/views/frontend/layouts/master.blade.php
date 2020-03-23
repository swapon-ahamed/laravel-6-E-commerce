<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title> @yield('title', 'Laravel Ecommerce')</title>
    @include('frontend.partials.styles')
</head>
<body>
  <div class="wrapper">
    @include("frontend.partials.nav")
    @include("frontend.partials.message")

    @yield('content')
    @include('frontend.partials.footer')
  </div>
  @include('frontend.partials.scripts')

  @yield('scripts')
</body>
</html>