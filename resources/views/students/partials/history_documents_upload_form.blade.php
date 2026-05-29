<div class="row mb-3">
    <div class="col-12">
        <label for="attended_school_previously">Previous School</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="attended_school_previously"
                name="attended_school_previously" value="1" {{ old('attended_school_previously') ? 'checked' : '' }}>
            <label class="form-check-label" for="attended_school_previously">
                Attended school previously
            </label>
        </div>
    </div>
    <div class="col-12" id="previous_school_wrapper" style="display:none;">
        <div class="form-group mt-2">
            <label for="previous_school_name">Previous School Name</label>
            <input type="text" class="form-control form-control-sm" id="previous_school_name"
                name="previous_school_name" value="{{ old('previous_school_name') }}">
        </div>
        <div class="form-group mt-2">
            <label for="previous_school_duration">Duration</label>
            <input type="text" class="form-control form-control-sm" id="previous_school_duration"
                name="previous_school_duration" value="{{ old('previous_school_duration') }}"
                placeholder="e.g. 2 years">
        </div>
        <div class="form-group mt-2">
            <label for="previous_class_attended">Last Class Attended</label>
            <input type="text" class="form-control form-control-sm" id="previous_class_attended"
                name="previous_class_attended" value="{{ old('previous_class_attended') }}" placeholder="e.g. UKG">
        </div>
    </div>
</div>
<hr>
<div class="row mb-3">
    <div class="col-md-6">
        <label for="birth_certificate">Birth Certificate <span class="text-danger">*</span></label>
        <input type="file" class="form-control-file @error('birth_certificate') is-invalid @enderror"
            id="birth_certificate" name="birth_certificate" accept=".pdf,.jpg,.jpeg,.png" required>
        @error('birth_certificate')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <div class="col-md-6">
        <label for="immuization_record">Immunization Record</label>
        <input type="file" class="form-control-file" id="immuization_record" name="immuization_record"
            accept=".pdf,.jpg,.jpeg,.png">
    </div>

    <div class="col-md-6 mt-2">
        <label for="transfer_certificate">Transfer Certificate</label>
        <input type="file" class="form-control-file" id="transfer_certificate" name="transfer_certificate"
            accept=".pdf,.jpg,.jpeg,.png">
    </div>

    <div class="col-md-6 mt-2">
        <label for="progress_report">Progress Report</label>
        <input type="file" class="form-control-file" id="progress_report" name="progress_report"
            accept=".pdf,.jpg,.jpeg,.png">
    </div>

    <div class="col-md-6 mt-2">
        <label for="passport">Passport</label>
        <input type="file" class="form-control-file" id="passport" name="passport" accept=".pdf,.jpg,.jpeg,.png">
    </div>

    <div class="col-md-6 mt-2">
        <label for="medical_report">Medical Report</label>
        <input type="file" class="form-control-file" id="medical_report" name="medical_report"
            accept=".pdf,.jpg,.jpeg,.png">
    </div>
</div>
