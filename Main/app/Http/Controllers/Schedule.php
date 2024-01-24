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
use App\Models\sission;

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
        // i removed thes from creation 'validate_date'
        //cut day from idCase

        $establishment_id = session()->get('establishment_id');
        $sission = sission::create([
            'day'=>$request->idCase,
            'day_part'=>$request->dayPart,
            'dure_sission'=>$request->dure,
            'module_id'=>$request->modele,
            'group_id'=>$request->group,
        	'establishment_id'=>$establishment_id,
            'user_id'=>$request->formateur,
            'class_room_id'=>$request->salle,
            'validate_date'=>null,
            'main_emploi_id'=>null,
            "demand_emploi_id"=>null,
            'message'=>null,
            'sission_type'=>$request->TypeSesion,
        	'status_sission'=>null,
        ]);
        return $request ;
    }
}
