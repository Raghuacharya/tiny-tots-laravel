<div class="row mb-3">
    <div class="col-md-4">
        <label for="allergies">Allergies (if any)</label>
        <input type="text" name="allergies" value="{{ old('allergies') }}"
            class="form-control form-control-sm @error('allergies') is-invalid @enderror"
            placeholder="e.g. Pollen, Dust, Nuts">
        @error('allergies')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="surgeries">Surgeries (if any)</label>
        <input type="text" name="surgeries" value="{{ old('surgeries') }}"
            class="form-control form-control-sm @error('surgeries') is-invalid @enderror"
            placeholder="e.g. Appendectomy, Tonsillectomy">
        @error('surgeries')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="chronic_illness">Chronic illness</label>
        <input type="text" name="chronic_illness" value="{{ old('chronic_illness') }}"
            class="form-control form-control-sm @error('chronic_illness') is-invalid @enderror"
            placeholder="e.g. Asthma, Diabetes">
        @error('chronic_illness')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="row mb-3">
    <div class="col-12">
        <label for="immunization_complete">Immunization</label>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="immunization_complete" name="immunization_complete"
                value="1" {{ old('immunization_complete') ? 'checked' : '' }}>
            <label class="form-check-label" for="immunization_complete">
                Immunization complete
            </label>
        </div>
    </div>
    <div class="col-12" id="immunization_certificate_wrapper" style="display:none;">
        <label for="immunization_certificate">
            Please upload immunization certificate <span class="text-danger">*</span>
        </label>
        <input type="file" name="immunization_certificate" id="immunization_certificate"
            accept=".pdf,.jpg,.jpeg,.png" {{ old('immunization_complete') ? 'required' : '' }}>
        @error('immunization_certificate')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>
</div>
