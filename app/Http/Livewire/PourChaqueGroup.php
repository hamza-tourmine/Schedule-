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

class PourChaqueGroup extends Component
{
    use LivewireAlert;
    public $modulee;
    public $module;
    public $salleclassTyp;
    public $TypeSesion;
    public $group;

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
    public $dataEmploi ;


    protected $listeners = ['receiveVariable' => 'receiveVariable'];

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
                'dure_sission'=>substr($idcase,8,3),
                'module_id'=> $this->moduleID,
                'group_id'=> $this->groupID,
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

        public function render()
        {
            $this->dataEmploi =DB::table('main_emploi')
        ->where('id', session()->get('id_main_emploi'))->get();
        
            $establishment_id = session()->get('establishment_id');
            $this->groups = group::where('establishment_id', $establishment_id)->get();
            $this->checkValues = Setting::select('typeSession','module','formateur','salle','typeSalle')
                ->where('userId', Auth::id())->get();

            if ($this->groupID) {
                // Load all formateurs for the selected group
                $this->formateurs = user::join('formateur_has_groups as FHG', 'FHG.formateur_id', '=', 'users.id')
                    ->where('FHG.group_id', $this->groupID)
                    ->select('users.*')
                    ->get();


                // Load modules for the selected group and formateur
                $this->modules = Module::join('module_has_formateur as MHF', 'MHF.module_id', '=', 'modules.id')
                    ->join('groupe_has_modules as GHM', 'GHM.module_id', '=', 'modules.id')
                    ->where('modules.establishment_id', $establishment_id)
                    ->where('MHF.formateur_id', $this->formateurId)
                    ->where('GHM.group_id', $this->groupID)
                    ->select('modules.*')
                    ->get();

                    // Fetch all sessions for the selected group
                    $sessions = Sission::select('sissions.*', 'modules.id as module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
                    ->leftJoin('modules', 'modules.id', '=', 'sissions.module_id')
                    ->join('groups', 'groups.id', '=', 'sissions.group_id')
                    ->join('users', 'users.id', '=', 'sissions.user_id')
                    ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
                    ->where('sissions.establishment_id', $establishment_id)
                    ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
                    ->get();

                    // Load class room types and available rooms for the establishment
                    $this->classType = class_room_type::where('establishment_id', $establishment_id)->get();
                    $salles = class_room::where('id_establishment', $establishment_id)->get();

                    // Prepare an array of room IDs that should be removed based on session criteria
                    $salleShouldRemove = [];
                    foreach ($sessions as $session) {
                    $combinedValue = $session->day . $session->day_part . $session->dure_sission;

                    if ($combinedValue === substr($this->receivedVariable, 0, 11)) {
                        $salleShouldRemove[] = $session->class_room_id;
                    }
                    }

                    // Filter the available rooms to exclude those that should be removed
                    $newSalles = $salles->reject(function ($salle) use ($salleShouldRemove) {
                    return in_array($salle->id, $salleShouldRemove);
                    });

                    // Assign the filtered rooms to the component property
                    $this->salles = $newSalles;
                    $this->sissions = $sessions;

            } else {
                // If no group is selected, reset data
                $this->modules = [];
                $this->formateurs = [];
                $this->salles = [];
                $this->classType = [];
                $this->sissions = [];
            }

            return view('livewire.pour-chaque-group');
        }



}
