@extends('layouts.main')

@section('title', 'Update User')

@section('content')
<div class="row">
    <div class="col-sm-12">

        <div class="card">
            <div class="card-body cat-card-body">
                <form role="form" method="post" action="{{ route('user.update') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name='id' value="{{$model->id}}">
                    <div class="row form-group category-table">
                        <div class="col col-6 col-sm-6">
                            <input type="text" name="first_name" placeholder="Enter First Name" class="form-control" required="" value="{{$model->first_name}}">
                        </div>
                        <div class="col col-6 col-sm-6">
                            <input type="text" name="last_name" placeholder="Enter Last Name" class="form-control" required="" value="{{$model->last_name}}">
                        </div>
                    </div>

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <select name="restaurant_id" id="branch" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Choose Branch</option>
                                @foreach(Helper::branch() as $key=> $branch)
                                <option value="{{$branch->id}}" {{ $branch->id == $model->restaurant_id ? 'selected' : '' }}>{{$branch->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <input type="hidden" id="latitude" name="latitude">
                        <input type="hidden" id="longitude" name="longitude">
                    </div>
                    <!--For entering post tags-->

                    <div class="row form-group category-table">
                        <div class="col col-12 col-sm-12">
                            <input type="text" name="email" placeholder="Enter User Email" class="form-control" required="" value="{{$model->email}}">
                            @if($errors->has('email'))
                            <small class="text-danger ml-2">{{ $errors->first('email') }}</small>
                            @endif
                        </div>


                    </div>

                    <div class="row form-group category-table">
                        <div class="col col-6 col-sm-6">
                            <input type="text" id="phone" name="phone_number" placeholder="Enter Phone Number" class="form-control" required="" value="{{$model->phone_number}}">
                        </div>
                        <div class="col col-6 col-sm-6">
                            <select name="role" id="role" class="form-control selectpicker" data-live-search="true" tabindex="-98">
                                <option selected="" disabled="" hidden="">Select Role</option>
                                @foreach(Helper::roles() as $key=> $role)
                                <option value="{{$role->name}}" {{$role->name==$model->roles->pluck('name')->first() ? 'selected' : ''}}>{{$role->name}}</option>
                                @endforeach
                            </select>
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
                                            <img id="profileDisplay" src="{{ ($model->profile_picture) ? asset($model->profile_picture) : asset('/images/ic_gallery.jpg') }}" alt="" style="width: 25%">
                                        </div>

                                        <div class="fileupload-preview fileupload-exists" style="display: flex; margin: 0 auto;justify-content: center;margin-bottom: 20px;width: 25%; max-height: 120px"></div>

                                        <div class="cat-select-img-btn">
                                            <span class="btn btn-theme02 btn-file  sel-img-text">
                                                <span class="fileupload-new"><i class="fa fa-paperclip"></i> Browse</span>
                                                <!--<span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>-->
                                                <input type="file" id="profile" accept="image/*" name="profile" class="default">
                                            </span>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-success btn-lg"> <i class="fa fa-save"></i> Save</button>
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
        $("#branch").change(function() {
            var id = $(this).val();
            $.ajax({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
                },
                type: "post",
                url: "{{ URL::route('info') }}",
                data: {
                    id: id
                },
                success: function(data) {
                    if (data) {
                        var data = $.parseJSON(data);
                        $('#latitude').val(data.latitude)
                        $('#longitude').val(data.longitude)
                    } else {
                        alert('Cannot find info');
                    }
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