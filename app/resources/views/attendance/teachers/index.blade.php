@extends('layouts.app')
@section('title', 'Teachers Attendance')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Teachers attendance</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Teachers attendance</li>
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
                        {{-- Date filter at the top --}}
                        <form action="{{ route('admin.attendance.teachers.index') }}" method="GET" id="dateFilterForm">
                            <div class="form-group row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <label for="date" class="col-sm-4 col-form-label">Select date <span
                                                class="text-danger">*</span></label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control form-control-sm" id="date"
                                                name="date" value="{{ $date }}" required
                                                max="{{ date('Y-m-d') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        {{-- Attendance Form --}}
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Teachers attendance</h3>
                            </div>
                            <form method="POST" action="{{ route('admin.attendance.teachers.store') }}">
                                @csrf
                                <input type="hidden" name="date" value="{{ $date }}" />
                                <div class="card-body">
                                    <table class="table table-bordered table-sm">
                                        <thead>
                                            <tr>
                                                <th>Teacher</th>
                                                <th>Status</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($teachers as $teacher)
                                                @php $attendance = $absentAttendance[$teacher->id] ?? null; @endphp
                                                <tr>
                                                    <td>{{ $teacher->full_name }}</td>
                                                    <td>
                                                        <select name="attendance[{{ $teacher->id }}][status]"
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
                                                            name="attendance[{{ $teacher->id }}][remarks]"
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
                                    <button type="submit" class="btn btn-sm btn-success px-4">Save</button>
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
    <script>
        document.getElementById('date').addEventListener('change', function() {
            document.getElementById('dateFilterForm').submit();
        });
    </script>
@endsection
