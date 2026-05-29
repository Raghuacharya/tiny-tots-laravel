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
                        <form action="{{ route('admin.students.store') }}" method="POST" enctype="multipart/form-data">
                            @include('students._form', ['row' => null])
                        </form>
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




        });
    </script>

    <script>
        $(document).ready(function() {
            const tabs = {
                'custom-tabs-four-general': '#custom-tabs-four-general-tab',
                'custom-tabs-four-academic': '#custom-tabs-four-academic-tab',
                'custom-tabs-four-medical': '#custom-tabs-four-medical-tab',
                'custom-tabs-four-history-documents': '#custom-tabs-four-history-documents-tab',
                'custom-tabs-four-parents': '#custom-tabs-four-parents-tab'
            };

            // 1. Enhanced validation with forced error display
            function validateTab(tabId) {
                const tabPane = $(`#${tabId}`);
                const requiredInputs = tabPane.find(':input[required]');

                let isValid = true;

                requiredInputs.each(function() {
                    const input = $(this)[0];
                    input.reportValidity(); // Trigger HTML5 validation

                    // Force show error styling
                    if (!input.validity.valid) {
                        isValid = false;
                        $(input).addClass('is-invalid');

                        // Custom error message if HTML5 doesn't show it
                        if (!input.validity.valid && input.validationMessage) {
                            let errorDiv = $(input).siblings('.invalid-feedback');
                            if (errorDiv.length === 0) {
                                errorDiv = $('<div class="invalid-feedback d-block"></div>');
                                $(input).after(errorDiv);
                            }
                            errorDiv.text(input.validationMessage || 'This field is required.');
                        }
                    } else {
                        $(input).removeClass('is-invalid');
                        $(input).siblings('.invalid-feedback').remove();
                    }
                });

                return isValid;
            }

            // 2. Tab click handler (prevent invalid tab switch)
            $('.nav-tabs a[data-toggle="pill"]').on('click', function(e) {
                const targetTabId = $(this).attr('href').substring(1); // Remove #
                const currentTabId = $('.tab-pane.show.active').attr('id');

                if (!validateTab(currentTabId)) {
                    e.preventDefault();
                    scrollToFirstError(currentTabId);
                    return false;
                }
            });

            // 3. Next/Previous buttons
            $('.btn-next').on('click', function() {
                const currentTabId = $('.tab-pane.show.active').attr('id');
                if (validateTab(currentTabId)) {
                    const nextTabKey = getNextTabKey(currentTabId);
                    if (nextTabKey) {
                        $(tabs[nextTabKey]).tab('show');
                    }
                } else {
                    scrollToFirstError(currentTabId);
                }
            });

            $('.btn-prev').on('click', function() {
                const currentTabId = $('.tab-pane.show.active').attr('id');
                const prevTabKey = getPrevTabKey(currentTabId);
                if (prevTabKey) {
                    $(tabs[prevTabKey]).tab('show');
                }
            });

            // 4. Form submit (validate ALL tabs)
            $('form').on('submit', function(e) {
                let allValid = true;
                Object.keys(tabs).forEach(tabId => {
                    if (!validateTab(tabId)) {
                        allValid = false;
                    }
                });

                if (!allValid) {
                    e.preventDefault();
                    const firstErrorTab = Object.keys(tabs).find(tabId => !validateTab(tabId));
                    $(tabs[firstErrorTab]).tab('show');
                    scrollToFirstError(firstErrorTab);
                    return false;
                }
                return true;
            });

            // Helper functions
            function scrollToFirstError(tabId) {
                const firstError = $(`#${tabId}`).find('.is-invalid, :invalid')[0];
                if (firstError) {
                    firstError.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    firstError.focus();
                }
            }

            function getNextTabKey(currentTabId) {
                const tabOrder = Object.keys(tabs);
                const currentIndex = tabOrder.indexOf(currentTabId);
                return tabOrder[currentIndex + 1] || null;
            }

            function getPrevTabKey(currentTabId) {
                const tabOrder = Object.keys(tabs);
                const currentIndex = tabOrder.indexOf(currentTabId);
                return currentIndex > 0 ? tabOrder[currentIndex - 1] : null;
            }

            // Clear errors when user starts typing
            $(document).on('input change', ':input[required]', function() {
                $(this).removeClass('is-invalid');
                $(this).siblings('.invalid-feedback').remove();
            });

            // Auto-focus first field on tab switch
            $('.nav-tabs a[data-toggle="pill"]').on('shown.bs.tab', function(e) {
                const targetTab = $(e.target.hash);
                const firstInput = targetTab.find(':input:not([type=hidden]):eq(0)');
                firstInput.focus();
            });
        });
    </script>


@endsection
