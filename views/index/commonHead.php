<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Coupon</title>
    <!-- GOOGLE FONTS -->

    <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,700,300' rel='stylesheet' type='text/css'>
    <!-- CSS -->
    <link rel="stylesheet" type="text/css" href="libs/bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="libs/font-awesome/css/font-awesome.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/ribbons.css"/>
    <link rel="stylesheet" type="text/css" href="css/animations.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <link rel="stylesheet" type="text/css" href="css/responsive.css"/>
    <!-- FAVICON -->
    <link rel="icon" type="image/ico" href="media/images/fav/favicon.ico"/>
    <!-- JS -->
    <script type="text/javascript" src="libs/jquery/2.0/jquery_2.0.min.js"></script>
    <script type="text/javascript" src="libs/jquery/jquery_ui/jquery.ui.min.js"></script>
    <script type="text/javascript" src="libs/angular/angularJs.js"></script>

    <script type="text/javascript" src="js/modules/core/captcha/captcha.js"></script>
    <script type="text/javascript" src="libs/fileSaver/fileSaver.min.js"></script>
    <script type="text/javascript" src="js/modules/core/ngRoute/angular-routes.js"></script>
    <script type="text/javascript" src="libs/angular/ng-file-upload.min.js"></script>
    <script type="text/javascript" src="libs/angular/ng-file-upload-shim.min.js"></script>

    <!--CDN link for  TweenMax-->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/TweenMax.min.js"></script>
    <!-- CORE MODULE -->
    <script type="text/javascript" src="js/modules/core/core.js"></script>
    <script type="text/javascript" src="js/modules/core/http/httpServices.js"></script>
    <!-- APP MODULE -->
    <script type="text/javascript" src="js/modules/app/app.js"></script>
    <script type="text/javascript" src="js/modules/app/controllers/loginController.js"></script>
    <script type="text/javascript" src="js/modules/app/controllers/couponController.js"></script>
    <script type="text/javascript" src="js/modules/app/controllers/excelController.js"></script>
    <script type="text/javascript" src="js/modules/app/controllers/backendController.js"></script>
   

</head>
<body ng-app="app">


    <nav ng-show="admin " class="navbar navbar-default topnav text-center" style="margin-bottom: 30px;">
        <div class="container">
           <!--img id="Logo" src="media/images/logo_small.png" />
            <div class="clearfix"></div>
        </div-->
    </nav>
