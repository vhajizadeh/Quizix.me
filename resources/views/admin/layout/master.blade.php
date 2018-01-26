<!DOCTYPE html>
<html>
   <head>
      <meta charset="UTF-8">
      <title>@yield('pagetitle')</title>

      <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

      <!-- bootstrap 3.0.2 -->
      <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
      <!-- font Awesome -->
      <link href="{{ asset('assets/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
      <!-- Ionicons -->
      <link href="{{ asset('assets/css/ionicons.min.css') }}" rel="stylesheet" type="text/css" />
      <!-- Morris chart -->
      <link href="{{ asset('assets/css/morris/morris.css') }}" rel="stylesheet" type="text/css" />
      <!-- jvectormap -->
      <link href="{{ asset('assets/css/jvectormap/jquery-jvectormap-1.2.2.css') }}" rel="stylesheet" type="text/css" />
      <!-- Date Picker -->
      <link href="{{ asset('assets/css/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
      <!-- fullCalendar -->
      <!-- <link href="{{ asset('assets/css/fullcalendar/fullcalendar.css') }}" rel="stylesheet" type="text/css" /> -->
      <!-- Daterange picker -->
      <link href="{{ asset('assets/css/daterangepicker/daterangepicker-bs3.css') }}" rel="stylesheet" type="text/css" />
      <!-- iCheck for checkboxes and radio inputs -->
      <link href="{{ asset('assets/css/iCheck/all.css') }}" rel="stylesheet" type="text/css" />
      <!-- bootstrap wysihtml5 - text editor -->
      <!-- <link href="{{ asset('assets/css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}" rel="stylesheet" type="text/css" /> -->
      <link href='//fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
      <!-- Theme style -->
      <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet" type="text/css" />

      <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
      <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
      <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
      <![endif]-->

      <link href="//cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.css" rel="stylesheet">

      <link href="https://cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" rel="stylesheet">
      
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
      <!-- daterangepicker -->
      <script src="{{ asset('assets/js/plugins/daterangepicker/daterangepicker.js') }}" type="text/javascript"></script>
      <script src="{{ asset('assets/js/plugins/chart.js') }}" type="text/javascript"></script>
      <!-- datepicker
         <script src="{{ asset('assets/js/plugins/datepicker/bootstrap-datepicker.js') }}" type="text/javascript"></script>-->
      <!-- Bootstrap WYSIHTML5
         <script src="{{ asset('assets/js/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}" type="text/javascript"></script>-->
      <!-- iCheck -->
      <script src="{{ asset('assets/js/plugins/iCheck/icheck.min.js') }}" type="text/javascript"></script>
      <!-- calendar -->
      <script src="{{ asset('assets/js/plugins/fullcalendar/fullcalendar.js') }}" type="text/javascript"></script>
      <!-- Director App -->
      <script src="{{ asset('assets/js/Director/app.js') }}" type="text/javascript"></script>

      <!--  Notifications Plugin    -->
      <script src="{{ asset('assets/js/bootstrap-notify.js') }}"></script>

      <!-- Director dashboard demo (This is only for demo purposes) -->
      <script src="{{ asset('assets/js/Director/dashboard.js') }}" type="text/javascript"></script>

      <!-- include summernote css/js -->
      <script src="{{ asset('assets/js/summernote.js') }}"></script>

      <script src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>

      <script src="{{ asset('assets/js/custom.js') }}"></script>

      <script>
         $(document).ready(function() {
            $('.input-editor').summernote({
               toolbar: [
                  ['font', ['bold', 'italic', 'superscript', 'subscript']],
               ]
            });
         });
      </script>

      @stack('scripts')

   </body>
</html>