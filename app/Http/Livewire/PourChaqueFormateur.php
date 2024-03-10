<?php

namespace App\Http\Livewire;

use Livewire\Component;
// use livewire\Attribute\on;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\group;
use App\Models\module;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\formateur_has_group;
use App\Models\user;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PourChaqueFormateur extends Component
{
    public $modulee;
    public $group;
    public $formateur;
    public $salle ;
    public $salleClasstyp;
    public $dure ;
    public $dayPart;
    public $TypeSession;
    public $selectedOption;

    public $formateurId;
    public $modules;
    public $groups;
    public $sissions;
    public $formateurs = [];
    public $classType ;
    public $salles ;
    public $checkValues;


    public function render()
{
    $establishment_id = session()->get('establishment_id');
    // Load all formateurs
    $this->formateurs = user::where('establishment_id', $establishment_id)
                                ->where('role', 'formateur')
                                ->where('status', 'active')
                                ->get();
    // Load modules, groups, and sessions based on the selected formateur
    if ($this->formateurId) {

        // $this->modules = module::where('formateur_id', $this->formateurId)->get();
        $this->modules = module::join('module_has_formateur as  M' , 'M.module_id' , '=' , 'modules.id')
        ->where('modules.establishment_id', $establishment_id)
        ->where('M.formateur_id', $this->formateurId)
        ->select('modules.module_name')
        ->get();
        $this->classType = class_room_type::where('establishment_id', $establishment_id)->get();
        $this->salles = class_room::where('id_establishment', $establishment_id)->get();
        $this->groups = group::join('formateur_has_groups as f', 'f.group_id', '=', 'groups.id')
        ->where('groups.establishment_id', $establishment_id)
        ->where('f.formateur_id', $this->formateurId)
        ->select('groups.group_name')
        ->get();


        $this->sissions = DB::table('sissions')
                            ->select('sissions.*', 'modules.module_name', 'groups.group_name','class_rooms.class_name')
                            ->join('modules', 'modules.id', '=', 'sissions.module_id')
                            ->join('groups', 'groups.id', '=', 'sissions.group_id')
                            ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
                            ->where('sissions.establishment_id', $establishment_id)
                            ->where('sissions.user_id', $this->formateurId)
                            ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
                            ->get();

    } else {
        // If no formateur is selected, clear the modules, groups, and sessions
        $this->modules =   [];
        $this->groups =    [];
        $this->salles =    [];
        $this->classType = [];
        $this->sissions =  [];
    }

    $this->checkValues = Setting::select('typeSession','module','formateur','salle','typeSalle')
    ->where('userId', Auth::id())->get() ;

    return view('livewire.pour-chaque-formateur');
}


}


































































    // public function render()
    // {
    //     // Load modules, groups, and sessions based on the selected formateur
    //     if ($this->formateurId) {
    //         $establishment_id = session()->get('establishment_id');
    //         // $this->modules = module::where('formateur_id', $this->formateurId)->get();
    //         $this->classType = class_room_type::where('establishment_id', $establishment_id)->get();
    //         $this->salles = class_room::where('id_establishment', $establishment_id)->get();

    //         $this->formateurs = user::where('establishment_id', $establishment_id)
    //                                       ->where('role', 'formateur')
    //                                       ->where('status', 'active')->get();
    //         $this->modules=[];

    //         $this->groups =  DB::table('groups')
    //                             ->select('groups.group_name')
    //                             ->join('formateur_has_groups', 'formateur_has_groups.formateur_id', '=', $this->formateurId)
    //                             ->where('formateur_has_groups.establishment_id', $establishment_id)
    //                             ->get();

    //         $this->sissions = DB::table('sissions')
    //                             ->select('sissions.*', 'modules.module_name', 'groups.group_name','class_rooms.class_name')
    //                             ->join('modules', 'modules.id', '=', 'sissions.module_id')
    //                             ->join('groups', 'groups.id', '=', 'sissions.group_id')
    //                             ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
    //                             ->where('sissions.establishment_id', $establishment_id)
    //                             ->where('sissions.user_id',$this->formateurId)
    //                             ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
    //                             ->get();
    //     } else {
    //         // If no formateur is selected, clear the modules, groups, and sessions
    //         $this->modules = [];
    //         $this->groups = [];
    //         $this->sissions = [];
    //     }

    //     return view('livewire.pour-chaque-formateur' );
    // }







// //    public function optionSelected($id)
// //     {
// //         dd($id);
// //         return  $this->selectedOption ;
// //         // Handle the event triggered by the select input
// //         // You can access the selected option using $this->selectedOption
// //     }

// public function optionSelected($formateurId)
// {
//     $this->selectedOption = $formateurId;
//     // dd($formateurId);

// }
//     public function render()
//     {
//             // data for  model form
//             $establishment_id = session()->get('establishment_id');
//             $groups = group::where('establishment_id', $establishment_id)->get();
//             // $groups = [];

//             // if ($this->selectedOption) {
//             //     $establishment_id = session()->get('establishment_id');
//             //     $groups = DB::table('groups')
//             //         ->select('groups.group_name')
//             //         ->join('formateur_has_groups', 'formateur_has_groups.formateur_id', '=', $this->selectedOption)
//             //         ->where('formateur_has_groups.establishment_id', $establishment_id)
//             //         ->get();
//             // }

//             $modules = module::where('establishment_id', $establishment_id)->get();
//             $salles = class_room::where('id_establishment', $establishment_id)->get();
//             $formateurs = user::where('establishment_id', $establishment_id)
//                               ->where('role', 'formateur')
//                               ->where('status', 'active')->get();
//             $classType = class_room_type::where('establishment_id', $establishment_id)->get();

//             $sessions = DB::table('sissions')
//             ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
//             ->join('modules', 'modules.id', '=', 'sissions.module_id')
//             ->join('groups', 'groups.id', '=', 'sissions.group_id')
//             ->join('users', 'users.id', '=', 'sissions.user_id')
//             ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
//             ->where('sissions.establishment_id', $establishment_id)
//             ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
//             ->get();
//         return view('livewire.pour-chaque-formateur' ,[
//         'sissions'=>$sessions,
//         'formateurs' => $formateurs,
//         'groups' => $groups,  // groupes for eash for mateur
//         'modules' => $modules, //should return models for eash formateur
//         'salles' => $salles,
//         'classType' => $classType,
//     ]);

//     }
