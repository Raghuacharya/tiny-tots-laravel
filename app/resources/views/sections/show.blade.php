@extends('layouts.app')
@section('title', 'Section Details | ' . $section->name)
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Section Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.sections.index') }}">Sections</a></li>
                            <li class="breadcrumb-item active">Section</li>
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
                                <h3 class="card-title">Section details</h3>
                                <div class="card-tools">
                                    <a href="{{ route('admin.sections.edit', $section->id) }}"
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
                                                    <th>Class</th>
                                                    <td>{{ $section->class->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Section name</th>
                                                    <td>{{ $section->name }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Teacher</th>
                                                    <td>{{ isset($section->teacher_id) ? $section->teacher->first_name . ' ' . $section->teacher->last_name : 'No teacher assigned' }}</td>
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
