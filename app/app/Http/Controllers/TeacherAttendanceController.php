<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\TeacherAttendance;
use App\Models\AcademicYear;
use Illuminate\Http\Request;

class TeacherAttendanceController extends Controller
{
    // Show attendance form for a specific date
    public function index(Request $request)
    {
        $date = $request->get('date', now()->format('Y-m-d'));
        $academicYearId = AcademicYear::activeId(); // Or your logic to get active year

        $teachers = Teacher::orderBy('first_name')->get();
        $absentAttendance = TeacherAttendance::where('date', $date)
            ->where('academic_year_id', $academicYearId)
            ->get()->keyBy('teacher_id');

        return view('attendance.teachers.index', compact('date', 'teachers', 'absentAttendance'));
    }

    // Store attendance (marks absentees/leaves only)
    public function store(Request $request)
    {
        $date = $request->input('date');
        $attendances = $request->input('attendance', []);

        foreach ($attendances as $teacherId => $details) {
            // Only store attendance if status is not empty (i.e., Absent or Leave)
            if (!empty($details['status'])) {
                TeacherAttendance::updateOrCreate(
                    [
                        'teacher_id' => $teacherId,
                        'date' => $date,
                        'academic_year_id' => AcademicYear::activeId(),
                    ],
                    [
                        'status' => $details['status'],
                        'remarks' => $details['remarks'] ?? null
                    ]
                );
            } else {
                // If the status is present or blank, delete any absentee record for this teacher on current date+year
                TeacherAttendance::where('teacher_id', $teacherId)
                    ->where('date', $date)
                    ->where('academic_year_id', AcademicYear::activeId())
                    ->delete();
            }
        }

        return redirect()->route('admin.attendance.teachers.index', ['date' => $date])
        ->with('success', 'Attendance updated successfully.');
    }
}
