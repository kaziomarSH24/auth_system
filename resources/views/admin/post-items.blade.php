@extends('admin.adminMaster')

@section('ad-content')
<div class="content-header">
    <div class="container-fluid">
        @include('admin.partials.breadcrumb')
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">All Post Items</h3>

                        <div class="card-tools">
                            <div class="form-group" style="margin: 0">
                                <select class="form-control items-status">
                                    <option value="">All Items</option>
                                    <option value="pending">Unapproved</option>
                                    <option value="approved">Approved</option>
                                    <option value="rejected">Rejected</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body table-responsive p-0" style="height: 300px;">
                        <table class="table table-hover table-head-fixed text-nowrap">
                            <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Post By</th>
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
@endsection

@push('js')
<script>
    $(document).ready(function() {
     //load all items first   
    showItems('');

    $('.items-status').on('change', function() {
        let itemsStatus = $(this).val(); 
        console.log(itemsStatus);
        showItems(itemsStatus);
    });
        function showItems(status){
            $.ajax({
            url: '/api/admin/items', 
            method: 'GET',
            headers: {'Authorization' : 'Bearer ' + localStorage.getItem('user_token') },
            data: { status: status }, 
            success: function(response) {
    
                $('#itemData').html('');
                $.each(response.items, function(index, item) {
                    let shortDes = item.description.length > 25 
                    ? item.description.substring(0, 25) + '...' 
                    : item.description;
                    let row = `<tr>
                                <td>${index + 1}</td>
                                <td>${item.user.name}</td>
                                <td>${item.title}</td>
                                <td>${shortDes}</td>
                                <td>
                                    <div class="form-group" style="margin: 0" >
                                        <select class="form-control cngStatus" data-itemsId ="${item.id}">
                                            <option value="pending" ${item.status === 'pending' ? 'selected' : ''}>Unapprove</option>
                                            <option value="approved" ${item.status === 'approved' ? 'selected' : ''}>Approve</option>
                                            <option value="rejected" ${item.status === 'rejected' ? 'selected' : ''}>Reject</option>
                                        </select>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-default  delete-item" data-item-id="${item.id}">
                                        <i class="fas fa-trash-alt text-danger"></i>
                                    </button>
                                    
                                </td>
                            </tr>`;
                    $('#itemData').append(row);
                });

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

        //delete post item function
        function deleteItem(itemId) {
        $.ajax({
            url: `/api/admin/items/${itemId}`,
            method: 'DELETE',
            headers: {'Authorization' : 'Bearer ' + localStorage.getItem('user_token') },
            success: function(response) {
                toastr.error(response.msg);
                showItems('');
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    }


    //change posts status :)
    $(document).on('change', '.cngStatus', function() {
        let itemId = $(this).data('itemsid');
        let itemStatus = $(this).val();
        
        console.log(itemId);
        
        let confirmation = confirm("Are you sure you want to " + itemStatus + " this post?");
        
        if (confirmation) {

            $.ajax({
                url: '/api/admin/items/' + itemId + '/status',
                method: 'PUT',
                headers: {
                'Authorization': 'Bearer ' + localStorage.getItem('user_token')
                },
                data: { status: itemStatus },
                success: function(response) {
                    if(response.success == true){
                        toastr.success(response.msg);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error updating status:', error);
                    alert('Failed to post items.');
                }
            });
        } else {
            $(this).val($(this).find('option[selected]').val()); 
        }
    });
});
</script>
@endpush