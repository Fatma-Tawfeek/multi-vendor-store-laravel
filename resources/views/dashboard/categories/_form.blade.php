<div class="card-body">
    <div class="form-group">
      <label>Name</label>
      <input type="text" class="form-control" name="name" placeholder="Enter name" value="{{ $category->name }}">
    </div>
    <div class="form-group">
      <label for="exampleSelectRounded0">Parent Category</label>
      <select class="custom-select rounded-0" id="exampleSelectRounded0" name="parent_id">
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" {{ $cat->id == $category->parent_id ? 'selected' : '' }}>{{ $cat->name }}</option>                          
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label>Description</label>
      <textarea class="form-control" rows="3" name="description" placeholder="Enter ...">{{ $category->description }}</textarea>
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
      <img src="{{ asset('storage/' . $category->image) }}" height="100" alt="">
    </div>
    <label>Status</label>
    <div class="form-check">
      <input class="form-check-input" type="radio" name="status" value="active" {{ $category->status == 'active' ? 'checked' : '' }}>
      <label class="form-check-label">Active</label>
    </div>
    <div class="form-check">
      <input class="form-check-input" type="radio" value="archived" name="status" {{ $category->status == 'archived' ? 'checked' : '' }}>
      <label class="form-check-label">Archived</label>
    </div>
  </div>
  <!-- /.card-body -->
  <div class="card-footer">
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>