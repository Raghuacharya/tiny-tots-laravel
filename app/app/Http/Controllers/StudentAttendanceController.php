<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\StudentAttendance;
use App\Models\AcademicYear;
use App\Models\SchoolClass;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentAttendanceController extends Controller
{
    // Show attendance form for a specific date
    public function index(Request $request)
    {
        $selectedClassId = $request->get('class_id');
        $selectedSectionId = $request->get('section_id');
        $date = $request->get('date', now()->format('Y-m-d'));
        $academicYearId = AcademicYear::activeId();

        // Classes for dropdown
        $classes = SchoolClass::all();

        // Get sections if class is selected
        $sections = [];
        if ($selectedClassId) {
            $sections = Section::where('class_id', $selectedClassId)->get();
        }

        // Get students if both class and section are selected
        $students = [];
        if ($selectedClassId && $selectedSectionId) {
            $students = Student::where('class_id', $selectedClassId)
                ->where('section_id', $selectedSectionId)
                ->get();
        }

        // Get absentees for selected date, class, section, year
        $absentAttendance = [];
        if ($students) {
            $studentIds = $students->pluck('id');
            $absentAttendance = StudentAttendance::whereIn('student_id', $studentIds)
                ->where('date', $date)
                ->where('academic_year_id', $academicYearId)
                ->get()->keyBy('student_id');
        }

        return view('attendance.students.index', compact(
            'classes',
            'sections',
            'students',
            'selectedClassId',
            'selectedSectionId',
            'date',
            'absentAttendance',
            'academicYearId'
        ));
    }

    public function store(Request $request)
    {
        $date = $request->input('date');
        $classId = $request->input('class_id');
        $sectionId = $request->input('section_id');
        $academicYearId = AcademicYear::activeId();
        $attendances = $request->input('attendance', []);

        foreach ($attendances as $studentId => $details) {
            if (!empty($details['status'])) {
                StudentAttendance::updateOrCreate(
                    [
                        'student_id' => $studentId,
                        'date' => $date,
                        'academic_year_id' => $academicYearId,
                    ],
                    [
                        'status' => $details['status'],
                        'remarks' => $details['remarks'] ?? null,
                        'class_id' => $classId,
                        'section_id' => $sectionId,
                    ]
                );
            } else {
                StudentAttendance::where('student_id', $studentId)
                    ->where('date', $date)
                    ->where('academic_year_id', $academicYearId)
                    ->delete();
            }
        }

        // Preserve filter state after submission
        return redirect()->route('admin.attendance.students.index', [
            'class_id' => $classId,
            'section_id' => $sectionId,
            'date' => $date
        ])->with('success', 'Attendance saved successfully.');
    }
}
