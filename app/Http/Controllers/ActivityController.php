<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function list()
    {
        //echo date("Y-m-d H:i:s",time());
        $rows = Activity::where('end_time','>=',date("Y-m-d H:i:s",time()))->get();

        return view('activity.list',['rows'=>$rows]);
    }

    public function show(Activity $row)
    {
        return view('activity.show',compact('row'));
    }
}
