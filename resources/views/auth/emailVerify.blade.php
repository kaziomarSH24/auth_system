@extends('auth.authMaster')

@section('auth')

<div id="non-verify" class="container-fluid mt-5">
    <div class="row">
        <div class="col-3"></div>
      <div class="col-6">
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Email Verification</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
              </button>
              {{-- <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                <i class="fas fa-times"></i>
              </button> --}}
            </div>
          </div>
          <div class="card-body" style="display: block;">
            Email is not Verify! Click here to verify your email.
          </div>
          <!-- /.card-body -->
          <div class="card-footer" style="display: block;">
            <div class="row ">
              <div class="col-md-6">
                <button data-id type="button" class="verify_mail btn btn-outline-primary btn-inline"><i class="fa fa-envelope"></i> Send a verification email</button>
                
              </div>
              <div class="col-md-3"></div>
              <div class="col-md-3">
                <button type="button" id="logout" class="btn btn-outline-danger btn-inline"><i class="fa fa-sign-out-alt"></i>Logout</button>
              </div>
            </div>
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      </div>
    </div>
  </div>
@endsection

@push('js')
    <script>
        $(document).ready(function(){
            //email verifaction
            let _token = 'Bearer ' + localStorage.getItem('user_token');
            $(document).on('click','.verify_mail',function(){
                let email = getQueryParam('email');
                $.ajax({
                url:"http://127.0.0.1:8000/api/send-verify-mail/"+email,
                type:"GET",
                headers: {'Authorization' : _token },
                success:function(response){
                    console.log(response);
                    
                    if(response.success == true){
                        toastr.success(response.msg);
                        
                    }else{
                        console.log("error");
                        
                    }
                }
            });
        });

        function getQueryParam(param) {
        let urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(param);
        }


       
        $(document).on('click', '#logout', function(e){
                let _token = 'Bearer ' + localStorage.getItem('user_token');
                console.log(_token);
                
                $.ajax({
                    url: "/api/logout",
                    type: "GET",
                    headers: {'Authorization' : _token },
                    success:function(data){
                        if(data.success == true){
                            localStorage.removeItem('user_token')
                            window.location.href = '/api/login'; 
                        }else{
                            alert(data.msg)
                        }
                        console.log(data);
                        
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
            })
            })
        })
    </script>
@endpush