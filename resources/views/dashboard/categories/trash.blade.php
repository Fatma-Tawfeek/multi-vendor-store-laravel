@extends('dashboard.layouts.dashboard')

@section('title', 'Categories')

@section('breadcrumb')
@parent
<li class="breadcrumb-item">Categories</li>
<li class="breadcrumb-item active">Trash</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <x-alert />  
              <form action="{{ URL::current() }}" method="get">
                <div class="input-group mb-3">
                  <input type="text" name="name" class="form-control mr-2" placeholder="name" value="{{ request()->name }}">
                  <select name="status" class="form-control mx-2" id="exampleSelectRounded0">
                    <option value="">All</option>
                    <option value="active" {{ request()->status == 'active' ? 'selected' : '' }}  >Active</option>
                    <option value="archived" {{ request()->status == 'archived' ? 'selected' : '' }}>Archived</option>
                  </select>
                  <button class="btn btn-primary ml-2" type="submit">Search</button>
                </div>
              </form>
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Categories</h3>
                      <div class="float-right">
                        <a href="{{ route('dashboard.categories.index') }}" class="btn btn-primary">Back</a>
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
                            <th>Deleted At</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($categories as $key => $cat)
                            <tr>
                                <td>{{ $categories->firstItem() + $key }}</td>
                                <td>
                                  @if ($cat->image)
                                  <img src="{{ asset( 'storage/' . $cat->image) }}" height="50" alt="">
                                  @endif
                                </td>
                                <td>{{ $cat->name }}</td>
                                <td>{{ $cat->parent->name }}</td>
                                <td>{{ $cat->deleted_at }}</td>
                                <td>
                                    @if ($cat->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Archived</span>
                                    @endif
                                </td>
                                <td> 
                                    <div class="btn-group">
                                      <form action="{{ route('dashboard.categories.restore', $cat->id) }}" method="post">
                                        @csrf
                                        @method('put')
                                        <button type="submit" class="btn btn-primary mr-2">Restore</button>
                                      </form>
                                        <form action="{{ route('dashboard.categories.forceDelete', $cat->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Force Delete</button>
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
                      {{-- <ul class="pagination pagination-sm m-0 float-right">
                        <li class="page-item"><a class="page-link" href="#">«</a></li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">»</a></li>
                      </ul> --}}
                      {{ $categories->withQueryString()->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection