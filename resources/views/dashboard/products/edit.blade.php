@extends('dashboard.layouts.dashboard')

@section('title', 'Edit Product')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Products</li>
<li class="breadcrumb-item active">Edit Product</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dashboard.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  <div class="card-body">
                      @if($errors->any())
                      <div class="alert alert-danger mt-2" role="alert">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h5><i class="icon fas fa-ban"></i> Error!</h5>
                          @foreach($errors->all() as $error)
                          @if($errors->count() > 0)
                          <ul>
                          <li>{{ $error }}</li>
                          </ul>
                          @endif
                          @endforeach
                      </div>    
                      @endif
                      <div class="form-group">
                        <label>Name</label>
                        <input type="text" name="name" value="{{ $product->name }}" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Category</label>
                        <select class="custom-select rounded-0" id="exampleSelectRounded0" name="category_id">
                          <option value="">Select Category</option>
                          @foreach (App\Models\Category::all() as $cat)
                              <option value="{{ $cat->id }}" {{ $product->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>                          
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Store</label>
                        <select class="custom-select rounded-0" id="exampleSelectRounded0" name="store_id">
                          <option value="">Select Store</option>
                          @foreach (App\Models\Store::all() as $store)
                              <option value="{{ $store->id }}" {{ $product->store_id == $store->id ? 'selected' : '' }}>{{ $store->name }}</option>                          
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Enter ...">{{ $product->description }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Image</label> <br>
                        <img src="{{ asset('storage/' . $product->image) }}" height="100" alt="">
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        </div>
                      </div>

                      <div class="form-group">
                        <label>Price</label>
                        <input type="number"  name="price" value="{{ $product->price }}" class="form-control"/>
                      </div>

                      <div class="form-group">
                        <label>Compare Price</label>
                        <input type="number" name="compare_price" value="{{ $product->compare_price }}" class="form-control"/>
                      </div>

                      <div class="form-group">
                      <label>Is Featured</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="featured" value="1" {{ $product->featured == 1 ? 'checked' : '' }}>
                        <label class="form-check-label">Yes</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="0" name="featured" {{ $product->featured == 0 ? 'checked' : '' }}>
                        <label class="form-check-label">No</label>
                      </div>
                      </div>

                      <div class="form-group">
                        <label>Status</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="active" {{ $product->status == 'active' ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="draft" {{ $product->status == 'draft' ? 'checked' : '' }}>
                        <label class="form-check-label">Draft</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="archived" name="status" {{ $product->status == 'archived' ? 'checked' : '' }}>
                        <label class="form-check-label">Archived</label>
                      </div>
                     </div>                     
                      

                      <div class="form-group">
                        <label>Tags <small>(Comma separated)</small></label>
                        <input class="form-control" name='tags' value="{{ $tags }}">
                      </div>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
              </div>
            </div>
        </div>
    </div>
</section>

@endSection

@push('styles')
<link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')

<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
<script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>

<script>
  // The DOM element you wish to replace with Tagify
  var input = document.querySelector('input[name=tags]');

  // initialize Tagify on the above input node reference
  new Tagify(input)
</script>
  
@endpush