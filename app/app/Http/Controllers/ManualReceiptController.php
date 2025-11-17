<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class ManualReceiptController extends Controller
{
    public function create()
    {
        return view('manual_receipts.create');
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'student_name'   => 'required|string|max:255',
            'father_name'    => 'nullable|string|max:255',
            'class'          => 'required|string|max:100',
            'section'        => 'nullable|string|max:100',
            'fee_type'       => 'required|string|max:100',
            'amount'         => 'required|numeric|min:1',
            'payment_mode'   => 'required|string|in:cash,card,upi,cheque,bank_transfer',
            'payment_date'   => 'required|date',
            'reference_no'   => 'nullable|string|max:255',
        ]);

        // Fake "student" object to match your existing blade
        $student = (object)[
            'full_name' => $data['student_name'],
            'class'     => (object)['name' => $data['class']],
            'section'   => (object)['name' => $data['section'] ?? ''],
            'parent'    => (object)['father_name' => $data['father_name'] ?? ''],
        ];

        // Fake "fee"
        $fee = (object)[
            'name'   => $data['fee_type'],
            'amount' => $data['amount'],
        ];

        // Fake "payments" list
        $payments = [
            (object)[
                'id'           => 'MR-' . strtoupper(uniqid()),
                'payment_date' => $data['payment_date'],
                'payment_mode' => $data['payment_mode'],
                'reference_no' => $data['reference_no'],
                'amount_paid'  => $data['amount'],
            ]
        ];

        $totalPaid = $data['amount'];

        // School details
        $school = School::current();

        return view('manual_receipts.receipt', compact('student', 'fee', 'payments', 'totalPaid', 'school'));
    }
}
