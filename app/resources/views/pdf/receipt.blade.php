@component('mail::message')
<img src="{{ asset('storage/' . getSchoolProfile()->logo) }}" alt="{{ getSchoolProfile()->name }}" width="120px"><br><br>

# Payment Receipt

**Student:** {{ $student->full_name }}
**Class:** {{ $student->class->name }} - {{ $student->section->name ?? '' }}
**Parent:** {{ $student->parent->father_name }}
**Date:** {{ now()->format('d-m-Y') }}

---

| Fee Type | Date | Mode | Reference | Amount |
|----------|------|------|-----------|--------|
@foreach($payments as $payment)
| {{ $payment->fee->name }} | {{ \Carbon\Carbon::parse($payment->payment_date)->format('d-m-Y') }} | {{ ucfirst($payment->payment_mode) }} | {{ $payment->reference_no ?? '-' }} | ₹{{ number_format($payment->amount_paid, 2) }} |
@endforeach

**Total Paid: ₹{{ number_format($totalPaid, 2) }}**

---

Thanks,
{{ $school->name }}
@endcomponent
