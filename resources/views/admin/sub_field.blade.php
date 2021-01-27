@extends('layouts.admin_layout')
@section('content')
    <div class="container-fluid px-lg-4">
        <div class="row">
            <div class="col-md-12 mt-lg-4 mt-4">
                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    @if($data['found'])
                        <h3 class="card-subtitle text-success h3 mb-0">Overview of Sub Fields</h3>
                    @else
                        <h5 class="card-subtitle text-danger h3 mb-0">No Sub Field have been created yet!</h5>
                    @endif
                    <button type="button" class="btn-sm btn-success shadow-sm" data-toggle="modal" data-target="#create_sub_field_modal"><i class="fas fa-address-card"></i>
                        Create a Sub New Field</button>
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
                                    <th class="border-top-0">Sub Field ID</th>
                                    <th class="border-top-0">Field ID</th>
                                    <th class="border-top-0">Sub Field Name</th>
                                    <th class="border-top-0">Translation</th>
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
                                    <td>{{$all->subFieldID}}</td>
                                    <td>{{$all->fieldID}}</td>
                                    <td>{{$all->subFieldName}}</td>
                                    @if($all->translation == null)
                                        <td>No Translation</td>
                                    @else
                                        <td>
                                            {{$all->translation}}
                                        </td>
                                    @endif
                                    <td>
                                        <button type="button" class="btn btn-warning btn-sm" data-toggle="modal" data-target="#edit_sub_field_modal" data-sub_field_id="{{$all->subFieldID}}" data-field_id="{{$all->fieldID}}" data-sub_field_name="{{$all->subFieldName}}" data-translation="{{$all->translation}}">Edit</button>
                                        <form action="/delete_sub_field" method="post" class="float-sm-right">
                                            @csrf
                                            <div class="form-row">
                                                <label>
                                                    <input type="hidden" name="subFieldID" value="{{$all->subFieldID}}">
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






    <!------------------------------------Add Sub Field Modal Starts ------------------------------->
    <div class="modal fade" id="create_sub_field_modal" tabindex="-1" role="dialog" aria-labelledby="create_sub_field_modalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-success" id="create_sub_field_modalTitle">Create a Sub Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/create_new_sub_field">
                        @csrf

                        {{-------------------------- Form Fields ---------------------}}



                        {{--------------------------Sub Field Name ---------------------}}
                        <div class="form-group row">
                            <label for="sub_field_name" class="col-md-4 col-form-label text-md-right">{{ __('Sub Field Name: ') }}</label>

                            <div class="col-md-6">
                                <input id="sub_field_name" type="text" class="form-control" name="sub_field_name" value="{{ old('sub_field_name') }}"  autocomplete="description" autofocus required>
                            </div>
                        </div>

                        {{-------------------------- Field Type ---------------------}}
                        <div class="form-group row">
                            <label for="field_id" class="col-md-4 col-form-label text-md-right">{{ __('Field Type: ') }}</label>

                            <div class="col-md-6">
                                <select class="form-control" id="field_id" name="field_id">
                                    <option selected> -------- </option>

                                    @foreach($data['field'] as $field)
                                        <option value="{{$field->fieldID}}">{{$field->fieldName}}</option>
                                    @endforeach

                                </select>
                                @error('field_id')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        {{-------------------------- Translation ---------------------}}
                        <div class="form-group row">
                            <label for="translation" class="col-md-4 col-form-label text-md-right">{{ __('Translation: ') }}</label>

                            <div class="col-md-6">
                                <input id="translation" type="text" class="form-control" name="translation" value="{{ old('translation') }}"  autocomplete="description" autofocus>
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
    <!------------------------------------Add Sub Field Modal Ends ------------------------------->



    <!--------------------------------Edit Modal Starts------------------------------------>



    <div class="modal fade" id="edit_sub_field_modal" tabindex="-1" role="dialog" aria-labelledby="edit_sub_field_modalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_sub_field_modalLabel">Edit Field</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="/edit_sub_field" enctype="multipart/form-data">
                        @csrf
                        {{--------------------------Sub Field Name---------------------------}}
                        <input type="hidden" id="sub_field_id" name="sub_field_id" value="">
                        <div class="form-group">
                            <label for="sub_field_name" class="col-form-label">Field Name: </label>
                            <input type="text" class="form-control" id="sub_field_name" name="sub_field_name">
                        </div>


                        {{-------------------------- Field Type ---------------------------}}
                        <div class="form-group">
                            <label for="field_id" class="col-form-label">Field Type:</label>
                            <select class="form-control" id="field_id" name="field_id">
                                <option value="">  </option>
                                @if($data['found'])
                                @foreach($data['field'] as $field)
                                    <option value="{{$field->fieldID}}">{{$field->fieldName}}</option>
                                @endforeach
                                @endif
                            </select>
                        </div>
                        {{-------------------------- Translation ---------------------------}}
                        <div class="form-group">
                            <label for="translation" class="col-form-label">Translation:</label>
                            <textarea class="form-control" id="translation" rows="3" name="translation"></textarea>
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

@section('edit_js')
    <script>
        $('#edit_sub_field_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var field_id = button.data('field_id')
            var sub_field_id = button.data('sub_field_id')
            var sub_field_name = button.data('sub_field_name')
            var translation = button.data('translation')
            var modal = $(this)
            modal.find('.modal-body #sub_field_name').val(sub_field_name)
            modal.find('.modal-body #field_id').val(field_id)
            modal.find('.modal-body #sub_field_id').val(sub_field_id)
            modal.find('.modal-body #translation').val(translation)
        })
    </script>
@endsection
