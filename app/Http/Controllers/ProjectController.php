<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ProjectController extends Controller
{
    public function index() {
        $projects = DB::table('projects')->paginate(9);
        return view('project.index', ['projects' => $projects]);
    }
}
