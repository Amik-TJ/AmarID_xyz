@extends('layouts.admin_layout')
@section('content')
<div class="container-fluid px-lg-4">
    <div class="row">
        <div class="col-md-12 mt-lg-4 mt-4">
            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
                <h1 class="h3 mb-0 text-gray-800">Packages</h1>
                <button type="button" class="d-none d-sm-inline-block btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#create_package_modal"><i class="fas fa-address-card"></i>
                    Create a New Package</button>

            </div>
        </div>
        <div class="col-md-12">
            <div class="row">
                @foreach($packages as $package)
                <div class="col-sm-3 mb-4">
                    <div class="card h-100">
                        <div class="card-body">
                            <h4 class="mb-3 text-success">{{$package->title}}</h4>
                            <h6 class="mt-1 mb-1"><span class="font-weight-bold">Price: </span>{{$package->price}} TK</h6>
                            <h6 class="mt-1 mb-1"><span class="font-weight-bold">Discount: </span>{{$package->discount}} TK</h6>
                            <div class="mb-1">

                                <h6 class=""> <span class="text-primary">Hard Copy :</span>
                                    @if($package->hardCopyIncluded)
                                        Included
                                    @else
                                        Not Included
                                    @endif
                                </h6>
                                <h6 class=""><span class="text-primary">Side :</span>
                                    @if($package->oneSidedCard)
                                        Both Side
                                    @else
                                        One Side
                                    @endif
                                </h6>
                                <h6 class=""><span class="text-primary">Soft Copies :</span>
                                    @if($package->noOfSoftID == null)
                                        No Soft Copies
                                    @else
                                        {{$package->noOfSoftID}}
                                    @endif
                                </h6>
                                <h6><span class="text-primary">Rounded Option :</span>
                                    @if($package->roundedOption == 1)
                                        Yes
                                        <h6><span class="text-primary">Rounded Price : </span>{{$package->roundPrice}}</h6>
                                    @else
                                        No
                                    @endif
                                </h6>
                                <h6><span class="text-primary">Spot Option :</span>
                                    @if($package->spotOption == 1)
                                        Yes
                                        <h6><span class="text-primary">Spot Price : </span>{{$package->spotPrice}}</h6>
                                    @else
                                        No
                                    @endif
                                </h6>
                                <h6 class=""><span class="text-primary">Texture Option :</span>
                                    @if($package->textureOption == 1)
                                        Yes
                                    @else
                                        No
                                    @endif
                                </h6>
                                <h6><span class="text-primary">Weight :</span>
                                    @if($package->weight == null)
                                        No Weight Specified
                                    @else
                                        {{$package->weight}}
                                    @endif
                                </h6>
                                <p class="">{{$package->description}}</p>
                            </div>


                        </div>
                        <div class="card-footer">
                            <button type="button" class="btn btn-warning btn-sm float-left" data-toggle="modal" data-target="#edit_package_modal" data-package_id="{{$package->packageID}}" data-title="{{$package->title}}" data-description="{{$package->description}}" data-hard_copy_included="{{$package->hardCopyIncluded}}" data-one_sided_card="{{$package->oneSidedCard}}" data-rounded_option="{{$package->roundedOption}}"data-texture_option="{{$package->textureOption}}" data-spot_option="{{$package->spotOption}}" data-round_price="{{$package->roundPrice}}"data-spot_price="{{$package->spotPrice}}" data-weight="{{$package->weight}}" data-price="{{$package->price}}" data-no_of_soft_id="{{$package->noOfSoftID}}" data-discount="{{$package->discount}}">Edit</button>
                            <form action="/delete_package" method="Post">
                                @csrf
                                <input type="hidden" name="package_id" value="{{$package->packageID}}">
                                <button class="btn btn-danger float-right btn-sm">Archive</button>
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


<!------------------------------------Create Package Modal Starts ------------------------------->
<div class="modal fade" id="create_package_modal" tabindex="-1" role="dialog" aria-labelledby="create_package_modalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-success" id="exampleModalLongTitle">Create a new Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/create_new_package">
                    @csrf

                    {{-------------------------- Form Fields ---------------------}}

                    {{-------------------------- Title ---------------------}}
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Tilte') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Description ---------------------}}
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"  autocomplete="description" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Number of Soft Copies ---------------------}}
                    <div class="form-group row">
                        <label for="noOfSoftID" class="col-md-4 col-form-label text-md-right">{{ __('No Of SoftID') }}</label>

                        <div class="col-md-6">
                            <input id="noOfSoftID" type="number" class="form-control" name="noOfSoftID" value="{{ old('noOfSoftID') }}"  autocomplete="noOfSoftID" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Hard Copy Included ---------------------}}
                    <div class="form-group row">
                        <label for="hardCopyIncluded" class="col-md-4 col-form-label text-md-right">{{ __('Hard Copy') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="hardCopyIncluded" name="hardCopyIncluded">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- One Sided Copy ---------------------}}
                    <div class="form-group row">
                        <label for="oneSidedCard" class="col-md-4 col-form-label text-md-right">{{ __('Card Side(One or Both)') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="oneSidedCard" name="oneSidedCard">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- Rounded Option---------------------}}
                    <div class="form-group row">
                        <label for="rounded_option" class="col-md-4 col-form-label text-md-right">{{ __('Rounded Option') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="rounded_option" name="rounded_option">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- Rounded Price ---------------------}}
                    <div id="show_rounded_price" style="display:none">
                        <div class="form-group row">
                            <label for="round_price" class="col-md-4 col-form-label text-md-right">{{ __('Round Price') }}</label>
                            <div class="col-md-6">
                                <input id="round_price" type="number" class="form-control" name="round_price" value="{{ old('round_price') }}"  autocomplete="round_price" autofocus >
                            </div>
                        </div>
                    </div>


                    {{-------------------------- Spot Option---------------------}}
                    <div class="form-group row">
                        <label for="spot_option" class="col-md-4 col-form-label text-md-right">{{ __('Spot Option') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="spot_option" name="spot_option" >
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- Spot Price ---------------------}}
                    <div id="show_spot_price" style="display:none">
                        <div class="form-group row">
                            <label for="spot_price" class="col-md-4 col-form-label text-md-right">{{ __('Spot Price') }}</label>
                            <div class="col-md-6">
                                <input id="spot_price" type="number" class="form-control" name="spot_price" value="{{ old('spot_price') }}"  autocomplete="spot_price" autofocus >
                            </div>
                        </div>
                    </div>
                    {{-------------------------- Texture Option---------------------}}
                    <div class="form-group row">
                        <label for="texture_option" class="col-md-4 col-form-label text-md-right">{{ __('Texture Option') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="texture_option" name="texture_option">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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

                    {{-------------------------- Price ---------------------}}
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Discount ---------------------}}
                    <div class="form-group row">
                        <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>
                        <div class="col-md-6">
                            <input id="discount" type="number" class="form-control" name="discount" value="{{ old('discount') }}"  autocomplete="discount" autofocus>
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
<!------------------------------------Create Modal Ends------------------------------->


<!--------------------------------Edit Modal Starts------------------------------------>



<div class="modal fade" id="edit_package_modal" tabindex="-1" role="dialog" aria-labelledby="edit_package_modalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_package_modalLabel">Edit Package</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/edit_package">
                    @csrf

                    {{-------------------------- Form Fields ---------------------}}

                    <input type="hidden" id="package_id" name="package_id" value="">

                    {{-------------------------- Title ---------------------}}
                    <div class="form-group row">
                        <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Tilte') }}</label>

                        <div class="col-md-6">
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}"  autocomplete="title" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Description ---------------------}}
                    <div class="form-group row">
                        <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                        <div class="col-md-6">
                            <input id="description" type="text" class="form-control" name="description" value="{{ old('description') }}"  autocomplete="description" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Number of Soft Copies ---------------------}}
                    <div class="form-group row">
                        <label for="no_of_soft_id" class="col-md-4 col-form-label text-md-right">{{ __('No Of SoftID') }}</label>

                        <div class="col-md-6">
                            <input id="no_of_soft_id" type="number" class="form-control" name="no_of_soft_id" value="{{ old('no_of_soft_id') }}"  autocomplete="noOfSoftID" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Hard Copy Included ---------------------}}
                    <div class="form-group row">
                        <label for="hard_copy_included" class="col-md-4 col-form-label text-md-right">{{ __('Hard Copy') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="hard_copy_included" name="hard_copy_included">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- One Sided Copy ---------------------}}
                    <div class="form-group row">
                        <label for="one_sided_card" class="col-md-4 col-form-label text-md-right">{{ __('Card Side(One or Both)') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="one_sided_card" name="one_sided_card">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- Rounded Option---------------------}}
                    <div class="form-group row">
                        <label for="rounded_option" class="col-md-4 col-form-label text-md-right">{{ __('Rounded Option') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="rounded_option" name="rounded_option">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- Rounded Price ---------------------}}
                    <div id="show_rounded_price">
                        <div class="form-group row">
                            <label for="round_price" class="col-md-4 col-form-label text-md-right">{{ __('Round Price') }}</label>
                            <div class="col-md-6">
                                <input id="round_price" type="number" class="form-control" name="round_price" value="{{ old('round_price') }}"  autocomplete="round_price" autofocus >
                            </div>
                        </div>
                    </div>


                    {{-------------------------- Spot Option---------------------}}
                    <div class="form-group row">
                        <label for="spot_option" class="col-md-4 col-form-label text-md-right">{{ __('Spot Option') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="spot_option" name="spot_option" >
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                    </div>

                    {{-------------------------- Spot Price ---------------------}}
                    <div id="show_spot_price" >
                        <div class="form-group row">
                            <label for="spot_price" class="col-md-4 col-form-label text-md-right">{{ __('Spot Price') }}</label>
                            <div class="col-md-6">
                                <input id="spot_price" type="number" class="form-control" name="spot_price" value="{{ old('spot_price') }}"  autocomplete="spot_price" autofocus >
                            </div>
                        </div>
                    </div>
                    {{-------------------------- Texture Option---------------------}}
                    <div class="form-group row">
                        <label for="texture_option" class="col-md-4 col-form-label text-md-right">{{ __('Texture Option') }}</label>
                        <div class="col-md-6">
                            <select class="form-control" id="texture_option" name="texture_option">
                                <option >----</option>
                                <option value="1">Yes</option>
                                <option value="0">No</option>
                            </select>
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

                    {{-------------------------- Price ---------------------}}
                    <div class="form-group row">
                        <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('Price') }}</label>
                        <div class="col-md-6">
                            <input id="price" type="number" class="form-control" name="price" value="{{ old('price') }}"  autocomplete="price" autofocus required>
                        </div>
                    </div>

                    {{-------------------------- Discount ---------------------}}
                    <div class="form-group row">
                        <label for="discount" class="col-md-4 col-form-label text-md-right">{{ __('Discount') }}</label>
                        <div class="col-md-6">
                            <input id="discount" type="number" class="form-control" name="discount" value="{{ old('discount') }}"  autocomplete="discount" autofocus>
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
<!--------------------------------Edit Modal Ends------------------------------------>
@endsection



{{----------------------------------JavaScript Section Starts-------------------------------}}

@section('package_js')
    <script type="text/javascript">
        $('#rounded_option').on('change', function (e) {
            var valueSelected = $(this).find("option:selected").val();
            if(valueSelected =='1'){
                $('#show_rounded_price').show();
            } else {
                $('#show_rounded_price').hide();
            }
        });

        $('#spot_option').on('change', function (e) {
            var valueSelected = $(this).find("option:selected").val();
            if(valueSelected =='1'){
                $('#show_spot_price').show();
            } else {
                $('#show_spot_price').hide();
            }
        });
    </script>
@endsection


@section('edit_js')
    <script>
        $('#edit_package_modal').on('show.bs.modal', function (event) {

            var button = $(event.relatedTarget)
            var package_id = button.data('package_id')
            var title = button.data('title')
            var description = button.data('description')
            var hard_copy_included = button.data('hard_copy_included')
            var one_sided_card = button.data('one_sided_card')
            var rounded_option = button.data('rounded_option')
            var texture_option = button.data('texture_option')
            var spot_option = button.data('spot_option')
            var round_price = button.data('round_price')
            var spot_price = button.data('spot_price')
            var weight = button.data('weight').split(",");
            var price = button.data('price')
            var no_of_soft_id = button.data('no_of_soft_id')
            var discount = button.data('discount')
            var modal = $(this)


            if(weight != 'Null'){
                for(var i=0; i<weight.length;i++){
                    if(weight[i] == 'B'){
                        modal.find('.modal-body #weight1').prop('checked', weight[i]);
                    }else if(weight[i] == 'S'){
                        modal.find('.modal-body #weight2').prop('checked', weight[i]);
                    }else{
                        modal.find('.modal-body #weight3').prop('checked', weight[i]);
                    }
                    console.log(weight[i]);
                }
            }

            modal.find('.modal-body #package_id').val(package_id)
            modal.find('.modal-body #title').val(title)
            modal.find('.modal-body #description').val(description)
            modal.find('.modal-body #hard_copy_included').val(hard_copy_included)
            modal.find('.modal-body #one_sided_card').val(one_sided_card)
            modal.find('.modal-body #rounded_option').val(rounded_option)
            modal.find('.modal-body #texture_option').val(texture_option)
            modal.find('.modal-body #spot_option').val(spot_option)
            modal.find('.modal-body #round_price').val(round_price)
            modal.find('.modal-body #spot_price').val(spot_price)
            //modal.find('.modal-body #weight').val(weight)
            modal.find('.modal-body #price').val(price)
            modal.find('.modal-body #no_of_soft_id').val(no_of_soft_id)
            modal.find('.modal-body #discount').val(discount)
        })
    </script>
@endsection

{{----------------------------------JavaScript Section Ends-------------------------------}}
