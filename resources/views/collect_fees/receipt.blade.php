<!DOCTYPE html>
<html>

<head>
    <title>Payment Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .receipt {
            border: 1px solid #000;
            padding: 20px;
            width: 600px;
            margin: auto;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .details,
        .payments {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
        }

        .details td {
            padding: 5px;
        }

        .payments th,
        .payments td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 12px;
        }
    </style>
</head>

<body onload="window.print()">

    <div class="receipt">
        <div class="header">
            <img src="{{ asset('storage/' . getSchoolProfile()->logo) }}" alt="{{ getSchoolProfile()->name }}" width="80px">
            <h2 style="margin-bottom: 4px">{{ $school->name }}</h2>
            <small>{{ $school->address }}</small><br>
            <small>{{ $school->contact_phone }}</small><br>
            <small>{{ $school->contact_email }}</small><br>
            <p><strong>Payment Receipt</strong></p>
        </div>

        <table class="details">
            <tr>
                <td><strong>Student:</strong> {{ $student->full_name }}</td>
                <td><strong>Class:</strong> {{ $student->class->name }} - {{ $student->section->name ?? '' }}</td>
            </tr>
            <tr>
                <td><strong>Parent:</strong> {{ $student->parent->father_name }}</td>
                <td><strong>Date:</strong> {{ now()->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <td colspan="2"><strong>Fee:</strong> {{ $fee->name }} ({{ $fee->amount }})</td>
            </tr>
        </table>

        <table class="payments">
            <thead>
                <tr>
                    <th>Payment ID</th>
                    <th>Date</th>
                    <th>Mode</th>
                    <th>Reference</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>
                        <td>{{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }}</td>
                        <td>{{ ucfirst($payment->payment_mode) }}</td>
                        <td>{{ $payment->reference_no ?? '-' }}</td>
                        <td>{{ number_format($payment->amount_paid, 2) }}</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right;"><strong>Total Paid:</strong></td>
                    <td><strong>{{ number_format($totalPaid, 2) }}</strong></td>
                </tr>
            </tbody>
        </table>

        <div class="footer">
            <p>Thank you for your payment!</p>
        </div>
    </div>

</body>

</html>
