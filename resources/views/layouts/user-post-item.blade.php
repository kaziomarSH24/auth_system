@extends('layouts.app')

@section('content')
<div class="content-header">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Post Items</h3>
                        <!-- Create Post Button -->
                        <div class="card-tools">
                            <button type="button" id="createPostBtn" class="btn btn-primary" data-toggle="modal"
                                data-target="#createEditModal">
                                <i class="fas fa-plus"></i> Create Post
                            </button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="itemData">

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


<!-- Modal -->
<div class="modal fade" id="createEditModal" tabindex="-1" role="dialog" aria-labelledby="createEditModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createEditModalLabel">Create New Post</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Form Inside Modal -->
                <form id="createEditForm">
                    <input type="hidden" id="postId" name="postId" value="">
                    <div class="form-group">
                        <label for="postTitle">Post Title</label>
                        <input type="text" class="form-control" id="postTitle" placeholder="Enter post title">
                    </div>
                    <div class="form-group">
                        <label for="postDescription">Post Description</label>
                        <textarea class="form-control" id="postDescription" rows="3"
                            placeholder="Enter post description"></textarea>
                    </div>
                    <ul id="msg" style="color: rgb(236, 8, 149)"></ul>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="savePost">Save Post</button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('js')
<script>
    $(document).ready(function() {

        let _token = 'Bearer ' + localStorage.getItem('user_token');
        showPostItems();

        function showPostItems(){
            $.ajax({
            url: '/api/items', 
            method: 'GET',
            headers: {'Authorization' : _token }, 
            success: function(response) {
                console.log(response);
                if(response.length > 0){
                    $('#itemData').html('');
                $.each(response, function(index, item) {
                    
                    let shortDes = item.description.length > 25 
                    ? item.description.substring(0, 25) + '...' 
                    : item.description;
                    let row = `<tr>
                                <td>${index + 1}</td>
                                <td>${item.title}</td>
                                <td>${shortDes}</td>
                                    <td><span class="badge ${item.status === 'pending' ? 'badge-warning' : item.status === 'approved' ? 'badge-success' : item.status === 'rejected' ? 'badge-danger' : 'badge-secondary'}">${item.status === 'pending' ? 'Unapproved' : item.status === 'approved' ? 'Approved' : item.status === 'rejected' ? 'Rejected' : 'Unknown'}</span></td>
                                <td>
                                    <button type="button" class="btn btn-default edit-item" data-item-id="${item.id}">
                                        <i class="fas fa-edit text-info"></i>
                                    </button>
                                    <button type="button" class="btn btn-default delete-item" data-item-id="${item.id}">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                </td>
                            </tr>`;
                    $('#itemData').append(row);
                });
                    
                }else{
                    
                    $('#itemData').append('<tr><td colspan="5" class="text-center mt-3 text-bold">No data found</td></tr>');
                }
                

                //for delete post
                $('.delete-item').on('click', function() {
                let itemId = $(this).data('item-id');
                if (confirm('Are you sure you want to delete this item?')) {
                    deleteItem(itemId);
                }
            });
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
        }


       



        //single data fatch of update
        $(document).on('click','.edit-item', function () {
            const itemId = $(this).data('item-id');
            // console.log(itemId);
            
            $.ajax({
            url: `/api/items/${itemId}`,
            method: 'GET',
            headers: {'Authorization' : _token }, 
            success: function(post) {
                console.log(post.item.title);
                
                $('#postId').val(post.item.id);
                $('#postTitle').val(post.item.title);
                $('#postDescription').val(post.item.description);
                $('#createEditModalLabel').text("Edit Post Item");
                $('#createEditModal').modal('show');
            }
            });
        });


        //create post btn
        $('#createPostBtn').click(function (e) { 
            $('#createEditModalLabel').text("Create New Post");
            $('#postId').val('');
            
            $('#createEditForm')[0].reset();
        });

    //create or edit post
    $('#savePost').on('click', function() {

        let postId = $('#postId').val();
        console.log(postId);
        
        let title = $('#postTitle').val();
        let description = $('#postDescription').val();
        let data = {
            title: title,
            description: description,
        };
        if(postId){
            data.id = postId;
        }
        const url = postId ? `/api/items/${postId}` : '/api/items';
        const method = postId ? 'PUT' : 'POST'; 
        $.ajax({
            url: url,  
            method: method,
            headers: {'Authorization' : _token },
            data: data,
            success: function(response) {
                
                if(response.success == true){
                    toastr.success(response.msg);
                    showPostItems();
                    $('#createEditForm')[0].reset()
                    $('#createEditModal').modal('hide'); 
                }else{
                    printErrMsg(response)
                }  
            },
            error: function(xhr) {
                alert('Something went wrong!');
            }
        });
        function printErrMsg(msg){
                $.each(msg,function(key, value){
                    console.log(value);
                    $('#msg').append('<li>' + value + '</li>');
                })
            }
    });

      //delete post item function
      function deleteItem(itemId) {
        $.ajax({
            url: `/api/items/${itemId}`,
            method: 'DELETE',
            headers: {'Authorization' : _token },
            success: function(response) {
               if(response.success == true){
                toastr.error(response.msg);
                $('#itemData').html('');
                showPostItems();
               }else{
                toastr.warning(response.msg);
               }
                
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }
    
});
</script>
@endpush