<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    
    <title>@section('title') Task Manager @show</title>

    @section('css')

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Raleway:300,400,500,700,800|Montserrat:300,400,700" rel="stylesheet">

      <!-- Bootstrap CSS File -->
      <link href="{{ asset('frontend/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">

      <!-- Libraries CSS Files -->
      <link href="{{ asset('frontend/vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/animate/animate.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/magnific-popup/magnific-popup.css') }}" rel="stylesheet">
      <link href="{{ asset('frontend/vendor/ionicons/css/ionicons.min.css') }}" rel="stylesheet">

      <!-- Main Stylesheet File -->
      <link href="{{ asset('frontend/css/style.css') }}" rel="stylesheet">

    @show
    @yield('head-js')

  </head>

  <body id="page-top">

    @section('topbar')
     
    @show

    @section('nav')
      <header id="header">
        <div class="container" id="body">

          <div id="logo" class="pull-left">
            <a href="/"><img style="width: 50px;" src="{{ asset('frontend/images/tasklogo.jpg') }}" alt="" title="" /></a>
			
          </div>
		<div id="logo" class="pull-right">
          <h3>Task Manager</h3>
        </div>
		</div>
      </header><!-- #header -->
    @show

    @section('intro')
    @show

    <main id="main">
      <section id="body" class="wow fadeInUp">
        <div class="container" style="min-height: 800px;">
          @yield('content')
        </div>
      </section>
    </main>
    
    @section('footer')
      <footer id="footer">
        <div class="container">
          <div class="copyright">
            &copy; Copyright <strong>TaskManager</strong>. All Rights Reserved
          </div>
        </div>
      </footer><!-- #footer -->

      <a href="#" class="back-to-top"><i class="fa fa-chevron-up"></i></a>
    @show

    @section('js')
      <!-- JavaScript Libraries -->
      <script src="{{ asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/jquery/jquery-migrate.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/easing/easing.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/superfish/hoverIntent.js')}}"></script>
      <script src="{{ asset('frontend/vendor/superfish/superfish.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/wow/wow.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/owlcarousel/owl.carousel.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/magnific-popup/magnific-popup.min.js')}}"></script>
      <script src="{{ asset('frontend/vendor/sticky/sticky.js')}}"></script>
      <!-- Template Main Javascript File -->
      <script src="{{ asset('frontend/js/main.js')}}"></script>
    @show
    @yield('post-js')
  </body>

</html>
