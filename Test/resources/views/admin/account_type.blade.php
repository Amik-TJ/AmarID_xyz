@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    @if($data['found'])
                        <h3 class="card-subtitle text-success h3 mb-0">Overview of Account Types</h3>
                    @else
                        <h5 class="card-subtitle text-danger h3 mb-0">No Account Type have been created yet!</h5>
                    @endif
                    <button type="button" class=" btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#create_account_type_modal"><i class="fas fa-address-card"></i>
                        Create a New Account Type</button>
                </div>
            </div>
        {{----------------------------------Table Starts-------------------------------------------}}

        <!-- column -->
            <div class="col-md-12 mt-4">
                <div class="card">
                    @if($data['found'])
                        <div class="table-responsive">
                            <table class="table v-middle table-hover">
                                <thead>
                                <tr class="bg-light">
                                    <th class="border-top-0">#</th>
                                    <th class="border-top-0">Account Type ID</th>
                                    <th class="border-top-0">Account Type Name</th>
                                    <th class="border-top-0">Icon</th>
                                    <th class="border-top-0 text-center">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php
                                    $count = 0;
                                @endphp
                                @foreach($data['data'] as $all)
                                <tr>
                                    <td>{{++$count}}</td>
                                    <td>{{$all->accTypeID}}</td>
                                    <td>{{$all->typeName}}</td>
                                    @if($all->iconUrl == null)
                                        <td>No Icon</td>
                                    @else
                                        <td>
                                            <img src="{{url('storage/'.$all->iconUrl)}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_account_modal"  data-account_type_id="{{$all->accTypeID}}" data-account_type_name="{{$all->typeName}}">Edit</button>

                                        <form action="/delete_account_type" method="post" class="float-sm-right">
                                            @csrf
                                            <div class="form-row">
                                                <label>
                                                    <input type="hidden" name="accTypeID" value="{{$all->accTypeID}}">
                                                </label>
                                                <button type="submit" class="btn btn-sm btn-danger my-auto">Delete</button>
                                            </div>
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



    {{--Modal--}}
    <!-- Button trigger modal -->


    <!------------------------------------Add Acount Type Modal Starts ------------------------------->
    <div class="modal fade" id="create_account_type_modal" tabindex="-1" role="dialog" aria-labelledby="create_account_type_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLongTitle">Create a new Account Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_new_account_type" enctype="multipart/form-data">
                        @csrf

                        {{-------------------------- Form Fields ---------------------}}

                        {{-------------------------- Account Type Name ---------------------}}
                        <div class="form-group row">
                            <label for="account_type_name" class="col-md-4 col-form-label text-md-right">{{ __('Account Type Name: ') }}</label>

                            <div class="col-md-6">
                                <input id="account_type_name" type="text" class="form-control" name="account_type_name" value="{{ old('account_type_name') }}"  autocomplete="description" autofocus required>
                            </div>
                        </div>


                        {{-------------------------- Icon Image ---------------------}}
                        <div class="form-group row">
                            <label for="account_type_icon" class="col-md-4 col-form-label text-md-right">{{ __('Account Type Icon: ') }}</label>
                            <div class="col-md-6 custom-file ml-3">
                                <input type="file" class="custom-file-input" id="account_type_icon" name="account_type_icon">
                                <label class="custom-file-label" for="account_type_icon" ></label>
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
    <!------------------------------------Add Account Type Modal Ends ------------------------------->


    <!--------------------------------Edit Modal Starts------------------------------------>

    <div class="modal fade" id="edit_account_modal" tabindex="-1" role="dialog" aria-labelledby="edit_account_modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_account_modalLabel">Edit Account Type</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_account_type" enctype="multipart/form-data">
                        @csrf
                        {{--------------------------Account Type Name---------------------------}}
                        <input type="hidden" id="account_type_id" name="account_type_id" value="">
                        <div class="form-group">
                            <label for="account_type_name" class="col-form-label">Account Type Name: </label>
                            <input type="text" class="form-control" id="account_type_name" name="account_type_name">
                        </div>

                        {{-------------------------- Account Icon ---------------------------}}
                        <span>Account Type Icon: </span>
                        <div class="custom-file">
                            <label class="custom-file-label" for="account_type_icon"></label>
                            <input type="file" class="custom-file-input" id="account_type_icon" name="account_type_icon">
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
        $('#edit_account_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var account_type_id = button.data('account_type_id')
            var account_type_name = button.data('account_type_name')
            var modal = $(this)
            modal.find('.modal-body #account_type_id').val(account_type_id)
            modal.find('.modal-body #account_type_name').val(account_type_name)
        })
    </script>
@endsection
