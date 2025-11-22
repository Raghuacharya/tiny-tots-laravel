@extends('layouts.app')
@section('title', 'Collect Fees')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Collect Fees</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Collect Fees</li>
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
                        <h5>Search Students</h5>
                    </div>
                    <div class="col-12">
                        <p class="text-muted">You can search students by selecting class & section or by entering admission
                            number.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="row">
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="class_id">Class</label>
                                    <select name="class_id" id="class_id" class="form-control form-control-sm">
                                        <option value="" selected disabled>Select class</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="section_id">Section</label>
                                    <select name="section_id" id="section_id" class="form-control form-control-sm">
                                        <option value="" selected disabled>Select section</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 flex-column d-flex justify-content-center align-items-center">
                                <p class="text-muted or-divider"><span class="or-text">OR</span></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="admission_no">Admission No.</label>
                            <input type="text" name="admission_no" id="admission_no" class="form-control form-control-sm"
                                placeholder="Enter admission no">
                        </div>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-12">
                        <button type="button" id="search_button" class="btn btn-primary btn-sm px-4">Search</button>
                    </div>
                </div>
                {{-- <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Select Criteria</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <!-- Left card: Class & Section -->
                                    <div class="col-md-6">
                                        <div class="card border-primary shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="card-title mb-0">By Class & Section</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="class_id">Class <span class="text-danger">*</span></label>
                                                    <select name="class_id" id="class_id"
                                                        class="form-control form-control-sm">
                                                        <option value="" selected disabled>Select class</option>
                                                        @foreach ($classes as $class)
                                                            <option value="{{ $class->id }}">{{ $class->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group mt-2">
                                                    <label for="section_id">Section <span
                                                            class="text-danger">*</span></label>
                                                    <select name="section_id" id="section_id"
                                                        class="form-control form-control-sm">
                                                        <option value="" selected disabled>Select section</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Right card: Admission No -->
                                    <div class="col-md-6">
                                        <div class="card border-success shadow-sm">
                                            <div class="card-header bg-light">
                                                <h5 class="card-title mb-0">By Admission No.</h5>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label for="admission_no">Admission No.</label>
                                                    <input type="text" name="admission_no" id="admission_no"
                                                        class="form-control form-control-sm"
                                                        placeholder="Enter admission no">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Footer -->
                            <div class="card-footer">
                                <button type="button" id="search_button" class="btn btn-primary px-4">Search</button>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Students List</h3>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="table">
                                        <thead>
                                            <tr>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Admission No.</th>
                                                <th>Student Name</th>
                                                <th>Father Name</th>
                                                <th>Date of Birth</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody></tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Class</th>
                                                <th>Section</th>
                                                <th>Admission No.</th>
                                                <th>Student Name</th>
                                                <th>Father Name</th>
                                                <th>Date of Birth</th>
                                                <th>Actions</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function() {
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

            $('#table').DataTable({
                processing: true,
                serverSide: false,
                ajax: {
                    url: "{{ route('admin.collect-fees.getStudents') }}",
                    data: function(d) {
                        d.class_id = $('#class_id').val();
                        d.section_id = $('#section_id').val();
                        d.admission_no = $('#admission_no').val();
                    }
                },
                columns: [{
                        data: 'class',
                        name: 'class'
                    },
                    {
                        data: 'section',
                        name: 'section'
                    },
                    {
                        data: 'admission_no',
                        name: 'admission_no'
                    },
                    {
                        data: 'student_name',
                        name: 'student_name'
                    },
                    {
                        data: 'father_name',
                        name: 'father_name'
                    },
                    {
                        data: 'dob',
                        name: 'dob'
                    },
                    {
                        data: 'actions',
                        name: 'actions',
                        orderable: false,
                        searchable: false
                    }
                ]
            });

            $('#search_button').on('click', function() {
                $('#table').DataTable().ajax.reload();
            });
        });
    </script>
@endsection
