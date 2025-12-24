<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;


class StaffController extends Controller
{
    /**
     * Store a newly created staff member.
     */
    public function staff(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            $photoPath = Storage::disk('public')->putFile('staff', $request->file('photo'));
            $data['photo'] = $photoPath;
        }

        // Generate a random password
        $data['password'] = bcrypt('password123');

        // Create the user
        User::create($data);

        return redirect()->route('staffList')->with('success', 'Staff member added successfully.');
    }

    /**
     * Display a list of all staff members.
     */
    public function staffList()
    {
        $staffMembers = User::all();
        return view('staffList', ['staffMembers' => $staffMembers]);
    }

    /**
     * Show the form for editing a staff member.
     */
    public function edit($id)
    {
        $staff = User::findOrFail($id);
        return view('editStaff', ['staff' => $staff]);
    }

    /**
     * Update the staff member in the database.
     */
    public function update(Request $request, $id)
    {
        $staff = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'phone' => 'nullable|string|max:50',
            'position' => 'nullable|string|max:100',
            'department' => 'nullable|string|max:100',
            'photo' => 'nullable|file|image|max:2048',
        ]);

        // Handle photo upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($staff->photo && Storage::disk('public')->exists($staff->photo)) {
                Storage::disk('public')->delete($staff->photo);
            }
            $photoPath = Storage::disk('public')->putFile('staff', $request->file('photo'));
            $data['photo'] = $photoPath;
        }

        $staff->update($data);

        return redirect()->route('staffList')->with('success', 'Staff member updated successfully.');
    }

    /**
     * Delete a staff member from the database.
     */
    public function destroy($id)
    {
        $staff = User::findOrFail($id);

        // Delete photo if exists
        if ($staff->photo && Storage::disk('public')->exists($staff->photo)) {
            Storage::disk('public')->delete($staff->photo);
        }

        $staff->delete();

        return redirect()->route('staffList')->with('success', 'Staff member deleted successfully.');
    }
     public function staffView()
    {
        return view('addStaff');
    }
}
