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
                                @include('students._form', ['row' => null])
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
