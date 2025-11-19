@extends('layouts.app')
@section('title', 'Collect Fees')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Collect Fees</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('admin.collect.fees.index') }}">Collect Fees</a>
                            </li>
                            <li class="breadcrumb-item active">Student details</li>
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
                        <div class="card mb-3">
                            <div class="card-header bg-primary text-white">
                                <strong>Student Details</strong>
                            </div>
                            <div class="card-body">
                                <div class="row align-items-center">
                                    <div class="col-md-2 text-center">
                                        @if ($student->child_photo)
                                            <img src="{{ asset('storage/' . $student->child_photo) }}" alt="Student Photo"
                                                class="img-fluid rounded-circle" style="max-width: 120px;">
                                        @else
                                            <img src="{{ asset('images/defaults/student-avatar.png') }}" alt="Default Photo"
                                                class="img-fluid rounded-circle" style="max-width: 120px;">
                                        @endif
                                    </div>
                                    <div class="col-md-10">
                                        <table class="table table-sm table-borderless mb-0">
                                            <tr>
                                                <th width="25%">Admission No:</th>
                                                <td>{{ $student->student_id }}</td>
                                            </tr>
                                            <tr>
                                                <th>Full Name:</th>
                                                <td>{{ $student->full_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Class & Section:</th>
                                                <td>{{ $student->class->name }} {{ $student->section->name ?? '' }}</td>
                                            </tr>
                                            <tr>
                                                <th>Father's Name:</th>
                                                <td>{{ $student->parent->father_name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Date of Birth:</th>
                                                <td>{{ \Carbon\Carbon::parse($student->date_of_birth)->format('d-m-Y') }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <th>Status:</th>
                                                <td>
                                                    <span
                                                        class="badge
                                @if ($student->status == 'active') badge-success
                                @elseif($student->status == 'inactive') badge-secondary
                                @elseif($student->status == 'graduated') badge-info
                                @else badge-danger @endif">
                                                        {{ ucfirst($student->status) }}
                                                    </span>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Student Fees</h3>
                                <div class="card-tools">
                                    <button class="btn btn-xs btn-secondary bulkCollectBtn"
                                        data-student="{{ $student->id }}" data-amount="{{ $totalBalance }}"
                                        title="Collect All Fees">
                                        Bulk collect
                                    </button>
                                    <a href="{{ route('admin.collect-fees.printAllReceipts', $student->id) }}"
                                        target="_blank" class="btn btn-xs btn-info" title="Print All Receipts">
                                        Print All
                                    </a>
                                    <a href="{{ route('admin.collect-fees.sendAllReceipts', $student->id) }}"
                                        class="btn btn-xs btn-warning sendEmailBtn" title="Send Receipt Email">
                                        Send Email
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-sm" id="table">
                                        <thead>
                                            <tr>
                                                <th>Fees</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Payment ID</th>
                                                <th>Mode</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($feesWithPayments as $row)
                                                <tr>
                                                    <td>{{ $row['fee']->name }}</td>
                                                    <td>
                                                        <span
                                                            class="badge
                    {{ $row['status'] == 'Paid' ? 'bg-success' : ($row['status'] == 'Partial' ? 'bg-warning' : 'bg-danger') }}">
                                                            {{ $row['status'] }}
                                                        </span>
                                                    </td>
                                                    <td>{{ $row['fee']->amount }}</td>
                                                    <td>
                                                        @foreach ($row['payments'] as $payment)
                                                            {{ $payment->reference_no }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($row['payments'] as $payment)
                                                            {{ ucfirst($payment->payment_mode) }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @foreach ($row['payments'] as $payment)
                                                            {{ $payment->payment_date }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        @if ($row['status'] != 'Paid')
                                                            <button class="btn btn-xs btn-secondary collectFeeBtn"
                                                                data-student="{{ $student->id }}"
                                                                data-fee="{{ $row['fee']->id }}"
                                                                data-amount="{{ $row['balance'] }}" title="Collect Fee">
                                                                Collect
                                                            </button>
                                                        @endif

                                                        @if ($row['paidAmount'] > 0)
                                                            <a href="{{ route('admin.collect-fees.printReceipt', [$student->id, $row['fee']->id]) }}"
                                                                target="_blank" class="btn btn-xs btn-info"
                                                                title="Print Receipt">
                                                                Print
                                                            </a>
                                                        @endif
                                                    </td>

                                                </tr>
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr>
                                                <th>Fees</th>
                                                <th>Status</th>
                                                <th>Amount</th>
                                                <th>Payment ID</th>
                                                <th>Mode</th>
                                                <th>Date</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Collect Fee Modal -->
        <div class="modal fade" id="collectFeeModal" tabindex="-1" aria-labelledby="collectFeeModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form id="collectFeeForm" method="POST" action="">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="collectFeeModalLabel">Collect Fee</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <input type="hidden" name="student_id" id="student_id">
                            <input type="hidden" name="fee_id" id="fee_id">

                            <div class="mb-3">
                                <label>Amount to Pay</label>
                                <input type="number" step="0.01" name="amount_paid" id="amount_paid"
                                    class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label>Payment Mode</label>
                                <select name="payment_mode" id="payment_mode" class="form-control" required>
                                    <option value="cash">Cash</option>
                                    <option value="card">Card</option>
                                    <option value="upi">UPI</option>
                                    <option value="cheque">Cheque</option>
                                    <option value="bank_transfer">Bank Transfer</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label>Reference No.</label>
                                <input type="text" name="reference_no" id="reference_no" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label>Notes</label>
                                <textarea name="notes" id="notes" class="form-control"></textarea>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('page_scripts')
    <script>
        $(document).ready(function() {
            $('#table').DataTable({
                processing: true,
                serverSide: false,
            });

            $(document).on('click', '.collectFeeBtn', function() {
                let studentId = $(this).data('student');
                let feeId = $(this).data('fee');
                let balance = $(this).data('amount');

                $('#student_id').val(studentId);
                $('#fee_id').val(feeId);
                $('#amount_paid').val(balance).attr('readonly', false); // default fill with balance

                // set form action dynamically
                let actionUrl = "{{ route('admin.collect-fees.storePayment', [':studentId', ':feeId']) }}"
                    .replace(':studentId', studentId)
                    .replace(':feeId', feeId);
                $('#collectFeeForm').attr('action', actionUrl);

                $('#collectFeeModal').modal('show');
            });

            $(document).on('click', '.bulkCollectBtn', function() {
                let studentId = $(this).data('student');
                let balance = $(this).data('amount');

                $('#student_id').val(studentId);
                $('#fee_id').val(''); // clear, since bulk
                $('#amount_paid').val(balance).attr('readonly', true);

                // bulk action URL
                let actionUrl = "{{ route('admin.collect-fees.storeBulkPayment', ':studentId') }}"
                    .replace(':studentId', studentId);
                $('#collectFeeForm').attr('action', actionUrl);

                $('#collectFeeModal').modal('show');
            });

            $(document).on('click', '.sendEmailBtn', function(e) {
                $(this)
                    .addClass('disabled')
                    .css('pointer-events', 'none')
                    .text('Sending...');
            });

        });
    </script>
@endsection
