<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/images/logo/favicon.png"/>

    <title>@yield('title_heading')</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta content="Admin dashboard - Tedozi CMS" name="description"/>
    <meta content="duyphan.developer@gmail.com" name="author"/>

    <!-- css -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
    <!-- Bootstrap -->
    <link href="{{$asset_path}}vendors/bootstrap-3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{$asset_path}}vendors/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{$asset_path}}vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- iCheck -->
    <link href="{{$asset_path}}vendors/iCheck/skins/flat/green.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{$asset_theme}}css/custom.min.css" rel="stylesheet">
    <link href="{{$asset_theme}}css/extra.min.css" rel="stylesheet">
    <!-- end css -->

    <!-- OTHER PLUGINS -->
@yield('css')
<!-- END OTHER PLUGINS -->

</head>
<body class="nav-md">
<div class="container body">
    <div class="main_container">
        @include('admin.default/_partials/left')
        @include('admin.default/_partials/header')
        <div class="right_col" role="main">
            @include('admin.common/flash_messages')
            @include('admin.common/flash_messages_session')
            <div id="TMAlert"></div>
            @yield('content')
        </div>
        @include('admin.default/_partials/footer')
    </div>
</div>
{{--@include('vendor.flash.modal')--}}

<!-- jQuery -->
<script src="{{$asset_path}}vendors/jquery-2.2.4/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{$asset_path}}vendors/bootstrap-3.3.6/js/bootstrap.min.js"></script>
<!-- FastClick -->
<script src="{{$asset_path}}vendors/fastclick/lib/fastclick.js"></script>
<!-- NProgress -->
<script src="{{$asset_path}}vendors/nprogress/nprogress.js"></script>
<!-- iCheck -->
<script src="{{$asset_path}}vendors/iCheck/icheck.min.js"></script>
<!-- validator -->
<script src="{{$asset_path}}vendors/validator/validator.js"></script>
<!-- autocomplete -->
<script src="{{$asset_path}}vendors/jquery-autocomplete-devbridge/jquery.autocomplete.min.js"></script>
<!-- OTHER PLUGINS -->
@yield('js')
<!-- END OTHER PLUGINS -->

<!-- Custom Theme Scripts -->
<script src="{{$asset_theme}}js/custom.min.js"></script>
<script src="{{$asset_theme}}js/extra.min.js"></script>

<!-- JS INIT -->
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        },
//        async:true,
//        contentType:'application/x-www-form-urlencoded; charset=UTF-8',
//        crossDomain:false,
//        //dataType:Intelligent Guess (xml, json, script, or html),
//        global:true,
//        type:'GET',
//        url:'',
//        success:'',
//        error:'',
    });
    $(document).ajaxComplete(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
<script>
    $('.language-select').on('click', '.dropdown-menu li a', function () {
        var a = $(this);
        var ul = $(this).parents('.language-select');
        $.get({
            url: '{{route('admin.language.set-language')}}',
            data: {'language': a.attr('data-value')},
            success: function (rs) {
                window.location = window.location.href;
                //console.log(rs);
            }
        });
    });

</script>
@yield('js-init')
<!-- JS INIT -->

{{--     @include('default/_partials/_flash-messages')--}}

<script>
    $('#flash-overlay-modal').modal();
</script>
</body>
</html>