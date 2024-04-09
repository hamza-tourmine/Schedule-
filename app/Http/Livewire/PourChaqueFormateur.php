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
use App\Models\sission ;
use Illuminate\Support\Facades\Auth;
use App\Models\formateur_has_group;
use App\Models\user;
use App\Models\branch;
use App\Models\formateur_has_branche;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class PourChaqueFormateur extends Component
{
    use LivewireAlert;
    public $modulee;
    public $module;
    public $salleclassTyp;
    public $TypeSesion;
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
    public $receivedVariable;
    public $groupID;
    public $moduleID ;
    public $baranches = [] ;
    public $brancheId;
    public $selectedGroups = [];
    protected $listeners = ['receiveVariable' => 'receiveVariable'];
    public $dataEmploi ;

    public function receiveVariable($variable)
    {
        $this->receivedVariable = $variable;

        $this->brancheId = null;
        $this->module = null;
        $this->selectedGroups = [];
        $this->salle = null;
        $this->salleclassTyp = null;
        $this->TypeSesion = null;
    }

    protected $rules = [
        'group' => 'required',
    ];


    public function createSession()
    {

        if (empty($this->selectedGroups) || empty($this->salle) || empty($this->formateurId)) {
            // throw new \Exception('Selected groups, salle, and formateurId must not be empty.');
            $this->alert('error', 'Selected groups, salle, and formateurId must not be empty.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }else{




        try{
            $idcase = $this->receivedVariable;
            foreach($this->selectedGroups as $group) {
            $sission = sission::create([
                'day'=>substr($idcase,0,3),
                'day_part'=>substr($idcase,3,5),
                'dure_sission'=>substr($idcase,8,3),
                'module_id'=> $this->moduleID,
                'group_id'=> $group,
                'establishment_id'=>session()->get('establishment_id'),
                'user_id'=>$this->formateurId,
                'class_room_id'=>$this->salle,
                'validate_date'=>null,
                'main_emploi_id'=>session()->get('id_main_emploi'),
                "demand_emploi_id"=>null,
                'message'=>null,
                'sission_type'=>$this->TypeSesion,
                'status_sission'=>'Accepted',
            ]);
            if($sission){
                $this->alert('success', 'Vous créez une nouvelle session',[
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,]);
                // return redirect()->route('ChaqueFormateur');
            }
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
            }
        }
    }

        }

    public function render()
{
    $this->dataEmploi =DB::table('main_emploi')
        ->where('id', session()->get('id_main_emploi'))->get();
    $establishment_id = session()->get('establishment_id');
    // Load all formateurs
    $this->formateurs = user::where('establishment_id', $establishment_id)
                                ->where('role', 'formateur')
                                ->where('status', 'active')
                                ->get();



    if ($this->formateurId) {

        // $this->modules = module::where('formateur_id', $this->formateurId)->get();
        $this->modules = Module::join('module_has_formateur as MHF', 'MHF.module_id', '=', 'modules.id')
        ->join('groupe_has_modules as GHM', 'GHM.module_id', '=', 'modules.id')
        ->where('modules.establishment_id', $establishment_id)
        ->where('MHF.formateur_id', $this->formateurId)
        ->whereIn('GHM.group_id', $this->selectedGroups)
        ->select('modules.*')
        ->get();


        $this->classType = class_room_type::where('establishment_id', $establishment_id)->get();
        $salles = class_room::where('id_establishment', $establishment_id)->get();

        $sessions = DB::table('sissions')
        ->select('sissions.*', 'modules.id as module_name', 'groups.group_name', 'class_rooms.class_name')
        ->leftJoin('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
        ->get();


        $this->baranches = DB::table('branches')
        ->select('branches.*')
        ->join('formateur_has_filier', 'formateur_has_filier.barnch_id', '=', 'branches.id')
        ->where('formateur_has_filier.formateur_id', $this->formateurId)
        ->get();

        $groupsQuery = Group::join('formateur_has_groups as f', 'f.group_id', '=', 'groups.id')
        ->where('groups.establishment_id', $establishment_id)
        ->where('f.formateur_id', $this->formateurId)
        ->select('groups.id', 'groups.group_name'); // Select ID along with group_name

    // Check if $this->brancheId is set and add the condition if it is
    if ($this->brancheId) {
        $groupsQuery->where('groups.barnch_id', $this->brancheId);
    }

    $groups = $groupsQuery->get();


        $groupsToRemove = [];
        $salleShouldRemove = [];

        foreach ($sessions as $session) {
            $combinedValue = $session->day . $session->day_part . $session->dure_sission;
            if (strtolower($combinedValue) === strtolower($this->receivedVariable)) {
                $groupsToRemove[] = $session->group_id;
                $salleShouldRemove[] = $session->class_room_id;
            }
        }


        $newGroups = [];
        foreach ($groups as $group) {
            if (!in_array($group->id, $groupsToRemove)) {
                $newGroups[] = $group;
            }
        }

        $newSalles = [];
        foreach ($salles as $salle) {
            if (!in_array($salle->id, $salleShouldRemove)) {
                $newSalles[] = $salle;
            }
        }

        $this->groups = $newGroups;
        $this->salles = $newSalles;
        $newSession = [];

        foreach($sessions as $session ){
            if($session->user_id === $this->formateurId){
                $newSession[] = $session ;
            };
        }
        $this->sissions = $newSession;


    } else {
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

}







































































































