@extends('layouts.app')
@section('title', 'Teacher Details | ' . $teacher->first_name)
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Teacher Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.teachers.index') }}">Teachers</a></li>
                            <li class="breadcrumb-item active">Teachers</li>
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
                                <h3 class="card-title">Teacher details</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.teachers.edit', $teacher->id) }}"
                                        class="btn btn-default btn-sm">
                                        <i class="fas fa-edit" style="font-size: 12px"></i> Edit
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">

                                    <div class="col-md-4">
                                        <table class="table table-sm table-striped table-bordered">
                                            <tbody>
                                                <tr>
                                                    <th>First Name</th>
                                                    <td>{{ $teacher->first_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Last Name</th>
                                                    <td>{{ $teacher->last_name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Email</th>
                                                    <td>{{ $teacher->email }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Phone Number</th>
                                                    <td>{{ $teacher->phone_number }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date of Birth</th>
                                                    <td>{{ $teacher->date_of_birth ? $teacher->date_of_birth->format('d-m-Y') : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Gender</th>
                                                    <td>{{ $teacher->gender ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Address</th>
                                                    <td>{{ $teacher->address ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Qualification</th>
                                                    <td>{{ $teacher->qualification ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Specialization</th>
                                                    <td>{{ $teacher->specialization ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Date Joined</th>
                                                    <td>{{ $teacher->date_joined ? $teacher->date_joined->format('d-m-Y') : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ $teacher->status }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Aadhaar Number</th>
                                                    <td>{{ $teacher->aadhaar_number ?? '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <th>PAN Number</th>
                                                    <td>{{ $teacher->pan_number ?? '-' }}</td>
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
