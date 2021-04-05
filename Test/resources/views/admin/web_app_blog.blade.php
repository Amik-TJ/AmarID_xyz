@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    @if($data['found'])
                        <h3 class="card-subtitle text-success h3 mb-0">Overview of All Web Blogs</h3>
                    @else
                        <h5 class="card-subtitle text-danger h3 mb-0">No Web Blogs have been created yet!</h5>
                    @endif
                    <button type="button" class="btn-sm btn-success shadow-sm ml-sm-auto"
                            data-toggle="modal" data-target="#create_blog_modal"><i class="fa fa-address-card"></i>
                        Create Web Blog
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
                                    <th class="border-top-0">Blog ID</th>
                                    <th class="border-top-0">User ID</th>
                                    <th class="border-top-0">Photo</th>
                                    <th class="border-top-0">Title</th>
                                    <th class="border-top-0">Content</th>
                                    <th class="border-top-0">Created at</th>
                                    <th class="border-top-0 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data['data'] as $all)
                                    <tr>
                                        <td>{{$all->blogID}}</td>
                                        <td>{{$all->userID}}</td>
                                        @if($all->blog_photo_url == null)
                                            <td>No Image</td>
                                        @else
                                            <td>
                                                <img src="{{url('storage/'.$all->blog_photo_url)}}" alt=""
                                                     style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                            </td>
                                        @endif
                                        <td>
                                            @if(strlen($all->blog_title) < 110)
                                                {{$all->blog_title}}
                                            @else
                                                {{substr($all->blog_title, 0, 80)}}.....
                                                <a class="text-primary" href="" type="button" data-toggle="modal" data-target="#view_more_modal" data-blog_id="{{$all->blogID}}" data-blog_title="{{$all->blog_title}}"  data-blog_content="{{$all->blog_content}}">
                                                    Show More
                                                </a>
                                            @endif
                                        </td>
                                        <td>
                                            @if(strlen($all->blog_content) < 110)
                                                {{$all->blog_content}}
                                            @else
                                                {{substr($all->blog_content, 0, 80)}}.....
                                                <a class="text-primary" href="" type="button" data-toggle="modal" data-target="#view_more_modal" data-blog_id="{{$all->blogID}}" data-blog_title="{{$all->blog_title}}"  data-blog_content="{{$all->blog_content}}">
                                                    Show More
                                                </a>
                                            @endif
                                        </td>
                                        <td>{{$all->created_at}}</td>
                                        <td class="mx-auto">
                                            <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_web_app_blog_modal" data-user_id="{{$all->userID}}" data-blog_id="{{$all->blogID}}" data-content="{{$all->blog_content}}" data-title="{{$all->blog_title}}">Edit</button>
                                            <form action="/delete_web_app_blog" method="post" class="float-sm-right">
                                                @csrf
                                                <input type="hidden" name="blog_id" value="{{$all->blogID}}">
                                                <input type="hidden" name="user_id" value="{{$all->userID}}">
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
    <div class="modal fade" id="create_blog_modal" tabindex="-1" role="dialog"
         aria-labelledby="create_blog_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="create_blog_modalLongTitle">Create new Web Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_web_app_blog" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="user_id" value="{{auth()->user()->userID}}">
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


    <div class="modal fade" id="edit_web_app_blog_modal" tabindex="-1" role="dialog" aria-labelledby="edit_web_app_blog_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_web_app_blog_modalLabel">Edit Web Blog</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_web_app_blog" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="blog_id" name="blog_id" value="">
                        <input type="hidden" id="user_id" name="user_id" value="">
                        <div class="form-group">
                            <label for="title" class="col-form-label">Title</label>
                            <input type="text" class="form-control" id="blog_title" name="blog_title">
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


    {{--------------------------------View More Details Modal Starts---------------------------}}

    <!-- Modal -->
    <div class="modal fade" id="view_more_modal" tabindex="-1" role="dialog" aria-labelledby="view_more_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="text-centers text-secondary font-weight-bold" id="view_more_modal_title">Blog No  :  <span id="s_blog_id"></span></h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h4 class="font-weight-bold text-danger">
                        blog_title :
                    </h4>
                    <p id="s_blog_title">.........</p>
                    <h4 class="font-weight-bold text-success">
                        blog_content :
                    </h4>
                    <p id="s_blog_content">..........</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>



    {{--------------------------------View More Details Modal Starts---------------------------}}
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
        $('#edit_web_app_blog_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var title = button.data('title')
            var content = button.data('content')
            var blog_id = button.data('blog_id')
            var user_id = button.data('user_id')
            var modal = $(this)
            console.log(title);
            modal.find('.modal-body #blog_title').val(title)
            modal.find('.modal-body #blog_content').val(content)
            modal.find('.modal-body #blog_id').val(blog_id)
            modal.find('.modal-body #user_id').val(user_id)
        })


        $('#view_more_modal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget)
            var blog_id = button.data('blog_id')
            var blog_title = button.data('blog_title')
            var blog_content = button.data('blog_content')
            var modal = $(this)

            document.getElementById("s_blog_id").innerHTML = blog_id
            document.getElementById("s_blog_content").innerHTML = blog_content
            document.getElementById("s_blog_title").innerHTML = blog_title


        })
    </script>
@endsection
