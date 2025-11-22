@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <x-alert :message="$error" :type="$type" />
                {{-- Top Row: Stats --}}
                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa fa-graduation-cap"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Students</span>
                                <span class="info-box-number">
                                    {{ $totalStudents }}
                                </span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-danger elevation-1"><i class="fas fa fa-users"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Total Parents</span>
                                <span class="info-box-number">{{ $totalParents }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-success elevation-1"><i class="fas fa fa-book"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Classes</span>
                                <span class="info-box-number">{{ $totalClasses }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="info-box mb-3">
                            <span class="info-box-icon bg-warning elevation-1"><i class="fas fa fa-bars"></i></span>

                            <div class="info-box-content">
                                <span class="info-box-text">Sections</span>
                                <span class="info-box-number">{{ $totalSections }}</span>
                            </div>
                            <!-- /.info-box-content -->
                        </div>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <strong>Fee Collection Summary</strong>
                            </div>
                            <div class="card-body text-center">
                                <div style="max-width: 300px; margin: auto;">
                                    <canvas id="feeChart" height="120"></canvas>
                                </div>
                                <p class="mt-3">
                                    Collected <strong>₹{{ number_format($totalCollected, 2) }}</strong>
                                    of <strong>₹{{ number_format($totalFees, 2) }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <strong>Upcoming Birthdays</strong>
                            </div>
                            <div class="card-body">
                                @forelse($upcomingBirthdays as $student)
                                    <p>{{ $student->full_name }} ({{ $student->date_of_birth->format('d M') }})</p>
                                @empty
                                    <p>No birthdays this month 🎉</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <strong>Recent Admissions</strong>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Class</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentStudents as $student)
                                            <tr>
                                                <td>{{ $student->full_name }}</td>
                                                <td>{{ $student->class->name ?? '-' }}</td>
                                                <td>{{ $student->created_at->format('d-m-Y') }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No admissions yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card shadow-sm">
                            <div class="card-header">
                                <strong>Recent Fee Payments</strong>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-sm">
                                    <thead>
                                        <tr>
                                            <th>Student</th>
                                            <th>Fee</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentPayments as $payment)
                                            <tr>
                                                <td>{{ $payment->student->full_name }}</td>
                                                <td>{{ $payment->fee->name }}</td>
                                                <td>₹{{ number_format($payment->amount_paid, 2) }}</td>
                                                <td>{{ date('d-m-Y', strtotime($payment->payment_date)) }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4">No payments yet</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
@section('page_scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('feeChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Collected', 'Remaining'],
                datasets: [{
                    data: [
                        {{ $totalCollected }},
                        {{ max($totalFees - $totalCollected, 0) }}
                    ],
                    backgroundColor: ['#28a745', '#dc3545'],
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
            }
        });
    </script>
@endsection
