@extends('dashboard.layouts.dashboard')

@section('title', 'Edit Profile')

@section('breadcrumb')
@parent
<li class="breadcrumb-item active">Edit Profile</li>
@endSection

@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header">
                  <h3 class="card-title">Edit Profile</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="{{ route('dashboard.profile.update') }}" method="post" >
                  @csrf
                  @method('patch')
                  <div class="card-body">
                    <x-alert />
                    @if($errors->any())
                      <div class="alert alert-danger mt-2" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                        @foreach($errors->all() as $error)
                        @if($errors->count() > 1)
                        <ul>
                          <li>{{ $error }}</li>
                        </ul>
                        @endif
                        @endforeach
                      </div>    
                    @endif
                      <div class="form-group">
                        <label>First Name</label>
                        <input type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" placeholder="Enter first name" value="{{ old('first_name', $user->profile->first_name) }}">
                        @error('first_name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label>Last Name</label>
                        <input type="text" class="form-control @error('last_name') is-invalid @enderror" name="last_name" placeholder="Enter last name" value="{{ old('first_name', $user->profile->last_name) }}">
                        @error('last_name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label>Birth of Date</label>
                        <input type="date" class="form-control @error('date') is-invalid @enderror" name="birth_date" placeholder="Enter first name" value="{{ old('date', $user->profile->birth_date) }}">
                        @error('name')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label for="exampleSelectRounded0">Gender</label>
                        <select class="custom-select rounded-0" id="exampleSelectRounded0" name="gender">
                          <option value="male" {{ old('gender', $user->profile->gender) == 'male' ? 'selected' : '' }}>Male</option>
                          <option value="female" {{ old('gender', $user->profile->gender) == 'female' ? 'selected' : '' }}>Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Street Address</label>
                        <input type="text" class="form-control @error('street_address') is-invalid @enderror" name="street_address" placeholder="Enter street address" value="{{ old('street_address', $user->profile->street_address) }}">
                        @error('street_address')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label>City</label>
                        <input type="text" class="form-control @error('city') is-invalid @enderror" name="city" placeholder="Enter city" value="{{ old('city', $user->profile->city) }}">
                        @error('city')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label>State</label>
                        <input type="text" class="form-control @error('state') is-invalid @enderror" name="state" placeholder="Enter state" value="{{ old('state', $user->profile->state) }}">
                        @error('state')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label>Country</label>
                        <select name="country" id="country" class="form-control @error('country') is-invalid @enderror">
                          @foreach ($countries as $key => $country)
                            <option value="{{ $key }}" {{ old('country', $user->profile->country) == $key ? 'selected' : '' }}>{{ $country }}</option>
                          @endforeach
                        </select>
                        @error('country')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
                      </div>
                      <div class="form-group">
                        <label for="locale">Locale</label>
                        <select name="locale" id="locale" class="form-control @error('locale') is-invalid @enderror">
                          @foreach ($locales as $key => $locale)
                            <option value="{{ $key }}" {{ old('locale', $user->profile->locale) == $key ? 'selected' : '' }}>{{ $locale }}</option>
                          @endforeach
                        </select>
                        @error('locale')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                        @enderror
                      </div>
                      <div class="form-group">
                        <label>Postalcode</label>
                        <input type="text" class="form-control @error('postalcode') is-invalid @enderror" name="postal_code" placeholder="Enter postalcode" value="{{ old('postalcode', $user->profile->postal_code) }}">
                        @error('postalcode')
                        <div class="invalid-feedback">
                          {{ $message }}
                        </div>
                      @enderror
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