<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from miles.tortoizthemes.com/live-final/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Jul 2021 16:01:45 GMT -->
<head>
    <meta charset="UTF-8">
    <title>{{ $meta['meta_title'] ?? "Free Press Release Submission with PRNews Land" }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{ $meta['meta_description'] ?? "PRNews Land Helps you to reach and engage with target audiences across the globe with notable increased online visibility." }}"/>
    <meta name="author" content="shail">
    <meta name="keywords" content="{{ $meta['meta_keyword'] ?? "" }}"/>
    <link rel="icon" href="{{ url('front/images/favicon.png') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('front/assets/css/main.min.css') }}">
    @yield('css')
    @yield('schema')
</head>
<body>
<div class="wrapper">
    @include('front.layout.partials.header')
    @yield('content')
    @include('front.layout.partials.footer')
    <script src="{{ asset('front/assets/js/bundle.min.js') }}"></script>
@yield('footer_scripts')
</body>
<!-- Mirrored from miles.tortoizthemes.com/live-final/ by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 12 Jul 2021 16:02:21 GMT -->
</html>
