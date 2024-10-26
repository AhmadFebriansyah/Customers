<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>Sign In</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico')}}">
    
    
    <!-- Layout config Js -->
    <script src="{{asset('js/layout.js')}}"></script>
    {{-- <script src="{{asset('js/layout.js')}}"></script>         --}}
    
    
    <!-- Bootstrap Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap.min.css')}}">
    
    <!-- Icons Css -->
    <link rel="stylesheet" type="text/css" href="{{asset('css/icons.min.css')}}">
    <!-- App Css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/app.min.css')}}">
    <!-- custom Css-->
    <link rel="stylesheet" type="text/css" href="{{asset('css/custom.min.css')}}">

    <!-- Sweet Alert css-->
    <link rel="stylesheet" type="text/css" href="{{asset('libs/sweetalert2/sweetalert2.min.css')}}">
</head>
<body>
    
    <div class="auth-page-wrapper pt-5">
        @yield("content")
    </div>
    
    <script src="{{asset('libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>        
    
    <script src="{{asset('libs/simplebar/simplebar.min.js')}}"></script>        
    <script src="{{asset('libs/node-waves/waves.min.js')}}"></script>        
    <script src="{{asset('libs/feather-icons/feather.min.js')}}"></script>        
    <script src="{{asset('js/pages/plugins/lord-icon-2.1.0.js')}}"></script>        
    <script src="{{asset('js/plugins.js')}}"></script>        
    
    <!-- particles js -->
    <script src="{{asset('libs/particles.js/particles.js')}}"></script>        
    <!-- particles app js -->
    <script src="{{asset('js/pages/particles.app.js')}}"></script>        
    <!-- password-addon init -->
    <script src="{{asset('js/pages/form-validation.init.js')}}"></script>        
    <script src="{{asset('js/pages/passowrd-create.init.js')}}"></script>  

        <!-- Sweet Alerts js -->
    <script src="{{asset('libs/sweetalert2/sweetalert2.min.js')}}"></script>   

    <!-- Sweet alert init js-->
    <script src="{{asset('js/pages/sweetalerts.init.js')}}"></script>   
</body>
</html>