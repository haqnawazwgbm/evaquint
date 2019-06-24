<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/bootstrap.css" rel="stylesheet">


    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,700,600,300' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,300,200,500,600,700,800,900' rel='stylesheet' type='text/css'/>
    <link href='http://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>

    <link href="/css/fonts/font-awesome-4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="/css/own/owl.carousel.css" rel="stylesheet">
    <link href="/css/own/owl.theme.css" rel="stylesheet">
    <link href="/css/jquery.bxslider.css" rel="stylesheet">
    <link href="/css/jquery.jscrollpane.css" rel="stylesheet">
    <link href="/css/minislide/flexslider.css" rel="stylesheet">
    <link href="/css/component.css" rel="stylesheet">
    <link href="/css/prettyPhoto.css" rel="stylesheet">
    <link href="/css/style_dir.css" rel="stylesheet">
    <link href="/css/responsive.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <script src="/js/jquery-1.10.2.js" type="text/javascript"></script>

    <!-- Scripts -->
    <script>
        window.Laravel = <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>
    <style>
        h3 {
             margin-top: 0px;
            }
        .main-wrapper {
            padding-top: 15%;
        }
    </style>
</head>
<body>
<div class="main-wrapper" id="bslide" style="height: 705px;">

        @yield('content')
</div>

    <!-- Scripts -->
    <script src="/js/app.js"></script>

</body>
</html>
