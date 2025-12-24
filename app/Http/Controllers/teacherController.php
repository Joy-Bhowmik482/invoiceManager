<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Teacher;


class TeacherController extends Controller
{
    /**
     * Store a newly created teacher.
     */
    public function teacher(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = Storage::disk('public')->putFile('teacher', $request->file('photo'));
            $data['photo'] = $photoPath;
        }

        // Generate a default password
        $data['password'] = bcrypt('password123');

        // Create the teacher
        Teacher::create($data);

        return redirect()->route('teacherList')->with('success', 'Teacher added successfully.');
    }

    /**
     * Display a list of all teachers.
     */
    public function teacherList()
    {
        $teachers = Teacher::all();
        return view('teacherList', ['teachers' => $teachers]);
    }

    /**
     * Show the form for editing a teacher.
     */
    public function edit($id)
    {
        $teacher = Teacher::findOrFail($id);
        return view('editTeacher', ['teacher' => $teacher]);
    }

    /**
     * Update the teacher in the database.
     */
    public function update(Request $request, $id)
    {
        $teacher = Teacher::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $id,
            'phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
                Storage::disk('public')->delete($teacher->photo);
            }
            $photoPath = Storage::disk('public')->putFile('teacher', $request->file('photo'));
            $data['photo'] = $photoPath;
        }

        $teacher->update($data);

        return redirect()->route('teacherList')->with('success', 'Teacher updated successfully.');
    }

    /**
     * Delete a teacher from the database.
     */
    public function destroy($id)
    {
        $teacher = Teacher::findOrFail($id);

        if ($teacher->photo && Storage::disk('public')->exists($teacher->photo)) {
            Storage::disk('public')->delete($teacher->photo);
        }

        $teacher->delete();

        return redirect()->route('teacherList')->with('success', 'Teacher deleted successfully.');
    }

    public function teacherView()
    {
        return view('addTeacher');
    }
}
