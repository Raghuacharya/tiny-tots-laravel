<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            color: #333;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo {
            max-height: 80px;
            margin-bottom: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('storage/' . getSchoolProfile()->logo) }}" alt="{{ getSchoolProfile()->name }}" width="120px"><br><br>
        <h2>{{ $school->name }}</h2>
        <p>{{ $school->address ?? '' }}</p>
    </div>

    <p>Dear {{ $student->parent->father_name }},</p>

    <p>This is a confirmation for the payment received on <strong>{{ now()->format('d-m-Y') }}</strong> for your child:
    </p>

    <ul>
        <li><strong>Student:</strong> {{ $student->full_name }}</li>
        <li><strong>Class:</strong> {{ $student->class->name }} - {{ $student->section->name ?? '' }}</li>
        <li><strong>Admission No:</strong> {{ $student->student_id }}</li>
    </ul>

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

    <p>We appreciate your prompt payment.
        Please find the attached PDF receipt for your records.</p>

    <p>Thanks & Regards,<br>{{ $school->name }}</p>
</body>

</html>
