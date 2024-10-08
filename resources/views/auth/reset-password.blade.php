@extends('auth.authMaster')

@section('auth')
<div class="login-box">
    <div class="login-logo">
      <a href="javascript:void(0)"><b>Admin</b>LTE</a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
  
        <form id="reset-form">
          @csrf
          <input id='token' type="hidden" name="csrf_token" value="{{ csrf_token() }}">
          <div class="input-group mb-3">
            <input id="pass" type="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input id="cpass" type="password" class="form-control" placeholder="Confirm Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <p id="msg" style="color: rgb(236, 8, 149)"></p>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">Change password</button>
            </div>
            <!-- /.col -->
          </div>
        </form>
  
        <p class="mt-3 mb-1">
          <a href="{{url('api/login')}}">Login</a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection

@push('js')
    <script>
      $(document).ready(function(){
        $("#reset-form").submit(function(e){
          e.preventDefault()
          $("#msg").empty();
          let pass = $('#pass').val();
          let cpass = $('#cpass').val();
          let _token = $('#token').val();
          let id = {{$user->id}};
            console.log(_token);
            
          $.ajax({
            url: 'http://127.0.0.1:8000/reset-password',
            type:'POST',
            data: {
              "_token": _token,
              id: id,
              password: pass,
              password_confirmation: cpass
            },
            success:function(response){
              
              if(response.success == true){
                toastr.success(response.msg);
                $('#reset-form')[0].reset()
                setTimeout(() => {
                  window.location.href = '/api/login';
                }, 3000);
              }else{
                printErrMsg(response);
              }
            },
            error: function(xhr) {   
               console.log(xhr.responseJSON);
            }
        })
          function printErrMsg(msg){
                $.each(msg,function(key, value){
                    console.log(value);
                    $('#msg').append('<li>' + value + '</li>');
                })
            }
        });

      });
    </script>
@endpush