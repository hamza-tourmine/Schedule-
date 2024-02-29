<?php

namespace App\Http\Controllers;

use App\Models\class_room;
use App\Models\establishment;
use App\Models\formateur_has_group;
use App\Models\main_emploi;
use App\Models\module_has_formateur;
use App\Models\sission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormateurRequestController extends Controller
{
    function show(){
        $user_id = Auth::id(); // Retrieve the logged-in formateur's ID
        $GroupsList = formateur_has_group::where('formateur_id', $user_id)->get();
        $modulesList = module_has_formateur::where('formateur_id', $user_id)->get();
        $classRooms = class_room::all()->where('id_establishment',session()->get('establishment_id'));
        $main_emplois = main_emploi::all();
        $seancesType = ["Présentielle","Teams","EFM"];
        $daysOfWeek = ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
        $daysPart = ["matin","Amidi"];
        $seancesPart =["S1","S2","S3","S4"];
        return view('formateurDashboard.FormateurRequest.Request',
        [
            'main_emplois' => $main_emplois,
            'days_of_week'=>$daysOfWeek,
            'days_part'=>$daysPart,
            'seances_part'=>$seancesPart,
            'GroupsList'=> $GroupsList,
            'modulesList' => $modulesList,
            'class_rooms' => $classRooms,
            'seances_type' => $seancesType
        ]
    );
    }
    public function reciveData(Request $request){
    $data = $request->all();
    $user_id = Auth::id();
    $establishment = session()->get('establishment_id');
    
    // Validate and save data to the database
    $sission = new sission([
        'day' => $data['day'],
        'day_part' => $data['dayPart'],
        'sission_type' => $data['type'],
        'group_id' => $data['group'],
        'module_id' => $data['module'],
        'class_room_id' => $data['class'],
        'establishment_id' => $establishment,
        'dure_sission' => $data['seancePart'],
        'user_id' => $user_id,
        // 'validate_date'	=>"",
        'main_emploi_id'=>$data['mainEmploiId'],
        "demand_emploi_id"=>1,
        'message'=>$data['message'],
        'status_sission'=>"Pending",
    ]);

    $sission->save();

    return response()->json(['message' => 'Data received and saved successfully.']);


}
}