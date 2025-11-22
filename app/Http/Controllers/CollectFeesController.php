<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\Payment;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReceiptMail;

class CollectFeesController extends Controller
{
    public function index()
    {
        $classes = SchoolClass::all();
        return view('collect_fees.index', compact('classes'));
    }

    public function getStudents(Request $request)
    {
        if ($request->filled('admission_no')) {
            $students = Student::with('class', 'section', 'parent')->where('student_id', $request->admission_no)->get();
        } else {
            $students = Student::with('class', 'section', 'parent')
                ->where('class_id', $request->class_id)
                ->where('section_id', $request->section_id)
                ->get();
        }

        $data = $students->map(function ($student) {
            return [
                'class' => $student->class->name ?? '',
                'section' => $student->section->name ?? '',
                'admission_no' => $student->student_id,
                'student_name' => $student->full_name,
                'father_name' => $student->parent->father_name ?? '',
                'dob' => $student->date_of_birth->format('d-m-Y'),
                'actions' => '<a href="' . route('admin.collect-fees.show', $student->id) . '" class="btn btn-xs btn-secondary">Collect Fees</a>',
            ];
        });

        return response()->json(['data' => $data]);
    }

    public function show($studentId)
    {
        $student = Student::with('class')->findOrFail($studentId);

        // Get all fees for this student's class
        $fees = Fee::where('class_id', $student->class_id)->get();

        // Attach payment info
        $feesWithPayments = $fees->map(function ($fee) use ($student) {
            $payments = \App\Models\Payment::where('student_id', $student->id)
                ->where('fee_id', $fee->id)
                ->get();

            $paidAmount = $payments->sum('amount_paid');
            $balance = $fee->amount - $paidAmount;

            return [
                'fee' => $fee,
                'status' => $paidAmount >= $fee->amount ? 'Paid' : ($paidAmount > 0 ? 'Partial' : 'Unpaid'),
                'paidAmount' => $paidAmount,
                'balance' => $balance,
                'payments' => $payments,
            ];
        });

        $totalBalance = $feesWithPayments->sum('balance');

        return view('collect_fees.show', compact('student', 'feesWithPayments', 'totalBalance'));
    }

    public function storePayment(Request $request, $studentId, $feeId)
    {
        $request->validate([
            'amount_paid' => 'required|numeric|min:1',
            'payment_mode' => 'required|in:cash,card,upi,cheque,bank_transfer',
        ]);

        Payment::create([
            'student_id' => $studentId,
            'fee_id' => $feeId,
            'amount_paid' => $request->amount_paid,
            'payment_date' => now(),
            'payment_mode' => $request->payment_mode,
            'reference_no' => $request->reference_no,
            'notes' => $request->notes,
        ]);

        return redirect()->back()->with('success', 'Payment recorded successfully!');
    }

    public function storeBulkPayment(Request $request, $studentId)
    {
        $student = Student::with('class')->findOrFail($studentId);

        // Get all fees for this student’s class
        $fees = Fee::where('class_id', $student->class_id)->get();

        foreach ($fees as $fee) {
            $paid = Payment::where('student_id', $studentId)
                ->where('fee_id', $fee->id)
                ->sum('amount_paid');

            $balance = $fee->amount - $paid;

            if ($balance > 0) {
                Payment::create([
                    'student_id' => $studentId,
                    'fee_id' => $fee->id,
                    'amount_paid' => $balance,
                    'payment_date' => now(),
                    'payment_mode' => $request->payment_mode,
                    'reference_no' => $request->reference_no ?? 'BULK-' . uniqid(),
                    'notes' => $request->notes,
                ]);
            }
        }

        return redirect()->back()->with('success', 'All pending fees collected successfully.');
    }


    public function printReceipt($studentId, $feeId)
    {
        $student = Student::with('class', 'section', 'parent')->findOrFail($studentId);
        $fee = Fee::findOrFail($feeId);

        $payments = Payment::where('student_id', $studentId)
            ->where('fee_id', $feeId)
            ->get();

        $totalPaid = $payments->sum('amount_paid');
        $school = School::current();

        return view('collect_fees.receipt', compact('student', 'fee', 'payments', 'totalPaid', 'school'));
    }

    public function printAllReceipts($studentId)
    {
        $student = Student::with('class', 'section', 'parent')->findOrFail($studentId);

        // Fetch all payments of this student with fee info
        $payments = Payment::with('fee')
            ->where('student_id', $studentId)
            ->get();

        $totalPaid = $payments->sum('amount_paid');
        $school = School::current();

        return view('collect_fees.receipt_all', compact('student', 'payments', 'totalPaid', 'school'));
    }

    public function sendAllReceipts($studentId)
    {
        $student = Student::with('class', 'section', 'parent')->findOrFail($studentId);
        $payments = Payment::with('fee')
            ->where('student_id', $studentId)
            ->get();

        $school = School::current();

        // total paid
        $totalPaid = $payments->sum('amount_paid');

        // parent email
        $email = $student->parent->father_email ?? null;

        if (!$email) {
            return redirect()->back()->with('error', 'Parent email not found.');
        }

        // send email
        Mail::to($email)->send(new ReceiptMail($student, $payments, $school, $totalPaid));

        return redirect()->back()->with('success', 'Receipt sent successfully to parent.');
    }
}
