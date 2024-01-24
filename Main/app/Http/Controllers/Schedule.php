<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\group;
use App\Models\module;
use Illuminate\Support\Facades\Session;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\user;
use App\Models\class_has_type;

class Schedule extends Controller
{
    public function index(){
        
        $establishment_id = session()->get('establishment_id');
        $groups = group::all()->where('establishment_id',$establishment_id);

        $establishment_id = session()->get('establishment_id');
        $modules = module::all()->where('establishment_id',$establishment_id);

        $establishment_id = session()->get('establishment_id');
        $salles = class_room::all()->where('id_establishment',session()->get('establishment_id'));

        $establishment_id = session()->get('establishment_id');
        $formateurs = user::all()->where('establishment_id',$establishment_id)->where('role','formateur');

        $establishment_id = session()->get('establishment_id');
        $classType = class_room_type::all()->where('establishment_id',$establishment_id);
        return  view('adminDashboerd.mane.mane',['formateurs'=>$formateurs,'groups'=>$groups,'modules'=>$modules,'salles'=>$salles,'classType'=>$classType]);
    }

    public function insertSession(Request $request){
        return $request ;
    }
}
