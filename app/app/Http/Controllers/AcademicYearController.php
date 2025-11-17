<?php

namespace App\Http\Controllers;

use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class AcademicYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $academicYears = AcademicYear::latest()->get();
            return DataTables::of($academicYears)
                ->addIndexColumn()
                ->editColumn('start_date', function ($academicYear) {
                    return date('d-m-Y', strtotime($academicYear->start_date));
                })
                ->editColumn('end_date', function ($academicYear) {
                    return date('d-m-Y', strtotime($academicYear->end_date));
                })
                ->editColumn('status', function ($academicYear) {
                    return $academicYear->is_active ? 'Yes' : 'No';
                })
                ->addColumn('actions', function ($academicYear) {
                    return view('academic_years.partials.actions', compact('academicYear'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('academic_years.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('academic_years.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:academic_years,name',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        if ($request->is_active) {
            AcademicYear::where('is_active', true)->update(['is_active' => false]);
        }

        AcademicYear::create($request->all());

        return redirect()->back()->with('success', 'Academic Year added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);
        return view('academic_years.edit', compact('academicYear'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        $request->validate([
            'name' => 'required|unique:academic_years,name,' . $academicYear->id,
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date'
        ]);

        if ($academicYear->is_active && !$request->is_active) {
            return redirect()->back()->withErrors(['is_active' => 'Cannot deactivate the currently active academic year.']);
        }

        if ($request->is_active) {
            AcademicYear::where('id', '!=', $academicYear->id)->update(['is_active' => false]);
        }

        $academicYear->update($request->all());

        return redirect()->back()->with('success', 'Academic Year updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $academicYear = AcademicYear::findOrFail($id);

        // Prevent deleting the currently active academic year
        if ($academicYear->is_active) {
            return redirect()->back()->withErrors(['error' => 'You cannot delete the currently active academic year.']);
        }

        $academicYear->delete();

        return redirect()->back()->with('success', 'Academic Year deleted successfully.');
    }
}
