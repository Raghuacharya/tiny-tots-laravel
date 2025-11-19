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
                                {{-- @csrf
                                @method('PUT')
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="class_id">Class <span class="text-danger">*</span></label>
                                        <select name="class_id" id="class_id"
                                            class="form-control form-control-sm @error('class_id') is-invalid @enderror">
                                            <option value="" selected disabled>Select class</option>
                                            @foreach ($classes as $class)
                                                <option value="{{ $class->id }}"
                                                    {{ old('class_id', $fee->class_id) == $class->id ? 'selected' : '' }}>
                                                    {{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name', $fee->name) }}" required
                                            placeholder="Nursery fees">
                                        @error('name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control form-control-sm @error('amount') is-invalid @enderror"
                                            id="amount" name="amount" value="{{ old('amount', $fee->amount) }}" required
                                            placeholder="1000">
                                        @error('amount')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="frequency">Frequency <span class="text-danger">*</span></label>
                                        <select name="frequency" id="frequency"
                                            class="form-control form-control-sm @error('frequency') is-invalid @enderror">
                                            <option value="" disabled>Select frequency</option>
                                            <option value="one-time"
                                                {{ old('frequency', $fee->frequency) == 'one-time' ? 'selected' : '' }}>One
                                                time</option>
                                            <option value="monthly"
                                                {{ old('frequency', $fee->frequency) == 'monthly' ? 'selected' : '' }}>
                                                Monthly</option>
                                            <option value="termly"
                                                {{ old('frequency', $fee->frequency) == 'termly' ? 'selected' : '' }}>
                                                Termly</option>
                                            <option value="yearly"
                                                {{ old('frequency', $fee->frequency) == 'yearly' ? 'selected' : '' }}>
                                                Yearly</option>
                                        </select>
                                        @error('frequency')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="term">Term</label>
                                        <input type="number"
                                            class="form-control form-control-sm @error('term') is-invalid @enderror"
                                            id="term" name="term" value="{{ old('term', $fee->term) }}"
                                            {{ old('frequency', $fee->frequency) == 'termly' ? '' : 'disabled' }}>
                                        @error('term')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea rows="5"class="form-control form-control-sm" id="description" name="description">{{ old('description', $fee->description) }}</textarea>
                                        @error('description')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Create Fee</button>
                                    <a href="{{ route('admin.fees.index') }}" class="btn btn-secondary">Cancel</a>
                                </div> --}}
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
