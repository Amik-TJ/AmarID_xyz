@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    @if($data['found'])
                        <h3 class="card-subtitle text-success h3 mb-0">Overview of All Blogs</h3>
                    @else
                        <h5 class="card-subtitle text-danger h3 mb-0">No Blogs have been created yet!</h5>
                    @endif
                    <button type="button" class="btn-sm btn-success shadow-sm ml-sm-auto"
                            data-toggle="modal" data-target="#create_field_modal"><i class="fa fa-address-card"></i>
                        Create a New Blog
                    </button>
                </div>
            </div>
        {{----------------------------------Table Starts-------------------------------------------}}

        <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card">
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table v-middle table-hover" id="datatable">
                                <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Blog ID</th>
                                    <th class="border-top-0">Title</th>
                                    <th class="border-top-0">Image</th>
                                    <th class="border-top-0">Content</th>
                                    <th class="border-top-0">Time</th>
                                    <th class="border-top-0 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0
                                @endphp
                                @foreach($data['data'] as $all)
                                    <tr>
                                        <td>{{++$count}}</td>
                                        <td>{{$all->blogID}}</td>
                                        <td>{{$all->title}}</td>
                                        @if($all->imgUrl == null)
                                            <td>No Image</td>
                                        @else
                                            <td>
                                                <img src="{{url('storage/'.$all->imgUrl)}}" alt=""
                                                     style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                            </td>
                                        @endif
                                        <td style="max-width: 180px;word-wrap: break-word; ">{{$all->content}}</td>
                                        <td>{{$all->time}}</td>
                                        <td class="mx-auto">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_blog_modal" data-id="{{$all->blogID}}" data-content="{{$all->content}}" data-title="{{$all->title}}">Edit</button>
                                            <form action="/delete_blog" method="post" class="float-sm-right">
                                                @csrf

                                                <input type="hidden" name="blog_id" value="{{$all->blogID}}">
                                                <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>







    <!------------------------------------Add Blog Modal Starts ------------------------------->
    <div class="modal fade" id="create_field_modal" tabindex="-1" role="dialog"
         aria-labelledby="create_field_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="create_field_modalLongTitle">Create a new Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_new_blog" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="blog_title">
                        </div>
                        <div class="form-group">
                            <label for="blog_content" class="col-form-label">Content:</label>
                            <textarea class="form-control" id="blog_content" rows="5" name="blog_content"></textarea>
                        </div>
                        <span>Choose Image: </span>
                        <div class="custom-file">
                            <label class="custom-file-label" for="blog_image"></label>
                            <input type="file" class="custom-file-input" id="blog_image" name="blog_image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    {{-------------------------Modal---------------------------}}






    <!--------------------------------Edit Modal Starts------------------------------------>



    <div class="modal fade" id="edit_blog_modal" tabindex="-1" role="dialog" aria-labelledby="edit_blog_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_blog_modalLabel">Edit Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_blog" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="blog_id" name="blog_id" value="">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="blog_title">
                        </div>
                        <div class="form-group">
                            <label for="blog_content" class="col-form-label">Content:</label>
                            <textarea class="form-control" id="blog_content" rows="5" name="blog_content"></textarea>
                        </div>
                        <span>Choose Image: </span>
                        <div class="custom-file">
                            <label class="custom-file-label" for="blog_image"></label>
                            <input type="file" class="custom-file-input" id="blog_image" name="blog_image">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--------------------------------Edit Modal Ends------------------------------------>
@endsection




@section('single_filename_bootstrap_js')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
@endsection


@section('edit_js')
    <script>
        $('#edit_blog_modal').on('show.bs.modal', function (event) {
            console.log('Modal Oppenned');
            var button = $(event.relatedTarget)
            var title = button.data('title')
            var content = button.data('content')
            var id = button.data('id')
            var modal = $(this)
            modal.find('.modal-body #title').val(title)
            modal.find('.modal-body #blog_content').val(content)
            modal.find('.modal-body #blog_id').val(id)
        })
    </script>
@endsection
