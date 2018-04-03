<?php

namespace App\Http\Controllers;
use App\Project;
use App\Package;
use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::paginate(9);
        return view('project.index', ['projects' => $projects]);
    }
    public function detail($id) {
        $project = Project::findOrFail($id);

        $packages = Package::where('project_id', $id)->get();
        return view('project.detail', ['project' => $project, 'packages' => $packages]);
    }
}
