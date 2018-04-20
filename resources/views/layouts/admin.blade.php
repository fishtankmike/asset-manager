<!DOCTYPE html>
<html lang="no-js css-menubar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Chicopee Asset System</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">


  <!-- Stylesheets -->
  <link rel="stylesheet" href="/files/global/css/bootstrap.min.css">
 <link rel="stylesheet" href="/files/global/css/bootstrap-extend.min.css">
  <link rel="stylesheet" href="/files/css/site.min.css">

  <link rel="stylesheet" href="/files/global/vendor/animsition/animsition.css">
  <link rel="stylesheet" href="/files/global/vendor/asscrollable/asScrollable.css">
  <link rel="stylesheet" href="/files/global/vendor/switchery/switchery.css">
  <link rel="stylesheet" href="/files/global/vendor/intro-js/introjs.css">
  <link rel="stylesheet" href="/files/global/vendor/slidepanel/slidePanel.css">
  <link rel="stylesheet" href="/files/global/vendor/flag-icon-css/flag-icon.css">
  <link rel="stylesheet" href="/files/global/vendor/select2/select2.css">
  <link rel="stylesheet" href="/files/examples/css/apps/media.css">

  <link rel="stylesheet" href="/files/global/fonts/web-icons/web-icons.min.css">
  <link rel="stylesheet" href="/files/global/fonts/brand-icons/brand-icons.min.css">
  <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,300italic'>

     <script src="/files/global/vendor/modernizr/modernizr.js"></script>
  <script src="/files/global/vendor/breakpoints/breakpoints.js"></script>
  <script>
  Breakpoints();
  </script>


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body class="app-media">

  <!--[if lt IE 8]>
          <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
      <![endif]-->

  @extends('layouts.navadmin')


    @yield('content')

    <!-- JavaScripts -->
    <script src="/files/global/vendor/jquery/jquery.js"></script>
  <script src="/files/global/vendor/bootstrap/bootstrap.js"></script>
  <script src="/files/global/vendor/animsition/animsition.js"></script>
  <script src="/files/global/vendor/asscroll/jquery-asScroll.js"></script>
  <script src="/files/global/vendor/mousewheel/jquery.mousewheel.js"></script>
  <script src="/files/global/vendor/asscrollable/jquery.asScrollable.all.js"></script>
  <script src="/files/global/vendor/ashoverscroll/jquery-asHoverScroll.js"></script>
  <!-- Plugins -->
  <script src="/files/global/vendor/switchery/switchery.min.js"></script>
  <script src="/files/global/vendor/intro-js/intro.js"></script>
  <script src="/files/global/vendor/screenfull/screenfull.js"></script>
  <script src="/files/global/vendor/slidepanel/jquery-slidePanel.js"></script>
  <script src="/files/global/vendor/jquery-placeholder/jquery.placeholder.js"></script>
  <script src="/files/global/vendor/select2/select2.min.js"></script>
  <!-- Scripts -->
  <script src="/files/global/js/core.js"></script>
  <script src="/files/js/site.js"></script>
  <script src="/files/js/sections/menu.js"></script>
  <script src="/files/js/sections/menubar.js"></script>
  <script src="/files/js/sections/gridmenu.js"></script>
  <script src="/files/js/sections/sidebar.js"></script>
  <script src="/files/global/js/configs/config-colors.js"></script>
  <script src="/files/js/configs/config-tour.js"></script>
  <script src="/files/global/js/components/asscrollable.js"></script>
  <script src="/files/global/js/components/animsition.js"></script>
  <script src="/files/global/js/components/slidepanel.js"></script>
  <script src="/files/global/js/components/switchery.js"></script>
  <script src="/files/global/js/components/jquery-placeholder.js"></script>
  <script src="/files/global/js/components/select2.min.js"></script>
  <script>
  (function(document, window, $) {
    'use strict';
    var Site = window.Site;
    $(document).ready(function() {
      Site.run();
    });
  })(document, window, jQuery);
  </script>
    @stack('scripts')
</body>
</html>
