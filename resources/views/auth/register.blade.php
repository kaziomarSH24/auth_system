@extends('auth.authMaster')

@section('auth')
<div class="register-box">
    <div class="register-logo">
      <a href="javascript:void(0)"><b>Admin</b>LTE</a>
    </div>
  
    <div class="card">
      <div class="card-body register-card-body">
        <p class="login-box-msg">Register a new membership</p>
  
        <form id="register_form">
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="email" class="form-control" placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="pass" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="cpass" type="password" class="form-control" placeholder="Retype password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                <label for="agreeTerms">
                 I agree to the <a href="#">terms</a>
                </label>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Register</button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <a href="{{url('api/login')}}" class="text-center">I already have a membership</a>
        <ul id="msg" style="color: rgb(236, 8, 149)"></ul>
      </div>
      <!-- /.form-box -->
    </div><!-- /.card -->
  </div>
  <!-- /.register-box -->
@endsection

@push('js')
<script>
    $(document).ready(function(){
        $('#register_form').submit(function(event){
            event.preventDefault();
            $('#msg').empty()
            let name = $('input[type="text"]').val();
            let email = $('input[type="email"]').val();
            let pass = $('#pass').val();
            let cpass = $('#cpass').val();

            $.ajax({
                url:"http://127.0.0.1:8000/api/register",
                type:"POST",
                data: {
                    name:name,
                    email: email,
                    password: pass,
                    password_confirmation:cpass
                   },
                success:function(data){
                    console.log(data);
                    if(data.success == true){
                        $('#register_form')[0].reset()
                        toastr.success("Registation successfully. Please log in & verify your email first!");
            setTimeout(function() {
              window.location.href = '/api/login';
 
            }, 3000);
                    }else{
                        printErrMsg(data);
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




{{-- @extends('layouts.app')

@section('content')

<div class="row d-flex justify-content-center">
  <div class="col-md-6 ">
      <div class="card mt-5">
          <div class="card-body">
            <h5 class="card-title text-center">Registation Form</h5>
            <form id="register_form">  <div class="mb-3">
                  <label for="inputName" class="form-label">Name</label>
                  <input type="text" name="name" class="form-control" id="inputName">
                </div>
                <div class="mb-3">
                  <label for="inputEmail" class="form-label">Email address</label>
                  <input type="email" name="email" class="form-control" id="inputEmail" >
                </div>
                <div class="mb-3">
                  <label for="inputPassword" class="form-label">Password</label>
                  <input type="password" name="password" class="form-control" id="inputPassword">
                </div>
                <div class="mb-3">
                  <label for="inputConfirmPass" class="form-label">Confirm Password</label>
                  <input type="password" name="password_confirmation" class="form-control" id="inputConfirmPass">
                </div>
                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    <p>Alrady have an account. <a href="/login">Logni?</a></p>
                </div>
                <ul id="msg" style="color: rgb(236, 8, 149)"></ul>
              </form>
          </div>
        </div>
  </div>
</div>

  

 
@endsection --}}