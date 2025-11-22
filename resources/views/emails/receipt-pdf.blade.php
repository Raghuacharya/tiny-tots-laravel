<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-height: 80px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #000;
        }

        th,
        td {
            padding: 6px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('storage/' . getSchoolProfile()->logo) }}" alt="{{ getSchoolProfile()->name }}" width="120px"><br><br>
        <h3>{{ $school->name }}</h3>
        <p>{{ $school->address ?? '' }}</p>
    </div>

    <p><strong>Student:</strong> {{ $student->full_name }} ({{ $student->student_id }})</p>
    <p><strong>Class:</strong> {{ $student->class->name }} - {{ $student->section->name ?? '' }}</p>
    <p><strong>Date:</strong> {{ now()->format('d-m-Y') }}</p>

    <table>
        <thead>
            <tr>
                <th>Fee Type</th>
                <th>Date</th>
                <th>Mode</th>
                <th>Reference</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->fee->name }}</td>
                    <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                    <td>{{ ucfirst($payment->payment_mode) }}</td>
                    <td>{{ $payment->reference_no ?? '-' }}</td>
                    <td>₹{{ number_format($payment->amount_paid, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Paid: ₹{{ number_format($totalPaid, 2) }}</strong></p>
</body>

</html>
