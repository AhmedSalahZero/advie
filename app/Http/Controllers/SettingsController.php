<?php

namespace App\Http\Controllers;

use App\Setting;
use Hamcrest\Core\Set;
use Illuminate\Http\Request;

class SettingsController extends Controller
{

    public function index()
    {


    }


    public function create()
    {
        return view('backend.settings.form')->with('settings',Setting::all());
    }


    public function store(Request $request)
    {
        foreach ($request->only(['address','phone','email']) as $key=>$value)
            Setting::where('setting_name',$key)->update(['setting_value'=>$value]);
        return redirect()->route('settings.create')->with('success','settings have been edited successfully');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
