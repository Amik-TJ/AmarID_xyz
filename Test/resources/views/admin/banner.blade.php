@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid px-lg-4">
    <div class="row">
        <div class="col-md-12 mt-lg-4 mt-4">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-info ">Banners</h1>
                @if(!$data['found'])
                <h4 class="h3 mb-0 text-info ">No Banners Available</h4>
                @endif
                <button type="button" class=" btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#create_banner_modal"><i class="fas fa-address-card"></i>
                    Create a New Banner</button>

            </div>
        </div>
        @if($data['found'])
        <div class="col-md-12">
            <div class="row">
                @foreach($data['data'] as $banner)

                <div class="col-md-6 col-lg-3 mb-4">
                    <div class="card h-100">
                        <img class="img-fluid" src="{{url('storage/'.$banner->imgURL)}}"  alt="">
                        <div class="card-body">
                            <h6 class="card-title">Banner No : <span class="text-primary">{{$banner->bannerID}}</span></h6>
                            <h6 class="card-title">Title : <span class="text-primary">{{$banner->banner_title}}</span></h6>
                            <h6 class="card-title">SEO : <span class="text-primary">{{$banner->banner_seo}}</span></h6>
                            <h6 class="card-title">Type :
                                <span class="text-danger">
                                    @if($banner->banner_row == 1 )
                                        For Home
                                    @elseif($banner->banner_row == 2)
                                        For Office
                                    @elseif($banner->banner_row == 3)
                                        Home & Office
                                    @else
                                        Not selected
                                    @endif
                                </span>
                            </h6>
                        </div>
                        <div class="card-footer">
                                <button type="button" class="btn btn-sm btn-warning float-left" data-toggle="modal" data-target="#edit_banner_modal" data-banner_id="{{$banner->bannerID}}" data-banner_title="{{$banner->banner_title}}" data-banner_seo="{{$banner->banner_seo}}" data-banner_row="{{$banner->banner_row}}">edit</button>
                            <form action="/delete_banner" method="Post">
                                @csrf
                                <input type="hidden" name="bannerID" value="{{$banner->bannerID}}">
                                <button class="btn btn-sm btn-danger float-right">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

    {{--Modal--}}
<!-- Button trigger modal -->


<!------------------------------------Modal Starts ------------------------------->
<div class="modal fade" id="create_banner_modal" tabindex="-1" role="dialog" aria-labelledby="create_banner_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLongTitle">Create a new Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/create_new_banner" enctype="multipart/form-data">
                    @csrf

                    {{-------------------------- Form Fields ---------------------}}
                    {{-------------------------- Title ---------------------}}
                    <div class="form-group row">
                        <label for="banner_title" class="col-md-4 col-form-label text-md-right">{{ __('Banner Title') }}</label>

                        <div class="col-md-6">
                            <input id="banner_title" type="text" class="form-control" name="banner_title" value="{{ old('banner_title') }}"  autocomplete="banner_title" autofocus required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="banner_seo" class="col-md-4 col-form-label text-md-right">{{ __('Banner SEO') }}</label>

                        <div class="col-md-6">
                            <input id="banner_seo" type="text" class="form-control" name="banner_seo" value="{{ old('banner_seo') }}"  autocomplete="banner_seo" autofocus >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="banner_row" class="col-md-4 col-form-label text-md-right">{{ __('Banner Type') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="banner_row" name="banner_row">
                                <option >----</option>
                                <option value="1">Services For Home</option>
                                <option value="2">Services For Office</option>
                                <option value="3">Both Home & Office</option>
                            </select>
                        </div>
                    </div>
                    {{-------------------------- Banner Image ---------------------}}
                    <div class="form-group row">
                        <label for="banner_image" class="col-md-4 col-form-label text-md-right mr-3">{{ __('Banner Image') }}</label>
                        <div class="col-md-6 custom-file">
                            <input type="file" class="custom-file-input" id="banner_image" name="banner_image">
                            <label class="custom-file-label" for="banner_image"></label>
                        </div>
                    </div>

                    {{-------------------------- Create Button ---------------------}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Create</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<!------------------------------------ Create Modal Ends------------------------------->




    {{---------------------------EDIT Banner Modal Starts--------------------------------}}
<div class="modal fade" id="edit_banner_modal" tabindex="-1" role="dialog" aria-labelledby="edit_banner_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="edit_banner_modalTitle">Edit Banner</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/edit_banner" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="banner_id" id="banner_id" value="">
                    {{-------------------------- Form Fields ---------------------}}
                    {{-------------------------- Title ---------------------}}
                    <div class="form-group row">
                        <label for="banner_title_e" class="col-md-4 col-form-label text-md-right">{{ __('Banner Title') }}</label>

                        <div class="col-md-6">
                            <input id="banner_title_e" type="text" class="form-control" name="banner_title_e" value="{{ old('banner_title_e') }}"  autocomplete="banner_title_e" autofocus required>
                        </div>
                    </div>


                    <div class="form-group row">
                        <label for="banner_seo_e" class="col-md-4 col-form-label text-md-right">{{ __('Banner SEO') }}</label>

                        <div class="col-md-6">
                            <input id="banner_seo_e" type="text" class="form-control" name="banner_seo_e" value="{{ old('banner_seo_e') }}"  autocomplete="banner_seo_e" autofocus >
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="banner_row_e" class="col-md-4 col-form-label text-md-right">{{ __('Banner Type') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="banner_row_e" name="banner_row_e">
                                <option >----</option>
                                <option value="1">Services For Home</option>
                                <option value="2">Services For Office</option>
                                <option value="3">Both Home & Office</option>
                            </select>
                        </div>
                    </div>
                    {{-------------------------- Banner Image ---------------------}}
                    <div class="form-group row">
                        <label for="banner_image" class="col-md-4 col-form-label text-md-right mr-3">{{ __('Banner Image') }}</label>
                        <div class="col-md-6 custom-file">
                            <input type="file" class="custom-file-input" id="banner_image" name="banner_image">
                            <label class="custom-file-label" for="banner_image"></label>
                        </div>
                    </div>

                    {{-------------------------- Create Button ---------------------}}
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-warning">Edit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{---------------------------EDIT Banner Modal Ends--------------------------------}}



@endsection


@section('extra_js')
    <script>
        $('#edit_banner_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var banner_id = button.data('banner_id')
            var banner_title = button.data('banner_title')
            var banner_seo = button.data('banner_seo')
            var banner_row = button.data('banner_row')
            var modal = $(this)



            modal.find('.modal-body #banner_id').val(banner_id)
            modal.find('.modal-body #banner_title_e').val(banner_title)
            modal.find('.modal-body #banner_seo_e').val(banner_seo)
            modal.find('.modal-body #banner_row_e').val(banner_row)
        })
    </script>
@endsection

{{--------------- File name show in Input Box JavaScript Starts -----------------}}
@section('filename_bootstrap_js')
    <script type="text/javascript">
        $('.custom-file input').change(function (e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(', '));
        });
    </script>
@endsection
{{--------------- File name show in Input Box JavaScript Ends-----------------}}
