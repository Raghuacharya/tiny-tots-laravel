@extends('layouts.app')
@section('title', 'Academic Year Details | ' . $academicYear->name)
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Academic Year Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.academic-years.index') }}">Academic Years</a></li>
                            <li class="breadcrumb-item active">Class</li>
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
                                <h3 class="card-title">Academic Year Details</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.classes.edit', $academicYear->id) }}"
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
                                                    <th>Name</th>
                                                    <td>{{ $academicYear->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Start date</th>
                                                    <td>{{ date('d-m-Y', strtotime($academicYear->start_date)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>End date</th>
                                                    <td>{{ date('d-m-Y', strtotime($academicYear->end_date)) }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Status</th>
                                                    <td>{{ $academicYear->is_active ? 'Active' : 'Inactive' }}</td>
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
