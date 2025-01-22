<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ProjectPicture;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    // for home page projects
    public function homeProjects()
    {
        $projects = Project::all();
        foreach ($projects as $key => $project) {
            $project->pictures=ProjectPicture::where('project_id',$project->id)->get();
        }
        // return $projects;
        return view('project', compact('projects'));
    }
    public function index()
    {
        $projects = Project::all();
        foreach ($projects as $key => $project) {
            $project->pictures=ProjectPicture::where('project_id',$project->id)->get();
        }
        // return $projects;
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'main_picture' => 'required|image|mimes:png,jpg,jpeg,gif|max:4000',
            'link' => 'nullable|url', // Validate if link is URL
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:200000', // Max file size in kilobytes (200MB
        ]);
        // return $request;

        $projectData = $request->except(['pictures', 'main_picture']);
        $project = Project::create($projectData);

          // Handle main_picture
          if ($request->hasFile('main_picture')) {
            $mainPicture = $request->file('main_picture');
            $uniqueName = Str::uuid()->toString() . '.' . $mainPicture->getClientOriginalExtension();

            // Store the main picture with the unique name
            $path = $mainPicture->storeAs('project_pictures', $uniqueName, 'public');

            // Save the main picture path to the database
            $project->update(['main_picture' => $path]);
        }

        //save video or link
         if($request->hasFile('video')){
            $mainVideo=$request->file('video');
            $uniqueName=Str::uuid()->toString().'.'.$mainVideo->getClientOriginalExtension();

            // store the video
            $path=$mainVideo->storeAs('project_videos',$uniqueName,'public');
            $project->update(['video' => $path]);

        } else if($request->has('video_link')){
            $project->update(['video' => $request->get('video_link')]);
        }

        if($request->pictures){
            $this->handlePictures($request, $project);
        }


        flashy()->success('✅ Project Created Successfully','#');
        return redirect()->route('projects.create')->with('success', 'Project created successfully');
    }



    public function show(Project $project)
    {
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        // return $project;
        $project_pictures=ProjectPicture::where('project_id',$project->id)->get();
        // return $project_pictures;
        return view('projects.edit', compact('project','project_pictures'));
    }



    public function destroy(Project $project)
    {
        // Get the paths of associated project pictures
        $picturePaths = $project->pictures()->pluck('picture_path')->toArray();

        // Delete associated project pictures in storage
        foreach ($picturePaths as $picturePath) {
            Storage::delete('public/'.$picturePath);
        }
        if($project->main_picture){
            Storage::disk('public')->delete($project->main_picture);
        }
        // Delete associated project pictures in the database
        $project->pictures()->delete();
        // delete the project
        $project->delete();

        flashy()->mutedDark('😖 Project Deleted SuccessFully','#');
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully');
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'name' => 'required',
            'category' => 'required',
            'main_picture' => 'image|mimes:png,jpg,jpeg,gif|max:2048',
            'link' => 'nullable|url', // Validate if link is URL
            'video' => 'nullable|file|mimes:mp4,mov,avi|max:200000', // Max file size in kilobytes (200MB
        ]);

        $projectData = $request->except('pictures');

        if($request->hasFile('main_picture')) {
            $mainPicture= $request->file('main_picture');
            $uniqueName=Str::uuid().'.'.$mainPicture->getClientOriginalExtension();
            $path=$mainPicture->storeAs('project_pictures',$uniqueName,'public');

            if($project->main_picture){
                Storage::disk('public')->delete($project->main_picture);
            }

            $projectData['main_picture']=$path;
        }

        $project->update($projectData);

         //save video or link
         if($request->hasFile('video')){
            $mainVideo=$request->file('video');
            $uniqueName=Str::uuid()->toString().'.'.$mainVideo->getClientOriginalExtension();

            // store the video
            $path=$mainVideo->storeAs('project_videos',$uniqueName,'public');
            $project->update(['video' => $path]);

        } else if($request->has('video_link')){
            $project->update(['video' => $request->get('video_link')]);
        }


        if($request->pictures){
            $this->handlePictures($request, $project);
        }

        flashy()->success('😎 Data updated SuccessFully !','#');
        return redirect()->route('projects.index')->with('success', 'Project updated successfully');
    }
    public function updateProjectPictures(request $request,ProjectPicture $projectPicture){

        if($request->hasFile('project_picture')){
            $uniqueName=Str::uuid().'.'.$request->project_picture->getClientOriginalExtension();
            $path=$request->project_picture->storeAs('project_pictures',$uniqueName,'public');

            // Delete the previous project picture if it exists
            if($projectPicture->picture_path){
                Storage::disk('public')->delete($projectPicture->picture_path);
            }

            $projectPicture->update([
                'picture_path'=>$path
            ]);
        }
        return redirect()->route('projects.edit',$request->project_id);
    }

    public function destroyProjectPictures(ProjectPicture $projectPicture){
        $project_id = $projectPicture->project_id;

        // Delete the picture from storage if it exists
        if ($projectPicture->picture_path) {
            Storage::disk('public')->delete($projectPicture->picture_path);
        }

        // Delete the ProjectPicture record
        $projectPicture->delete();

        return redirect()->route('projects.edit', $project_id);
    }


    protected function handlePictures(Request $request, Project $project)
    {
        $request->validate([
            'pictures' => 'nullable|array',
            'pictures.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        foreach ($request->file('pictures') as $picture) {
            // Generate a unique name for each picture
            $uniqueName = Str::uuid()->toString() . '.' . $picture->getClientOriginalExtension();

            // Store the picture with the unique name
            $path = $picture->storeAs('project_pictures', $uniqueName, 'public');

            // Create a new project picture record in the database
            $project->pictures()->create(['picture_path' => $path]);
        }
    }

}
