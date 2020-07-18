@extends('layouts.main')

@section('content')
<div style="margin: 0px 10px 10px 10px; padding: 10px">
  @if(session()->get('success'))
  <div class="alert alert-success">
    {{ session()->get('success') }}
  </div><br />
  @endif

  <div class="card">
    <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">ADD NEW RIDER</h1>
      <a href="{{ route('rider.index') }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Riders List</span></a>

    </div>
    <div class="card-body">
      <form role="form" method="post" action="{{ route('rider.store') }}" enctype="multipart/form-data">
        @csrf
        <fieldset>
          <legend style="color: black; font-family: serif; font-weight: bold">BASIC DETAILS</legend>
          <hr>
          <!-- Text input-->
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

                <input value="{{ old('last_name') }}" name="last_name" style="border-radius: 0px" class="form-control " required="" type="text">

              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="phone">PHONE</label>

                <input id="phone" value="{{ old('phone_number') }}" id="phone" name="phone_number" style="border-radius: 0px" class="form-control " required="" type="tel">
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
                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="cnic">CNIC</label>
                <input id="cnic" name="cnic" style="border-radius: 0px" class="form-control " required="" type="text">
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="cnic_expiry">CNIC Expiry Date</label>
                <input id="cnic_expiry" name="cnic_expire_date" style="border-radius: 0px" class="form-control " required="" type="date">
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
                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="status">ONLINE/OFFLINE</label>
                <select id="status" name="eStatus" style="border-radius: 0px" class="form-control">
                  <option value="10">Online</option>
                  <option value="9">Offline</option>
                </select>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="country">COUNTRY</label>
                <select id="country" name="country_id" style="border-radius: 0px" class="form-control">
                  <option>Select Country</option>
                  <option value="166">Pakistan</option>
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="state">STATE</label>

                <select id="state" name="state_id" style="border-radius: 0px" class="form-control">
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
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="city">CITY</label>

                <select id="city" name="city_id" style="border-radius: 0px" class="form-control">
                  <option selected="" disabled="" hidden="">Select City</option>
                </select>
                @if($errors->has('city_id'))
                <small class="text-danger ml-2">{{ $errors->first('city_id') }}</small>
                @endif
                </select>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="restaurant">RESTAURANT</label>
                <select id="branch" name="restaurant_id" style="border-radius: 0px" class="form-control">
                  <option selected="" disabled="" hidden="">Choose Branch</option>
                  @foreach(Helper::branch() as $key=> $branch)
                  <option value="{{$branch->id}}">{{$branch->name}}</option>
                  @endforeach
                </select>
                @if($errors->has('restaurant_id'))
                <small class="text-danger ml-2">{{ $errors->first('restaurant_id') }}</small>
                @endif
              </div>
              <input type="hidden" id="latitude" name="latitude">
              <input type="hidden" id="longitude" name="longitude">
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="rider_image">RIDER IMAGE</label>
                <br>
                <input id="rider_image" class="col-md-6" name="profile" class="input-file" type="file">

              </div>
            </div>

          </div>

          <!-- Text input-->
          <hr>
          <legend style="color: black; font-family: serif; font-weight: bold">ADDRESS DETAILS</legend>
          <hr>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="address">ADDRESS</label>
                <input id="address" name="address" style="border-radius: 0px" class="form-control" readonly="" required="" type="text">


              </div>
            </div>
            <div class="col-sm-12">
              <div class="form-group">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6806.007666440382!2d74.31320992509033!3d31.469080725546153!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x391906aa20f282d1%3A0x1f670ea0693b1114!2sTele%20Tower!5e0!3m2!1sen!2s!4v1592383763663!5m2!1sen!2s" width="100%" height="300" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>

              </div>
            </div>

          </div>

          <hr>
          <!-- Button -->
          <div class="form-group text-right" style="margin-top: 1rem">

            <button id="add_rider" name="add_rider" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">ADD RIDER</button>

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
    $("#branch").change(function() {
      var id = $(this).val();
      $.ajax({
        type: "post",
        url: "{{ URL::route('rider.info') }}",
        data: {
          "_token": "{{ csrf_token() }}",
          id: id
        },
        success: function(data) {
          console.log(data)
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

    $("#state").change(function() {
      var id = $(this).val();
      console.log(id)
      $.ajax({
        type: "post",
        url: "{{ URL::route('getCities') }}",
        data: {
          "_token": $('meta[name="csrf-token"]').attr('content'),
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