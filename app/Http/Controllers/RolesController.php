<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RolesController extends Controller
{

    public function index()
    {
        $roles = Role::paginate(5);
        return view('backend.roles.index' , compact('roles'));
    }

    function fetchDataByAjax(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $roles = DB::table('roles')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(5);
            return view('backend.roles.fetch-Data-By-Ajax', compact('roles'))->render();
        }
    }


    public function create()
    {
        return view('backend.roles.form');
    }

    public function store(Request $request)
    {
        $this->validate($request , [
            'name' => 'required',
        ]);
        $role = new Role();
        $role->name= $request->name;
        $role->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Create','Role',$role->id);
        Session()->flash('success' , 'Role Created Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('roles.index');
                break;
        }
    }


    public function edit($id)
    {
        $role = Role::find($id);
        return view('backend.roles.form' , compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request , [
            'name' => 'required',
        ]);
        $role = Role::find($id);
        $role->name= $request->name;
        $role->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Updated','Role',$role->id);
        Session()->flash('success' , 'Role Updated Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('roles.index');
                break;
        }
    }

    public function destroy($id)
    {
        $role = Role::find($id);
        $role->delete();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Deleted','User',$role->id);
        session()->flash('success' , 'Role Deleted Successfully');
        return redirect()->back();
    }
}
