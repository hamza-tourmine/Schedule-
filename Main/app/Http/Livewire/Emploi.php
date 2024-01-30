<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Models\group;
use App\Models\module;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\user;

class Emploi extends Component
{
    public $modulee;
    public $group;
    public $formateur;
    public $salle ;
    public $salleClasstyp;
    public $dure ;
    public $dayPart;
    public $TypeSession;

    //
    public $groups;
    public $modules ;
    public $formateurs ;
    public $salles;
    public $classType;
    // for catche date from  form Module
    public $salleclassTyp;
    // public $group;
    public $module ;
    public $idCase;
    public $TypeSesion;


    public function render()
    {
        $establishment_id = session()->get('establishment_id');
        // Fetch groups with establishment_id condition
        $groups = group::where('establishment_id', $establishment_id)->get();
        // Fetch modules with establishment_id condition
        $modules = module::where('establishment_id', $establishment_id)->get();
        // Fetch class rooms with id_establishment condition
        $salles = class_room::where('id_establishment', $establishment_id)->get();
        // Fetch formateurs with establishment_id and role condition
        $formateurs = user::where('establishment_id', $establishment_id)
                          ->where('role', 'formateur')->get();
        // Fetch class room types with establishment_id condition
        $classType = class_room_type::where('establishment_id', $establishment_id)->get();
        // Get main_emploi_id from session
        $id_main_emploi = session()->get('id_main_emploi');
        // Fetch sissions using joins and conditions
        $sissions = DB::table('sissions')
            ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
            ->join('modules', 'modules.id', '=', 'sissions.module_id')
            ->join('groups', 'groups.id', '=', 'sissions.group_id')
            ->join('users', 'users.id', '=', 'sissions.user_id')
            ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
            ->where('sissions.establishment_id', $establishment_id)
            ->where('sissions.main_emploi_id', $id_main_emploi)
            ->get();
        return view('livewire.emploi', [
            'sissions' => $sissions,
            'formateurs' => $formateurs,
            'groups' => $groups,
            'modules' => $modules,
            'salles' => $salles,
            'classType' => $classType
        ]);
    }
    public function insertSession(Request $request){
        try{
           // $request->validate([
           //     "modele"=>  'required',
           //     "group"=>  'required',
           //     "formateur"=>  'required',
           //     "salle"=>  'required',
           //     "salleclassTyp"=>  'required',
           //     "dure"=>  'required',
           //     'idcase'=>'required',
           //     "dayPart"=>  'required',
           //     "TypeSesion"=>  'required'
           // ]);
           // // $day = substr($request->idCase,0,3);
           // $establishment_id = session()->get('establishment_id');
           // $sission = sission::create([
           //     'day'=>substr($request->idCase,0,3),
           //     'day_part'=>$request->dayPart,
           //     'dure_sission'=>$request->dure,
           //     'module_id'=>$request->modele,
           //     'group_id'=>$request->group,
           // 	'establishment_id'=>$establishment_id,
           //     'user_id'=>$request->formateur,
           //     'class_room_id'=>$request->salle,
           //     'validate_date'=>null,
           //     'main_emploi_id'=>session()->get('id_main_emploi'),
           //     "demand_emploi_id"=>null,
           //     'message'=>null,
           //     'sission_type'=>$request->TypeSesion,
           // 	'status_sission'=>null,
           // ]);
           // if($sission){
           //     return back();
           // }

           return $request ;

        }catch(\Exception  $e){
           dd($e->getMessage());
        }
           // dd(session());
           // return session()->get('id_main_emploi');
       }
       public function submit(){
        dd($this);
       }
}
