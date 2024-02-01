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
use App\Models\main_emploi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Schedule extends Controller
{

    public function index(){
        // $establishment_id = session()->get('establishment_id');
        // $groups = group::all()->where('establishment_id',$establishment_id);
        // $modules = module::all()->where('establishment_id',$establishment_id);
        // $salles = class_room::all()->where('id_establishment',session()->get('establishment_id'));
        // $formateurs = user::all()->where('establishment_id',$establishment_id)->where('role','formateur');
        // $classType = class_room_type::all()->where('establishment_id',$establishment_id);
        // $id_main_emploi =  session()->get('id_main_emploi');
        // $establishment_id = session()->get('establishment_id');
        // $sission = DB::table('sissions')
        // ->select('sissions.*','modules.module_name','groups.group_name','users.user_name','class_rooms.class_name')
        // ->join('modules', 'modules.id', '=', 'sissions.module_id')
        // ->join('groups', 'groups.id', '=', 'sissions.group_id')
        // ->join('users', 'users.id', '=', 'sissions.user_id')
        // ->join('class_rooms','class_rooms.id','=','class_rooms.class_name')
        // ->where('sissions.establishment_id', $establishment_id)
        // ->where('sissions.main_emploi_id',$id_main_emploi)
        // ->get();
        // return $sission ;


//         ,[
//             'sissions'=>$sission,
//             'formateurs'=>$formateurs,
//             'groups'=>$groups,
//             'modules'=>$modules,
//             'salles'=>$salles,
//             'classType'=>$classType
// ]
        return  view('adminDashboard.main.main');
    }




    //creating new schadule
    public function createNewSchedule(Request $request){
        //we need to  create  new id for new shadule
        $dateStart = $request->dateStart;
        $initialDate = Carbon::parse($dateStart);
        $numberOfDaysToAdd = 7;
        $modifiedDate = $initialDate->addDays($numberOfDaysToAdd);
        $dateEnd =  $modifiedDate->format('Y-m-d');
        $establishment_id = session()->get('establishment_id');
        try {
            $main_emploi = main_emploi::create([
                'datestart' => $dateStart,
                'dateend' => $dateEnd,
                'establishment_id' => $establishment_id,
            ]);
           if($main_emploi){
            // create a session for last Main emploi created
            $main_emploi = DB::table('main_emploi')
            ->select(['id', 'datestart'])
            ->where('establishment_id', $establishment_id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->first();
            session(['id_main_emploi' => $main_emploi->id,'datestart'=>$main_emploi->datestart]);
            // return session()->get('id_main_emploi');
            return redirect()->back()->with('success', "Commencez à créer l'emploi du temps maintenant.");
           }
         } catch (\Exception $e) {
             return redirect()->back()->withErrors(['error' => "select date start"]);
        }
    }

    public function MainFormSchadule(Request $request){
        Session::forget('id_main_emploi');
        Session::forget('datestart');
        return back() ;
    }
}
