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
                  @include('dashboard.categories._form')
                </form>
              </div>
            </div>
        </div>
    </div>
</section>

@endSection