<?php

namespace App\Http\Controllers;

use App\Models\class_room;
use App\Models\establishment;
use App\Models\formateur_has_group;
use App\Models\main_emploi;
use App\Models\module_has_formateur;
use App\Models\RequestEmploi;
use App\Models\sission;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;


class FormateurRequestController extends Controller
{
    function show(){
        $user_id = Auth::id(); 
        $AllSeance = sission::where('user_id',$user_id)->get();
        $GroupsList = formateur_has_group::where('formateur_id', $user_id)->get();
        $modulesList = module_has_formateur::where('formateur_id', $user_id)->get();
        $classRooms = class_room::all()->where('id_establishment',session()->get('establishment_id'));
        $main_emplois = main_emploi::all();
        $seancesType = ["Présentielle","Teams","EFM"];
        $daysOfWeek = ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
        $daysPart = ["Matin","A.Midi"];
        $seancesPart =["SE1","SE2","SE3","SE4"];
        return view('formateurDashboard.FormateurRequest.Request',
        [
            'main_emplois' => $main_emplois,
            'days_of_week'=>$daysOfWeek,
            'days_part'=>$daysPart,
            'seances_part'=>$seancesPart,
            'GroupsList'=> $GroupsList,
            'modulesList' => $modulesList,
            'class_rooms' => $classRooms,
            'seances_type' => $seancesType,
            'AllSeances' => $AllSeance
        ]
    );
    }
    
public function submitAllData(Request $request)
{
    $data = $request->all();
    $selectedData = $data['selectedData'];
    $data = $request->all();
   
    $user_id = Auth::id();
    $establishment = session()->get('establishment_id');
    foreach ($selectedData as $item) {
    $sission = new sission([
        'day' => $item['day'],
        'day_part' => $item['dayPart'],
        'sission_type' => $item['type'],
        'group_id' => $item['group'],
        'module_id' => $item['module'],
        'class_room_id' => $item['class'],
        'establishment_id' => $establishment,
        'dure_sission' => $item['seancePart'],
        'user_id' => $user_id,
        'main_emploi_id'=>$item['mainEmploiId'],
        "demand_emploi_id"=>17,
        'message'=>$item['message'],
        'status_sission'=>"Pending",
    ]);

    $sission->save();
        Log::info('Sission created:', ['data' => $item]);
    }
    $createdsission = sission::find($sission->id);

    return response()->json(['message' => 'All data submitted successfully.',$createdsission]);
}
public function createRequestEmploi(Request $request)
{
    $data = $request->all();
    $mainEmploiId = $data['mainEmploiId'];
    $user_id = Auth::id();

    // Create a new request emploi
    $requestEmploi = new RequestEmploi([
        'date_request' => now(),
        'comment' => 'test comment', // Adjust according to your form fields
        'user_id' => $user_id,
        'main_emploi_id' => $mainEmploiId,
    ]);

    $requestEmploi->save();

    // Fetch the created request emploi with its related data
    $createdRequestEmploi = RequestEmploi::with('mainEmploi')->find($requestEmploi->id);

    return response()->json([
        'message' => 'Request emploi created successfully.',
        'requestEmploi' => $createdRequestEmploi,
        'user_id'=>$user_id]);
}

}