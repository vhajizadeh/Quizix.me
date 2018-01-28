<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>@yield('pagetitle')</title>

      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

      <!-- Bootstrap -->
      <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
      <!-- font Awesome -->
      <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
      <!-- Google Font -->
      <link href='//fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
      <!-- Theme style -->
      <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />
      <!-- Summernote -->
      <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->

      
      
      @stack('styles')

   </head>
   <body class="skin-black">
      @include('admin.include.header')
      <div class="wrapper row-offcanvas row-offcanvas-left">
         <!-- Left side column. contains the logo and sidebar -->
         @include('admin.include.sidebar')
         <aside class="right-side">
            <!-- Main content -->
            <section class="content">
              @yield('content')
            </section>
            <!-- /.content -->
            @include('admin.include.footer')
         </aside>
         <!-- /.right-side -->
      </div>
      <!-- ./wrapper -->
      <!-- jQuery 2.0.2 -->
      <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
      <script src="{{ asset('assets/js/jquery.min.js') }}" type="text/javascript"></script>
      <!-- jQuery UI 1.10.3 -->
      <script src="{{ asset('assets/js/jquery-ui-1.10.3.min.js') }}" type="text/javascript"></script>
      <!-- Bootstrap -->
      <script src="{{ asset('assets/js/bootstrap.min.js') }}" type="text/javascript"></script>
      <!-- Director App -->
      <script src="{{ asset('assets/js/Director/app.js') }}" type="text/javascript"></script>
      <!--  Notifications Plugin    -->
      <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>
      <!-- Summernote -->
      <script src="{{ asset('assets/js/summernote.js') }}"></script>
      <!-- Custom Script -->  
      <script src="{{ asset('assets/js/custom.js') }}"></script>

      <script>
         $(document).ready(function() {
            $('.input-editor').summernote({
               toolbar: [
                  ['font', ['superscript', 'subscript']],
               ]
            });
         });
      </script>

      @stack('scripts')

   </body>
</html>