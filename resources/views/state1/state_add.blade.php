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
		<h1 class="h3 mb-0 " style="color: black; font-family: serif; font-weight: bold">ADD NEW STATE</h1>
                <a href="{{ route('state') }}"
                   class="d-none d-sm-inline-block btn btn-sm shadow-sm" style="background-color:#ffc107; color: black"><i
                        class="fas fa-fw fa-1x fa-arrow-left fa-sm text-dark-300"></i> <span style="font-weight: bold">Back to State List</span></a>

	</div>
      <div class="card-body">
    <form>
<fieldset>


<div class="row">
    <div class="col-sm-12"><div class="form-group">

    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="country">COUNTRY</label>

    <select id="country" name="country" style="border-radius: 0px" class="form-control">
        <option>Select Country</option>
        <option>Pakistan</option>
    </select>


</div>
</div>

</div>
<div class="row">
    <div class="col-sm-12"><div class="form-group">
    <label class="col-md-4" style="color: black; font-size: 12px; font-weight: 700" for="state_name">STATE NAME</label>

    <input id="state_name" name="state_name" style="border-radius: 0px" class="form-control " required="" type="text">


</div>
</div>

</div>

<div class="row">
    <div class="col-sm-12"><div class="form-group">
    <label class="col-md-4 " style="color: black; font-size: 12px; font-weight: 700" for="status">STATUS</label>

    <select id="status" name="status" style="border-radius: 0px" class="form-control">
        <option>Active</option>
        <option>Deactive</option>
    </select>


</div>
</div>


</div>
<hr>
<!-- Button -->
<div class="form-group text-right" style="margin-top: 1rem">

      <button id="add_state" name="add_state" class="btn" style="background-color: #F6BF2D; color: black;  font-weight: bold">ADD STATE</button>

  </div>
</fieldset>
</form>
</div>
</div>
</div>
@endsection
