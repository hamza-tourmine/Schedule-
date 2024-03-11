<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\sission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\group;
use App\Models\module;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\user;
use App\Models\formateur_has_group;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Emploi extends Component
{
    use LivewireAlert;
    public $modulee;
    public $group;
    public $formateur;
    public $salle ;
    public $salleClasstyp;
    public $dure ;
    public $dayPart;
    public $TypeSession;
    public $receivedVariable;


    public $groups;
    public $modules ;
    public $formateurs ;
    public $salles;
    public $classType;
    // for catche date from  form Module
    public $salleclassTyp;
    public $sissions = [];
    public $module ;
    public $idCase;
    public $TypeSesion;



    protected $listeners = ['receiveVariable' => 'receiveVariable','closeModal'=>'closeModal'];
    public function receiveVariable($variable)
    {
        $this->receivedVariable = $variable;
    }

    protected $rules = [
        'group' => 'required',
    ];
    public function createSession()
{
    try{
        $idcase = $this->receivedVariable;
        $sission = sission::create([
            'day'=>substr($idcase,0,3),
            'day_part'=>substr($idcase,3,5),
            'dure_sission'=>substr($idcase,8,2),
            'module_id'=>$this->module,
            'group_id'=>substr($idcase,10),
        	'establishment_id'=>session()->get('establishment_id'),
            'user_id'=>$this->formateur,
            'class_room_id'=>$this->salle,
            'validate_date'=>null,
            'main_emploi_id'=>session()->get('id_main_emploi'),
            "demand_emploi_id"=>null,
            'message'=>null,
            'sission_type'=>$this->TypeSesion,
        	'status_sission'=>null,
        ]);
        if($sission){
            $this->alert('success', 'Vous créez une nouvelle session',[
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,]);
            return redirect()->route('CreateEmploi');
        }
     }catch (\Illuminate\Database\QueryException $e) {
        if (strpos($e->getMessage(), "Column 'main_emploi_id' cannot be null") !== false) {
            $this->alert('error', 'Vous devriez sélectionner la date de début.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }elseif(strpos($e->getMessage(), "Column 'user_id' cannot be null") !==false){
            $this->alert('error', 'Vous devriez sélectionner le formateur.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
        elseif(strpos($e->getMessage(),"Column 'class_room_id' cannot be null") !==false){
            $this->alert('error', 'Vous devriez sélectionner la salle.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
        else {
            $this->alert('error', $e->errorInfo[2], [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
            return redirect()->back()->withErrors(['insertion_error' => $e->errorInfo[2]]);
        }
    }

    }








    public function AddAutherEmploi(){
        Session::forget('id_main_emploi');
        Session::forget('datestart');
        $this->Alert('success','Maintenant, vous pouvez créer un autre emploi du temps en
        sélectionnant simplement la date de début.', [
            'position' => 'center',
            'timer' => 12000,
            'toast' => false,
            'width' =>650,
           ]);
        return redirect()->route('CreateEmploi');

    }
    public function deleteAllSessions(){

        DB::table('sissions')->where('establishment_id', session()->get('establishment_id'))
        ->where('main_emploi_id', session()->get('id_main_emploi'))->delete();
        DB::table('main_emploi')->where('establishment_id', session()->get('establishment_id'))
        ->where('id', session()->get('id_main_emploi'))->delete();
        $this->Alert('success', "Vous supprimez toutes les séances.", [
            'position' => 'center',
            'timer' => 12000,
            'toast' => false,
            'width' =>650,
           ]);
        Session::forget('id_main_emploi');
        Session::forget('datestart');
        return redirect()->route('CreateEmploi');

    }
    public function render()
    {
         // data for  model form
         $establishment_id = session()->get('establishment_id');
        $this->classType = class_room_type::where('establishment_id', $establishment_id)->get();
        $this->groups = group::where('establishment_id', $establishment_id)->get();
        // $this->modules = module::where('establishment_id', $establishment_id)->get();
        $salles = class_room::where('id_establishment', $establishment_id)->get();

     $this->modules = Module::join('module_has_formateur as mhf', 'modules.id', '=', 'mhf.module_id')
     ->where('mhf.formateur_id', $this->formateur)
     ->get();

        $formateurs =  user::select('users.*')
        ->join('formateur_has_groups as f', 'f.formateur_id', '=', 'users.id')
        ->where('f.establishment_id' , '=' , $establishment_id)
        ->where('users.status' , '=' , 'active')
        ->where('f.group_id', substr($this->receivedVariable,10)) // Select ID along with group_name
        ->get();

        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
        ->get();


        $formateurShouldRemove = [];
        $salleShouldRemove = [];

        foreach ($sissions as $session) {
            $combinedValue = $session->day . $session->day_part . $session->dure_sission;
            if ($combinedValue === substr($this->receivedVariable, 0, 10)) {
                $formateurShouldRemove[] = $session->user_id;
                $salleShouldRemove[] = $session->class_room_id;
            }
        }

        $newFormateurs = $formateurs->reject(function ($formateur) use ($formateurShouldRemove) {
            return in_array($formateur->id, $formateurShouldRemove);
        });

        $newSalles = $salles->reject(function ($salle) use ($salleShouldRemove) {
            return in_array($salle->id, $salleShouldRemove);
        });

        $this->formateurs = $newFormateurs;
        $this->sissions = $sissions;
        $this->salles = $newSalles;


        return view('livewire.emploi');
    }
}
