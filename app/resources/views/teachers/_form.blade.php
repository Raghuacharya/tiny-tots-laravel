@csrf
@if (isset($row))
    @method('PUT')
@endif

<div class="card-body">
    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="first_name">First name: <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('first_name') is-invalid @enderror"
                id="first_name" name="first_name" value="{{ old('first_name', isset($row) ? $row->first_name : '') }}"
                required placeholder="Enter first name">
            @error('first_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="last_name">Last name: <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('last_name') is-invalid @enderror"
                id="last_name" name="last_name" value="{{ old('last_name', isset($row) ? $row->last_name : '') }}"
                required placeholder="Enter last name">
            @error('last_name')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="email">Email: <span class="text-danger">*</span></label>
            <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror"
                id="email" name="email" value="{{ old('email', isset($row) ? $row->email : '') }}"
                placeholder="Enter email address" required>
            @error('email')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="phone_number">Phone Number: <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('phone_number') is-invalid @enderror"
                id="phone_number" name="phone_number"
                value="{{ old('phone_number', isset($row) ? $row->phone_number : '') }}"
                placeholder="Enter phone number" required>
            @error('phone_number')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="date_of_birth">Date of Birth:</label>
            <input type="date" class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror"
                id="date_of_birth" name="date_of_birth"
                value="{{ old('date_of_birth', isset($row) && $row->date_of_birth ? date('Y-m-d', strtotime($row->date_of_birth)) : '') }}">
            @error('date_of_birth')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="gender">Gender:</label>
            <select class="form-control form-control-sm @error('gender') is-invalid @enderror" id="gender"
                name="gender">
                <option value="">Select gender</option>
                <option value="Male"
                    {{ old('gender', isset($row) ? $row->gender : '') == 'Male' ? 'selected' : '' }}>
                    Male</option>
                <option value="Female"
                    {{ old('gender', isset($row) ? $row->gender : '') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other"
                    {{ old('gender', isset($row) ? $row->gender : '') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="address">Address:</label>
            <textarea class="form-control form-control-sm @error('address') is-invalid @enderror" id="address" name="address"
                rows="2" placeholder="Enter address">{{ old('address', isset($row) ? $row->address : '') }}</textarea>
            @error('address')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="qualification">Qualification:</label>
            <input type="text" class="form-control form-control-sm @error('qualification') is-invalid @enderror"
                id="qualification" name="qualification"
                value="{{ old('qualification', isset($row) ? $row->qualification : '') }}"
                placeholder="Enter qualification">
            @error('qualification')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="specialization">Specialization:</label>
            <input type="text" class="form-control form-control-sm @error('specialization') is-invalid @enderror"
                id="specialization" name="specialization"
                value="{{ old('specialization', isset($row) ? $row->specialization : '') }}"
                placeholder="Enter specialization">
            @error('specialization')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="date_joined">Date Joined:</label>
            <input type="date" class="form-control form-control-sm @error('date_joined') is-invalid @enderror"
                id="date_joined" name="date_joined"
                value="{{ old('date_joined', isset($row) && $row->date_joined ? date('Y-m-d', strtotime($row->date_joined)) : '') }}">
            @error('date_joined')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="status">Status:</label>
            <select class="form-control form-control-sm @error('status') is-invalid @enderror" name="status"
                id="status">
                <option value="Active"
                    {{ old('status', isset($row) ? $row->status : '') == 'Active' ? 'selected' : '' }}>Active</option>
                <option value="Inactive"
                    {{ old('status', isset($row) ? $row->status : '') == 'Inactive' ? 'selected' : '' }}>Inactive
                </option>
            </select>
            @error('status')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mb-3">
            <label for="aadhaar_number">Aadhaar Number: <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('aadhaar_number') is-invalid @enderror"
                id="aadhaar_number" name="aadhaar_number"
                value="{{ old('aadhaar_number', isset($row) ? $row->aadhaar_number : '') }}" maxlength="12"
                placeholder="Enter Aadhaar number" required>
            @error('aadhaar_number')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
        <div class="col-md-6 mb-3">
            <label for="pan_number">PAN Number: <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm @error('pan_number') is-invalid @enderror"
                id="pan_number" name="pan_number"
                value="{{ old('pan_number', isset($row) ? $row->pan_number : '') }}" maxlength="10"
                placeholder="Enter PAN number" required>
            @error('pan_number')
                <span class="invalid-feedback">{{ $message }}</span>
            @enderror
        </div>
    </div>
</div>


<div class="card-footer">
    <a href="{{ route('admin.teachers.index') }}" class="btn btn-default btn-sm">Cancel</a>
    <button type="submit" class="btn btn-success btn-sm">Save</button>
</div>
