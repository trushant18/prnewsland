<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="shortcut icon" href="{{ url('user/images/favicon.ico') }}" />
    <title>PRNewsland | Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link rel="stylesheet" href="{{ asset('user/assets/icons/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('user/assets/css/style.css') }}">
    @yield('css')
</head>
<body>
<div class="container-scroller">
    <!-- topNav -->
    @include('user.layout.partials.header')
    <!-- /topNav -->
    <div class="container-fluid page-body-wrapper">
        <!-- sideNav -->
        @include('user.layout.partials.sidebar')
        <!-- /sideNav -->
        <div class="main-panel">
            @yield('content')
            <!-- footer -->
            @include('user.layout.partials.footer')
            <!-- /footer -->
        </div>
    </div>
</div>
<script src="{{ asset('user/assets/js/base.js') }}"></script>
<script src="{{ asset('user/assets/js/off-canvas.js') }}"></script>
<script src="{{ asset('user/assets/js/hoverable-collapse.js') }}"></script>
<script src="{{ asset('user/assets/js/misc.js') }}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
    $.validate({
        scrollToTopOnError: false,
        modules: 'security'
    });
</script>
<script type="text/javascript">
    var $app_url = "{{ url('/') }}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('footer_scripts')
</body>
</html>
