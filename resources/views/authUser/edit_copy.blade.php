@extends('layouts.main')

@section('title', 'Update Admin')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 style="color: black; font-family: serif; font-weight: bold">Create @yield('title')</h3>
        @role('admin')
        <a href="{{ url()->previous() }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm font-weight-bold" style="background-color: #ffc107; color: black">
            <i class="fas fa-arrow-left"></i>
            Admin List
        </a>
        @endrole
    </div>
    <div class="col-sm-12">

        <div class="card">
            <div class="card-body cat-card-body">
                <form role="form" method="post" action="{{ route('auth.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" value="{{$model->id}}" name="id">
                    <div class="row form-group category-table">
                        <div class="col col-6 col-sm-6">
                            <input type="text" value="{{ $model->first_name }}" name="first_name" placeholder="Enter First Name" class="form-control" required="">
                        </div>
                        <div class="col col-6 col-sm-6">
                            <input type="text" value="{{ $model->last_name }}" name="last_name" placeholder="Enter Last Name" class="form-control" required="">
                        </div>
                    </div>
                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" value="{{ $model->email }}" name="email" placeholder="Enter User Email" class="form-control" required="">
                            @if($errors->has('email'))
                            <small class="text-danger ml-2">{{ $errors->first('email') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group category-table">
                        <div class="col col-6 col-sm-6">
                            <select name="state_id" id="state" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Select State</option>
                                @foreach(Helper::getStates() as $key=> $state)
                                <option value="{{$state->id}}" {{ $state->id === $model->state_id ? 'selected' : '' }}>{{$state->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('state_id'))
                            <small class="text-danger ml-2">{{ $errors->first('state_id') }}</small>
                            @endif
                        </div>
                        <div class="col col-6 col-sm-6">
                            <select name="city_id" id="city" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                @foreach(App\City::where('state_id',$model->state_id)->get() as $key=> $city)
                                <option value="{{$city->id}}" {{ $city->id === $model->city_id ? 'selected' : '' }}>{{$city->name}}</option>
                                @endforeach
                            </select>
                            @if($errors->has('city_id'))
                            <small class="text-danger ml-2">{{ $errors->first('city_id') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row form-group category-table">
                        <div class="col col-6 col-sm-6">
                            <input type="text" value="{{ $model->phone_number }}" id="phone" name="phone_number" placeholder="Enter Phone Number" class="form-control" required="">
                            @if($errors->has('phone_number'))
                            <small class="text-danger ml-2">{{ $errors->first('phone_number') }}</small>
                            @endif
                        </div>
                        <div class="col col-6 col-sm-6">
                            <select name="role" id="role" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Select Role</option>
                                @role('admin')
                                <option value="sub-admin">Sub Admin</option>
                                <option value="user">User</option>
                                @endrole
                                @role('sub-admin')
                                <option value="user">User</option>
                                @endrole
                            </select>
                            @if($errors->has('role'))
                            <small class="text-danger ml-2">{{ $errors->first('role') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-12 col-sm-12">
                            <div class="row form-group category-table">
                                <div class="col col-12 col-sm-12">
                                    <label style="text-align: left">Upload Profile Picture</label>
                                </div>
                            </div>

                            <div class="row form-group category-table" id="ifYesForImage" style="display: flex;">
                                <div class="col col-12 col-sm-12">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">

                                        <div class="fileupload-new thumbnail" style="width: 100%">
                                            <img id="profileDisplay" src="{{ asset('/') }}images/ic_gallery.jpg" alt="" style="width: 25%">
                                        </div>

                                        <div class="fileupload-preview fileupload-exists" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>

                                        <div class="cat-select-img-btn">
                                            <span class="btn btn-theme02 btn-file  sel-img-text">
                                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                                                <!--<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>-->
                                                <input type="file" id="profile" accept="image/*" name="profile_picture" class="default">
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-center">
                        <button type="submit" style="background-color: #F6BF2D; color: black;text-align:center; width: 70%; font-weight: bold;" class="btn btn-success btn-lg"> <i class="fa fa-save"></i> Save</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

</div>
</div>
@stop
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $("#state").change(function() {
            var id = $(this).val();
            console.log(id)
            $.ajax({
                type: "post",
                url: "{{ URL::route('getCities') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    id: id
                },
                success: function(data) {
                    console.log(data)
                    $('#city').html(data.html);
                }
            });
        });
        $.noConflict();
        $("#profile").change(function(e) {
            var fileName = e.target.files[0].name;
            //$('#imageLabel').html(fileName);
            readURL(this);
        });
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profileDisplay').src = e.target.result;
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>