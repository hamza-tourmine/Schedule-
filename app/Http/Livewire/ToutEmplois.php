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
    public $FormateurOrgroup;
    // Model
    public $idMainEmploi;
    public $sissions  = [];
    public $formateurs;
    public $selectedValue ;//i will sit default value here
    public $selectedType;
    public $groups;
    public $receivedVariable;
    public $Main_emplois;
    public $checkValues ;


    protected $listeners = ['receiveVariable' => 'receiveVariable','receiveidEmploiid'=>'receiveidEmploiid', 'fresh'=>'$refresh'];

    // receive  id case
    public function receiveVariable($variable)
    {
     //    dd($variable);
        // session(['idCase'=>$variable]);
        $this->receivedVariable = $variable;
    }

public function receiveidEmploiid($variable){
     // $receivedValue = $variable;
     session(['idEmploiSelected' => $variable]);
}


public function UpdateSession()
{
 // dd($this);
  $idcase = $this->receivedVariable;
 // $idcase =  session('idCase');
 try{

     dd($idcase);
     $day = substr( $idcase , 0, 3);
     $day_part = substr( $idcase, 3, 5);
     // if($FormateurOrgroup==='Group'){
         $group_id = substr($idcase, 10);
     // }

     // dd($group_id);
     $dure_sission = substr($idcase, 8, 2);
     $session = sission::where([
         'main_emploi_id' => session()->get('idEmploiSelected'),
         'day' => $day,
         'day_part' => $day_part,
         'group_id' => $group_id,
         'dure_sission' => $dure_sission,
     ])->first();
     // dd($session);
     if($session){
             $session->day = $day;
             $session->day_part = $day_part;
             $session->group_id = $group_id || $this->group;
             $session->dure_sission = $dure_sission;
             $session->module_id = $this->module;
             $session->establishment_id = session()->get('establishment_id');
             $session->user_id = $this->formateur;
             $session->class_room_id = $this->salle;
             $session->main_emploi_id = session()->get('idEmploiSelected');
             $session->demand_emploi_id = null;
             $session->message = null;
             $session->sission_type = $this->TypeSesion;
             $session->status_sission = null;
             $session->validate_date = null;
             $session->save(); //
             $this->emit('fresh');
     }else{
         // dd(substr($idcase,3,5));
         // $idcase =  session()->get('idCase');
          sission::create([
             'day'=>substr($idcase,0,3),
             'day_part'=>substr($idcase,3,5),
             'dure_sission'=>substr($idcase,8,2),
             'module_id'=>$this->module,
             'group_id'=>substr($idcase,10),
             'establishment_id'=>session()->get('establishment_id'),
             'user_id'=>$this->formateur,
             'class_room_id'=>$this->salle,
             'validate_date'=>null,
             'main_emploi_id'=>session()->get('idEmploiSelected'),
             "demand_emploi_id"=>null,
             'message'=>null,
             'sission_type'=>$this->TypeSesion,
             'status_sission'=>null,]);
     }
             // dd($session);
 }catch(\Exception $e){
     dd( $e->getMessage());

 }


}
public function DeleteSession()
{

 // $idcase =  session()->get('idCase');
 $idcase = $this->receivedVariable;
     $day = substr( $idcase , 0, 3);
     $day_part = substr( $idcase, 3, 5);
     $group_id = substr($idcase, 10);
     $dure_sission = substr($idcase, 8, 2);
  sission::where([
     'main_emploi_id' => Session::get('idEmploiSelected'),
     'day' => $day,
     'day_part' => $day_part,
     'group_id' => $group_id,
     'dure_sission' => $dure_sission
 ])->delete();
 return redirect()->route('toutlesEmploi');
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
        // dd($this);
        $establishment_id = session()->get('establishment_id');

        $this->checkValues = Setting::select('typeSession','module','formateur','salle','typeSalle')
        ->where('userId', Auth::id())->get() ;



        $this->Main_emplois = DB::table('main_emploi')
            ->where('establishment_id', $establishment_id) ->orderBy('datestart')->get();

        $this->modules = Module::where('establishment_id', $establishment_id)->get();
        $this->salles = Class_room::where('id_establishment', $establishment_id)->get();
        $this->classType = Class_room_type::where('establishment_id', $establishment_id)->get();

        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->leftJoin('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id',  $this->selectedValue)
        ->get();
        if($this->selectedType === "Group"){
            $this->sissions ;
        }else{
            $this->sissions ;
        }
        // dd($sissions);
        $this->groups = group::where('establishment_id', $establishment_id)->get();
        $this->formateurs = user::where(['establishment_id'=> $establishment_id,'role'=>'formateur'])->get();
        return view('livewire.tout-emplois');
    }
}
