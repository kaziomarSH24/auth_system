@extends('admin.adminMaster')
@section('ad-content')

<div class="content">
  @if(session('success'))
  <div class="alert alert-success">
    {{ session('success') }}
  </div>
  @endif
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      
      @include('admin.partials.breadcrumb')

      <div class="row">

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-success">
            <div class="inner">
              <h3 id="userCount">{{$userCount}}</h3>

              <p>User Registrations</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>

        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-info">
            <div class="inner">
              <h3>{{$itemCount}}</h3>

              <p>Total Post Item</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-paper"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-primary">
            <div class="inner">
              <h3>{{$approvedPosts}}</h3>

              <p>Approved Post Item</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-checkmark"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <!-- ./col -->
        <div class="col-lg-3 col-6">
          <!-- small box -->
          <div class="small-box bg-danger">
            <div class="inner">
              <h3>{{$unapprovedPosts}}</h3>

              <p>Unapproved Post Item</p>
            </div>
            <div class="icon">
              <i class="ion ion-ios-close"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->

      </div>
    </div><!-- /.container-fluid -->
  </div>
</div>
@endsection
@push('style')
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
@endpush

@push('js')

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
  // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('dc510a09d5a66c2d6061', {
      cluster: 'ap2'
    });

    var channel = pusher.subscribe('UserRegistered');
    channel.bind('user.registered', function(data) {
      toastr.success(`New user registered:  ${data.user.name} (${data.user.email}) at ${data.formattedTime}`);
      let count = parseInt($('#userCount').text()) + 1;
      $('#userCount').text(count);
      console.log(data);
      
    });
</script>
@endpush