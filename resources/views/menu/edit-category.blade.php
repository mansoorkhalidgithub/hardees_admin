@extends('layouts.main')

@section('content')
<div  style="margin: 0px 10px 10px 10px; padding: 10px">
    @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div><br />
  @endif

  <div class="card">
  <div class="card-header d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0"style="color: black; font-family: serif; font-weight: bold">UPDATE MENU CATEGORY</h1>

                <a href="{{ route('menu-categories') }}"
      class="d-none d-sm-inline-block btn btn-sm  shadow-sm"  style="background-color: #ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-white-300"></i> <span style="font-weight: bold">Menu Category List</span></a>

  </div>
      <div class="card-body">
    <form role="form" method="post" action="{{route('update-category')}}" enctype="multipart/form-data">
                @csrf
<fieldset>

<!-- Form Name -->
<legend style="color: black; font-family: serif; font-weight: bold">EDIT MENU CATEGORY</legend>
<hr>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="category_name">CATEGORY NAME</label>
<input type="hidden" value="{{$catgorey->id}}" name="categoryId">
  <input id="category_name" value="{{ $catgorey->name?$catgorey->name:old('name') }}" name="name" style="border-radius: 0px" class="form-control " required="" type="text">
@if ($errors->has('name'))
                            <span class="help-block text-danger">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif

</div>
<div class="form-group text-right" style="margin-top: 1rem">

      <button id="update_menu" name="update_menu" class="btn" style="background-color: #F6BF2D; color: black;  font-weight: bold;">UPDATE CATEGOR</button>

  </div>
<!-- <div class="form-group text-center" style="margin-top: 3rem">

      <button id="add_category" name="add_category" class="btn" style="background-color: #F6BF2D; color: black; width: 70%; font-weight: bold">UPDATE CATEGORY</button>

  </div> -->
</fieldset>
</form>
</div>
</div>
</div>
@endsection
