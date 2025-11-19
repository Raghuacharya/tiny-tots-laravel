@csrf
@if (isset($row))
    @method('PUT')
@endif

<div class="card-body">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
                name="name" value="{{ old('name', isset($row) ? $row->name : '') }}" required placeholder="e.g. Class 1">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="code">Code</label>
            <input type="text" class="form-control form-control-sm @error('code') is-invalid @enderror"
                id="code" name="code" value="{{ old('code', isset($row) ? $row->code : '')}}" placeholder="e.g. C1">
            @error('code')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="card-footer">
    <a href="{{ route('admin.classes.index') }}" class="btn btn-default btn-sm">Cancel</a>
    <button type="submit" class="btn btn-success btn-sm">Save</button>
</div>
