@extends('layouts.main')

@section('content')
<div style="margin: 0px 10px 10px 10px; padding: 10px">

    <div class="card">
        <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">ADD NEW ADMIN</h1>
            <a href="{{ route('auth.index') }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Admins List</span></a>
        </div>
        <div class="card-body">
            <form role="form" method="post" action="{{ route('auth.store') }}" enctype="multipart/form-data">
                @csrf
                <fieldset>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="admin_type">ADMIN TYPE</label>

                                <select id="admin_type" name="admin_type" style="border-radius: 0px" class="form-control">
                                    <option selected="" disabled="" hidden="">Choose Admin Type</option>
                                    @foreach(App\MasterModel::ADMIN_TYPE as $key => $type)
                                    <option value="{{$key}}">{{$type}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('admin_type'))
                                <small class="text-danger ml-2">{{ $errors->first('admin_type') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="user_name">USERNAME</label>

                                <input id="user_name" name="username" value="{{ old('username') }}" style="border-radius: 0px" class="form-control " required="" type="text">
                                @if($errors->has('username'))
                                <small class="text-danger ml-2">{{ $errors->first('username') }}</small>
                                @endif

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="first_name">FIRST NAME</label>

                                <input id="first_name" value="{{ old('first_name') }}" name="first_name" style="border-radius: 0px" class="form-control " required="" type="text">


                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="last_name">LAST NAME</label>

                                <input id="last_name" name="last_name" value="{{ old('last_name') }}" style="border-radius: 0px" class="form-control " required="" type="text">


                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="pass">PASSWORD</label>
                                <input id="pass" value="{{ old('password') }}" name="password" style="border-radius: 0px" class="form-control " required="" type="password">
                                @if($errors->has('password'))
                                <small class="text-danger ml-2">{{ $errors->first('password') }}</small>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="con_pass">CONFIRM PASSWORD</label>
                                <input id="confirm_password" value="{{ old('password') }}" name="confirm_password" style="border-radius: 0px" class="form-control " required="" type="password">
                                @if($errors->has('confirm_password'))
                                <small class="text-danger ml-2">{{ $errors->first('confirm_password') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="phone">PHONE NUMBER</label>

                                <input id="phone" value="{{ old('phone_number') }}" name="phone_number" style="border-radius: 0px" class="form-control " required="" type="tel">
                                @if($errors->has('phone_number'))
                                <small class="text-danger ml-2">{{ $errors->first('phone_number') }}</small>
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="email">EMAIL</label>

                                <input id="email" value="{{ old('email') }}" name="email" style="border-radius: 0px" class="form-control " required="" type="email">
                                @if($errors->has('email'))
                                <small class="text-danger ml-2">{{ $errors->first('email') }}</small>
                                @endif

                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="country">COUNTRY</label>
                                <select id="country" name="country" style="border-radius: 0px" class="form-control">
                                    <option>Select Country</option>
                                    <option value="166">Pakistan</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="state">STATE</label>

                                <select name="state_id" id="state" style="border-radius: 0px" class="form-control">
                                    <option selected="" disabled="" hidden="">Select State</option>
                                    @foreach(Helper::getStates() as $key=> $state)
                                    <option value="{{$state->id}}">{{$state->name}}</option>
                                    @endforeach
                                </select>
                                @if($errors->has('state_id'))
                                <small class="text-danger ml-2">{{ $errors->first('state_id') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="city">CITY</label>

                                <select name="city_id" id="city" style="border-radius: 0px" class="form-control">
                                    <option selected="" disabled="" hidden="">Select City</option>
                                </select>
                                @if($errors->has('city_id'))
                                <small class="text-danger ml-2">{{ $errors->first('city_id') }}</small>
                                @endif

                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="status">STATUS</label>

                                <select id="status" name="status" style="border-radius: 0px" class="form-control">
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>


                            </div>
                        </div>

                    </div>
                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="admin_image">ADMIN IMAGE</label>
                                <br>
                                <input id="admin_image" name="profile" class="input-file" type="file">


                            </div>
                        </div>

                    </div>



                    <hr>
                    <!-- Button -->
                    <div class="form-group text-right" style="margin-top: 1rem">

                        <button id="add_admin" name="add_admin" class="btn" style="background-color: #F6BF2D; color: black;  font-weight: bold">ADD ADMIN</button>

                    </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection
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