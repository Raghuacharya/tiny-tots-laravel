<div class="row">
    <div class="col-md-12">
        <p><u><b>Note: </b>You can search for an existing parent or create a new parent while adding a student.</u></p>
        <div class="row mb-3">
            <div class="col-12">
                <input type="radio" id="existing-parent-radio" name="parent_option"
                    {{ isset($row) && $row->parent_id ? 'checked' : (!isset($row) ? 'checked' : '') }} value="existing">
                <label for="existing-parent-radio">Select Existing Parent</label>
                &nbsp;&nbsp;&nbsp;
                <input type="radio" id="new-parent-radio" name="parent_option"
                    {{ isset($row) && !$row->parent_id ? 'checked' : '' }} value="new">
                <label for="new-parent-radio">Create New Parent</label>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-5">
                <div class="row">
                    <div class="col-12">
                        <label for="parent_id" class="form-label">Parent</label>
                        <select class="form-control select2" id="parent_id" name="parent_id" required>

                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12">
                        <div id="parent-info-card" class="card shadow-sm border mt-2" style="display:none;">
                            <div class="card-body p-2">
                                <div class="d-flex align-items-center">
                                    <img id="father-photo" src="" alt="Father" class="rounded-circle me-2"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <strong id="father-name"></strong><br>
                                        <small id="father-contact"></small>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div class="d-flex align-items-center">
                                    <img id="mother-photo" src="" alt="Mother" class="rounded-circle me-2"
                                        style="width: 40px; height: 40px; object-fit: cover;">
                                    <div>
                                        <strong id="mother-name"></strong><br>
                                        <small id="mother-contact"></small>
                                    </div>
                                </div>
                                <hr class="my-2">
                                <div>
                                    <small><strong>Residential:</strong> <span id="residential-address"></span></small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <label>Sibling/s</label>
                <button type="button" class="btn btn-secondary btn-xs float-right mb-2" id="add-sibling-btn"><i
                        class="fas fa-plus"></i> Add Sibling</button>
                <table class="table table-sm" id="siblings-table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Age</th>
                            <th>Class</th>
                            <th>School</th>
                        </tr>
                    </thead>
                    <tbody id="siblings-table-body">
                        @if (old('sibling_name'))
                            @foreach (old('sibling_name') as $index => $name)
                                <tr>
                                    <td><input type="text" name="sibling_name[]" value="{{ $name }}"
                                            class="form-control form-control-sm"></td>
                                    <td>
                                        <select name="sibling_gender[]" class="form-control form-control-sm">
                                            <option value="">-- Select --</option>
                                            <option value="male"
                                                {{ old('sibling_gender.' . $index) == 'male' ? 'selected' : '' }}>
                                                Male</option>
                                            <option value="female"
                                                {{ old('sibling_gender.' . $index) == 'female' ? 'selected' : '' }}>
                                                Female</option>
                                            <option value="other"
                                                {{ old('sibling_gender.' . $index) == 'other' ? 'selected' : '' }}>
                                                Other</option>
                                        </select>
                                    </td>
                                    <td><input type="text" name="sibling_age[]"
                                            value="{{ old('sibling_age.' . $index) }}"
                                            class="form-control form-control-sm"></td>
                                    <td><input type="text" name="sibling_class[]"
                                            value="{{ old('sibling_class.' . $index) }}"
                                            class="form-control form-control-sm"></td>
                                    <td><input type="text" name="sibling_school[]"
                                            value="{{ old('sibling_school.' . $index) }}"
                                            class="form-control form-control-sm"></td>
                                </tr>
                            @endforeach
                        @else
                            {{-- Empty row on first load --}}
                            <tr>
                                <td><input type="text" name="sibling_name[]" class="form-control form-control-sm"
                                        placeholder="Sibling name"></td>
                                <td>
                                    <select name="sibling_gender[]" class="form-control form-control-sm">
                                        <option value="">-- Select --</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </td>
                                <td><input type="text" name="sibling_age[]" class="form-control form-control-sm"
                                        placeholder="Age"></td>
                                <td><input type="text" name="sibling_class[]" class="form-control form-control-sm"
                                        placeholder="Class"></td>
                                <td><input type="text" name="sibling_school[]" class="form-control form-control-sm"
                                        placeholder="School"></td>
                            </tr>
                        @endif
                    </tbody>

                </table>
            </div>
        </div>
    </div>
</div>
