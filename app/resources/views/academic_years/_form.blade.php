@csrf
@if (isset($row))
    @method('PUT')
@endif

<div class="card-body">
    <div class="form-group">
        <label for="name">Name <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name"
            name="name" value="{{ old('name', isset($row) ? $row->name : '') }}" required placeholder="e.g. 2025-2026">
        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="start_date">Start Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control form-control-sm @error('start_date') is-invalid @enderror"
            id="start_date" name="start_date"
            value="{{ old('start_date', isset($row) && $row->start_date ? date('Y-m-d', strtotime($row->start_date)) : '') }}"
            required>
        @error('start_date')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="end_date">End Date <span class="text-danger">*</span></label>
        <input type="date" class="form-control form-control-sm @error('end_date') is-invalid @enderror"
            id="end_date" name="end_date"
            value="{{ old('end_date', isset($row) && $row->end_date ? date('Y-m-d', strtotime($row->end_date)) : '') }}"
            required>
        @error('end_date')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="is_active">Is Active</label>
        <select class="form-control form-control-sm @error('is_active') is-invalid @enderror" id="is_active"
            name="is_active">
            <option value="1" {{ old('is_active', isset($row) ? $row->is_active : '') == 1 ? 'selected' : '' }}>Yes
            </option>
            <option value="0" {{ old('is_active', isset($row) ? $row->is_active : '') == 0 ? 'selected' : '' }}>No
            </option>
        </select>
        @error('is_active')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="card-footer">
    <a href="{{ route('admin.academic-years.index') }}" class="btn btn-default btn-sm">Cancel</a>
    <button type="submit" class="btn btn-success btn-sm">Save</button>
</div>
