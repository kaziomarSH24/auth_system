<script>
  let _role = localStorage.getItem('user_role');
  if(_role && _role == 'user'){
   window.location.href = '/user/dashboard';
  }
</script>

<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>{{ config('app.name') }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/fontawesome-free/css/all.min.css">
  <!-- Toast -->
  <link rel="stylesheet" href="{{asset('backend')}}/plugins/toastr/toastr.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('backend')}}/dist/css/adminlte.min.css">

  <script>
    let _uri = window.location.hostname;
    let token = localStorage.getItem('user_token');

    if(window.location.pathname=="/api/login" || window.location.pathname == "/api/register"){

        if(token != null){
            window.location.href = '/api/admin/dashboard';
        }
    }else{
        if(token == null){
            window.location.href = '/api/login';
        }
    }


  </script>
  @stack('style')
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    @include('admin.partials.navbar')
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->

    @include('admin.partials.aside')

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

      @yield('ad-content')

    </div>


    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <div class="float-right d-none d-sm-block">
        <b>Version</b> 3.1.0
      </div>
      <strong>Copyright © 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="{{asset('backend')}}/plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="{{asset('backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="{{asset('backend')}}/dist/js/adminlte.min.js"></script>
  <!--Toastr-->
  <script src="{{asset('backend')}}/plugins/toastr/toastr.min.js"></script>
  <!--pusher-->
  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

  <script>
      Pusher.logToConsole = true;

      var pusher = new Pusher('dc510a09d5a66c2d6061', {
        cluster: 'ap2'
      });

      var channel = pusher.subscribe('UserRegistered');
      channel.bind('user.registered', function(data) {
        console.log('hello');
        toastr.success(`New user registered:  ${data.user.name} (${data.user.email}) at ${data.formattedTime}`);
        let count = parseInt($('#userCount').text()) + 1;
        $('#userCount').text(count);
        console.log(data);

      });
  </script>

  <script>
    $(document).ready(function(){
      let tabText = $('.nav-item a.active p').text().trim();
      $('.brcText').text(tabText);
    })
  </script>

  <script>
    $(document).ready(function(){
    let _token = 'Bearer ' + localStorage.getItem('user_token');
      $.ajax({
              url:"http://127.0.0.1:8000/api/profile",
              type:"GET",
              headers: {'Authorization' : _token },
              success:function(response){
                  console.log(response.data.role);

                  if(response.success == true){
                    if(response.data.role == 'user'){
                    window.location.href = '/user/dashboard';
                   }else{
                    console.log(response);
                    $('.userName').text(response.data.name)
                   }

                  }else {

                  }

              }
          });



      let successMessage = $('#success-message');
      if (successMessage.length) {
          setTimeout(function() {
              successMessage.fadeOut();
          }, 2000);
      }
  })
  </script>
  @stack('js')


</body>

</html>
