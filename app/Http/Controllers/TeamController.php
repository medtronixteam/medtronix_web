<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team; // Make sure to import the Team model
use App\Models\User;
class TeamController extends Controller
{
public function create()
{
    $users = User::all(); // Retrieve all users from the database
    return view('team.manage', compact('users'));
}

   public function store(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'team_name' => 'required|string|max:255', // Validation for team name
    ]);

    // Check if a team with the given name already exists
    $existingTeam = Team::where('name', $validatedData['team_name'])->first();

    if ($existingTeam) {
        flashy()->error('Team already exists');
        return redirect()->back()->withInput();
    }

    // Create a new team using the validated data
    $team = Team::create([
        'name' => $validatedData['team_name'],
        // Add any other fields you may have in your teams table
    ]);

    flashy()->success('Team Created Successfully');

    // Redirect the user back with a success message
    return redirect()->back();
}
public function list()
    {
        $users = User::whereNot('role','admin')->get(); // Retrieve all users from the database
        $teamLeaders = User::where('role','team_lead')->get();
        $teams = Team::all(); // Retrieve all teams from the database
        return view('team.list', compact('teams','users','teamLeaders'));
    }


    public function edit(Team $team)
{
    // You can add any necessary logic here, such as fetching additional data
    return view('team.manage', compact('team'));
}

public function update(Request $request, Team $team)
{
    $request->validate([
        'team_name' => 'required|string|max:255',
    ]);

    $team->update([
        'name' => $request->team_name,
        // Add other fields to update here if needed
    ]);

    flashy()->success('Team updated successfully');

    return redirect()->route('team.list');
}

public function destroy(Team $team)
{
    // Delete the team
    $team->delete();

    flashy()->success('Team deleted successfully');

    // Redirect the user back to the list of teams or any other appropriate page
    return redirect()->route('team.list');
}

public function setlead(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'team_lead' => 'nullable|exists:users,id', // Allow null or existing user ID
        'team_id' => 'required|exists:teams,id' // Validate team ID
    ]);

    // Get the selected user as the team lead, if provided
    $teamLeadId = $request->team_lead;

    // Retrieve the team based on the provided team ID
    $team = Team::findOrFail($request->team_id);

    // Get the existing team lead ID
    $existingLeadId = $team->team_lead_id;

    // If the provided team lead ID is different from the existing one, update it
    if ($existingLeadId != $teamLeadId) {
        $team->team_lead_id = $teamLeadId;
        $team->save();

        // Optionally, you can add a success message here
        flashy()->success('Team lead updated successfully');
    }

    // Redirect the user back to the list of teams
    return redirect()->route('team.list');
}

public function addMembers(Request $request)
{
    // Validate the incoming request data
    $request->validate([
        'team_id' => 'required|exists:teams,id',
        'members' => 'required|array',
        'members.*' => 'exists:users,id',
    ]);

    // Retrieve the team based on the provided team ID
    $team = Team::findOrFail($request->team_id);

    // Loop through each member and update their team_id
    foreach ($request->members as $userId) {
        $user = User::findOrFail($userId);
        $user->team_id = $team->id;
        $user->save();
    }

    // Optionally, you can add a success message here
    session()->flash('success', 'Team members added successfully');

    // Redirect the user back to the list of teams
    return redirect()->route('team.list');
}

public function myteam()
{

    $teamId=auth()->user()->team_id;
    $members=[];
    $teamCheck=false;
    $teamLead=$myTeamName=null;
    if($teamId!=null){
        $teamCheck=true;
         $team=Team::find($teamId);
        if($team){
             $teamLead=($team->teamLead!=null)?$team->teamLead->name:"Not Set";
            $members=User::where('team_id', $teamId)->get();
         $myTeamName=$team->name;
        }else{
            $teamCheck=false;
        }


    }
    return view('employeeui.team', ['teamCheck'=>$teamCheck,'members'=>$members,'myTeamName'=>$myTeamName,'teamLead'=>$teamLead]);
}


}
