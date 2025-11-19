<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $teachers = Teacher::select(['id', 'first_name', 'last_name', 'email', 'phone_number', 'status']);

            return datatables()->of($teachers)
                ->addIndexColumn()
                ->addColumn('full_name', function (Teacher $teacher) {
                    return $teacher->first_name . ' ' . $teacher->last_name;
                })
                ->addColumn('phone', function (Teacher $teacher) {
                    return $teacher->phone_number;
                })
                ->addColumn('actions', function (Teacher $teacher) {
                    return view('teachers.partials.actions', compact('teacher'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('teachers.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('teachers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validation rules
        $validatedData = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|unique:teachers,email',
            'phone_number'   => 'required|string|max:15',
            'date_of_birth'  => 'nullable|date',
            'gender'         => 'nullable|in:Male,Female,Other',
            'address'        => 'nullable|string',
            'qualification'  => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'date_joined'    => 'nullable|date',
            'status'         => 'required|in:Active,Inactive',
            'aadhaar_number' => 'required|string|size:12|unique:teachers,aadhaar_number',
            'pan_number'     => 'required|string|size:10|unique:teachers,pan_number',
        ]);

        // Create the teacher
        Teacher::create($validatedData);

        // Redirect with success message
        return redirect()->route('admin.teachers.index')->with('success', 'Teacher created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.show', compact('teacher'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        // Validation rules with unique fields excluding the current record
        $validatedData = $request->validate([
            'first_name'     => 'required|string|max:255',
            'last_name'      => 'required|string|max:255',
            'email'          => 'required|email|unique:teachers,email,' . $teacher->id,
            'phone_number'   => 'required|string|max:15',
            'date_of_birth'  => 'nullable|date',
            'gender'         => 'nullable|in:Male,Female,Other',
            'address'        => 'nullable|string',
            'qualification'  => 'nullable|string|max:255',
            'specialization' => 'nullable|string|max:255',
            'date_joined'    => 'nullable|date',
            'status'         => 'required|in:Active,Inactive',
            'aadhaar_number' => 'required|string|size:12|unique:teachers,aadhaar_number,' . $teacher->id,
            'pan_number'     => 'required|string|size:10|unique:teachers,pan_number,' . $teacher->id,
        ]);

        // Update teacher data
        $teacher->update($validatedData);

        return redirect()->route('admin.teachers.edit', $teacher->id)->with('success', 'Teacher details updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $deleted = Teacher::destroy($id);
        if ($deleted) {
            return redirect()->route('admin.teachers.index')->with('success', 'Teacher deleted successfully.');
        } else {
            return redirect()->route('admin.teachers.index')->with('error', 'Failed to delete teacher.');
        }
    }
}
