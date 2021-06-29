<?php

namespace App\Http\Controllers;

use App\Activity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Activitiescontroller extends Controller
{

    public function index()
    {
        $activities = Activity::paginate(10);
        return view('backend.activities.index' , compact('activities'));
    }

    function fetchDataByAjax(Request $request)
    {

        if ($request->ajax())
        {
            $query = $request->get('query');
            $query = str_replace(" ", "%", $query);
            $activities = Activity::with('oneUser')
                ->where('action', 'like', '%' . $query . '%')
                ->orWhere('table', 'like', '%' . $query . '%')
                ->orWhere('text', 'like', '%' . $query . '%')
                ->paginate(10);
            return view('backend.activities.fetch-Data-By-Ajax', compact('activities'))->render();
        }
    }


    public function create()
    {
        //
    }



    public function store($user_id,$action_name,$table_name,$row_id)
    {
        $activities= Activity::create([
            'user_id' => $user_id,
            'action' => $action_name,
            'table' => $table_name,
            'row_id' => $row_id,
            'text' => Auth::user()->name .' has '. $action_name.' Record In ' .$table_name. ' Table With ID:' .$row_id
        ]);
    }

    public function show(Activitiy $activitie)
    {
        //
    }

    public function edit(Activitiy $activitie)
    {
        //
    }

    public function update(Request $request, Activitiy $activitie)
    {
        //
    }


    public function destroy(Activitiy $activitie)
    {
        //
    }

}
