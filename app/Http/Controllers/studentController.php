<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Student;


class StudentController extends Controller
{
    /**
     * Store a newly created student member.
     */
    public function student(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email',
            'phone' => 'nullable|string|max:50',
            'class' => 'nullable|string|max:100',
            'roll_number' => 'nullable|string|max:100',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = Storage::disk('public')->putFile('students', $request->file('photo'));
            $data['photo'] = $photoPath;
        }

        // Generate a random password
        $data['password'] = bcrypt('password123');

        // Create the student
        Student::create($data);
        return redirect()->route('studentList')->with('success', 'Student member added successfully.');
    }

    /**
     * Display a list of all student members.
     */
    public function studentList()
    {
        $studentMembers = Student::all();
        return view('studentList', ['studentMembers' => $studentMembers]);
    }

    /**
     * Show the form for editing a student member.
     */
    public function edit($id)
    {
        $student = Student::findOrFail($id);
        return view('editStudent', ['student' => $student]);
    }

    /**
     * Update the student member in the database.
     */
    public function update(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email,' . $id,
            'phone' => 'nullable|string|max:50',
            'class' => 'nullable|string|max:100',
            'roll_number' => 'nullable|string|max:100',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($student->photo && Storage::disk('public')->exists($student->photo)) {
                Storage::disk('public')->delete($student->photo);
            }
            $photoPath = Storage::disk('public')->putFile('students', $request->file('photo'));
            $data['photo'] = $photoPath;
        }

        $student->update($data);                                                                                                      

        return redirect()->route('studentList')->with('success', 'Student member updated successfully.');
    }

    /**
     * Delete a student member from the database.
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        // Delete photo if exists
        if ($student->photo && Storage::disk('public')->exists($student->photo)) {
            Storage::disk('public')->delete($student->photo);
        }

        $student->delete();

        return redirect()->route('studentList')->with('success', 'Student member deleted successfully.');
    }
     public function studentView()
     
    {
        return view('addStudent');
    }
}
