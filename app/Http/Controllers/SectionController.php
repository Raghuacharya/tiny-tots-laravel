<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SchoolClass;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;
use App\Models\AcademicYear;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $academicYearId = AcademicYear::activeId();

            $sections = Section::where('academic_year_id', $academicYearId)->with('class', 'teacher')->latest()->get();
            return DataTables::of($sections)
                ->addIndexColumn()
                ->editColumn('class', function ($row) {
                    return $row->class->name ?? '-';
                })
                ->editColumn('teacher', function ($row) {
                    return $row->teacher ? ($row->teacher->first_name . ' ' . $row->teacher->last_name) : '-';
                })
                ->addColumn('actions', function ($section) {
                    return view('sections.partials.actions', compact('section'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('sections.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        $teachers = Teacher::all();
        return view('sections.create', compact('classes', 'teachers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $academicYearId = AcademicYear::activeId();
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);
        $request->merge(['academic_year_id' => $academicYearId]);
        Section::create($request->all());

        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $academicYearId = AcademicYear::activeId();
        $section = Section::where('academic_year_id', $academicYearId)->with('class', 'teacher')->findOrFail($id);
        return view('sections.show', compact('section'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $section = Section::findOrFail($id);
        $classes = SchoolClass::all();
        $teachers = Teacher::all();
        return view('sections.edit', compact('section', 'classes', 'teachers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $section = Section::findOrFail($id);

        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'teacher_id' => 'nullable|exists:teachers,id',
        ]);

        $section->update($request->all());

        return redirect()->back()->with('success', 'Section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $section = Section::findOrFail($id);
        $section->delete();

        return redirect()->back()->with('success', 'Section deleted successfully.');
    }
}
