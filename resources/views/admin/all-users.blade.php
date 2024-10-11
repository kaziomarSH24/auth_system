@extends('admin.adminMaster')

@section('ad-content')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')


        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Users</h3>

                        <div class="card-tools">
                            <div class="input-group input-group-sm" style="width: 150px;">
                                <input type="text" name="table_search" class="form-control float-right"
                                    placeholder="Search">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>User Role</th>
                                    <th>Verified Status</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="userData">

                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function () {
        $.ajax({
        url: '/api/admin/all-users',
        method: 'GET',
        headers: {
          'Authorization': 'Bearer ' + localStorage.getItem('user_token')
        },
        success: function(response) {
          if(response.success == true){

            let userData = $('#userData');
            userData.empty(); 
            $.each(response.users, function(index, user) {
                console.log(user.role);
                
                let row = `<tr>
                    <td>${user.id}</td>
                    <td>${user.name}</td>
                    <td>${user.email}</td>
                    <td>
                        <div class="form-group" style="margin: 0">
                         <select class="form-control user-role" data-userId = "${user.id}">
                             <option ${user.role === 'user' ? 'selected' : ''}>User</option>
                             <option ${user.role === 'admin' ? 'selected' : ''}>Admin</option>
                         </select>
                        </div>
                    </td>
                    <td>${user.verified ? 'Verified' : 'Not Verified'}</td>
                    <td>${user.date}</td>
                </tr>`;
                userData.append(row); 

            });
          }else{
            console.log('NO DATA FOUND!');
            
          }
        },
        error: function(xhr) {
          console.error(xhr.responseText);
        }
      });


    //change user role :)
    $(document).on('change', '.user-role', function() {
        let userId = $(this).data('userid');
        let newRole = $(this).val();
        
        console.log(userId);
        
        let confirmation = confirm("Are you sure you want to change this user's role to " + newRole + "?");
        
        if(newRole == 'Admin'){
            newRole = 'admin';
        }else{
            newRole = 'user'
        }
        if (confirmation) {

            $.ajax({
                url: '/api/admin/users/' + userId + '/role',
                method: 'PUT',
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
                },
                data: { role: newRole },
                success: function(response) {
                    if(response.success == true){
                        toastr.success(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating role:', error);
                    alert('Failed to update user role.');
                }
            });
        } else {
            $(this).val($(this).find('option[selected]').val()); 
        }
    });

    });
</script>
@endpush