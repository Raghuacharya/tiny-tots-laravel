<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $sections = Section::with('class')->latest()->get();
            return DataTables::of($sections)
                ->addIndexColumn()
                ->editColumn('class', function ($row) {
                    return $row->class->name ?? '-';
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
        return view('sections.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'teacher' => 'nullable|string|max:255',
        ]);

        Section::create($request->all());

        return redirect()->route('admin.sections.index')->with('success', 'Section created successfully.');
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
        $section = Section::findOrFail($id);
        $classes = SchoolClass::all();
        return view('sections.edit', compact('section', 'classes'));
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
            'teacher' => 'nullable|string|max:255',
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
