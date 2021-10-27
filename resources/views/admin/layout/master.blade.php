<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="description" content="PRNEWSLAND Admin.">
    <meta name="author" content="ThemePixels">

    <title>PRNEWSLAND</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="{{ asset('admin/theme/lib/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/theme/lib/Ionicons/css/ionicons.css') }}" rel="stylesheet">
    <link href="{{ asset('global/plugins/select2/css/select2.min.css') }}" rel="stylesheet">
    @yield('css')
    <link href="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/theme-default.min.css" rel="stylesheet"/>
    <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote-bs4.css" rel="stylesheet">
    <link href="{{ asset('global/plugins/dropify/css/dropify.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/theme/css/slim.css') }}">
</head>
<body>
<!-- slim-header -->

@include('admin.layout.partials.header')
@include('admin.layout.partials.navbar')
<div class="slim-mainpanel">
    <div class="container">
        @yield('content')
    </div>
</div>
@include('admin.layout.partials.footer')

<script src="{{ asset('admin/theme/lib/jquery.js') }}"></script>
<script src="{{ asset('admin/theme/lib/popper.js') }}"></script>
<script src="{{ asset('admin/theme/lib/bootstrap/js/bootstrap.js') }}"></script>
<script src="{{ asset('global/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('global/plugins/summernote/summernote-bs4.js') }}"></script>
<script src="{{ asset('global/plugins/dropify/js/dropify.min.js') }}" type="text/javascript"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
<script type="text/javascript">
    var $app_url = "{{ url('/') }}";
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('footer_scripts')
<script src="{{ asset('admin/js/global.js') }}"></script>
</body>
</html>
