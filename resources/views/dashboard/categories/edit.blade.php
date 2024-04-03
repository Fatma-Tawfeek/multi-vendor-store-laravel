@extends('dashboard.layouts.dashboard')

@section('title', 'Edit Category')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Categories</li>
<li class="breadcrumb-item active">Edit Category</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Category</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dashboard.categories.update', $category->id) }}" method="post" enctype="multipart/form-data">
                  @csrf
                  @method('put')
                  @include('dashboard.categories._form')
                </form>
              </div>
            </div>
        </div>
    </div>
</section>

@endSection