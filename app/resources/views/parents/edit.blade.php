@extends('layouts.app')
@section('title', 'Edit Parent')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Parent Details</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.parents.index') }}">Parents</a></li>
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
                                <h3 class="card-title">Edit parents details</h3>
                            </div>
                            <form action="{{ route('admin.parents.update', $parent->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')

                                <div class="card-body">

                                    {{-- Father Details --}}
                                    <h5 class="mb-3">Father Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_name">Father Name <span
                                                        class="text-danger">*</span></label>
                                                <input type="text" id="father_name" name="father_name"
                                                    class="form-control form-control-sm @error('father_name') is-invalid @enderror"
                                                    value="{{ old('father_name', $parent->father_name) }}" required>
                                                @error('father_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_occupation">Father Occupation</label>
                                                <input type="text" id="father_occupation" name="father_occupation"
                                                    class="form-control form-control-sm @error('father_occupation') is-invalid @enderror"
                                                    value="{{ old('father_occupation', $parent->father_occupation) }}">
                                                @error('father_occupation')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="father_place_of_work">Father Place of Work</label>
                                        <input type="text" id="father_place_of_work" name="father_place_of_work"
                                            class="form-control form-control-sm @error('father_place_of_work') is-invalid @enderror"
                                            value="{{ old('father_place_of_work', $parent->father_place_of_work) }}">
                                        @error('father_place_of_work')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="father_office_address">Father Office Address</label>
                                        <textarea rows="5"id="father_office_address" name="father_office_address"
                                            class="form-control form-control-sm @error('father_office_address') is-invalid @enderror" rows="2">{{ old('father_office_address', $parent->father_office_address) }}</textarea>
                                        @error('father_office_address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_email">Father Email</label>
                                                <input type="email" id="father_email" name="father_email"
                                                    class="form-control form-control-sm @error('father_email') is-invalid @enderror"
                                                    value="{{ old('father_email', $parent->father_email) }}">
                                                @error('father_email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="father_contact_no">Father Contact No</label>
                                                <input type="text" id="father_contact_no" name="father_contact_no"
                                                    class="form-control form-control-sm @error('father_contact_no') is-invalid @enderror"
                                                    value="{{ old('father_contact_no', $parent->father_contact_no) }}">
                                                @error('father_contact_no')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="father_photo">Father Photo</label>
                                        <input type="file" id="father_photo" name="father_photo"
                                            class="form-control-file @error('father_photo') is-invalid @enderror">
                                        @if ($parent->father_photo)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $parent->father_photo) }}"
                                                    alt="Father Photo" style="max-width:120px;">
                                            </div>
                                        @endif
                                        @error('father_photo')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <hr>

                                    {{-- Mother Details --}}
                                    <h5 class="mb-3">Mother Details</h5>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_name">Mother Name</label>
                                                <input type="text" id="mother_name" name="mother_name"
                                                    class="form-control form-control-sm @error('mother_name') is-invalid @enderror"
                                                    value="{{ old('mother_name', $parent->mother_name) }}">
                                                @error('mother_name')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_occupation">Mother Occupation</label>
                                                <input type="text" id="mother_occupation" name="mother_occupation"
                                                    class="form-control form-control-sm @error('mother_occupation') is-invalid @enderror"
                                                    value="{{ old('mother_occupation', $parent->mother_occupation) }}">
                                                @error('mother_occupation')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mother_place_of_work">Mother Place of Work</label>
                                        <input type="text" id="mother_place_of_work" name="mother_place_of_work"
                                            class="form-control form-control-sm @error('mother_place_of_work') is-invalid @enderror"
                                            value="{{ old('mother_place_of_work', $parent->mother_place_of_work) }}">
                                        @error('mother_place_of_work')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="mother_office_address">Mother Office Address</label>
                                        <textarea rows="5"id="mother_office_address" name="mother_office_address"
                                            class="form-control form-control-sm @error('mother_office_address') is-invalid @enderror" rows="2">{{ old('mother_office_address', $parent->mother_office_address) }}</textarea>
                                        @error('mother_office_address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_email">Mother Email</label>
                                                <input type="email" id="mother_email" name="mother_email"
                                                    class="form-control form-control-sm @error('mother_email') is-invalid @enderror"
                                                    value="{{ old('mother_email', $parent->mother_email) }}">
                                                @error('mother_email')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="mother_contact_no">Mother Contact No</label>
                                                <input type="text" id="mother_contact_no" name="mother_contact_no"
                                                    class="form-control form-control-sm @error('mother_contact_no') is-invalid @enderror"
                                                    value="{{ old('mother_contact_no', $parent->mother_contact_no) }}">
                                                @error('mother_contact_no')
                                                    <span class="invalid-feedback">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="mother_photo">Mother Photo</label>
                                        <input type="file" id="mother_photo" name="mother_photo"
                                            class="form-control-file @error('mother_photo') is-invalid @enderror">
                                        @if ($parent->mother_photo)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/' . $parent->mother_photo) }}"
                                                    alt="Mother Photo" style="max-width:120px;">
                                            </div>
                                        @endif
                                        @error('mother_photo')
                                            <span class="invalid-feedback d-block">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <hr>

                                    {{-- Residential Contact --}}
                                    <h5 class="mb-3">Residential Contact</h5>
                                    <div class="form-group">
                                        <label for="residential_address">Residential Address</label>
                                        <textarea rows="5"id="residential_address" name="residential_address"
                                            class="form-control form-control-sm @error('residential_address') is-invalid @enderror" rows="2">{{ old('residential_address', $parent->residential_address) }}</textarea>
                                        @error('residential_address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="residential_contact">Residential Contact</label>
                                        <input type="text" id="residential_contact" name="residential_contact"
                                            class="form-control form-control-sm @error('residential_contact') is-invalid @enderror"
                                            value="{{ old('residential_contact', $parent->residential_contact) }}">
                                        @error('residential_contact')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <hr>

                                    {{-- Guardian Details --}}
                                    <h5 class="mb-3">Guardian Details (if applicable)</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="guardian_name" placeholder="Guardian Name"
                                                value="{{ old('guardian_name', $parent->guardian_name) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="guardian_relationship" placeholder="Relationship"
                                                value="{{ old('guardian_relationship', $parent->guardian_relationship) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="guardian_contact" placeholder="Contact No"
                                                value="{{ old('guardian_contact', $parent->guardian_contact) }}">
                                        </div>
                                    </div>

                                    <hr>

                                    {{-- Emergency Contact --}}
                                    <h5 class="mb-3">Emergency Contact</h5>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="emergency_contact_name" placeholder="Contact Name"
                                                value="{{ old('emergency_contact_name', $parent->emergency_contact_name) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="emergency_contact_relationship" placeholder="Relationship"
                                                value="{{ old('emergency_contact_relationship', $parent->emergency_contact_relationship) }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control form-control-sm mb-2"
                                                name="emergency_contact_phone" placeholder="Phone"
                                                value="{{ old('emergency_contact_phone', $parent->emergency_contact_phone) }}">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="emergency_contact_address">Emergency Contact Address</label>
                                        <textarea rows="5"id="emergency_contact_address" name="emergency_contact_address"
                                            class="form-control form-control-sm @error('emergency_contact_address') is-invalid @enderror" rows="2">{{ old('emergency_contact_address', $parent->emergency_contact_address) }}</textarea>
                                        @error('emergency_contact_address')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-success">Update</button>
                                    <a href="{{ route('admin.parents.index') }}" class="btn btn-secondary">Back</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
