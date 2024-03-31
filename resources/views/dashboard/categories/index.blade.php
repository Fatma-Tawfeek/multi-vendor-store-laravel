@extends('dashboard.layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Success!</h5>
                        {{ session('success') }}
                    </div>                    
                @endif
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Categories List</h3>
                      <div class="float-right">
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">Add Category</a>
                    </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Parent</th>
                            <th>Created At</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $cat)
                            <tr>
                                <td>{{ $cat->id }}</td>
                                <td><img src="{{ $cat->image }}" width="50" alt=""></td>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->parent_id }}</td>
                                <td>{{ $cat->created_at }}</td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.categories.edit', $cat->id) }}" class="btn btn-primary mr-2">Edit</a>
                                        <form action="{{ route('dashboard.categories.destroy', $cat->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>      
                            @empty
                                <tr>
                                    <td colspan="6">No categories found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                      </ul>
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection