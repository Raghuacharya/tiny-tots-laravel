@extends('layouts.app')
@section('title', 'Show Parent')
@section('page_styles')
    <style>
        @media print {
            body * {
                visibility: hidden;
            }

            .container-fluid,
            .container-fluid * {
                visibility: visible;
            }

            .container-fluid {
                margin: 0;
                padding: 0;
            }

            .btn,
            .sidebar,
            .navbar,
            .footer {
                display: none !important;
            }
        }
    </style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Parent Details</h1>
                        <button class="btn btn-primary btn-sm" onclick="window.print()">
                            <i class="fas fa-print"></i> Print
                        </button>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.parents.index') }}">Parents</a></li>
                            <li class="breadcrumb-item active">Show</li>
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
                    {{-- Father details --}}
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-primary text-white">
                                Father Details
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    @if ($parent->father_photo)
                                        <img src="{{ asset('storage/' . $parent->father_photo) }}" alt="Father Photo"
                                            class="rounded-circle me-3"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                            style="width: 80px; height: 80px; font-size: 24px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                    <h5 class="mb-0">{{ $parent->father_name }}</h5>
                                </div>
                                <p><strong>Occupation:</strong> {{ $parent->father_occupation ?? '-' }}</p>
                                <p><strong>Place of Work:</strong> {{ $parent->father_place_of_work ?? '-' }}</p>
                                <p><strong>Office Address:</strong> {{ $parent->father_office_address ?? '-' }}</p>
                                <p><strong>Email:</strong> {{ $parent->father_email ?? '-' }}</p>
                                <p><strong>Contact No:</strong> {{ $parent->father_contact_no ?? '-' }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Mother details --}}
                    <div class="col-md-6">
                        <div class="card shadow-sm mb-3">
                            <div class="card-header bg-success text-white">
                                Mother Details
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center mb-3">
                                    @if ($parent->mother_photo)
                                        <img src="{{ asset('storage/' . $parent->mother_photo) }}" alt="Mother Photo"
                                            class="rounded-circle me-3"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <div class="rounded-circle bg-light d-flex align-items-center justify-content-center me-3"
                                            style="width: 80px; height: 80px; font-size: 24px;">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                    <h5 class="mb-0">{{ $parent->mother_name }}</h5>
                                </div>
                                <p><strong>Occupation:</strong> {{ $parent->mother_occupation ?? '-' }}</p>
                                <p><strong>Place of Work:</strong> {{ $parent->mother_place_of_work ?? '-' }}</p>
                                <p><strong>Office Address:</strong> {{ $parent->mother_office_address ?? '-' }}</p>
                                <p><strong>Email:</strong> {{ $parent->mother_email ?? '-' }}</p>
                                <p><strong>Contact No:</strong> {{ $parent->mother_contact_no ?? '-' }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Residential & Guardian -->
                <div class="card shadow-sm mb-3">
                    <div class="card-header bg-secondary text-white">
                        Contact Information
                    </div>
                    <div class="card-body">
                        <p><strong>Residential Address:</strong> {{ $parent->residential_address ?? '-' }}</p>
                        <p><strong>Residential Contact:</strong> {{ $parent->residential_contact ?? '-' }}</p>
                        <p><strong>Guardian Name:</strong> {{ $parent->guardian_name ?? '-' }}</p>
                        <p><strong>Guardian Relationship:</strong> {{ $parent->guardian_relationship ?? '-' }}</p>
                        <p><strong>Guardian Contact:</strong> {{ $parent->guardian_contact ?? '-' }}</p>
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div class="card shadow-sm">
                    <div class="card-header bg-danger text-white">
                        Emergency Contact
                    </div>
                    <div class="card-body">
                        <p><strong>Name:</strong> {{ $parent->emergency_contact_name ?? '-' }}</p>
                        <p><strong>Relationship:</strong> {{ $parent->emergency_contact_relationship ?? '-' }}</p>
                        <p><strong>Phone:</strong> {{ $parent->emergency_contact_phone ?? '-' }}</p>
                        <p><strong>Address:</strong> {{ $parent->emergency_contact_address ?? '-' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
