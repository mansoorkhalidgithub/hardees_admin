@extends('layouts.main')
@section('title', 'All Categories')
@section('content')

<div class="card">
    <div class="card-header">
        <button type="button" id="create-new-category" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
            <i class="fas fa-plus"></i>
        </button>
        Add Category
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-sm-12 col-md-6">
                <div class="dataTables_length" id="bootstrap-data-table-export_length">
                    <label>
                        <select name="bootstrap-data-table-export_length" aria-controls="bootstrap-data-table-export" class="custom-select custom-select-sm form-control form-control-sm">
                            <option selected>Show</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                            <option value="-1">All</option>
                        </select>
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <div id="bootstrap-data-table-export_filter" class=" float-right dataTables_filter"><input type="search" id='search' class="form-control form-control-sm" placeholder="Search" aria-controls="bootstrap-data-table-export"></<input>
                </div>
            </div>
        </div>
        <div class="row">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">Action</th>
                        <th scope="col">Block/UnBlock</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr id="category_{{ $category->id }}">
                        <td>{{$category->title}}</td>
                        <td>
                            <a href="javascript:void(0)" id="edit_category" data-id="{{ $category->id }}"><i class="fa fa-eye "></i></a>
                            <a href="javascript:void(0)" id="edit_category" data-id="{{ $category->id }}"><i class="fa fa-edit "></i></a>
                            <a href="javascript:void(0)" class="del_category" id="del_category" data-id="{{ $category->id }}"><i class="fa fa-trash"></i></a>
                        </td>
                        <td>
                            <input type="checkbox" checked data-toggle="toggle">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="text-center">
                <ul class="pagination pagination-large">
                    <li><span>{{$categories->links()}}</span></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <p id="c">Add Category</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('add_category')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Title</label>
                            <input type="text" class="form-control" id="title" name="title" placeholder="Add Category">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <button id="save" type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal" id="update_category">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="card">
                <div class="card-header">
                    <p id="c">Edit Category</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{route('category.update')}}">
                        @csrf
                        <input type="hidden" name="cat_id" id="cat_id1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Category Title</label>
                            <input type="text" class="form-control" id="title1" name="title" placeholder="Add Category">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Description</label>
                            <textarea class="form-control" id="description1" name="description" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@stop