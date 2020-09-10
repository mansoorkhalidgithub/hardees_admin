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
            <h1 class="h3 mb-0" style="color: black; font-family: serif; font-weight: bold">Update {{$model->first_name}} {{$model->last_name}} </h1>
            <a href="{{ route('version.index') }}" class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to Version List</span></a>

        </div>
        <div class="card-body">
            <form role="form" method="post" action="{{ route('version.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name='id' value="{{$model->id}}">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="address">Android Version</label>
                            <input id="address" value="{{$model->android}}" name="android" style="border-radius: 0px" class="form-control" required="" type="text">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="address">IOS Version</label>
                            <input id="address" value="{{$model->ios}}" name="ios" style="border-radius: 0px" class="form-control" required="" type="text">
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="address">Type</label>
                            <input id="address" value="{{$model->type}}" name="type" style="border-radius: 0px" class="form-control" required="" type="text">
                        </div>
                    </div>

                </div>

                <hr>
                <!-- Button -->
                <div class="form-group text-right" style="margin-top: 1rem">

                    <button name="update-version" class="btn" style="background-color: #F6BF2D; color: black; font-weight: bold">Update Version</button>

                </div>
                </fieldset>
            </form>
        </div>
    </div>
</div>
@endsection