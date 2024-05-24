@extends('dashboard.layouts.dashboard')

@section('title', 'Products')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
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
                      <h3 class="card-title">Products</h3>
                      <div class="float-right">
                        <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary">Add Product</a>
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
                            <th>Category</th>
                            <th>Store</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($products as $key => $product)
                            <tr>
                                <td>{{ $products->firstItem() + $key }}</td>
                                <td>
                                  @if ($product->image)
                                  <img src="{{ asset( 'storage/' . $product->image) }}" height="50" alt="">
                                  @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->category->name }}</td>
                                <td>{{ $product->store->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>
                                    @if ($product->status == 'active')
                                        <span class="badge badge-success">Active</span>
                                    @elseif($product->status == 'draft')
                                        <span class="badge badge-warning">Draft</span>
                                    @else
                                        <span class="badge badge-danger">Archived</span>
                                    @endif
                                </td>
                                <td> 
                                    <div class="btn-group">
                                        <a href="{{ route('dashboard.products.edit', $product->id) }}" class="btn btn-primary mr-2">Edit</a>
                                        <form action="{{ route('dashboard.products.destroy', $product->id) }}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>      
                            @empty
                                <tr>
                                    <td colspan="6">No products found.</td>
                                </tr>                          
                            @endforelse                          
                        </tbody>
                      </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer clearfix">
                      {{ $products->withQueryString()->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection