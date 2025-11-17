@extends('layouts.app')
@section('title', 'Create Manual Receipt')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Create Manual Receipt</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create Manual Receipt</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <x-alert />
                <div class="alert alert-warning" role="alert">
                    <strong>Note:</strong> Receipts generated here are <u>not saved in the system</u>.
                    This is a manual receipt generator for one-time use only.
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Generate Manual Receipt</h3>
                            </div>
                            <form action="{{ route('admin.manual-receipts.generate') }}" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="student_name">Student name <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('student_name') is-invalid @enderror"
                                            id="student_name" name="student_name" value="{{ old('student_name') }}" required
                                            placeholder="Enter the student name">
                                        @error('student_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="father_name">Father’s name</label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('father_name') is-invalid @enderror"
                                            id="father_name" name="father_name" value="{{ old('father_name') }}"
                                            placeholder="Enter the father's name">
                                        @error('father_name')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="class">Class <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('class') is-invalid @enderror"
                                            id="class" name="class" value="{{ old('class') }}" required
                                            placeholder="Enter class (e.g., Nursery, LKG, UKG)">
                                        @error('class')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="section">Section <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('section') is-invalid @enderror"
                                            id="section" name="section" value="{{ old('class') }}" required
                                            placeholder="Enter section (e.g., A, B, C, D)">
                                        @error('section')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="fee_type">Fee Type <span class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('fee_type') is-invalid @enderror"
                                            id="fee_type" name="fee_type" value="{{ old('fee_type') }}" required
                                            placeholder="e.g., Admission Fee, Tuition Fee, Books & Stationery">
                                        @error('fee_type')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="amount">Amount <span class="text-danger">*</span></label>
                                        <input type="number"
                                            class="form-control form-control-sm @error('amount') is-invalid @enderror"
                                            id="amount" name="amount" value="{{ old('amount') }}" required
                                            placeholder="Enter amount">
                                        @error('amount')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_mode">Payment Mode <span class="text-danger">*</span></label>
                                        <select name="payment_mode" id="payment_mode"
                                            class="form-control form-control-sm @error('payment_mode') is-invalid @enderror"
                                            required>
                                            <option value="" disabled selected>Select payment mode</option>
                                            <option value="cash" {{ old('payment_mode') == 'cash' ? 'selected' : '' }}>
                                                Cash</option>
                                            <option value="card" {{ old('payment_mode') == 'card' ? 'selected' : '' }}>
                                                Card</option>
                                            <option value="upi" {{ old('payment_mode') == 'upi' ? 'selected' : '' }}>UPI
                                            </option>
                                            <option value="cheque" {{ old('payment_mode') == 'cheque' ? 'selected' : '' }}>
                                                Cheque</option>
                                            <option value="bank_transfer"
                                                {{ old('payment_mode') == 'bank_transfer' ? 'selected' : '' }}>Bank
                                                Transfer</option>
                                        </select>
                                        @error('payment_mode')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="payment_date">Payment Date <span class="text-danger">*</span></label>
                                        <input type="date"
                                            class="form-control form-control-sm @error('payment_date') is-invalid @enderror"
                                            id="payment_date" name="payment_date"
                                            value="{{ old('payment_date', date('Y-m-d')) }}" required>
                                        @error('payment_date')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="reference_no">Reference number <span
                                                class="text-danger">*</span></label>
                                        <input type="text"
                                            class="form-control form-control-sm @error('reference_no') is-invalid @enderror"
                                            id="reference_no" name="reference_no" value="{{ old('reference_no') }}"
                                            required placeholder="Enter reference number">
                                        @error('reference_no')
                                            <span class="invalid-feedback">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Generate Receipt</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
