@extends('layouts.app')
@section('title', 'Student Details | ' . $student->name)
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Student Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.students.index') }}">Students</a></li>
                            <li class="breadcrumb-item active">Student details</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student details</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.students.edit', $student->id) }}"
                                        class="btn btn-default btn-sm">
                                        <i class="fas fa-edit" style="font-size: 12px"></i> Edit
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-sm table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <td>{{ $student->student_id }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Full name</th>
                                                    <td>{{ $student->full_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Admission date</th>
                                                    <td>{{ date('d-m-Y', strtotime($student->admission_date)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date of birth</th>
                                                    <td>{{ date('d-m-Y', strtotime($student->date_of_birth)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Age</th>
                                                    <td>
                                                        @php
                                                            use Carbon\Carbon;
                                                            $dob = $student->date_of_birth
                                                                ? Carbon::parse($student->date_of_birth)
                                                                : null;
                                                            $now = Carbon::now();
                                                            $age = $dob ? $dob->diff($now) : null;
                                                        @endphp
                                                        {{ $age ? $age->y . ' years ' . $age->m . ' months' : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td>{{ $student->gender ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Place of birth</th>
                                                    <td>{{ $student->place_of_birth ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Nationality</th>
                                                    <td>{{ $student->nationality ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Mother tongue</th>
                                                    <td>{{ $student->mother_tongue ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Blood group</th>
                                                    <td>{{ $student->blood_group ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Class</th>
                                                    <td>{{ $student->class->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Section</th>
                                                    <td>{{ $student->section->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Allergies</th>
                                                    <td>{{ $student->allergies ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Surgeries</th>
                                                    <td>{{ $student->surgeries ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Chronic illness</th>
                                                    <td>{{ $student->chronic_illness ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Immunization complete</th>
                                                    <td>{{ $student->immunization_complete ? 'Yes' : 'No' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Medical notes</th>
                                                    <td>{{ $student->medical_notes ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Parents</th>
                                                    <td>
                                                        <a href="{{ route('admin.parents.show', $student->parent->id) }}"
                                                            target="_blank">
                                                            {{ $student->parent->father_name . ' & ' . $student->parent->mother_name }}
                                                            <i class="fas fa-external-link-alt"
                                                                style="color: #3c3c3c; font-size: 10px; margin-left: 4px;"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Attended school previously</th>
                                                    <td>{{ $student->attended_school_previously ? 'Yes' : 'No' }}</td>
                                                </tr>
                                                @if ($student->attended_school_previously)
                                                    <tr>
                                                        <th>Previous school details</th>
                                                        <td>{{ $student->previous_school_details ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Previous school duration</th>
                                                        <td>{{ $student->previous_school_duration ?? '-' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Previous class attended</th>
                                                        <td>{{ $student->previous_class_attended ?? '-' }}</td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <th>Birth certificate</th>
                                                    <td>
                                                        @if ($student->birth_certificate)
                                                            <a href="{{ asset('storage/' . $student->birth_certificate) }}"
                                                                target="_blank">View Document
                                                                <i class="fas fa-external-link-alt"
                                                                    style="color: #3c3c3c; font-size: 10px; margin-left: 4px;"></i>
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Immunization record</th>
                                                    <td>
                                                        @if ($student->immunization_record)
                                                            <a href="{{ asset('storage/' . $student->immunization_record) }}"
                                                                target="_blank">View Document
                                                                <i class="fas fa-external-link-alt"
                                                                    style="color: #3c3c3c; font-size: 10px; margin-left: 4px;"></i>
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Transfer certificate</th>
                                                    <td>
                                                        @if ($student->transfer_certificate)
                                                            <a href="{{ asset('storage/' . $student->transfer_certificate) }}"
                                                                target="_blank">View Document
                                                                <i class="fas fa-external-link-alt"
                                                                    style="color: #3c3c3c; font-size: 10px; margin-left: 4px;"></i>
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Progress report</th>
                                                    <td>
                                                        @if ($student->progress_report)
                                                            <a href="{{ asset('storage/' . $student->progress_report) }}"
                                                                target="_blank">View Document
                                                                <i class="fas fa-external-link-alt"
                                                                    style="color: #3c3c3c; font-size: 10px; margin-left: 4px;"></i>
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Passport</th>
                                                    <td>
                                                        @if ($student->passport)
                                                            <a href="{{ asset('storage/' . $student->passport) }}"
                                                                target="_blank">View Document
                                                                <i class="fas fa-external-link-alt"
                                                                    style="color: #3c3c3c; font-size: 10px; margin-left: 4px;"></i>
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Medical report</th>
                                                    <td>
                                                        @if ($student->medical_report)
                                                            <a href="{{ asset('storage/' . $student->medical_report) }}"
                                                                target="_blank">View Document
                                                                <i class="fas fa-external-link-alt"
                                                                    style="color: #3c3c3c; font-size: 10px; margin-left: 4px;"></i>
                                                            </a>
                                                        @else
                                                            N/A
                                                        @endif
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
