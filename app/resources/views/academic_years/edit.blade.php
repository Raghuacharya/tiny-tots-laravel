@extends('layouts.app')
@section('title', 'Edit Academic Year')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Academic Year</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.academic-years.index') }}">Academic
                                    Years</a></li>
                            <li class="breadcrumb-item active">Edit</li>
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
                                <h3 class="card-title">Update academic year details</h3>
                            </div>
                            <form action="{{ route('admin.academic-years.update', $academicYear->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $academicYear->name) }}" required placeholder="e.g. 2025-2026">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="start_date">Start Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm @error('start_date') is-invalid @enderror" id="start_date" name="start_date" value="{{ old('start_date', $academicYear->start_date) }}" required>
                                        @error('start_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="end_date">End Date <span class="text-danger">*</span></label>
                                        <input type="date" class="form-control form-control-sm @error('end_date') is-invalid @enderror" id="end_date" name="end_date" value="{{ old('end_date', $academicYear->end_date) }}" required>
                                        @error('end_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="is_active">Is Active</label>
                                        <select class="form-control form-control-sm @error('is_active') is-invalid @enderror" id="is_active" name="is_active">
                                            <option value="1" {{ old('is_active', $academicYear->is_active) == 1 ? 'selected' : '' }}>Yes</option>
                                            <option value="0" {{ old('is_active', $academicYear->is_active) == 0 ? 'selected' : '' }}>No</option>
                                        </select>
                                        @error('is_active')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update Academic Year</button>
                                    <a href="{{ route('admin.academic-years.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
