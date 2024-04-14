<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
       // CREATE PROJECT API
       public function createProject(Request $request)
       {
           // validation
           $request->validate([
               "title" => "required",
               "description" => "required",
               "duration" => "required"
           ]);
   
           // user id + create data
           $user_id = auth()->user()->id;
   
           $project = new Project();
   
           $project->user_id = $user_id;
           $project->name = $request->name;
           $project->description = $request->description;
           $project->duration = $request->duration;
   
           $project->save();
   
   
           // send response
           return response()->json([
               "status" => 1,
               "message" => "Project has been created"
           ]);
       }
   
       // LIST PROJECT API
       public function listProject()
       {
           $user_id = auth()->user()->id;
   
           $projects = Project::where("user_id", $user_id)->get();
   
           return response()->json([
               "status" => 1,
               "message" => "Projects",
               "data" => $projects
           ]);
       }
   
       // SINGLE PROJECT API
       public function singleProject($id)
       {
           $user_id = auth()->user()->id;
   
           if(Project::where([
               "id" => $id,
               "user_id" => $user_id
           ])->exists()){
   
               $details = Project::where([
                   "id" => $id,
                   "user_id" => $user_id
               ])->first();
   
               return response()->json([
                   "status" => 1,
                   "message" => "Project detail",
                   "data" => $details
               ]);
           }else{
   
               return response()->json([
                   "status" => 0,
                   "message" => "Project not found"
               ]);
           }
       }
   
       // DELETE PROJECT API
       public function deleteProject($id)
       {
           $user_id = auth()->user()->id;
   
           if(Project::where([
               "id" => $id,
               "user_id" => $user_id
           ])->exists()){
   
               $project = Project::where([
                   "id" => $id,
                   "user_id" => $id
               ])->first();
   
               $project->delete();
   
               return response()->json([
                   "status" => 1,
                   "message" => "Project has been deleted successfully"
               ]);
   
           }else{
   
               return response()->json([
                   "status" => 0,
                   "message" => "Project not found"
               ]);
           }
       }
}