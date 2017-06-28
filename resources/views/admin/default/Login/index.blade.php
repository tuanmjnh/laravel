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

    <title>{{$lang['title_heading'] or 'title_heading'}}</title>
    <meta name="_token" content="{{ csrf_token() }}">
    <meta content="Admin dashboard - Tedozi CMS" name="description"/>
    <meta content="duyphan.developer@gmail.com" name="author"/>

    <!-- css -->
    <!-- Bootstrap -->
    <link href="{{$asset_path}}vendors/bootstrap-3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{$asset_path}}vendors/font-awesome-4.6.3/css/font-awesome.min.css" rel="stylesheet">
    <!-- Login Theme Style -->
    <link href="{{$asset_theme}}css/login.css" rel="stylesheet">
    <!-- end css -->

</head>
<body>
<div class="message warning">
    <div class="inset">
        <div class="login-head">
            <h1>{{$lang['text_login'] or 'text_login'}}</h1>
        </div>
        {{--{!! Form::open(['route' => $route_form,'id'=>'login-form','novalidate'=>'','data-parsley-validate'=>'']) !!}--}}
        <form method="post" action="{{route($route_form)}}" id="login-form" novalidate data-parsley-validate>
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            @include('admin.common/flash_messages')
            @include('admin.common/flash_messages_session')
            <div class="TMAlert"></div>
            <div id="p-account" class="group-p item">
                <div class="form-item">
                    <label for="username" class="glyphicon glyphicon-user"></label>
                    <input type="text" id="username" name="username" class="text" required="required"
                           data-toggle="tooltip" data-placement="right"
                           title="{{$lang['entry_username'] or 'entry_username'}}"
                           placeholder="{{$lang['entry_username'] or 'entry_username'}}">
                </div>
            </div>
            <div class="clear"></div>
            <div id="p-password" class="group-p item">
                <div class="form-item">
                    <label for="password" class="glyphicon glyphicon-lock"></label>
                    <input type="password" id="password" name="password" required="required"
                           data-toggle="tooltip" data-placement="right"
                           title="{{$lang['entry_password'] or 'entry_password'}}"
                           placeholder="{{$lang['entry_password'] or 'entry_password'}}">
                </div>
            </div>
            <div class="clear"></div>
            <div class="remember">
                <label><input type="checkbox" name="remember" value="1">{{$lang['checkbox_remember'] or 'checkbox_remember'}}
                </label>
                <a href="#">{{$lang['text_forgot'] or 'text_forgot'}}</a>
            </div>
            <div class="clear"></div>
            <button id="login-submit" class="submit btn">{{$lang['button_login'] or 'button_login'}}</button>
        </form>
        {{--        {!! Form::close()  !!}--}}
    </div>
</div>
<div class="clear"></div>
<!--- footer --->
<div class="footer">
    <p><a href="">Webshop</a></p>
</div>

<!-- OTHER PLUGINS -->
<!-- jQuery -->
<script src="{{$asset_path}}vendors/jquery-2.2.4/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{$asset_path}}vendors/bootstrap-3.3.6/js/bootstrap.min.js"></script>
<!-- END OTHER PLUGINS -->
<!-- Custom Theme Scripts -->
<script src="{{$asset_theme}}js/extra.min.js"></script>
@include('admin/common/validator')
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
    })
    $(function () {
        $('[data-toggle="tooltip"]').tooltip()
    })
    {{--$.post({--}}
    {{--url: '{{route($auth)}}',--}}
    {{--data: '',--}}
    {{--success:function (d) {--}}
    {{--console.log(d);--}}
    {{--}--}}
    {{--});--}}
</script>
<!-- JS INIT -->
</body>
</html>