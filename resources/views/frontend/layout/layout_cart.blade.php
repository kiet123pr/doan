<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Document</title>
    <link href="{{asset('frontend/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/responsive.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('frontend/rate.css')}}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="{{asset('frontend/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/price-range.js')}}"></script>
    <script src="{{asset('frontend/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/main.js')}}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body>
    @include('frontend.layout.header')
    @include('frontend.layout.slide')
    @yield('section')
    @include('frontend.layout.footer')
</body>

</html>