<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::paginate(10);
        return view('backend.users.index' , compact('users'));
    }

    public function create()
    {
        return view('backend.users.form');
    }

    public function store(StoreUserRequest $request)
    {
        $user = new User();
        $user->name= $request->name;
        if ($request->has('avatar')) {
            $user->avatar = $request->file('avatar')->store('users', 'public');
        }
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->password = hash::make($request->password);
        $user->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Create','User',$user->id);
        Session()->flash('success' , 'User Created Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('users.index');
                break;
        }
    }

    public function edit($id)
    {
        $user = User::find($id);
        return view('backend.users.form' , compact('user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::where('id',$id)->first();
        $user->name= $request->name;
        if ($request->avatar !== null) {
            Storage::disk('public')->delete('users/'.$user->avatar);
        }
        if (request()->hasFile('avatar')) {
            $image = $request->file('avatar');
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(225, 225);
            $img->stream();
            $user->avatar = $fileName;
            Storage::disk('local')->put('public/users' . '/' . $fileName, $img, 'public');
        }
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->email = $request->email;
        $user->save();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Update','User',$user->id);
        Session()->flash('success' , 'User Updated Successfully');
        switch($request->submitbutton)
        {
            case 'save':
                return redirect()->back();
                break;
            case 'save-draft':
                return redirect()->route('users.index');
                break;
        }
    }

    public function destroy($id)
    {
        $user = User::find($id);
        Storage::disk('public')->delete('users/'.$user->avatar);
        DB::table('role_user')->where('user_id' , $id)->delete();
        $user->delete();
        app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Deleted','User',$user->id);
        session()->flash('success' , 'User Deleted Successfully');
        return redirect()->back();
    }

    function fetchDataByAjax(Request $request)
    {
        if ($request->ajax()) {
            $sort_by = $request->get('sortby');
            $sort_type = $request->get('sorttype');
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $users = DB::table('users')
                ->where('email', 'like', '%' . $query . '%')
                ->orWhere('phone', 'like', '%' . $query . '%')
                ->orWhere('name', 'like', '%' . $query . '%')
                ->orderBy($sort_by, $sort_type)
                ->paginate(10);
            return view('backend.users.fetch-Data-By-Ajax', compact('users'))->render();
        }
    }

    public function setRole($id) {
        $users = User::find($id);
        $user_id = User::where('id' , $id)->first();
        $roles = Role::all();
        return view('backend.users.role')->with('users' , $users)->with('roles' , $roles)->with('user_id' , $user_id);
    }

    public function doRole(Request $request) {
        $this->validate($request , [
            'name' => 'required',
        ]);
        $users = User::find($request->user_id);
        if ($request->name) {
            $users->roles()->attach($request->name);
            app('App\Http\Controllers\Activitiescontroller')->store(auth()->user()->id,'Create','Role',$users->id);
            Session()->flash('success' , 'Role Created Successfully');
            switch($request->submitbutton)
            {
                case 'save':
                    return redirect()->back();
                    break;
                case 'save-draft':
                    return redirect()->route('users.index');
                    break;
            }
        }
    }
}
