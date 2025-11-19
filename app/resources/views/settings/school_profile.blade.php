@extends('layouts.app')
@section('title', 'School Profile')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">School details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">School</li>
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
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">School Profile</h3>
                            </div>
                            <form action="{{ route('admin.school.update') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="name">School Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="name" name="name"
                                            value="{{ old('name', $school ? $school->name : '') }}" required placeholder="Enter school name">
                                    </div>
                                    <div class="form-group">
                                        <label for="code">Code</label>
                                        <input type="text" class="form-control form-control-sm" id="code" name="code"
                                            value="{{ old('code', $school ? $school->code : '') }}" placeholder="Enter school code">
                                    </div>
                                    <div class="form-group">
                                        <label for="address">Address <span class="text-danger">*</span></label>
                                        <textarea rows="5"class="form-control form-control-sm" id="address" name="address" rows="3" required placeholder="Enter school address">{{ old('address', $school ? $school->address : '') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_phone">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control form-control-sm" id="contact_phone" name="contact_phone"
                                            value="{{ old('contact_phone', $school ? $school->contact_phone : '') }}" required placeholder="Enter school phone number">
                                    </div>
                                    <div class="form-group">
                                        <label for="contact_email">Email <span class="text-danger">*</span></label>
                                        <input type="email" class="form-control form-control-sm" id="contact_email" name="contact_email"
                                            value="{{ old('contact_email', $school ? $school->contact_email : '') }}" required placeholder="Enter school email">
                                    </div>
                                    <div class="form-group">
                                        <label for="website">Website</label>
                                        <input type="url" class="form-control form-control-sm" id="website" name="website"
                                            value="{{ old('website', $school ? $school->website : '') }}" placeholder="Enter school website URL">
                                    </div>
                                    <div class="form-group">
                                        <label for="logo">Logo</label>
                                        <input type="file" class="form-control-file" id="logo" name="logo">
                                        @if ($school && $school->logo)
                                            <img src="{{ asset('storage/' . $school->logo) }}" alt="School Logo" class="mt-2" style="max-width: 150px;">
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success btn-sm">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
