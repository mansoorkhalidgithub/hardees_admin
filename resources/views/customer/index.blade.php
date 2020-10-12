@extends('layouts.main') @section('content')

<div style="margin: 0px 10px 10px 10px">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h3 style="color: black; font-family: serif; font-weight: bold">UAN Users</h3>
    </div>
    <div class="uper" style="overflow-x: scroll; font-size: 13px">
        @if(session()->get('success'))
        <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif
        <table class="table table-striped table-hover" id="manage_users">
            <thead>
                <tr style="color:black">
                    <th>#</th>
                    <th>Country</th>
                    <th>State</th>
                    <th>City</th>
                    <th>Name</th>
                    <th style="min-width: 80px">Phone No.</th>
                    <th>Avg. Rating</th>
                    <th>Status</th>
                    <th>History</th>
                </tr>
            </thead>
            <tbody style="color: black">
                @foreach($model as $key => $user)
                <tr>
                    <td>{{++$key}}</td>
                    <td>
                        {{ $user->country->name ?? 'Not Set' }}

                    </td>
                    <td>
                        {{ $user->state->name ?? 'Not Set' }}

                    </td>
                    <td>
                        {{ $user->city->name ?? 'Not Set' }}

                    </td>
                    <td> {{ $user->name }} </td>
                    <td> {{ $user->phone_number }} </td>
                    <td>{{round($user->rating,2) }}</td>
                    <td> @if($user->status===1)Active @else Inactive @endif </td>
                    <td>
                        <form>
                            <button class="btn btn-warning btn-xs" type="submit"><span style="color: black; font-size: 12px; font-weight: bold">History({{$user->orderCount}})</span></button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<script src="{{ asset('extra') }}/plugins/jquery/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $.noConflict();
        var table = $('#manage_users').DataTable();
    });
</script>
@endsection