@extends('layouts.app')
@section('content')
<div class="content">

 
  @if(session('success'))
  <div class="alert alert-success">
      {{ session('success') }}
  </div>
@endif
  <div class=".verify container-fluid">
      <div class="row">
        <div class="card card-widget widget-user-2 shadow-sm">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-warning">
              <div class="widget-user-image">
                <img class="img-circle elevation-2" src="{{asset('backend')}}/dist/img/6132.jpg" alt="User Avatar">
              </div>
              <!-- /.widget-user-image -->
              <h3 class="userName widget-user-username"></h3>
              <h5 class="userRole widget-user-desc">User</h5>
            </div>
            <div class="card-footer p-0">
              <ul class="nav flex-column">
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Projects <span class="float-right badge bg-primary">31</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Tasks <span class="float-right badge bg-info">5</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Completed Projects <span class="float-right badge bg-success">12</span>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    Followers <span class="float-right badge bg-danger">842</span>
                  </a>
                </li>
              </ul>
            </div>
          </div>
        <!-- /.col-md-6 -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->

    
  </div>
@endsection

@push('js')
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
                    console.log(response);
                    $('.userName').text(response.data.name)
                    $('.userRole').text(response.data.role)
                   }
                  else {
                    $('.userName').text('User')
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
@endpush