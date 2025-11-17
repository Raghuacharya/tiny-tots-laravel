<?php

namespace App\Http\Controllers;

use App\Models\ParentModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ParentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $parents = ParentModel::all();
            return DataTables::of($parents)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return '<small class="text-muted">Father:</small> ' . $row->father_name . '<br>' .
                        '<small class="text-muted">Mother:</small> ' . $row->mother_name;
                })
                ->editColumn('email', function ($row) {
                    return '<small class="text-muted">Father:</small> ' . $row->father_email . '<br>' .
                        '<small class="text-muted">Mother:</small> ' . $row->mother_email;
                })
                ->editColumn('contact_number', function ($row) {
                    return '<small class="text-muted">Father:</small> ' . $row->father_contact_no . '<br>' .
                        '<small class="text-muted">Mother:</small> ' . $row->mother_contact_no;
                })

                ->addColumn('actions', function ($parent) {
                    return view('parents.partials.actions', compact('parent'))->render();
                })
                ->rawColumns(['name', 'email', 'contact_number', 'actions'])
                ->make(true);
        }
        return view('parents.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('parents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'father_name' => 'required|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'father_place_of_work' => 'nullable|string|max:255',
            'father_office_address' => 'nullable|string',
            'father_email' => 'nullable|email|max:255',
            'father_contact_no' => 'nullable|string|max:20',

            'mother_name' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'mother_place_of_work' => 'nullable|string|max:255',
            'mother_office_address' => 'nullable|string',
            'mother_email' => 'nullable|email|max:255',
            'mother_contact_no' => 'nullable|string|max:20',

            'residential_address' => 'nullable|string',
            'residential_contact' => 'nullable|string|max:20',

            'guardian_name' => 'nullable|string|max:255',
            'guardian_relationship' => 'nullable|string|max:100',
            'guardian_contact' => 'nullable|string|max:20',

            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_address' => 'nullable|string',

            // Photo validations
            'father_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=150,min_height=150,max_width=1000,max_height=1000',
            'mother_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=150,min_height=150,max_width=1000,max_height=1000',
        ]);

        $data = $request->except(['father_photo', 'mother_photo']);

        // Handle Father Photo
        if ($request->hasFile('father_photo')) {
            $data['father_photo'] = $request->file('father_photo')->store('parents/fathers', 'public');
        }

        // Handle Mother Photo
        if ($request->hasFile('mother_photo')) {
            $data['mother_photo'] = $request->file('mother_photo')->store('parents/mothers', 'public');
        }

        ParentModel::create($data);

        return redirect()->route('admin.parents.index')->with('success', 'Parent details added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parent = ParentModel::findOrFail($id);
        return view('parents.show', compact('parent'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $parent = ParentModel::findOrFail($id);
        return view('parents.edit', compact('parent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parent = ParentModel::findOrFail($id);

        $request->validate([
            // Father
            'father_name' => 'required|string|max:255',
            'father_occupation' => 'nullable|string|max:255',
            'father_place_of_work' => 'nullable|string|max:255',
            'father_office_address' => 'nullable|string',
            'father_email' => 'nullable|email|max:255',
            'father_contact_no' => 'nullable|string|max:20',
            'father_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=200,min_height=200,max_width=1000,max_height=1000',

            // Mother
            'mother_name' => 'nullable|string|max:255',
            'mother_occupation' => 'nullable|string|max:255',
            'mother_place_of_work' => 'nullable|string|max:255',
            'mother_office_address' => 'nullable|string',
            'mother_email' => 'nullable|email|max:255',
            'mother_contact_no' => 'nullable|string|max:20',
            'mother_photo' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048|dimensions:min_width=200,min_height=200,max_width=1000,max_height=1000',

            // Residential
            'residential_address' => 'nullable|string',
            'residential_contact' => 'nullable|string|max:20',

            // Guardian
            'guardian_name' => 'nullable|string|max:255',
            'guardian_relationship' => 'nullable|string|max:100',
            'guardian_contact' => 'nullable|string|max:20',

            // Emergency
            'emergency_contact_name' => 'nullable|string|max:255',
            'emergency_contact_relationship' => 'nullable|string|max:100',
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_address' => 'nullable|string',
        ]);

        $data = $request->except(['father_photo', 'mother_photo']);

        // Handle Father Photo
        if ($request->hasFile('father_photo')) {
            if ($parent->father_photo && \Storage::disk('public')->exists($parent->father_photo)) {
                \Storage::disk('public')->delete($parent->father_photo);
            }
            $data['father_photo'] = $request->file('father_photo')->store('parents/fathers', 'public');
        }

        // Handle Mother Photo
        if ($request->hasFile('mother_photo')) {
            if ($parent->mother_photo && \Storage::disk('public')->exists($parent->mother_photo)) {
                \Storage::disk('public')->delete($parent->mother_photo);
            }
            $data['mother_photo'] = $request->file('mother_photo')->store('parents/mothers', 'public');
        }

        $parent->update($data);

        return redirect()->back()->with('success', 'Parent updated successfully.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
