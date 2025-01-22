<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Increment;
use Illuminate\Http\Request;


class IncrementController extends Controller
{
    // Add increment
    public function addIncrement(Request $request)
    {
        // Validate the request
        $request->validate([
            'employee_id' => 'required|exists:users,id',
            'increment' => 'required|numeric|min:1',
        ]);

        // Find the user by id
        $user = User::find($request->employee_id);

        if ($user) {
            // Update the current_salary column in the users table
            $newSalary = $user->current_salary + $request->increment;
            $user->update(['current_salary' => $newSalary]);

            // Create a new increment record
            $increment = Increment::create([
                'user_id' => $request->employee_id,
                'increment' => $request->increment,
            ]);

            return response()->json(['success' => true, 'user_id' => $user->id, 'increment_id' => $increment->id, 'current_salary' => $newSalary]);
        }

        return response()->json(['success' => false, 'error' => 'User not found.']);
    }

    public function list($id){
        $user = User::with('increments')->find($id);

        if ($user) {
            return view('employees.increment-list', compact('user'));
        }

        return redirect()->back()->with('error', 'User not found.');
    }
    public function delete(Request $request){
        $increment = Increment::find($request->id);

        // Check if the increment exists
        if(!$increment) {
            flashy()->error('❌ Increment not found!','#');
            return redirect()->back();
        }

        // Retrieve the user associated with the increment using optional
        $user = optional($increment->user);

        // Check if the user exists
        if (!$user) {
            flashy()->error('❌ User not found for the increment!','#');
            return redirect()->back();
        }

        // Save the current salary before deleting the increment
        $currentSalary = $user->current_salary;

        // Delete the increment
        $increment->delete();

        // Check if the user has a current_salary before updating
        if (!is_null($currentSalary)) {
            // Decrement the current salary
            $user->update([
                'current_salary' => max(0, $currentSalary - $increment->increment)
            ]);
        }

        flashy()->success('✅ Increment Deleted successfully!','#');
        return redirect()->back();
    }
    public function edit($id){
        $increment = Increment::find($id);
        return view('employees.increment-edit', compact('increment'));

    }

    public function update(Request $request, $id){
        $validatedData = $request->validate([
            'increment' =>'required|numeric|min:1',
        ]);

        // Find the increment record
        $increment = Increment::find($id);

        // Save the old increment value
        $oldIncrement = $increment->increment;

        // Update the increment with the new value
        $increment->increment = $request->increment;
        $increment->save();

        // Calculate the difference between the old and new increment
        $incrementDifference = $request->increment - $oldIncrement;

        // Update the user's current_salary
        $user = $increment->user;

        // Check if the user exists
        if ($user) {
            $user->update([
                'current_salary' => max(0, $user->current_salary + $incrementDifference)
            ]);
        }

        flashy()->success('😎 Data updated successfully!','#');
        return redirect()->back()->with('success', 'Data updated successfully!');
    }


}
