<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\main_emploi;
use Illuminate\Support\Facades\DB;
use App\Models\group;
use App\Models\user;
use App\Models\module;
use App\Models\class_room;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting ;
use App\Models\class_room_type;
use Illuminate\Support\Facades\Session;
use App\Models\sission;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ToutEmplois extends Component
{
    use LivewireAlert;
    public $modules;
    public $salles;
    public $classType;
    public $formateur;
    public $salle;
    public $TypeSesion;
    public $module;
    public $salleclassTyp;
    public $idCase;
    public $group;
    public $FormateurOrgroup;
    // Model
    public $idMainEmploi;
    public $sissions  = [];
    public $formateurs;
    public $selectedValue;//i will sit default value here
    public $selectedType;
    public $groups;
    public $receivedVariable;
    public $Main_emplois;
    public $checkValues ;


    protected $listeners = [
        'receiveidEmploiid'=>'receiveidEmploiid',
        'fresh'=>'$refresh'];


    public function getidCase($variable){
        $this->receivedVariable = $variable;
    }

public function receiveidEmploiid($variable){
     session(['idEmploiSelected' => $variable]);
}


public function UpdateSession()
{
    try {
        $idcase = $this->receivedVariable;
        $day = substr($idcase, 0, 3);
        $day_part = substr($idcase, 3, 5);
        $group_id = substr($idcase, 10);
        $user_id = substr($idcase, 10);
        $dure_sission = substr($idcase, 8, 2);

        $sessionData = [
            'day' => $day,
            'day_part' => $day_part,
            'dure_sission' => $dure_sission,
            'module_id' => $this->module,
            'establishment_id' => session()->get('establishment_id'),
            'class_room_id' => $this->salle,
            'main_emploi_id' => session()->get('idEmploiSelected'),
            'demand_emploi_id' => null,
            'message' => null,
            'sission_type' => $this->TypeSesion,
            'status_sission' => null,
        ];

        if ($this->selectedType === "Group") {
            // for group side
            $sessionData['group_id'] = $group_id;
            $sessionData['user_id'] = $this->formateur;

            $session = sission::where([
                'main_emploi_id' => session()->get('idEmploiSelected'),
                'day' => $day,
                'day_part' => $day_part,
                'group_id' => $group_id,
                'dure_sission' => $dure_sission,
            ])->first();

        } else {
            // for formateur group side
            $sessionData['group_id'] = $this->group;
            $sessionData['user_id'] = $user_id;

            $session = sission::where([
                'main_emploi_id' => session()->get('idEmploiSelected'),
                'day' => $day,
                'day_part' => $day_part,
                'user_id' => $user_id,
                'dure_sission' => $dure_sission,
            ])->first();
        }

        if ($session) {
            $session->update($sessionData);
        } else {
            sission::create($sessionData);
        }

        $this->emit('fresh');
    } catch (\Exception $e) {
        dd($e->getMessage());
    }
}




public function DeleteSession()
{
    $idcase = $this->receivedVariable;
    $day = substr($idcase, 0, 3);
    $day_part = substr($idcase, 3, 5);
    $group_id = substr($idcase, 10);
    $user_id = substr($idcase, 10);
    $dure_sission = substr($idcase, 8, 2);

     if ($this->selectedType === "Group") {
  sission::where([
     'main_emploi_id' => Session::get('idEmploiSelected'),
     'day' => $day,
     'day_part' => $day_part,
     'group_id' => $group_id,
     'dure_sission' => $dure_sission
 ])->delete();
  }else{
    sission::where([
        'main_emploi_id' => Session::get('idEmploiSelected'),
        'day' => $day,
        'day_part' => $day_part,
        'user_id' => $user_id,
        'dure_sission' => $dure_sission
    ])->delete();
  }

}


    // Method to update selected type emploi group or formateur
    public function updateSelectedType($value)
    {
        $this->selectedType = $value;
    }
    // Method to update selected id emploi
    public function updateSelectedIDEmploi($value)
    {

        // dd($this);
        session(['idEmploiSelected' => $value]);
        $this->selectedValue = $value;
    }
    // for delate all sessions
    public function deleteAllSessions(){
        DB::table('sissions')->where('establishment_id', session()->get('establishment_id'))
        ->where('main_emploi_id',  $this->selectedValue)->delete();
        DB::table('main_emploi')->where('establishment_id', session()->get('establishment_id'))
        ->where('id',  $this->selectedValue)->delete();
       $this->Alert("success","Vous avez supprimé l'emploi du template.", [
        'position' => 'center',
        'timer' => 3000,
        'toast' => false,
        'width' =>650,
       ]);
       return redirect('toutlesEmploi');
    }

    public function render()
    {
        $establishment_id = session()->get('establishment_id');
        $this->checkValues = Setting::select('typeSession','module','formateur','salle','typeSalle')
        ->where('userId', Auth::id())->get() ;

        $this->Main_emplois = DB::table('main_emploi')
            ->where('establishment_id', $establishment_id) ->orderBy('datestart')->get();

        $this->modules = Module::where('establishment_id', $establishment_id)->get();
        $this->salles = Class_room::where('id_establishment', $establishment_id)->get();
        $this->classType = Class_room_type::where('establishment_id', $establishment_id)->get();

        $this->sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.*', 'class_rooms.class_name')
        ->leftJoin('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id',  $this->selectedValue)
        ->get();
        $this->groups = group::where('establishment_id', $establishment_id)->get();
        $this->formateurs = user::where(['establishment_id'=> $establishment_id,'role'=>'formateur'])->get();
        return view('livewire.tout-emplois');
    }
}
