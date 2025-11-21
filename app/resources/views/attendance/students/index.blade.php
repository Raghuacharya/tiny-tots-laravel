@extends('layouts.app')
@section('title', 'Students Attendance')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Students attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Students attendance</li>
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
                        {{-- Filter at the top --}}
                        <form action="{{ route('admin.attendance.students.index') }}" method="GET" id="dateFilterForm">
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <h5 class="mb-0">Filter attendance</h5>
                                    <p class="text-muted">
                                        Select class and date to view or mark attendance.
                                    </p>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="class_id">Class <span class="text-danger">*</span></label>
                                        <select class="form-control form-control-sm" id="class_id" name="class_id"
                                            required>
                                            <option value="">--Select class--</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ isset($selectedClassId) && $selectedClassId == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="section_id">Section <span class="text-danger">*</span></label>
                                        <select name="section_id" id="section_id" class="form-control form-control-sm">
                                            <option value="">--Select section--</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ isset($selectedSectionId) && $selectedSectionId == $section->id ? 'selected' : '' }}>
                                                    {{ $section->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="date">Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm" id="date"
                                            name="date" value="{{ $date }}" required max="{{ date('Y-m-d') }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary btn-sm px-4" type="submit">Search</button>
                                </div>
                            </div>
                        </form>
                        @if (isset($students) && count($students) > 0)
                            <form method="POST" action="{{ route('admin.attendance.students.store') }}">
                                @csrf
                                <input type="hidden" name="date" value="{{ $date }}">
                                <input type="hidden" name="class_id" value="{{ $selectedClassId }}">
                                <input type="hidden" name="section_id" value="{{ $selectedSectionId }}">
                                <input type="hidden" name="academic_year_id" value="{{ $academicYearId }}">
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="mb-0">Mark Attendance for {{ $date }}</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-bordered table-sm mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Student</th>
                                                    <th>Student ID</th>
                                                    <th>Status</th>
                                                    <th>Remarks</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($students as $i => $student)
                                                    @php
                                                        $attendance = $absentAttendance[$student->id] ?? null;
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $i + 1 }}</td>
                                                        <td>{{ $student->full_name }}</td>
                                                        <td>{{ $student->student_id }}</td>
                                                        <td>
                                                            <select name="attendance[{{ $student->id }}][status]"
                                                                class="form-control form-control-sm">
                                                                <option value="">Present</option>
                                                                <option value="Absent"
                                                                    {{ $attendance && $attendance->status == 'Absent' ? 'selected' : '' }}>
                                                                    Absent</option>
                                                                <option value="Leave"
                                                                    {{ $attendance && $attendance->status == 'Leave' ? 'selected' : '' }}>
                                                                    Leave</option>
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <input type="text"
                                                                name="attendance[{{ $student->id }}][remarks]"
                                                                value="{{ $attendance->remarks ?? '' }}"
                                                                placeholder="Remarks (optional)"
                                                                class="form-control form-control-sm" />
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-success btn-sm px-4">Save</button>
                                    </div>
                                </div>
                            </form>
                        @elseif (isset($selectedClassId) && isset($selectedSectionId))
                            <div class="alert alert-info">
                                No students found for selected class and section.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page_scripts')
    <script>
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
                        '<option value="" disabled selected>--Select section--</option>');

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
    </script>
@endsection
