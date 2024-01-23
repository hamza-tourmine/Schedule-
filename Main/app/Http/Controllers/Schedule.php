<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\group;
use App\Models\module;
use Illuminate\Support\Facades\Session;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\class_has_type;

class Schedule extends Controller
{
    public function index(){
        $establishment_id = session()->get('establishment_id');
        $groups = group::all()->where('establishment_id',$establishment_id);
        return  view('adminDashboerd.mane.mane',['groups'=>$groups]);
    }
}
