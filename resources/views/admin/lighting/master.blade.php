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

        <title>@yield('title') - CMS Webshop</title>
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="Admin dashboard - Tedozi CMS" name="description"/>
        <meta content="duyphan.developer@gmail.com" name="author"/>

        <!-- css -->
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <!-- Bootstrap -->
        <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
        <!-- bootstrap-progressbar -->
        <link href="../vendors/bootstrap-progressbar/css/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet">
        
        <!-- Custom Theme Style -->
        <link href="../build/css/custom.min.css" rel="stylesheet">
        <!-- end css -->

        <!-- OTHER PLUGINS -->
        @yield('css')
        <!-- END OTHER PLUGINS -->
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                @include('themes/default/partials/left')
                @include('themes/default/partials/header')
                <div class="right_col" role="main">
                 @yield('content')
             </div>
             @include('themes/default/partials/footer')
         </div>
     </div>

     <!-- OTHER PLUGINS -->
     @yield('js')
     <!-- END OTHER PLUGINS -->

     <!-- JS INIT -->
     @yield('js-init')
     <!-- JS INIT -->

     @include('themes/default/partials/_flash-messages')
 </body>
 </html>