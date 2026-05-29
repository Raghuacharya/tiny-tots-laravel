<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use App\Models\Student;
use App\Models\ParentModel;
use App\Models\School;
use App\Models\SchoolClass;
use App\Models\Section;
use App\Models\Sibling;
use App\Models\StudentEnrolment;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class StudentController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $students = Student::with([
                'parent',
                'currentEnrolment.section.class',
            ])
                ->latest()
                ->get();

            return DataTables::of($students)
                ->addIndexColumn()
                ->editColumn('parent', function ($student) {
                    return $student->parent ? $student->parent->display_name : 'N/A';
                })
                ->addColumn('class_section', function ($student) {
                    $enrolment = $student->currentEnrolment;
                    if (! $enrolment || ! $enrolment->section) {
                        return 'N/A';
                    }

                    $class = $enrolment->section->class->name ?? '';
                    $section = $enrolment->section->name ?? '';
                    return trim($class . ' - ' . $section) ?: 'N/A';
                })
                ->editColumn('date_of_birth', function ($student) {
                    return $student->date_of_birth
                        ? $student->date_of_birth->format('d M Y')
                        : 'N/A';
                })
                ->editColumn('status', function ($student) {
                    $statusColors = [
                        'active'     => 'success',
                        'inactive'   => 'secondary',
                        'graduated'  => 'primary',
                        'withdrawn'  => 'danger',
                    ];
                    $color = $statusColors[$student->status] ?? 'secondary';

                    return '<span class="badge badge-' . $color . '">' . ucfirst($student->status) . '</span>';
                })
                ->addColumn('actions', function ($student) {
                    return view('students.partials.actions', compact('student'))->render();
                })
                ->rawColumns(['status', 'actions'])
                ->make(true);
        }

        return view('students.index');
    }


    public function create()
    {
        $classes = SchoolClass::all();
        return view('students.create', compact('classes'));
    }

    public function searchParents(Request $request)
    {
        $search = $request->get('q', '');

        $parents = ParentModel::query()
            ->where('father_name', 'like', "%{$search}%")
            ->orWhere('mother_name', 'like', "%{$search}%")
            ->select('id', 'father_name', 'mother_name')
            ->orderBy('father_name')
            ->limit(20)
            ->get();

        return response()->json($parents->map(function ($parent) {
            return [
                'id' => $parent->id,
                'text' => "{$parent->father_name} / {$parent->mother_name}"
            ];
        }));
    }

    public function getParentDetailsWithSiblings($id)
    {
        $parent = ParentModel::findOrFail($id);

        $defaultFather = asset('images/defaults/male-avatar-thumb.png');
        $defaultMother = asset('images/defaults/female-avatar-thumb.png');

        $currentSchool = School::current();

        $studentSiblings = $parent->students()
            ->with('class')
            ->get()
            ->map(function ($student) use ($currentSchool) {
                return [
                    'name'   => $student->full_name,
                    'gender' => $student->gender,
                    'age'    => $student->age_years,
                    'class'  => $student->class ? $student->class->name : null,
                    'school' => $currentSchool ? $currentSchool->name : null,
                    'student_id' => $student->id,
                ];
            });

        $externalSiblings = Sibling::where('parent_id', $parent->id)
            ->get()
            ->map(function ($sibling) {
                return [
                    'name'   => $sibling->name,
                    'gender' => $sibling->gender,
                    'age'    => $sibling->age,
                    'class'  => $sibling->class,
                    'school' => $sibling->school,
                    'student_id' => null,
                ];
            });

        // Merge both
        $siblings = $studentSiblings->merge($externalSiblings);

        return response()->json([
            'father_name' => $parent->father_name,
            'father_contact_no' => $parent->father_contact_no,
            'father_photo' => $parent->father_photo && file_exists(public_path('storage/' . $parent->father_photo))
                ? asset('storage/' . $parent->father_photo)
                : $defaultFather,
            'mother_name' => $parent->mother_name,
            'mother_contact_no' => $parent->mother_contact_no,
            'mother_photo' => $parent->mother_photo && file_exists(public_path('storage/' . $parent->mother_photo))
                ? asset('storage/' . $parent->mother_photo)
                : $defaultMother,
            'residential_address' => $parent->residential_address,
            'siblings' => $siblings->values()
        ]);
    }



    public function store(Request $request)
    {
        $academicYearId = AcademicYear::activeId();
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:male,female',
            'place_of_birth' => 'nullable|string|max:255',
            'nationality' => 'nullable|string|max:255',
            'mother_tongue' => 'nullable|string|max:255',
            'blood_group' => 'nullable|string|max:10',

            'allergies' => 'nullable|string',
            'surgeries' => 'nullable|string',
            'chronic_illness' => 'nullable|string',
            'immunization_complete' => 'boolean',
            'medical_notes' => 'nullable|string',

            'parent_id' => 'required|exists:parents,id',
            'class_id' => 'required|exists:classes,id',
            'section_id' => 'required|exists:sections,id',

            'attended_school_previously' => 'boolean',
            'previous_school_name' => 'nullable|string|max:255',
            'previous_school_duration' => 'nullable|string|max:255',
            'previous_class_attended' => 'nullable|string|max:255',

            'child_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',

            'admission_date' => 'required|date',
            'status' => 'nullable|in:active,inactive,graduated,withdrawn',

            'birth_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'immunization_record' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'transfer_certificate' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'progress_report' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'passport' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'medical_report' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // Generate Custom Student ID (e.g., LHB001, LHB002)
        $latestStudent = Student::latest()->first();
        $nextId = $latestStudent ? ((int) substr($latestStudent->student_id, 3)) + 1 : 1;
        $studentId = 'LHB' . str_pad($nextId, 3, '0', STR_PAD_LEFT);

        // Age Calculation
        $dob = \Carbon\Carbon::parse($validated['date_of_birth']);
        $ageYears = $dob->diffInYears(now());
        $ageMonths = $dob->diffInMonths(now()) % 12;

        // File Uploads
        $uploadFile = function ($field) use ($request) {
            return $request->hasFile($field)
                ? $request->file($field)->store('uploads/students', 'public')
                : null;
        };

        $student = Student::create([
            'student_id' => $studentId,
            'full_name' => $validated['full_name'],
            'date_of_birth' => $validated['date_of_birth'],
            'age_years' => $ageYears,
            'age_months' => $ageMonths,
            'gender' => $validated['gender'],
            'place_of_birth' => $validated['place_of_birth'] ?? null,
            'nationality' => $validated['nationality'] ?? 'Indian',
            'mother_tongue' => $validated['mother_tongue'] ?? null,
            'blood_group' => $validated['blood_group'] ?? null,

            'allergies' => $validated['allergies'] ?? null,
            'surgeries' => $validated['surgeries'] ?? null,
            'chronic_illness' => $validated['chronic_illness'] ?? null,
            'immunization_complete' => $validated['immunization_complete'] ?? false,
            'medical_notes' => $validated['medical_notes'] ?? null,

            'parent_id' => $validated['parent_id'],

            'attended_school_previously' => $validated['attended_school_previously'] ?? false,
            'previous_school_name' => $validated['previous_school_name'] ?? null,
            'previous_school_duration' => $validated['previous_school_duration'] ?? null,
            'previous_class_attended' => $validated['previous_class_attended'] ?? null,

            'child_photo' => $uploadFile('child_photo'),
            'admission_date' => $validated['admission_date'],
            'status' => $validated['status'] ?? 'active',

            'birth_certificate' => $uploadFile('birth_certificate'),
            'immunization_record' => $uploadFile('immunization_record'),
            'transfer_certificate' => $uploadFile('transfer_certificate'),
            'progress_report' => $uploadFile('progress_report'),
            'passport' => $uploadFile('passport'),
            'medical_report' => $uploadFile('medical_report'),
        ]);

        // Create Student Enrolment for this academic year + class/section
        $section = Section::find($validated['section_id']);

        // Auto-generate next roll number for this section
        $nextRollNo = StudentEnrolment::where('section_id', $section->id)
            ->max('roll_no') ?
            (int) StudentEnrolment::where('section_id', $section->id)->max('roll_no') + 1 :
            1;

        StudentEnrolment::create([
            'student_id' => $student->id,
            'academic_year_id' => $academicYearId,
            'section_id' => $section->id,
            'enrolment_date' => $validated['admission_date'],
            'status' => 'active',
            'roll_no' => $nextRollNo,
        ]);

        foreach ($request->sibling_student_id as $key => $ss_id) {
            if ($ss_id == null || $ss_id == '') {
                if ($request->sibling_name[$key] && $request->sibling_gender[$key] && $request->sibling_age[$key] && $request->sibling_class[$key] && $request->sibling_school[$key]) {
                    Sibling::create([
                        'parent_id' => $validated['parent_id'],
                        'name' => $request->sibling_name[$key],
                        'gender' => $request->sibling_gender[$key],
                        'age' => $request->sibling_age[$key],
                        'class' => $request->sibling_class[$key],
                        'school' => $request->sibling_school[$key]
                    ]);
                }
            }
        }

        return redirect()->route('admin.students.index')->with('success', 'Student created successfully!');
    }

    public function show($id)
    {
        $student = Student::with('parent', 'class', 'section')->findOrFail($id);
        return view('students.show', compact('student'));
    }

    public function edit(Student $student)
    {
        // Get current enrolment for display (most recent active, or first enrolment)
        $currentEnrolment = $student->enrolments()
            ->with(['academicYear', 'section.class', 'section'])
            ->where('status', 'active')
            ->orWhereNull('status')  // Legacy enrolments
            ->first();

        $classes = SchoolClass::all();
        $sections = [];

        return view('students.edit', compact(
            'student',
            'currentEnrolment',
            'classes',
            'sections'
        ));
    }

}
