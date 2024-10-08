<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Toast -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/toastr/toastr.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend')}}/dist/css/adminlte.min.css">
  
  <script>
    let _uri = window.location.hostname;
    let _pathname = window.location.pathname;
    let token = localStorage.getItem('user_token');
  
    if(_pathname=="/api/login" || _pathname == "/api/register" || _pathname == "/api/forget-password" || _pathname == '/reset-password'){
        
        if(token != null){
            window.location.href = '/profile/data'; 
        }
    }else{
        if(token == null){
            window.location.href = '/api/login'; 
        }
    }
  
    
  </script>
</head>
<body class="hold-transition login-page">
@yield('auth')

<!-- jQuery -->
<script src="{{asset('backend')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('backend')}}/dist/js/adminlte.min.js"></script>

<script src="{{asset('backend')}}/plugins/toastr/toastr.min.js"></script>
@stack('js')
</body>
</html>