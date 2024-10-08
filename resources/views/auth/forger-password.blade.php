@extends('auth.authMaster')

@section('auth')
<div class="login-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">You forgot your password? Here you can easily retrieve a new password.</p>

      <form id="form-forger-pass">
        <div class="input-group mb-3">
          <input id="email" type="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <p id="msg" style="color: rgb(236, 8, 149)"></p>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Request new password</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <p class="mt-3 mb-1">
        <a href="{{url('api/login')}}">Login</a>
      </p>
      <p class="mb-0">
        <a href="{{url('api/register')}}" class="text-center">Register a new membership</a>
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            $('#form-forger-pass').submit(function(e){
                e.preventDefault();
                let email = $('#email').val();
                $('#msg').empty();

                $.ajax({
                    url: '/api/forget-password',
                    type: 'POST',
                    data: {
                        email: email
                    },
                    success:function(response){
                        $('#form-forger-pass')[0].reset()
                        
                        if(response.success == true){
                            toastr.success(response.msg);
                        }else{
                            printErrMsg(response)
                        }
                    }
                })
            });
            function printErrMsg(msg){
                $.each(msg,function(key, value){
                    console.log(value);
                    
                    $('#msg').append('<li>' + value + '</li>');
                })
            }
        })
    </script>
@endpush