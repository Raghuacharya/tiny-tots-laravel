<?php

namespace App\Http\Controllers;

use App\Models\SchoolClass;
use App\Models\AcademicYear;
use App\Models\Section;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SchoolClassController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $classes = SchoolClass::latest()->get();
            return DataTables::of($classes)
                ->addIndexColumn()
                ->addColumn('actions', function ($class) {
                    return view('classes.partials.actions', compact('class'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('classes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $academicYears = AcademicYear::all();
        return view('classes.create', compact('academicYears'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
        ]);

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        SchoolClass::create([
            'name'             => $request->name,
            'code'             => $request->code,
            'academic_year_id' => $activeYear->id,
        ]);

        return redirect()->route('admin.classes.index')->with('success', 'Class created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        $academicYears = AcademicYear::all();
        return view('classes.edit', compact('class', 'academicYears'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $class = SchoolClass::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'nullable|string|max:50',
        ]);

        $activeYear = AcademicYear::where('is_active', true)->firstOrFail();

        $class->update([
            'name'             => $request->name,
            'code'             => $request->code,
            'academic_year_id' => $activeYear->id,
        ]);

        return redirect()->back()->with('success', 'Class updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $class = SchoolClass::findOrFail($id);
        $class->delete();

        return redirect()->back()->with('success', 'Class deleted successfully.');
    }

    public function getSections(string $id)
    {
        $academicYearId = AcademicYear::activeId();
        $sections = Section::where('class_id', $id)->where('academic_year_id', $academicYearId)->get(['id', 'name']);
        return response()->json($sections);
    }
}
