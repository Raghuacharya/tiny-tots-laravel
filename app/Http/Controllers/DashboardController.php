<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;
use App\Models\AcademicYear;
use App\Models\Fee;
use App\Models\ParentModel;
use App\Models\Payment;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Student;
use App\Models\StudentEnrolment;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display the admin dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $totalStudents = Student::count();
        $totalParents = ParentModel::count();
        $totalClasses = SchoolClass::count();
        $totalSections = Section::count();
        $academicYear = AcademicYear::where('is_active', true)->first();

        // Get student count per class
        $classStudentCounts = StudentEnrolment::join(
            'sections',
            'student_enrolments.section_id',
            '=',
            'sections.id'
        )
            ->where('student_enrolments.academic_year_id', $academicYear->id)
            ->where('student_enrolments.status', 'active')
            ->select(
                'sections.class_id',
                DB::raw('COUNT(*) as student_count')
            )
            ->groupBy('sections.class_id')
            ->pluck('student_count', 'sections.class_id');

        // Get all fees grouped by class
        $feesByClass = Fee::select('class_id', DB::raw('SUM(amount) as total_fee'))
            ->groupBy('class_id')
            ->pluck('total_fee', 'class_id');

        // Calculate total expected fees
        $totalExpected = 0;
        foreach ($feesByClass as $classId => $classFee) {
            $studentsInClass = $classStudentCounts[$classId] ?? 0; // 0 if no students
            $totalExpected += $classFee * $studentsInClass;
        }

        // Fees summary
        $totalFees = $totalExpected;
        $totalCollected = Payment::sum('amount_paid');

        // Recent
        $recentStudents = Student::latest()->take(5)->get();
        $recentPayments = Payment::latest()->with(['student', 'fee'])->take(5)->get();

        // Birthdays
        $upcomingBirthdays = Student::whereMonth('date_of_birth', now()->month)
            ->whereDay('date_of_birth', '>=', now()->day)
            ->orderByRaw('DAY(date_of_birth)')
            ->take(5)
            ->get();

        $school = School::first();

        $error = null;
        $type = null;

        if (!$school || !$school->name || !$school->address || !$school->contact_email) {
            $error = 'Please set up your school profile first. <a href="' . route('admin.school.edit') . '">Click here to set up</a>';
            $type = 'error';
        } elseif (!$academicYear) {
            $error = 'Please set up an active academic year first. <a href="' . route('admin.academic-years.create') . '">Click here to set up</a>';
            $type = 'error';
        }

        return view('dashboard.index', compact(
            'error',
            'type',
            'totalStudents',
            'totalParents',
            'totalClasses',
            'totalSections',
            'totalFees',
            'totalCollected',
            'recentStudents',
            'recentPayments',
            'upcomingBirthdays'
        ));
    }
}
