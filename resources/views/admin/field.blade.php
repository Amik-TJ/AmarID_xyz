@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    @if($data['found'])
                        <h3 class="card-subtitle text-success h3 mb-0">Overview of All Fields</h3>
                    @else
                        <h5 class="card-subtitle text-danger h3 mb-0">No Field have been created yet!</h5>
                    @endif
                    <button type="button" class="btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#create_field_modal"><i class="fas fa-address-card"></i>
                        Create a New Field</button>
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
                                    <th class="border-top-0">Field ID</th>
                                    <th class="border-top-0">Account Type ID</th>
                                    <th class="border-top-0">Field Name</th>
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
                                    <td>{{$all->fieldID}}</td>
                                    <td>{{$all->accTypeID}}</td>
                                    <td>{{$all->fieldName}}</td>
                                    @if($all->iconUrl == null)
                                        <td>No Icon</td>
                                    @else
                                        <td>
                                            <img src="{{url('storage/'.$all->iconUrl)}}" alt="" style="height: 40px;width: 60px;box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2), 0 6px 20px 0 rgba(0,0,0,0.19);">
                                        </td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_field_modal" data-field_id="{{$all->fieldID}}" data-acc_type_name="{{$all->accTypeName}}" data-account_type_id="{{$all->accTypeID}}" data-field_name="{{$all->fieldName}}">Edit</button>

                                        <form action="/delete_field" method="post" class="float-sm-right">
                                            @csrf
                                            <div class="form-row">
                                                <label>
                                                    <input type="hidden" name="fieldID" value="{{$all->fieldID}}">
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






    <!------------------------------------Modal Starts ------------------------------->
    <div class="modal fade" id="create_field_modal" tabindex="-1" role="dialog" aria-labelledby="create_field_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="exampleModalLongTitle">Create a new Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_new_field" enctype="multipart/form-data">
                        @csrf

                        {{-------------------------- Form Fields ---------------------}}

                        {{-------------------------- Field Name ---------------------}}
                        <div class="form-group row">
                            <label for="field_name" class="col-md-4 col-form-label text-md-right">{{ __('Field Name: ') }}</label>

                            <div class="col-md-6">
                                <input id="field_name" type="text" class="form-control" name="field_name" value="{{ old('field_name') }}"  autocomplete="description" autofocus required>
                            </div>
                        </div>
                        {{-------------------------- Account Type ---------------------}}
                        <div class="form-group row">
                            <label for="account_type" class="col-md-4 col-form-label text-md-right">{{ __('Account Type: ') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="account_type" name="account_type">
                                        <option selected> -------- </option>
                                    @foreach($data['account_type'] as $acc)
                                        <option value="{{$acc->accTypeID}}">{{$acc->typeName}}</option>
                                    @endforeach
                                </select>
                                @error('account_type')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-------------------------- Icon Image ---------------------}}
                        <div class="form-group row">
                            <label for="field_icon" class="col-md-4 col-form-label text-md-right">{{ __('Field Icon: ') }}</label>
                            <div class="col-md-6 custom-file ml-3">
                                <input type="file" class="custom-file-input" id="field_icon" name="field_icon">
                                <label class="custom-file-label" for="field_icon" ></label>
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


    <!--------------------------------Edit Modal Starts------------------------------------>



    <div class="modal fade" id="edit_field_modal" tabindex="-1" role="dialog" aria-labelledby="edit_field_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_field_modalLabel">Edit Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_field" enctype="multipart/form-data">
                        @csrf
                        {{--------------------------Field Name---------------------------}}
                        <input type="hidden" id="field_id" name="field_id" value="">
                        <div class="form-group">
                            <label for="field_name" class="col-form-label">Field Name: </label>
                            <input type="text" class="form-control" id="field_name" name="field_name">
                        </div>


                        {{-------------------------- Account Type ---------------------------}}
                        <div class="form-group">
                            <label for="account_type" class="col-form-label">Account Type:</label>
                            <select class="form-control" id="account_type_id" name="account_type">
                                    <option value="">  </option>
                                @foreach($data['account_type'] as $acc)
                                    <option value="{{$acc->accTypeID}}">{{$acc->typeName}}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-------------------------- Field Icon ---------------------------}}
                        <span>Field Icon: </span>
                        <div class="custom-file">
                            <label class="custom-file-label" for="field_icon"></label>
                            <input type="file" class="custom-file-input" id="field_icon" name="field_icon">
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
        $('#edit_field_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var field_id = button.data('field_id')
            var field_name = button.data('field_name')
            var acc_type_name = button.data('field_name')
            var account_type_id = button.data('account_type_id')
            var modal = $(this)
            modal.find('.modal-body #field_name').val(field_name)
            modal.find('.modal-body #field_id').val(field_id)
            modal.find('.modal-body #acc_type_name').val(acc_type_name)
            modal.find('.modal-body #account_type_id').val(account_type_id)
        })
    </script>
@endsection
