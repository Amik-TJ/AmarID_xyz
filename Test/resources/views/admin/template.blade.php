@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid px-lg-4">
    <div class="row">
        <div class="col-md-12 mt-lg-4 mt-4">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-info ">Templates</h1>
                <button type="button" class="d-none d-sm-inline-block btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#create_package_modal"><i class="fas fa-address-card"></i>
                    Create a New Template</button>

            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach($templates as $template)
                <div class="col-sm-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h3 class="mb-4">No : <span class="text-success">{{$template->templateID}}</span></h3>
                            <div class="row">
                                <div class="col-6">
                                    <div class="row mx-auto"><h5 class="text-center text-warning">Front</h5></div>
                                    <div class="row mx-auto"><img src="{{url('storage/'.$template->frontUrl)}}" alt="" style="height: 70px; width: 110px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"></div>
                                </div>
                                <div class="col-6">
                                    <div class="row mx-auto"><h5 class="text-center text-warning">Back</h5></div>
                                    <div class="row mx-auto"><img src="{{url('storage/'.$template->backUrl)}}"alt="" style="height: 70px; width: 110px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);"></div>
                                </div>
                            </div>
                            <div class="mt-5 mb-2">
                                    <h6><span class="text-primary">Weight :</span>
                                        @if($template->weight == null)
                                            No Weight Specified
                                        @else
                                            {{$template->weight}}
                                        @endif
                                    </h6>
                            </div>
                            <form action="/delete_template" method="Post">
                               @csrf
                                <input type="hidden" name="templateID" value="{{$template->templateID}}">
                                <button class="btn btn-danger float-right">Delete</button>
                            </form>

                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

    {{--Modal--}}
<!-- Button trigger modal -->


<!------------------------------------Modal Starts ------------------------------->
<div class="modal fade" id="create_package_modal" tabindex="-1" role="dialog" aria-labelledby="create_package_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLongTitle">Create a new Template</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/create_new_template" enctype="multipart/form-data">
                    @csrf

                    {{-------------------------- Form Fields ---------------------}}

                    {{-------------------------- Front Image ---------------------}}
                    <div class="form-group row">
                        <label for="front_image" class="col-md-4 col-form-label text-md-right">{{ __('Front Image') }}</label>
                        <div class="col-md-6 custom-file">
                            <input type="file" class="custom-file-input" id="front_image" name="front_image">
                            <label class="custom-file-label" for="front_image"></label>
                        </div>
                    </div>


                    {{-------------------------- Back Image ---------------------}}
                    <div class="form-group row">
                        <label for="back_image" class="col-md-4 col-form-label text-md-right">{{ __('Back Image') }}</label>
                        <div class="col-md-6 custom-file">
                            <input type="file" class="custom-file-input" id="back_image" name="back_image">
                            <label class="custom-file-label" for="back_image">Choose file</label>
                        </div>
                    </div>


                    {{-------------------------- Weight ---------------------}}
                    <div class="form-group row">
                        <label for="weight" class="col-md-4 col-form-label text-md-right">{{ __('Weight') }}</label>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="weight1" value="B" name="weight1">
                                <label class="form-check-label" for="weight1">B</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="weight2" value="S" name="weight2">
                                <label class="form-check-label" for="weight2">S</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" id="weight3" value="P" name="weight3">
                                <label class="form-check-label" for="weight3">P</label>
                            </div>
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
    {{--<script type="text/javascript">

        $('.custom-file input').change(function (e) {
            var files = [];
            for (var i = 0; i < $(this)[0].files.length; i++) {
                files.push($(this)[0].files[i].name);
            }
            $(this).next('.custom-file-label').html(files.join(', '));
        });



    </script>--}}
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
