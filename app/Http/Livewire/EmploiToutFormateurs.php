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
use App\Models\Setting;
use Illuminate\Support\Facades\Auth;

use Jantinnerezo\LivewireAlert\LivewireAlert;

class EmploiToutFormateurs extends Component
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
    public $formateurs =[];
    public $salles;
    public $classType;

    // for catche date from  form Module
    public $salleclassTyp;
    public $sissions = [];
    public $module ;
    public $idCase;
    public $TypeSesion;
    public $checkValues ;
    public $baranches;
    public $formateurId;
    public $brancheId ;
    public $groupId ;
    public $selectedGroups = [];

    public $dataEmploi ;
    public $selectedYear  ;
    public $yearFilter = [];
    public $SearchValue;




    protected $listeners = ['receiveVariable' => 'receiveVariable','closeModal'=>'closeModal'];



    public function receiveVariable($variable)
    {

        $this->formateurId =substr($variable , 11);
        $this->receivedVariable = $variable;
        // clean all variable  of modules
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

    public function createSession(){

        try {
            // Validate inputs
            if (empty($this->selectedGroups) || empty($this->salle) || empty($this->formateurId)) {
                // throw new \Exception('Selected groups, salle, and formateurId must not be empty.');
                $this->alert('error', 'Selected groups, salle, and formateurId must not be empty.', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            }else{

                $idcase = $this->receivedVariable;
            foreach($this->selectedGroups as $group) {
                // dd($group);
                $session = sission::create([
                    'day' => substr($idcase, 0, 3),
                    'day_part' => substr($idcase, 3, 5),
                    'dure_sission' => substr($idcase, 8, 3),
                    'module_id' => $this->module,
                    'group_id' => $group,
                    'establishment_id' => session()->get('establishment_id'),
                    'user_id' => $this->formateurId,
                    'class_room_id' => $this->salle,
                    'validate_date' => null,
                    'main_emploi_id' => session()->get('id_main_emploi'),
                    "demand_emploi_id" => null,
                    'message' => null,
                    'sission_type' => $this->TypeSesion,
                    'status_sission' => 'Accepted',
                ]);

                if (!$session) {
                    $this->alert('error', 'Session creation failed for group ID: $group', [
                        'position' => 'center',
                        'timer' => 3000,
                        'toast' => true,
                    ]);
                }
            }

            // Success alert
            $this->alert('success', 'Vous créez une nouvelle session', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);}

            // Reset selectedGroups
            $this->selectedGroups = [];
        } catch (\Illuminate\Database\QueryException $e) {
            // Handle specific database errors
            if (strpos($e->getMessage(), "Column 'main_emploi_id' cannot be null") !== false) {
                $this->alert('error', 'Vous devriez sélectionner la date de début.', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            } elseif (strpos($e->getMessage(), "Column 'user_id' cannot be null") !== false) {
                $this->alert('error', 'Vous devriez sélectionner le formateur.', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            } elseif (strpos($e->getMessage(), "Column 'class_room_id' cannot be null") !== false) {
                $this->alert('error', 'Vous devriez sélectionner la salle.', [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
            } else {
                // Generic error handling
                $this->alert('error', $e->errorInfo[2], [
                    'position' => 'center',
                    'timer' => 3000,
                    'toast' => true,
                ]);
                return redirect()->back()->withErrors(['insertion_error' => $e->errorInfo[2]]);
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            $this->alert('error', $e->getMessage(), [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
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
        $this->dataEmploi =DB::table('main_emploi')
        ->where('id', session()->get('id_main_emploi'))->get();
        // dd($dataEmploi);



        $establishment_id = session()->get('establishment_id');
        $this->yearFilter = DB::table('groups')
        ->where('establishment_id', $establishment_id)
        ->select('year')
        ->distinct()
        ->pluck('year');

        // branches
        $this->baranches = DB::table('branches')
        ->select('branches.*')
        ->join('formateur_has_filier', 'formateur_has_filier.barnch_id', '=', 'branches.id')
        ->where('formateur_has_filier.formateur_id', $this->formateurId)
        ->get();
        // groupes
        $groupsQuery = Group::join('formateur_has_groups as f', 'f.group_id', '=', 'groups.id')
        ->where('groups.establishment_id', $establishment_id)
        ->where('f.formateur_id', $this->formateurId)
        ->select('groups.id', 'groups.group_name'); // Select ID along with group_name

    // Check if $this->brancheId is set and add the condition if it is
      if ($this->brancheId !== 'Filiére' && $this->brancheId) {
            $groupsQuery->where('groups.barnch_id', $this->brancheId);

        }
        if($this->selectedYear !=='année' && $this->selectedYear){

            $groupsQuery->where('groups.year', "{$this->selectedYear}");
        }

    $groups = $groupsQuery->get();
         // data for  model form

        $this->classType = class_room_type::where('establishment_id', $establishment_id)->get();
        // $this->modules = module::where('establishment_id', $establishment_id)->get();
        $salles = class_room::where('id_establishment', $establishment_id)->get();
        $this->modules = Module::join('module_has_formateur as MHF', 'MHF.module_id', '=', 'modules.id')
        ->join('groupe_has_modules as GHM', 'GHM.module_id', '=', 'modules.id')
        ->where('modules.establishment_id', $establishment_id)
        ->where('MHF.formateur_id', $this->formateurId)
        ->whereIn('GHM.group_id', $this->selectedGroups)
        ->select('modules.*')
        ->get();


        $this->formateurs  =  user::where('user_name','like','%'.$this->SearchValue.'%')->where(['establishment_id'=> $establishment_id ,
        'status'=>'active' ,
        'role'=>'formateur'])->get();

        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.id as module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->leftJoin('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
        ->get();


        $groupsToRemove = [];
        $salleShouldRemove = [];

        foreach ($sissions as $session) {
            $combinedValue = $session->day . $session->day_part . $session->dure_sission;
            if ($combinedValue === substr($this->receivedVariable, 0, 11)) {
                $groupsToRemove[] = $session->group_id;
                $salleShouldRemove[] = $session->class_room_id;
            }
        }



        $newSalles = $salles->reject(function ($salle) use ($salleShouldRemove) {
            return in_array($salle->id, $salleShouldRemove);
        });

        $newGroups = [];
        foreach ($groups as $group) {
            if (!in_array($group->id, $groupsToRemove)) {
                $newGroups[] = $group;
            }
        }


        $this->groups = $newGroups;
        $this->sissions = $sissions;
        $this->salles = $newSalles;


        $this->checkValues = Setting::select('typeSession','modeRamadan','module','formateur','salle','typeSalle' ,'year','branch')
        ->where('userId', Auth::id())->get() ;


        return view('livewire.emploi-tout-formateurs');
    }
}
