<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\main_emploi;
use Illuminate\Support\Facades\DB;
use App\Models\group;
use App\Models\user;
use App\Models\module;
use App\Models\class_room;
use App\Models\class_room_type;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ToutEmplois extends Component
{
    use LivewireAlert;
    public $idMainEmploi;
    public $sissions ;
    public $selectedValue ;
    public $selectedType;
    public $receivedVariable;

    protected $listeners = ['UpdateSession', 'dataDeleted'];
    public function UpdateSession()
    {
    
    $establishment_id = session()->get('establishment_id');
    $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', Session::get('idEmploiSelected'))
        ->get();
        $this->sissions = $sissions;
        // Handle data update event
        // For example, update any relevant UI or data
    }

    public function dataDeleted()
    {
        // Handle data delete event
        // For example, update any relevant UI or data
    }



    public function updateSelectedtype(){
        return $this->selectedType ;
     }


        public function mount()
    {
        $establishment_id = Session::get('establishment_id');
        // $this->selectedValue = Session::get('id_main_emploi');
        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', Session::get('id_main_emploi'))
        ->get();
        $this->sissions=$sissions;
    }


    // catch date are selected from  the  tout_emplois blade
    public function updateSelectedMainEmploi()
    {


        return $this->selectedValue;
    }


    public function deleteAllSessions(){

        DB::table('sissions')->where('establishment_id', session()->get('establishment_id'))
        ->where('main_emploi_id', $this->updateSelectedMainEmploi())->delete();
        DB::table('main_emploi')->where('establishment_id', session()->get('establishment_id'))
        ->where('id', $this->updateSelectedMainEmploi())->delete();
       $this->Alert("success","Vous avez supprimé l'emploi du template.", [
        'position' => 'center',
        'timer' => 12000,
        'toast' => false,
        'width' =>650,
       ]);
        return redirect()->route('toutlesEmploi');

    }




    public function render(){

        $groups =[];
        $formateurs = [];
        $establishment_id = Session::get('establishment_id');

        // $Main_emploi we use it for diplay dateStart emploi
        $Main_emplois =  DB::table('main_emploi')->select('*')->where('establishment_id', $establishment_id)->orderBy('datestart')->get();
        $modules = module::where('establishment_id', $establishment_id)->get();
        $salles = class_room::where('id_establishment', $establishment_id)->get();
        $formateurs = user::where('establishment_id', $establishment_id)
                          ->where('role', 'formateur')->get();
        $classType = class_room_type::where('establishment_id', $establishment_id)->get();


        if($this->updateSelectedtype() === 'group'){
            $groups = group::where('establishment_id', $establishment_id)->get();
        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', !empty( $this->updateSelectedMainEmploi()) ? $this->updateSelectedMainEmploi() : Session::get('id_main_emploi'))
        ->get();
        $this->sissions=$sissions;
            return view('livewire.tout-emplois', ['modules'=>$modules,
            'salles'=>$salles,
            'classType'=>$classType,
            'groups' => $groups,
             'Main_emplois' => $Main_emplois ,
             'formateurs'=>$formateurs]);
        }else{

            $formateurs = user::where('establishment_id', $establishment_id)->get();
            $sissions = DB::table('sissions')
            ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
            ->join('modules', 'modules.id', '=', 'sissions.module_id')
            ->join('groups', 'groups.id', '=', 'sissions.group_id')
            ->join('users', 'users.id', '=', 'sissions.user_id')
            ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
            ->where('sissions.establishment_id', $establishment_id)
            ->where('sissions.main_emploi_id', !empty( $this->updateSelectedMainEmploi()) ? $this->updateSelectedMainEmploi() : Session::get('id_main_emploi'))
            ->get();
            $this->sissions=$sissions;
            return view('livewire.tout-emplois', ['groups' => $groups, 'Main_emplois' => $Main_emplois ,'formateurs'=>$formateurs]);
        }

    }
}
