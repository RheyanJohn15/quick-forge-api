<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\ValidationException;

class ProjectManagementController extends Controller
{
    public function add(Request $req){
        try{

            $req->validate([
                'name' => 'string|required',
                'description' => 'string|nullable'
            ]);

            $checkName = Project::where('project_name', $req->name)->first();

            if($checkName){
                return Response::fail([
                    'action'=> 'Adding project failed',
                    'message' => 'Project Name already exist',
                    'code' => 409
                ]);
            }

            $project = new Project();
            $project->project_name = $req->name;
            $project->project_description = $req->description;
            $project->save();

            return Response::success([
                'action' => 'Add Project',
                'message' => 'Project has been succesfully created',
                'code' => 201
            ]);

        }catch(ValidationException $e){
            return Response::fail([
                'action'=> 'Adding project failed',
                'message' => 'Validation error',
                'error' => $e->errors(),
            ]);
        }
    }

    public function list(){
        $projects = Project::where('isDeleted', false)->get();

        return Response::success([
            'action' => 'Project List',
            'result'=> $projects
        ]);
    }

    public function update(Request $req){

        try{

            $req->validate([
                'id' => 'string|required',
                'name' => 'string|required',
                'description' => 'string|nullable'
            ]);

            $project = $this->findProject($req->id);

            $project->update([
                'project_name' => $req->name,
                'project_description' => $req->description
            ]);

            return Response::success([
                'action' => 'Update Project',
                'message' => 'Project has been successfully updated',
            ]);

        }catch(ValidationException $e){
            return Response::fail([
                'action'=> 'Updating project failed',
                'message' => 'Validation error',
                'error' => $e->errors(),
            ]);
        }
    }

    public function info($id){

        $project = $this->findProject($id);

        return Response::success([
            'action' => 'Get project detail',
            'data'=> $project
        ]);
    }
}
