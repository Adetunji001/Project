@extends('admin.layout.app')
@section('content')
<?php
$snCount = 1
?>
<div class="main-content">

    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Blogs</h4>

                    </div>

                    


                               
                    

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="row">
                <div class="col-lg-12">
                    <div class="card" id="orderList">
                        <div class="card-header border-0">
                            <div class="row align-items-center gy-3">
                                <div class="col-sm">
                                    <h5 class="card-title mb-0">Blog Posts</h5>
                                </div>
                                <div class="col-sm-auto">
                                    <div class="d-flex gap-1 flex-wrap">
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal" ><i class="ri-add-line align-bottom me-1"></i> Create  Blog</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="button-datatables" class="display table table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Category</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($blogposts as $postItem)
                                        <tr>
                                            <td>{{$snCount++}}</td>
                                            <td>{{$postItem->post}}</td>
                                            <td>
                                                <div class="dropdown d-inline-block">
                                                    <button class="btn btn-n soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end">
                                                        <li>
                                                            <button id="editBtn" class="dropdown-item edit-item-btn" data-bs-toggle="modal" data-bs-target="#showEditModal{{$postItem->id}}">
                                                                <i class="ri-pencil-fill align-bottom me-2 text-muted"></i> 
                                                                Edit
                                                            </button>
                                                        </li>
                                                        <li>
                                                            <button id="deleteButton" class="dropdown-item remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{$postItem->id}}">
                                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
                                                            </button>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="showEditModal{{$postItem->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-light p-3">
                                                        <h5 class="modal-title" id="exampleModalLabel">EDIT Post</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                                                    </div>
                                                    <form method="POST" action="{{url('/admin/updatePost')}}" class="tablelist-form" autocomplete="off">
                                                        @csrf
                                                        <div class="modal-body">
                                                            <input type="hidden" id="category_id" name="category_id" value="{{$postItem->id}}" />

                                                            <div class="mb-3">
                                                                <label for="customername-field" class="form-label">Post Name</label>
                                                                <input name="category" type="text" id="category" value="{{$postItem->post}}" class="form-control" required />
                                                            </div>
                
                                                            
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-success" id="add-btn">Update Post</button>
                                                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal fade flip" id="deleteModal{{$postItem->id}}" tabindex="-1" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-body p-5 text-center">
                                                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#405189,secondary:#f06548" style="width:90px;height:90px"></lord-icon>
                                                        <div class="mt-4 text-center">
                                                            <form action="{{url('/admin/deletePost')}}" method="POST">
                                                                @csrf
                                                                <h4>You are about to delete the {{$postItem->category}} post?</h4>
                                                                <p class="text-muted fs-15 mb-4">Deleting this category will remove all of your information from our database.</p>
                                                                <input type="hidden" name="category_id" id="category_id" value="{{$postItem->id}}">
                                                                <div class="hstack gap-2 justify-content-center remove">
                                                                    <button type="button" class="btn btn-link link-success fw-medium text-decoration-none" id="deleteRecord-close" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Cancel</button>
                                                                    <button class="btn btn-danger" id="delete-record" type="submit">Yes, Delete It</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        
            <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header bg-light p-3">
                            <h5 class="modal-title" id="exampleModalLabel">&nbsp;</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                        </div>
                        <form method="POST" action="{{url('admin/addPost')}}" class="tablelist-form" autocomplete="off">
                            @csrf
                            <div class="modal-body">
                                <input type="hidden" id="id-field" />

                                <div class="mb-3">
                                    <label for="customername-field" class="form-label">Post Name</label>
                                    <input name="category" type="text" class="form-control" placeholder="Enter name" required />
                                </div>

                                
                            </div>
                            <div class="modal-footer">
                                <div class="hstack gap-2 justify-content-end">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-success" id="add-btn">Add Post</button>
                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div> 
            </div>
        </div>
        <!-- container-fluid -->
    </div>




                               


                        
                   
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Pages</a></li>
                                <li class="breadcrumb-item active">Posts</li>
                            </ol>
                        
                </div>
            </div>
            <!-- end page title -->

        </div>
        <!-- container-fluid -->
    </div>
</div>  <!-- End Page-content -->
@endsection

            