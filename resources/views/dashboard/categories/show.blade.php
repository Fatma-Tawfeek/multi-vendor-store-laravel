@extends('dashboard.layouts.dashboard')

@section('title', $category->name)

@section('breadcrumb')
@parent
<li class="breadcrumb-item">Categories</li>
<li class="breadcrumb-item active">{{ $category->name }}</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <x-alert />  
                <div class="card">
                    <div class="card-header">
                      <h3 class="card-title">Products</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Store</th>
                            <th>Price</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @forelse ($products = $category->products()->with('store')->paginate() as $key => $product)
                            <tr>
                                <td>
                                  @if ($product->image)
                                  <img src="{{ asset( $product->image) }}" height="50" alt="">
                                  @endif
                                </td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->store->name }}</td>
                                <td>{{ $product->price }}</td>
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
                      {{ $products->links() }}
                    </div>
                  </div>
            </div>
        </div>
</section>

@endSection