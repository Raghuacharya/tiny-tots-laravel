<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function edit()
    {
        $school = School::first(); // assuming only one school
        return view('settings.school_profile', compact('school'));
    }

    public function update(Request $request)
    {
        $school = School::first();

        // Handle logo upload separately
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('logos', 'public');
            $requestData = $request->except('logo');
            $requestData['logo'] = $path;
        } else {
            $requestData = $request->except('logo');
        }

        if (!$school) {
            $school = School::create($requestData);
        } else {
            $school->update($requestData);
        }

        return redirect()->back()->with('success', 'School profile updated!');
    }
}
