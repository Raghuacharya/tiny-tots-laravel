<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Barryvdh\DomPDF\Facade\Pdf;

class ReceiptMail extends Mailable
{
    use Queueable, SerializesModels;

    public $student, $payments, $school, $totalPaid;

    /**
     * Create a new message instance.
     */
    public function __construct($student, $payments, $school, $totalPaid)
    {
        $this->student   = $student;
        $this->payments  = $payments;
        $this->school    = $school;
        $this->totalPaid = $totalPaid;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        // Generate PDF from a Blade view
        $pdf = Pdf::loadView('emails.receipt-pdf', [
            'student'   => $this->student,
            'payments'  => $this->payments,
            'school'    => $this->school,
            'totalPaid' => $this->totalPaid,
        ]);

        return $this->subject('Payment Receipt - ' . $this->student->full_name)
            ->view('emails.receipt') // HTML email view
            ->with([
                'student'   => $this->student,
                'payments'  => $this->payments,
                'school'    => $this->school,
                'totalPaid' => $this->totalPaid,
            ])
            ->attachData(
                $pdf->output(),
                'receipt_' . $this->student->student_id . '.pdf',
                ['mime' => 'application/pdf']
            );
    }
}
