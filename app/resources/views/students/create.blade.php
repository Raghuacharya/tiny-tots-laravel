@extends('layouts.app')
@section('title', 'Create Student')
@section('page_styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add student</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
                            <li class="breadcrumb-item active">Add</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <x-alert />
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Enter student details</h3>
                            </div>
                            <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    @csrf
                                    <div class="row mb-3">
                                        <div class="col-md-10">
                                            <label for="full_name" class="form-label">Full name <span
                                                    class="text-danger">*</span></label>
                                            <input type="text"
                                                class="form-control form-control-sm @error('full_name') is-invalid @enderror"
                                                id="full_name" name="full_name" required placeholder="Enter full name"
                                                autofocus value="{{ old('full_name') }}">
                                            @error('full_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-2">
                                            <label for="admission_date">Admission date <span
                                                    class="text-danger">*</span></label>
                                            <input type="date"
                                                class="form-control form-control-sm @error('admission_date') is-invalid @enderror"
                                                value="{{ old('admission_date') }}"
                                                id="admission_date" name="admission_date" required>
                                            @error('admission_date')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label for="data_of_birth">Date of Birth <span
                                                    class="text-danger">*</span></label>
                                            <input type="date" name="date_of_birth" id="date_of_birth"
                                                value="{{ old('date_of_birth') }}"
                                                class="form-control form-control-sm @error('date_of_birth') is-invalid @enderror"
                                                required>
                                            @error('date_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-4">
                                            <label for="age">Age <span class="text-danger">*</span></label>
                                            <input type="text" class="form-control form-control-sm" readonly
                                                placeholder="Age will be calculated automatically" id="age"
                                                name="age" value="{{ old('age') }}">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="gender">Gender <span class="text-danger">*</span></label>
                                            <select name="gender" id="gender"
                                                class="form-control form-control-sm @error('gender') is-invalid @enderror"
                                                required>
                                                <option value="">-- Select --</option>
                                                <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>Male
                                                </option>
                                                <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>
                                                    Female</option>
                                                <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>
                                                    Other</option>
                                            </select>
                                            @error('gender')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="place_of_birth">Place of birth <span
                                                    class="text-danger">*</span></label>
                                            <input type="text" name="place_of_birth" value="{{ old('place_of_birth') }}"
                                                class="form-control form-control-sm @error('place_of_birth') is-invalid @enderror"
                                                required placeholder="Enter place of birth">
                                            @error('place_of_birth')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nationality">Nationality <span class="text-danger">*</span></label>
                                            <input type="text" name="nationality" value="{{ old('nationality') }}"
                                                class="form-control form-control-sm @error('nationality') is-invalid @enderror"
                                                required placeholder="Enter nationality">
                                            @error('nationality')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="mother_tongue">Mother tongue</label>
                                            <input type="text" name="mother_tongue" value="{{ old('mother_tongue') }}"
                                                class="form-control form-control-sm @error('mother_tongue') is-invalid @enderror"
                                                placeholder="e.g. English, Hindi, Kannada">
                                            @error('mother_tongue')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label>Blood Group</label>
                                            <input type="text" name="blood_group" value="{{ old('blood_group') }}"
                                                class="form-control form-control-sm @error('blood_group') is-invalid @enderror"
                                                placeholder="e.g. O+, AB-" pattern="^(A|B|AB|O)[+-]$">
                                            @error('blood_group')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h3 class="card-title">Academic details: </h3>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="class_id">Class <span class="text-danger">*</span></label>
                                            <select name="class_id" id="class_id"
                                                class="form-control form-control-sm  @error('class_id') is-invalid @enderror">
                                                <option value="" disabled selected>Select class</option>
                                                @foreach ($classes as $class)
                                                    <option value="{{ $class->id }}"
                                                        {{ old('class_id') == $class->id ? 'selected' : '' }}>
                                                        {{ $class->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="section_id">Section <span class="text-danger">*</span></label>
                                            <select name="section_id" id="section_id"
                                                class="form-control form-control-sm  @error('section_id') is-invalid @enderror">
                                                <option value="" disabled selected>Select section</option>
                                            </select>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-12">
                                            <h3 class="card-title">Medical details: </h3>
                                        </div>
                                    </div>
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
                                            <input type="text" name="chronic_illness"
                                                value="{{ old('chronic_illness') }}"
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
                                                <input class="form-check-input" type="checkbox"
                                                    id="immunization_complete" name="immunization_complete"
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
                                            <input type="file" name="immunization_certificate"
                                                id="immunization_certificate" accept=".pdf,.jpg,.jpeg,.png"
                                                {{ old('immunization_complete') ? 'required' : '' }}>
                                            @error('immunization_certificate')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="row mb-3">
                                        <div class="col-12">
                                            <label for="attended_school_previously">Previous School</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"
                                                    id="attended_school_previously" name="attended_school_previously"
                                                    value="1"
                                                    {{ old('attended_school_previously') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="attended_school_previously">
                                                    Attended school previously
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-12" id="previous_school_wrapper" style="display:none;">
                                            <div class="form-group mt-2">
                                                <label for="previous_school_name">Previous School Name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="previous_school_name" name="previous_school_name"
                                                    value="{{ old('previous_school_name') }}">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="previous_school_duration">Duration</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="previous_school_duration" name="previous_school_duration"
                                                    value="{{ old('previous_school_duration') }}"
                                                    placeholder="e.g. 2 years">
                                            </div>
                                            <div class="form-group mt-2">
                                                <label for="previous_class_attended">Last Class Attended</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="previous_class_attended" name="previous_class_attended"
                                                    value="{{ old('previous_class_attended') }}" placeholder="e.g. UKG">
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="birth_certificate">Birth Certificate <span
                                                    class="text-danger">*</span></label>
                                            <input type="file"
                                                class="form-control-file @error('birth_certificate') is-invalid @enderror"
                                                id="birth_certificate" name="birth_certificate"
                                                accept=".pdf,.jpg,.jpeg,.png" required>
                                            @error('birth_certificate')
                                                <div class="invalid-feedback d-block">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="col-md-6">
                                            <label for="immuization_record">Immunization Record</label>
                                            <input type="file" class="form-control-file" id="immuization_record"
                                                name="immuization_record" accept=".pdf,.jpg,.jpeg,.png">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="transfer_certificate">Transfer Certificate</label>
                                            <input type="file" class="form-control-file" id="transfer_certificate"
                                                name="transfer_certificate" accept=".pdf,.jpg,.jpeg,.png">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="progress_report">Progress Report</label>
                                            <input type="file" class="form-control-file" id="progress_report"
                                                name="progress_report" accept=".pdf,.jpg,.jpeg,.png">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="passport">Passport</label>
                                            <input type="file" class="form-control-file" id="passport"
                                                name="passport" accept=".pdf,.jpg,.jpeg,.png">
                                        </div>

                                        <div class="col-md-6 mt-2">
                                            <label for="medical_report">Medical Report</label>
                                            <input type="file" class="form-control-file" id="medical_report"
                                                name="medical_report" accept=".pdf,.jpg,.jpeg,.png">
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row mb-3">
                                        <div class="col-md-5">
                                            <div class="row">
                                                <div class="col-12">
                                                    <label for="parent_id" class="form-label">Parent</label>
                                                    <select class="form-control select2" id="parent_id" name="parent_id"
                                                        required>

                                                    </select>
                                                    @error('parent_id')
                                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="col-12">
                                                    <div id="parent-info-card" class="card shadow-sm border mt-2"
                                                        style="display:none;">
                                                        <div class="card-body p-2">
                                                            <div class="d-flex align-items-center">
                                                                <img id="father-photo" src="" alt="Father"
                                                                    class="rounded-circle me-2"
                                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                                <div>
                                                                    <strong id="father-name"></strong><br>
                                                                    <small id="father-contact"></small>
                                                                </div>
                                                            </div>
                                                            <hr class="my-2">
                                                            <div class="d-flex align-items-center">
                                                                <img id="mother-photo" src="" alt="Mother"
                                                                    class="rounded-circle me-2"
                                                                    style="width: 40px; height: 40px; object-fit: cover;">
                                                                <div>
                                                                    <strong id="mother-name"></strong><br>
                                                                    <small id="mother-contact"></small>
                                                                </div>
                                                            </div>
                                                            <hr class="my-2">
                                                            <div>
                                                                <small><strong>Residential:</strong> <span
                                                                        id="residential-address"></span></small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-7">
                                            <label>Sibling/s</label>
                                            <button type="button" class="btn btn-secondary btn-xs float-right mb-2"
                                                id="add-sibling-btn"><i class="fas fa-plus"></i> Add Sibling</button>
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
                                                                <td><input type="text" name="sibling_name[]"
                                                                        value="{{ $name }}"
                                                                        class="form-control form-control-sm"></td>
                                                                <td>
                                                                    <select name="sibling_gender[]"
                                                                        class="form-control form-control-sm">
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
                                                            <td><input type="text" name="sibling_name[]"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Sibling name"></td>
                                                            <td>
                                                                <select name="sibling_gender[]"
                                                                    class="form-control form-control-sm">
                                                                    <option value="">-- Select --</option>
                                                                    <option value="male">Male</option>
                                                                    <option value="female">Female</option>
                                                                    <option value="other">Other</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" name="sibling_age[]"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Age"></td>
                                                            <td><input type="text" name="sibling_class[]"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="Class"></td>
                                                            <td><input type="text" name="sibling_school[]"
                                                                    class="form-control form-control-sm"
                                                                    placeholder="School"></td>
                                                        </tr>
                                                    @endif
                                                </tbody>

                                            </table>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
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

            function toggleImmunizationUpload() {
                if ($('#immunization_complete').is(':checked')) {
                    $('#immunization_certificate_wrapper').slideDown();
                    $('#immunization_certificate').attr('required', true);
                } else {
                    $('#immunization_certificate_wrapper').slideUp();
                    $('#immunization_certificate').removeAttr('required');
                    $('#immunization_certificate').val(''); // clear file if unchecked
                }
            }

            // Run on page load (handles old() after validation errors)
            toggleImmunizationUpload();

            // Toggle on checkbox change
            $('#immunization_complete').on('change', toggleImmunizationUpload);

            function togglePreviousSchool() {
                if ($('#attended_school_previously').is(':checked')) {
                    $('#previous_school_wrapper').slideDown();
                } else {
                    $('#previous_school_wrapper').slideUp();
                    $('#previous_school_wrapper').find('input').val(''); // clear fields if unchecked
                }
            }

            // Run on page load
            togglePreviousSchool();

            // Toggle on checkbox change
            $('#attended_school_previously').on('change', togglePreviousSchool);

            // Initialize Select2 for parent selection
            $('#parent_id').select2({
                placeholder: '-- Select Parent --',
                minimumInputLength: 1,
                ajax: {
                    url: '{{ route('admin.students.search.parents') }}',
                    dataType: 'json',
                    delay: 250,
                    data: function(params) {
                        return {
                            q: params.term
                        };
                    },
                    processResults: function(data) {
                        return {
                            results: data
                        };
                    },
                    cache: true
                }
            }).on('select2:select', function(e) {
                let parentId = e.params.data.id;
                $.get('{{ url('/admin/parents') }}/' + parentId + '/details-with-siblings', function(
                    data) {
                    $('#father-name').text(data.father_name || 'N/A');
                    $('#father-contact').text(data.father_contact_no || '');
                    $('#father-photo').attr('src', data.father_photo);

                    $('#mother-name').text(data.mother_name || 'N/A');
                    $('#mother-contact').text(data.mother_contact_no || '');
                    $('#mother-photo').attr('src', data.mother_photo);

                    $('#residential-address').text(data.residential_address || '');

                    $('#parent-info-card').fadeIn();

                    // Fill siblings table
                    let tbody = $('#siblings-table-body');
                    tbody.empty();
                    if (data.siblings.length > 0) {
                        data.siblings.forEach(function(sib) {
                            tbody.append(getSiblingRow(sib.name, sib.gender, sib.age, sib
                                .class, sib.school, sib.student_id));
                        });
                    }
                    // Always add one blank row
                    tbody.append(getSiblingRow());
                });
            }).on('select2:clear', function() {
                $('#parent-info-card').hide();
                $('#siblings-table-body').empty().append(getSiblingRow());
            });

            // Function to generate sibling row
            function getSiblingRow(name = '', gender = '', age = '', className = '', school = '', studentId = '') {
                return `
        <tr>
            <td><input type="hidden" name="sibling_student_id[]" value="${studentId}"><input type="text" name="sibling_name[]" value="${name}" class="form-control form-control-sm" placeholder="Sibling name"></td>
            <td>
                <select name="sibling_gender[]" class="form-control form-control-sm">
                    <option value="">-- Select --</option>
                    <option value="male" ${gender === 'male' ? 'selected' : ''}>Male</option>
                    <option value="female" ${gender === 'female' ? 'selected' : ''}>Female</option>
                    <option value="other" ${gender === 'other' ? 'selected' : ''}>Other</option>
                </select>
            </td>
            <td><input type="text" name="sibling_age[]" value="${age}" class="form-control form-control-sm" placeholder="Age"></td>
            <td><input type="text" name="sibling_class[]" value="${className}" class="form-control form-control-sm" placeholder="Class"></td>
            <td><input type="text" name="sibling_school[]" value="${school}" class="form-control form-control-sm" placeholder="School"></td>
        </tr>
    `;
            }

            // Add Sibling Button
            $('#add-sibling-btn').on('click', function() {
                $('#siblings-table-body').append(getSiblingRow());
            });

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

            $('#class_id').on('change', function() {
                var classId = $(this).val();
                let url = "{{ route('admin.classes.getSections', ['id' => ':id']) }}";
                url = url.replace(':id', classId);
                $.ajax({
                    type: "get",
                    url: url,
                    dataType: "json",
                    success: function(response) {
                        let sectionSelect = $('#section_id');
                        sectionSelect.empty(); // clear old options
                        sectionSelect.append(
                            '<option value="" disabled selected>Select section</option>');

                        if (response.length > 0) {
                            $.each(response, function(index, section) {
                                sectionSelect.append('<option value="' + section.id +
                                    '">' + section.name + '</option>');
                            });
                        } else {
                            sectionSelect.append(
                                '<option value="">No sections available</option>');
                        }
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection
