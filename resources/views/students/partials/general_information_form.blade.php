<div class="row mb-3">
    <div class="col-md-6">
        <label for="full_name" class="form-label">Full name <span class="text-danger">*</span></label>
        <input type="text" class="form-control form-control-sm @error('full_name') is-invalid @enderror" id="full_name"
            name="full_name" required placeholder="Enter full name" autofocus
            value="{{ old('full_name', isset($row) ? $row->full_name : '') }}">
        @error('full_name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="admission_date">Admission date <span class="text-danger">*</span></label>
        <input type="date" class="form-control form-control-sm @error('admission_date') is-invalid @enderror"
            id="admission_date" name="admission_date" required
            value="{{ old('admission_date', isset($row) && $row->admission_date ? date('Y-m-d', strtotime($row->admission_date)) : '') }}">
        @error('admission_date')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="date_of_birth">Date of Birth <span class="text-danger">*</span></label>
        <input type="date" name="date_of_birth" max="{{ date('Y-m-d') }}" id="date_of_birth" required
            class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror"
            value="{{ old('date_of_birth', isset($row) && $row->date_of_birth ? date('Y-m-d', strtotime($row->date_of_birth)) : '') }}">
        @error('date_of_birth')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="gender">Gender <span class="text-danger">*</span></label>
        <select name="gender" id="gender" required
            class="form-control form-control-sm @error('gender') is-invalid @enderror">
            <option value="">-- Select --</option>
            <option value="male" {{ old('gender', isset($row) ? $row->gender : '') == 'male' ? 'selected' : '' }}>
                Male</option>
            <option value="female" {{ old('gender', isset($row) ? $row->gender : '') == 'female' ? 'selected' : '' }}>
                Female</option>
            <option value="other" {{ old('gender', isset($row) ? $row->gender : '') == 'other' ? 'selected' : '' }}>
                Other</option>
        </select>
        @error('gender')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="place_of_birth">Place of birth <span class="text-danger">*</span></label>
        <input type="text" name="place_of_birth" required
            class="form-control form-control-sm @error('place_of_birth') is-invalid @enderror"
            placeholder="Enter place of birth"
            value="{{ old('place_of_birth', isset($row) ? $row->place_of_birth : '') }}">
        @error('place_of_birth')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-6">
        <label for="nationality">Nationality <span class="text-danger">*</span></label>
        <input type="text" name="nationality" required
            class="form-control form-control-sm @error('nationality') is-invalid @enderror"
            placeholder="Enter nationality" value="{{ old('nationality', isset($row) ? $row->nationality : '') }}">
        @error('nationality')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>

@push('body_scripts')
    <script>
        function calculateAge(dob) {
            if (!dob) return '';

            let birthDate = new Date(dob);
            let today = new Date();

            let age = today.getFullYear() - birthDate.getFullYear();
            let monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            return age;
        }
        $(document).ready(function() {
            // On DOB change
            $('#date_of_birth').on('change', function() {
                let dob = $(this).val();
                let age = calculateAge(dob);
                $('#age').val(age ? age + ' years' : '');
            });

            // On page load (handles old values)
            let dob = $('#date_of_birth').val();
            if (dob) {
                $('#age').val(calculateAge(dob) + ' years');
            }
        });
    </script>
@endpush
