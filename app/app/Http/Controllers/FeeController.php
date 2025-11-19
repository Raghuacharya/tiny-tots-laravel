<?php

namespace App\Http\Controllers;

use App\Models\Fee;
use App\Models\SchoolClass;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class FeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (request()->ajax()) {
            $fee = Fee::with('class')->latest()->get();
            return DataTables::of($fee)
                ->addIndexColumn()
                ->editColumn('class', function ($fee) {
                    return $fee->class ? $fee->class->name : 'N/A';
                })
                ->addColumn('actions', function ($fee) {
                    return view('fees.partials.actions', compact('fee'))->render();
                })
                ->rawColumns(['actions'])
                ->make(true);
        }
        return view('fees.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $classes = SchoolClass::all();
        return view('fees.create', compact('classes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required',
            'term' => 'nullable|numeric|min:1',
            'description' => 'nullable|string',
        ]);

        Fee::create($request->all());

        return redirect()->route('admin.fees.index')->with('success', 'Fee added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fee = Fee::with('class')->findOrFail($id);
        return view('fees.show', compact('fee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $fee = Fee::findOrFail($id);
        $classes = SchoolClass::all();
        return view('fees.edit', compact('fee', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $fee = Fee::findOrFail($id);
        $request->validate([
            'class_id' => 'required|exists:classes,id',
            'name' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'frequency' => 'required',
            'term' => 'nullable|numeric|min:1',
            'description' => 'nullable|string',
        ]);
        $fee->update($request->all());
        return redirect()->back()->with('success', 'Fee updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fee = Fee::findOrFail($id);
        $fee->delete();
        return redirect()->back()->with('success', 'Fee deleted successfully.');
    }
}
