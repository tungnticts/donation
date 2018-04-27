<?php

namespace App\Http\Controllers;
use App\Project;
use App\Package;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DB;
use Validator;

class ProjectController extends Controller
{
    public function index() {
        $projects = Project::orderBy('id', 'desc')->paginate(9);
        return view('project.index', ['projects' => $projects]);
    }
    public function detail($slug, $id) {
        $project = Project::findOrFail($id);
        // dd($project->package()->get());
        $packages = $project->package()->get();
        $total_money_donating = 0;
        $total_donating = 0;
        foreach ($packages as $package) {
            $total_donating += $package->order()->count();
            $total_money_donating += $package->order()->count() * $package->price;
        }
        
        // $recent_projects = Project::where('id', '<>', $id)->take(3)->get();
        return view('project.detail', ['project' => $project, 'packages' => $packages, 'total_money_donating' => $total_money_donating, 'total_donating' => $total_donating]);
    }
    public function get_recent_project(Request $request) {
        $recent_projects = Project::where('id', '<>', $request->input('id'))->take(3)->get();
        foreach ($recent_projects as $key => $project) {
            $packages = $project->package();
            foreach ($packages as $package) {
                $recent_projects[$key]['total_money'] = $package->order()->count() * $package->price;
                $recent_projects[$key]['total_donating'] = $package->order()->count();
            }
        }
        return view('project.recents'. ['recent_projects' => $recent_projects]);
    }
    public function admin_list(Request $request) {
        $projects = Project::orderBy('id', 'desc')->paginate(15);
        return view('projects.admin_list', ['projects' => $projects]);
    }
    public function create() {
       return view('projects.create');
    }
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'aim_money' => 'required|numeric',
            'summary' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
            'image1' => 'required',
            'image2' => 'required',
            'image3' => 'required',
            'image4' => 'required',
            'image5' => 'required',
            'end_at' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect('admin/projects/create')->withErrors($validator)->withInput();
        }
        $project = new Project();
        $project->name = $request->input('name');
        $project->aim_money = $request->input('aim_money');
        $project->summary = $request->input('summary');
        $project->content = $request->input('content');
        $project->thumbnail = $request->input('thumbnail');
        $project->end_at = $request->input('end_at');
        $project->user_id = Auth::id();
        $project->image1 = $request->input('image1');
        $project->image2 = $request->input('image2');
        $project->image3 = $request->input('image3');
        $project->image4 = $request->input('image4');
        $project->image5 = $request->input('image5');
        $project->save();

        return redirect('admin/packages/create?project_id='.$project->id.'&quantity='.$request->input('package_number'))->with('success', 'Tạo dự án thành công !!!');   
    }
    public function edit($id) {
        $project = Project::findOrFail($id);
        return view('projects.edit', ['project' => $project]);
    }
    public function save_edit(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'aim_money' => 'required|numeric',
            'summary' => 'required',
            'content' => 'required',
            'thumbnail' => 'required',
            'image1' => 'required',
            'image2' => 'required',
            'image3' => 'required',
            'image4' => 'required',
            'image5' => 'required',
            'end_at' => 'required',
        ]);


        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        $project = Project::findOrFail($request->input('id'));
        $project->name = $request->input('name');
        $project->aim_money = $request->input('aim_money');
        $project->summary = $request->input('summary');
        $project->content = $request->input('content');
        $project->image1 = $request->input('image1');
        $project->image2 = $request->input('image2');
        $project->image3 = $request->input('image3');
        $project->image4 = $request->input('image4');
        $project->image5 = $request->input('image5');
        $project->thumbnail = $request->input('thumbnail');
        $project->end_at = $request->input('end_at');
        $project->user_id = Auth::id();
        $project->save();

        return redirect('admin/projects')->with('success', 'Update dự án thành công !!!');   
    }
    public function delete($id) {
        $project = Project::find($id);
        if (!$project) {
            return back()->with('fail', 'Dự án không tồn tại !!!');
        }
        $project->delete();
        return back()->with('success', 'Xóa dự án thành công !!!');
    }
    public function create_package(Request $request) {
        $project_id = $request->input('project_id');
        $project = Project::find($project_id);
        if (!$project) {
            return back()->with('error', 'Project không tồn tại');
        }
        $quantity = $request->input('quantity');
        return view('projects.create_package', ['project' => $project, 'quantity' => $quantity]);
    }
    public function store_package(Request $request) {
        $project = Project::find($request->input('project_id'));
        if (!$project) {
            return back()->with('error', 'Project không tồn tại');
        }
        $packages = $request->input('packages');
        foreach($packages as $package) {
            $item = new Package();
            $item->project_id = $project->id;
            $item->quantity = $package['quantity'];
            $item->title = $package['title'];
            $item->content = '';
            $item->price = $package['price'];
            $item->user_id = Auth::id();
            $item->save();
        }
        return redirect('admin/packages?project_id='.$project->id);
    }
    public function packages_list(Request $request) {
        $project = Project::find($request->input('project_id'));
        if (!$project) {
            return back()->with('error', 'Project không tồn tại');
        }
        $packages = Package::where('project_id', '=', $project->id)->get();
        // dd($packages);
        return view('projects.packages_list', ['packages' => $packages]);
    }
    public function edit_package(Request $request) {
        $package = Package::findOrFail($request->input('id'));
        if (!$package) {
            return back()->with('error', 'Package không tồn tại');
        }
        return view('projects.edit_package', ['package' => $package]);
    }
    public function save_edit_package(Request $request) {
        $package = Package::findOrFail($request->input('id'));
        if (!$package) {
            return back()->with('error', 'Package không tồn tại');
        }
        $package->title = $request->input('title');
        $package->price = $request->input('price');
        $package->quantity = $request->input('quantity');
        $package->type = $request->has('type') ? 1 : 0;
        $package->save();
        $project = $package->project()->first();
        // return back()->with('Success', 'Update thành công');
        return redirect('admin/packages?project_id='.$project->id)->with('Success', 'Update thành công');
    }
}
