@extends('auth.authMaster')

@section('auth')
<div class="login-box">
    <div class="login-logo">
      <a href="javascript:void(0)"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in to start your session</p>
  
        <form id="login_form">
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
        <p class="mb-1">
          <a href="{{route('auth.forgerPass')}}">I forgot my password</a>
        </p>
        <p class="mb-0">
          <a href="{{url('api/register')}}" class="text-center">Register a new membership</a>
        </p>
      </div>
      <ul id="msg" style="color: rgb(236, 8, 149)"></ul>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
@endsection

@push('js')
<script>
    $(document).ready(function(){
      console.log(_uri);
      
        $('#login_form').submit(function(event){
            event.preventDefault();
            $('#msg').empty()
            let email = $('input[type="email"]').val();
            let password = $('input[type="password"]').val();
            
            console.log(email);
            
            $.ajax({
                url: "/api/login",
                type:"POST",
                data: {
                    email: email,
                    password: password
                   },
                success:function(response){
                    console.log(response);
                    if(response.success == false){
                        $('#msg').append('<li>' + response.msg + '</li>')
                        
                    }else if (response.success == true){
                        localStorage.setItem("user_token",response.access_token)
                        console.log(response.user.email_verified_at);
                        
                        if(response.user.email_verified_at == null){
                          toastr.warning("Logged in successfully. Please verify your email!");

                          setTimeout(() => {
                            window.location.href = '/api/email/verify?email=' + encodeURIComponent(response.user.email);
                          }, 3000);
                          
                        }else{
                          toastr.success("Logged in successfully.");
                          setTimeout(() => {
                            window.location.href = response.redirect; 
                          }, 3000);
                          
                        }
                       
                    }else{
                        printErrMsg(response)
                    }
                }
            });

            function printErrMsg(msg){
                $.each(msg,function(key, value){
                    console.log(value);
                    
                    $('#msg').append('<li>' + value + '</li>');
                })
            }
            
        })
    })
  </script>
@endpush







{{-- @section('content')




<div class="row d-flex justify-content-center">
    <div class="col-md-6 ">
        <div class="card mt-5">
            <div class="card-body">
                <h5 class="card-title text-center">Login Form</h5>
                <form id="login_form">
                    <div class="mb-3">
                      <label for="inputEmail" class="form-label">Email address</label>
                      <input type="email" name="email" class="form-control" id="inputEmail" >
                    </div>
                    <div class="mb-3">
                      <label for="inputPassword" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="inputPassword">
                    </div>
                    <div class="d-flex justify-content-between">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                        <p>Don't have an account. <a href="/register">Registation here?</a></p>
                    </div>
                    <ul id="msg" style="color: rgb(236, 8, 149)"></ul>
                  </form>
            </div>
          </div>
    </div>
</div>



  
@endsection --}}