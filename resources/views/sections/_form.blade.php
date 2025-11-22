@csrf
@if (isset($row))
    @method('PUT')
@endif

<div class="card-body">
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="class_id">Class <span class="text-danger">*</span></label>
            <select name="class_id" id="class_id"
                class="form-control form-control-sm @error('class_id') is-invalid @enderror" required>
                <option value="">--Select Class--</option>
                @foreach ($classes as $class)
                    <option value="{{ $class->id }}" {{ old('class_id', isset($row) ? $row->class_id : '') == $class->id ? 'selected' : '' }}>
                        {{ $class->name }}</option>
                @endforeach
            </select>
            @error('class_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="name">Name <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror"
                id="name" name="name" value="{{ old('name', isset($row) ? $row->name : '') }}" required
                placeholder="e.g. A, B">
            @error('name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-12 mb-3">
            <label for="teacher">Class Teacher</label>
            <select name="teacher_id" id="teacher_id"
                class="form-control form-control-sm @error('teacher_id') is-invalid @enderror">
                <option value="">--Select Teacher--</option>
                @foreach ($teachers as $teacher)
                    <option value="{{ $teacher->id }}" {{ old('teacher_id', isset($row) ? $row->teacher_id : '') == $teacher->id ? 'selected' : '' }}>
                        {{ $teacher->first_name . ' ' . $teacher->last_name }}</option>
                @endforeach
            </select>
            @error('teacher_id')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>
<div class="card-footer">
    <a href="{{ route('admin.sections.index') }}" class="btn btn-default btn-sm px-4">Cancel</a>
    <button type="submit" class="btn btn-success btn-sm px-4">Save</button>
</div>
