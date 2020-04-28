@extends('layouts.main')

@section('title', 'All Restaurants Request')

@section('content')

<div class="row">
    <div class="col-12">
        <div class="card">
            <!-- /.card-header -->
            <div class="card-body">
                <div class="">
                    <table id="restaurants" class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Restaurant Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">More</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Sam</td>
                                <td>Zama Zama</td>
                                <td>sam@evitaerc.co.za </td>
                                <td>03336268994</td>
                                <td>aa,Miami,La,United States</td>
                                <td>nothing</td>
                                <td> <i class="fas fa-edit"></i> <i class="fas fa-eye"></i> </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Name</th>
                                <th scope="col">Restaurant Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Address</th>
                                <th scope="col">More</th>
                                <th scope="col">Action</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
<script src="{{ asset('admin') }}/plugins/jquery/jquery.min.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables/jquery.dataTables.js"></script>
<script src="{{ asset('admin') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>

<meta name="csrf-token" content="{{ csrf_token() }}" />

<script>
    $(document).ready(function() {
        $.noConflict();
        var table = $('#restaurants').DataTable({
            "pageLength": 10
        });

    });
</script>