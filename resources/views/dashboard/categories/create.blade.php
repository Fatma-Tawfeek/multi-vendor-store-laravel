@extends('dashboard.layouts.dashboard')

@section('title', 'Add Category')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Add Category</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Add Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dashboard.categories.store') }}" method="post" enctype="multipart/form-data">
                  @csrf
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
                        <x-form.input  name="name" :value="old('name')" class="form-control"/>
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Parent Category</label>
                        <select class="custom-select rounded-0" id="exampleSelectRounded0" name="parent_id">
                          <option value="">Select Parent Category</option>
                          @foreach ($categories as $cat)
                              <option value="{{ $cat->id }}" {{ old('parent_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>                          
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" rows="3" name="description" placeholder="Enter ...">{{ old('description') }}</textarea>
                      </div>
                      <div class="form-group">
                        <label for="exampleInputFile">Image</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="exampleInputFile" name="image">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                      <label>Status</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="status" value="active" {{ old('status') == 'active' ? 'checked' : '' }}>
                        <label class="form-check-label">Active</label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" value="archived" name="status" {{ old('status') == 'archived' ? 'checked' : '' }}>
                        <label class="form-check-label">Archived</label>
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