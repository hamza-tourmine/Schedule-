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
use App\Notifications\RequestEmploiNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Testing\Fakes\NotificationFake;

class FormateurRequestController extends Controller
{
    public function show(Request $request)
{
    try {
        // Retrieve the authenticated user's ID
        $user_id = Auth::id(); 
        
        // Retrieve main emploi ID from the request data
        $main_emploi_id = $request['main_emploi_id'];
        // dd($main_emploi_id);
        // Fetch all seances related to the user and main emploi
        $allSeances = Sission::where('user_id', $user_id)
                            //  ->where('main_emploi_id', $main_emploi_id)
                             ->get();

        // Fetch groups list associated with the formateur
        $groupsList = formateur_has_group::where('formateur_id', $user_id)->get();

        // Fetch modules list associated with the formateur
        $modulesList = module_has_formateur::where('formateur_id', $user_id)->get();

        // Fetch all classrooms associated with the establishment
        $classRooms = class_room::where('id_establishment', session()->get('establishment_id'))->get();

        // Fetch all main emplois
        $mainEmplois = main_emploi::all();

        // Define lists of seances types, days of week, days part, and seances part
        $seancesType = ["PRESENTIELLE", "TEAMS", "EFM"];
        $daysOfWeek = ["Lundi", "Mardi", "Mercredi", "Jeudi", "Vendredi", "Samedi"];
        $daysPart = ["Matin", "A.Midi"];
        $seancesPart = ["SE1", "SE2", "SE3", "SE4"];

        return view('formateurDashboard.FormateurRequest.Request', [
            'main_emplois' => $mainEmplois,
            'days_of_week' => $daysOfWeek,
            'days_part' => $daysPart,
            'seances_part' => $seancesPart,
            'GroupsList' => $groupsList,
            'modulesList' => $modulesList,
            'class_rooms' => $classRooms,
            'seances_type' => $seancesType,
            'AllSeances' => $allSeances
        ]);
    } catch (\Exception $e) {
        // Handle any exceptions
        return response()->json(['message' => 'Error occurred while processing request.', 'status' => 500, 'error' => $e->getMessage()]);
    }
}
    
public function submitAllData(Request $request)
{
    $data = $request->all();
    $selectedData = $data['selectedData'];
    $mainEmploiId = $data['mainEmploiId'];
    $data = $request->all();
    $user_id = Auth::id();
    $requestEmploiId = RequestEmploi::where('user_id', $user_id)->where('main_emploi_id',$mainEmploiId)->value('id');
    $establishment = session()->get('establishment_id');
    if (!$requestEmploiId) {
        return response()->json(['msg' => 'Tu dois créer une demande d\'emploi pour cet emploi d\'abord.', 'status' => 599]);
    }else {
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
                'main_emploi_id'=>$mainEmploiId,
                "demand_emploi_id"=>$requestEmploiId,
                'message'=>$item['message'],
                'status_sission'=>"Pending",
            ]);
        
            $sission->save();
                Log::info('Sission created:', ['data' => $item]);
            }
                return response()->json(['sucess' => 'Toutes les données ont été soumises avec succès.', 'status' => 200]);
                
    }
    
    
}
public function createRequestEmploi(Request $request)
{
    try {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'mainEmploiId' => 'required|integer', 
        ]);

        // Retrieve the validated mainEmploiId from the request data
        $mainEmploiId = $validatedData['mainEmploiId'];
        $comment = $request['comment'];
        
        // Get the authenticated user's ID
        $user_id = Auth::id();

        // Check if a request already exists for the user and mainEmploiId
        $existingRequest = RequestEmploi::where('user_id', $user_id)
            ->where('main_emploi_id', $mainEmploiId)
            ->first();
        $requestExists = $existingRequest ? true : false;

        if ($existingRequest) {
            // If a request already exists, update it
            $existingRequest->update([
                'date_request' => now(),
                'comment' => $comment,
            ]);

            return response()->json(['message' => 'Request emploi updated successfully.', 'status' => 400, 'requestExists' => $requestExists]);
        } else {
            // If no request exists, create a new one
            $requestEmploi = new RequestEmploi([
                'date_request' => now(),
                'comment' => $comment,
                'user_id' => $user_id,
                'main_emploi_id' => $mainEmploiId,
            ]);
            $requestEmploi->save();
            $MainUser = User::where('role', 'admin')->first();
            $FormateurRequest = Auth::user()->user_name;
            $RequestCommentaire = $request['comment'];
            Notification::send($MainUser,new RequestEmploiNotification($requestEmploi->id,$FormateurRequest,$RequestCommentaire,$mainEmploiId));
            return response()->json(['message' => 'Request emploi created successfully.', 'status' => 300, 'requestExists' => $requestExists]);
        }
    } catch (\Exception $e) {
        // Return error response in case of any exceptions
        return response()->json(['message' => 'Error creating or updating request emploi.', 'status' => 500, 'error' => $e->getMessage()]);
    }
}
public function MarkAsread() {
    $user = User::find(auth()->user()->id);
    foreach ($user->unreadNotifications as $notification) {
        $notification->markAsRead();
    }
    return redirect()->back();
}
public function Clear() {
    $user = User::find(auth()->user()->id);
    foreach ($user->Notifications as $notification) {
        $notification->delete();
    }
    return redirect()->back();
}

}
