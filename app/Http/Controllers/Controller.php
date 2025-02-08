<?php

namespace App\Http\Controllers;
use App\Models\Project;
use Illuminate\Support\Facades\Response;
abstract class Controller
{
    protected function findProject(string $id): Project{
        $project = Project::find($id);

        if(!$project){
            return Response::fail([
                'action'=> 'Find Project',
                'message' => 'Project not found'
            ]);
        }

        return $project;
    }
}
