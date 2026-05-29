<div class="row mb-3">
    <div class="col-md-6">
        <label for="class_id">Class <span class="text-danger">*</span></label>
        <select name="class_id" id="class_id" required
            class="form-control form-control-sm @error('class_id') is-invalid @enderror">
            <option value="" disabled selected>Select class</option>
            @foreach ($classes as $class)
                <option value="{{ $class->id }}" {{ old('class_id') == $class->id ? 'selected' : '' }}>
                    {{ $class->name }}
                </option>
            @endforeach
        </select>
        @error('class_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="section_id">Section <span class="text-danger">*</span></label>
        <select name="section_id" id="section_id" required
            class="form-control form-control-sm @error('section_id') is-invalid @enderror">
            <option value="" disabled selected>Select section</option>
        </select>
        @error('section_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('body_scripts')
    <script>
        $(document).ready(function() {
            $('#class_id').on('change', function() {
                const classId = $(this).val();
                if (!classId) {
                    $('#section_id').empty().prop('disabled', true);
                    return;
                }

                // Generic loader call
                const ajaxUrl = "{{ route('admin.classes.getSections', ['id' => ':id']) }}".replace(':id',
                    classId);
                window.loadDropdownOptions('class_id', 'section_id', ajaxUrl, {
                    placeholder: 'Select section',
                    timeout: 5000
                });
            });
        });
    </script>
@endpush
