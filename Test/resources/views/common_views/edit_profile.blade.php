@extends(auth()->user()->admin ||auth()->user()->print_vendor ||auth()->user()->delivery_vendor ?'layouts.admin_layout': 'layouts.user_layout')



@section('content')
    <div class="container-fluid px-lg-4">

        {{-------------------Profile Info----------------}}
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="card card-profile">
                                            <span class="mb-1 text-primary text-center"><i class="icon-people"></i></span>
                                            <h3 class="text-center text-facebook">Edit Profile</h3>
                                        </div>
                                        <div class="div mt-5">
                                            <div class="row justify-content-center">
                                                <div class="col"><h3 class="text-center mt-3 mb-5 text-info">Upload Profile Picture</h3></div>
                                            </div>
                                            <div class="row justify-content-center">
                                                <form action="/change_profile_picture" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group row">
                                                        <label for="first_name"
                                                               class="col-lg-4 col-form-label text-md-right display-3 font-weight-bold">{{ __('Upload Photo : ') }}</label>

                                                        <div class="col-lg-8">
                                                            <div class="custom-file">
                                                                <input type="file" class="custom-file-input  @error('photo') is-invalid @enderror" id="photo" name="photo" >
                                                                <label class="custom-file-label" for="validatedCustomFile">Choose file...</label>
                                                                <div class="invalid-feedback font-weight-bold">{{ $errors->first('photo') }}</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-------------------File Upload Ends-----------------}}


                                                    {{-------------------Button Starts-----------------}}
                                                    <div class="form-group row mb-0">
                                                        <div class="col-md-6 offset-md-4">
                                                            <button type="submit" class="btn btn-success">
                                                                {{ __('Upload') }}
                                                            </button>
                                                        </div>
                                                    </div>
                                                    {{--<div class="form-group row">
                                                        <label for="photo" class="col-lg-4 col-form-label">{{ __('Upload Photo') }}</label>
                                                        <div class="col-lg-8 custom-file">
                                                            <input type="file" class="custom-file-input m-sm-2" id="photo" name="photo">
                                                            <label class="custom-file-label" for="photo"></label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row justify-content-center">
                                                        <button type="submit" class="btn btn-primary">Upload</button>
                                                    </div>--}}
                                                </form>
                                            </div>
                                        </div>
                                        <hr class="border-primary">
                                        <div class="div mt-5">
                                            <div class="row justify-content-center">
                                                <div class="col"><h3 class="text-center mt-3 mb-5 text-info">Change Password</h3></div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-6">
                                                    <form action="/change_password" method="POST">
                                                        @csrf
                                                        <div class="form-group row">
                                                            <label for="old_password" class="col-sm-4 col-form-label">Old Password</label>
                                                            <div class="col-sm-8">
                                                                <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Old Password" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="new_password" class="col-sm-4 col-form-label">New Password</label>
                                                            <div class="col-sm-8">
                                                                <input type="password" class="form-control" id="new_password" name="new_password" placeholder="New Password" required>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <div class="col-sm-8 offset-sm-4">
                                                                <button type="submit" class="btn btn-success">Change</button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-lg-3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



@section('extra_js')
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function () {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <!-- Chartjs -->
    <script src="/plugins/chart.js/Chart.bundle.min.js"></script>
    <!-- Circle progress -->
    <script src="/plugins/circle-progress/circle-progress.min.js"></script>
    <!-- Datamap -->
    <script src="/plugins/d3v3/index.js"></script>
    <script src="/plugins/topojson/topojson.min.js"></script>
    <script src="/plugins/datamaps/datamaps.world.min.js"></script>
    <!-- Morrisjs -->
    <script src="/plugins/raphael/raphael.min.js"></script>
    <script src="/plugins/morris/morris.min.js"></script>
    <!-- Pignose Calender -->
    <script src="/plugins/moment/moment.min.js"></script>
    <script src="/plugins/pg-calendar/js/pignose.calendar.min.js"></script>
    <!-- ChartistJS -->
    <script src="/plugins/chartist/js/chartist.min.js"></script>
    <script src="/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js"></script>



    <script src="/js/dashboard/dashboard-1.js"></script>
@endsection
