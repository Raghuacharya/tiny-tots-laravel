@extends('layouts.app')
@section('title', 'Edit Fee')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Edit Fee</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.fees.index') }}">Fees</a></li>
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
                                <h3 class="card-title">Update fee details</h3>
                            </div>
                            <form action="{{ route('admin.fees.update', $fee->id) }}" method="POST">
                                @include('fees._form', ['row' => $fee])
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
        document.addEventListener('DOMContentLoaded', function() {
            const frequency = document.getElementById('frequency');
            const term = document.getElementById('term');

            function toggleTerm() {
                if (frequency.value === 'termly') {
                    term.disabled = false;
                } else {
                    term.disabled = true;
                    term.value = ''; // clear if not termly
                }
            }

            frequency.addEventListener('change', toggleTerm);

            // run once on page load
            toggleTerm();
        });
    </script>
@endsection
