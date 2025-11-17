@extends('layouts.app')
@section('title', 'Create Parent')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Add Parent</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.parents.index') }}">Parents</a></li>
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
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Enter parents details</h3>
                            </div>
                            <form action="{{ route('admin.parents.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    {{-- Father Details --}}
                                    <h5 class="mb-3">Father Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_name">Father Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text"
                                                    class="form-control form-control-sm @error('father_name') is-invalid @enderror"
                                                    id="father_name" name="father_name" value="{{ old('father_name') }}"
                                                    required>
                                                @error('father_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_occupation">Father Occupation</label>
                                                <input type="text"
                                                    class="form-control form-control-sm @error('father_occupation') is-invalid @enderror"
                                                    id="father_occupation" name="father_occupation"
                                                    value="{{ old('father_occupation') }}">
                                                @error('father_occupation')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_place_of_work">Place of Work</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="father_place_of_work" name="father_place_of_work"
                                                    value="{{ old('father_place_of_work') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_office_address">Office Address</label>
                                                <textarea rows="5"class="form-control form-control-sm" id="father_office_address" name="father_office_address">{{ old('father_office_address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_email">Email</label>
                                                <input type="email" class="form-control form-control-sm" id="father_email"
                                                    name="father_email" value="{{ old('father_email') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_contact_no">Contact No</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="father_contact_no" name="father_contact_no"
                                                    value="{{ old('father_contact_no') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="father_photo">Photo <span class="text-danger"><small>(Max 2MB | 150x150 - 1000x1000)</small></span></label>
                                                <input type="file" class="form-control-file" id="father_photo"
                                                    name="father_photo">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Mother Details --}}
                                    <h5 class="mb-3">Mother Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_name">Mother Name</label>
                                                <input type="text" class="form-control form-control-sm" id="mother_name"
                                                    name="mother_name" value="{{ old('mother_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_occupation">Mother Occupation</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="mother_occupation" name="mother_occupation"
                                                    value="{{ old('mother_occupation') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_place_of_work">Place of Work</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="mother_place_of_work" name="mother_place_of_work"
                                                    value="{{ old('mother_place_of_work') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_office_address">Office Address</label>
                                                <textarea rows="5"class="form-control form-control-sm" id="mother_office_address" name="mother_office_address">{{ old('mother_office_address') }}</textarea>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_email">Email</label>
                                                <input type="email" class="form-control form-control-sm"
                                                    id="mother_email" name="mother_email"
                                                    value="{{ old('mother_email') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_contact_no">Contact No</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="mother_contact_no" name="mother_contact_no"
                                                    value="{{ old('mother_contact_no') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="mother_photo">Photo <span class="text-danger"><small>(Max 2MB | 150x150 - 1000x1000)</small></span></label>
                                                <input type="file" class="form-control-file" id="mother_photo"
                                                    name="mother_photo">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Residential Contact --}}
                                    <h5 class="mb-3">Residential Details</h5>
                                    <div class="form-group">
                                        <label for="residential_address">Address</label>
                                        <textarea rows="5"class="form-control form-control-sm" id="residential_address" name="residential_address">{{ old('residential_address') }}</textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="residential_contact">Contact No</label>
                                        <input type="text" class="form-control form-control-sm"
                                            id="residential_contact" name="residential_contact"
                                            value="{{ old('residential_contact') }}">
                                    </div>

                                    <hr>

                                    {{-- Guardian Details --}}
                                    <h5 class="mb-3">Guardian Details (if applicable)</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_name">Guardian Name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="guardian_name" name="guardian_name"
                                                    value="{{ old('guardian_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_relationship">Relationship</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="guardian_relationship" name="guardian_relationship"
                                                    value="{{ old('guardian_relationship') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="guardian_contact">Contact No</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="guardian_contact" name="guardian_contact"
                                                    value="{{ old('guardian_contact') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Emergency Contact --}}
                                    <h5 class="mb-3">Emergency Contact</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="emergency_contact_name">Name</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="emergency_contact_name" name="emergency_contact_name"
                                                    value="{{ old('emergency_contact_name') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="emergency_contact_relationship">Relationship</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="emergency_contact_relationship"
                                                    name="emergency_contact_relationship"
                                                    value="{{ old('emergency_contact_relationship') }}">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="emergency_contact_phone">Phone</label>
                                                <input type="text" class="form-control form-control-sm"
                                                    id="emergency_contact_phone" name="emergency_contact_phone"
                                                    value="{{ old('emergency_contact_phone') }}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="emergency_contact_address">Address</label>
                                        <textarea rows="5"class="form-control form-control-sm" id="emergency_contact_address" name="emergency_contact_address">{{ old('emergency_contact_address') }}</textarea>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create Parent</button>
                                    <a href="{{ route('admin.parents.index') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
