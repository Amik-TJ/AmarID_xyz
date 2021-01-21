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

                <div class="col-md-6 col-lg-3">
                    <div class="card h-100">
                        <img class="img-fluid" src="{{url('storage/'.$banner->imgURL)}}"  alt="">
                        <div class="card-body">
                            <h5 class="card-title">Banner No : {{$banner->bannerID}}</h5>
                        </div>
                        <div class="card-footer">
                            <form action="/delete_banner" method="Post">
                                @csrf
                                <input type="hidden" name="bannerID" value="{{$banner->bannerID}}">
                                <button class="btn btn-danger float-lg-right">Delete</button>
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

                    {{-------------------------- Banner Image ---------------------}}
                    <div class="form-group row">
                        <label for="banner_image" class="col-md-4 col-form-label text-md-right">{{ __('Banner Image') }}</label>
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
<!------------------------------------Modal ------------------------------->
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
