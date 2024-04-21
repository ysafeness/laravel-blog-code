<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$meta_description}}">
    <meta name="author" content="{{config('blog.author')}}">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>{{$title??config('blog.title')}}</title>
    <link rel="alternate" href="{{url('rss')}}" type="application/rss+xml" title="RSS Feed {{config('blog.title')}}">

    {{--Styles--}}
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    @yield('styles')
</head>
<body>
    @include('blog.partials.page-nav')

    @yield('page-header')

    @yield('content')
    
    @include('blog.partials.page-footer')

    {{--Scripts--}}
    <script src="{{asset('js/app.js')}}"></script>
    @yield('scripts')
</body>
</html>