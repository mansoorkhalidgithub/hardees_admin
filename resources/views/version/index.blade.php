@extends('layouts.main')
@section('content')

<div style="margin: 0px 10px 10px 10px">

    <div class="uper" style="overflow-x: scroll; margin-bottom: 50px">

        <table class="table table-striped table-hover" id="version_list" style=" font-size: 13px">
            <thead>
                <tr style="color:black">
                    <th>#</th>
                    <th>Android Version</th>
                    <th>IOS Version</th>
                    <th>Type</th>
                    <th style="min-width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($model as $key => $version)
                <tr style="color: black">
                    <td>{{++$key}}</td>
                    <td> {{ $version->android }} </td>
                    <td> {{ $version->ios }} </td>
                    <td> {{ $version->type }} </td>

                    <td>
                        <a href="{{route('version.edit', $version->id)}}" class="d-none d-sm-inline btn btn-sm shadow-sm" style="background-color: #F6BF2D;" title="Edit"><i class="fas fa-pencil-alt" style="color: #28a745"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('extra') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>



<script>
    $(document).ready(function() {
        $.noConflict();
        var table = $('#version_list').DataTable();

    });
</script>

@endsection