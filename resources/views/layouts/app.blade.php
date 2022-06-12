<!--
Developer info: 
=================
|---------------------------------------------------------|
| Name   | Ashik                                          |
| Skype  | ashikur551                                     |
| Phone  | +880 1731002123                                |
| Email  | ashikurashik.sc@gmail.com                      |
|---------------------------------------------------------|
-->

<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Admin | @yield('title')</title>
  @yield('link')
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
  <script type="text/javascript">
    const Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000,
      timerProgressBar: true,
      didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
      }
    })
  </script>
  <style type="text/css">
    .table thead tr th, tfoot tr th:first-letter{
      text-transform: capitalize;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div id="app">
  @if(Session::has('flash_success'))
    {!! session('flash_success') !!}
  @endif
  <div class="wrapper">
    @include('inc.navbar')
    @include('inc.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      @yield('content')
    </div>
    <!-- /.content-wrapper -->
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
    @include('inc.footer')
  </div>
  <!-- ./wrapper -->
</div>
<!-- REQUIRED SCRIPTS -->

@yield('script')
</body>
</html>
