@csrf
@if (isset($row))
    @method('PUT')
@endif

<div class="card-body">
    {{-- Father Details --}}
    <h5 class="mb-3">Father Details</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="father_name">Father Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control form-control-sm @error('father_name') is-invalid @enderror"
                    id="father_name" name="father_name"
                    value="{{ old('father_name', isset($row) ? $row->father_name : '') }}" required
                    placeholder="Enter father name">
                @error('father_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="father_occupation">Father Occupation</label>
                <input type="text"
                    class="form-control form-control-sm @error('father_occupation') is-invalid @enderror"
                    id="father_occupation" name="father_occupation"
                    value="{{ old('father_occupation', isset($row) ? $row->father_occupation : '') }}"
                    placeholder="Enter occupation">
                @error('father_occupation')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="father_place_of_work">Place of Work</label>
                <input type="text"
                    class="form-control form-control-sm @error('father_place_of_work') is-invalid @enderror"
                    id="father_place_of_work" name="father_place_of_work"
                    value="{{ old('father_place_of_work', isset($row) ? $row->father_place_of_work : '') }}"
                    placeholder="Enter place of work">
                @error('father_place_of_work')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="father_email">Email</label>
                        <input type="email"
                            class="form-control form-control-sm @error('father_email') is-invalid @enderror"
                            id="father_email" name="father_email"
                            value="{{ old('father_email', isset($row) ? $row->father_email : '') }}"
                            placeholder="Enter email">
                        @error('father_email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="father_contact_no">Contact No</label>
                        <input type="text"
                            class="form-control form-control-sm @error('father_contact_no') is-invalid @enderror"
                            id="father_contact_no" name="father_contact_no"
                            value="{{ old('father_contact_no', isset($row) ? $row->father_contact_no : '') }}"
                            placeholder="Enter contact number">
                        @error('father_contact_no')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="father_photo">Photo <span class="text-danger"><small>(Max 2MB | 150x150 -
                                    1000x1000)</small></span></label>
                        <input type="file" class="form-control-file @error('father_photo') is-invalid @enderror"
                            id="father_photo" name="father_photo">
                        @error('father_photo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="father_office_address">Office Address</label>
                <textarea rows="5" class="form-control form-control-sm @error('father_office_address') is-invalid @enderror"
                    id="father_office_address" name="father_office_address" placeholder="Enter office address">{{ old('father_office_address', isset($row) ? $row->father_office_address : '') }}</textarea>
                @error('father_office_address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <hr>

    <h5 class="mb-3">Mother Details</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="mother_name">Mother Name</label>
                <input type="text" class="form-control form-control-sm @error('mother_name') is-invalid @enderror"
                    id="mother_name" name="mother_name"
                    value="{{ old('mother_name', isset($row) ? $row->mother_name : '') }}"
                    placeholder="Enter mother name">
                @error('mother_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="mother_occupation">Mother Occupation</label>
                <input type="text"
                    class="form-control form-control-sm @error('mother_occupation') is-invalid @enderror"
                    id="mother_occupation" name="mother_occupation"
                    value="{{ old('mother_occupation', isset($row) ? $row->mother_occupation : '') }}"
                    placeholder="Enter occupation">
                @error('mother_occupation')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="mother_place_of_work">Place of Work</label>
                <input type="text"
                    class="form-control form-control-sm @error('mother_place_of_work') is-invalid @enderror"
                    id="mother_place_of_work" name="mother_place_of_work"
                    value="{{ old('mother_place_of_work', isset($row) ? $row->mother_place_of_work : '') }}"
                    placeholder="Enter place of work">
                @error('mother_place_of_work')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="mother_email">Email</label>
                        <input type="email"
                            class="form-control form-control-sm @error('mother_email') is-invalid @enderror"
                            id="mother_email" name="mother_email"
                            value="{{ old('mother_email', isset($row) ? $row->mother_email : '') }}"
                            placeholder="Enter email">
                        @error('mother_email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="mother_contact_no">Contact No</label>
                        <input type="text"
                            class="form-control form-control-sm @error('mother_contact_no') is-invalid @enderror"
                            id="mother_contact_no" name="mother_contact_no"
                            value="{{ old('mother_contact_no', isset($row) ? $row->mother_contact_no : '') }}"
                            placeholder="Enter contact number">
                        @error('mother_contact_no')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <label for="mother_photo">Photo <span class="text-danger"><small>(Max 2MB | 150x150 -
                                    1000x1000)</small></span></label>
                        <input type="file" class="form-control-file @error('mother_photo') is-invalid @enderror"
                            id="mother_photo" name="mother_photo">
                        @error('mother_photo')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="mother_office_address">Office Address</label>
                <textarea rows="5" class="form-control form-control-sm @error('mother_office_address') is-invalid @enderror"
                    id="mother_office_address" name="mother_office_address" placeholder="Enter office address">{{ old('mother_office_address', isset($row) ? $row->mother_office_address : '') }}</textarea>
                @error('mother_office_address')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <hr>

    <h5 class="mb-3">Residential Details</h5>
    <div class="form-group">
        <label for="residential_address">Address</label>
        <textarea rows="5" class="form-control form-control-sm @error('residential_address') is-invalid @enderror"
            id="residential_address" name="residential_address" placeholder="Enter residential address">{{ old('residential_address', isset($row) ? $row->residential_address : '') }}</textarea>
        @error('residential_address')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
    <div class="form-group">
        <label for="residential_contact">Contact No</label>
        <input type="text" class="form-control form-control-sm @error('residential_contact') is-invalid @enderror"
            id="residential_contact" name="residential_contact"
            value="{{ old('residential_contact', isset($row) ? $row->residential_contact : '') }}"
            placeholder="Enter contact number">
        @error('residential_contact')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <hr>

    <h5 class="mb-3">Guardian Details (if applicable)</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="guardian_name">Guardian Name</label>
                <input type="text"
                    class="form-control form-control-sm @error('guardian_name') is-invalid @enderror"
                    id="guardian_name" name="guardian_name"
                    value="{{ old('guardian_name', isset($row) ? $row->guardian_name : '') }}"
                    placeholder="Enter guardian name">
                @error('guardian_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="guardian_relationship">Relationship</label>
                <input type="text"
                    class="form-control form-control-sm @error('guardian_relationship') is-invalid @enderror"
                    id="guardian_relationship" name="guardian_relationship"
                    value="{{ old('guardian_relationship', isset($row) ? $row->guardian_relationship : '') }}"
                    placeholder="Enter relationship">
                @error('guardian_relationship')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="guardian_contact">Contact No</label>
                <input type="text"
                    class="form-control form-control-sm @error('guardian_contact') is-invalid @enderror"
                    id="guardian_contact" name="guardian_contact"
                    value="{{ old('guardian_contact', isset($row) ? $row->guardian_contact : '') }}"
                    placeholder="Enter contact number">
                @error('guardian_contact')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>

    <hr>

    <h5 class="mb-3">Emergency Contact</h5>
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="emergency_contact_name">Name</label>
                <input type="text"
                    class="form-control form-control-sm @error('emergency_contact_name') is-invalid @enderror"
                    id="emergency_contact_name" name="emergency_contact_name"
                    value="{{ old('emergency_contact_name', isset($row) ? $row->emergency_contact_name : '') }}"
                    placeholder="Enter name">
                @error('emergency_contact_name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="emergency_contact_relationship">Relationship</label>
                <input type="text"
                    class="form-control form-control-sm @error('emergency_contact_relationship') is-invalid @enderror"
                    id="emergency_contact_relationship" name="emergency_contact_relationship"
                    value="{{ old('emergency_contact_relationship', isset($row) ? $row->emergency_contact_relationship : '') }}"
                    placeholder="Enter relationship">
                @error('emergency_contact_relationship')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label for="emergency_contact_phone">Phone</label>
                <input type="text"
                    class="form-control form-control-sm @error('emergency_contact_phone') is-invalid @enderror"
                    id="emergency_contact_phone" name="emergency_contact_phone"
                    value="{{ old('emergency_contact_phone', isset($row) ? $row->emergency_contact_phone : '') }}"
                    placeholder="Enter phone">
                @error('emergency_contact_phone')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
        </div>
    </div>
    <div class="form-group">
        <label for="emergency_contact_address">Address</label>
        <textarea rows="5"
            class="form-control form-control-sm @error('emergency_contact_address') is-invalid @enderror"
            id="emergency_contact_address" name="emergency_contact_address" placeholder="Enter emergency address">{{ old('emergency_contact_address', isset($row) ? $row->emergency_contact_address : '') }}</textarea>
        @error('emergency_contact_address')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>
</div>
<div class="card-footer">
    <a href="{{ route('admin.parents.index') }}" class="btn btn-default btn-sm px-4">Cancel</a>
    <button type="submit" class="btn btn-success btn-sm px-4">Save</button>
</div>
