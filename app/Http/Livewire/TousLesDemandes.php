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

use function PHPUnit\Framework\isEmpty;

class TousLesDemandes extends Component
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
    public $groupes = [] ;
    public $selectedGroups ;
    public $brancheId;
    public $baranches;
    public $Group_has_formateurs;
    public $yearFilter = [];
    public $selectedYear ;
    public $SearchValue;
    public $formateurId;
    public $groupID;


    protected $listeners = [
        'receiveidEmploiid'=>'receiveidEmploiid',
        'fresh'=>'$refresh'];

        public function mount()
        {
            // Fetch the last emploi from the database
            $lastEmploi = main_emploi::latest()->first();

            // Set the default value for selectedValue
            $this->selectedValue = $lastEmploi->id;
        }
    public function getidCase($variable){
        $this->receivedVariable = $variable;
        $this->selectedGroups = [];
         $this->brancheId = null;
         $this->formateur = null ;

    }

// NEWADD
public $isCaseEmpty = true;

    public function updateCaseStatus($isEmpty, $variable)
    {
        $this->isCaseEmpty = $isEmpty;
        $this->receivedVariable = $variable;
        $this->formateurId =substr($variable , 11);
        $this->brancheId = null;
        $this->formateur = null;
        $this->selectedGroups = [];
        $this->selectedYear = null;
        $this->salle = null;
        $this->module = null;
        $this->salleclassTyp = null;
        $this->TypeSesion = null;
    }






    public function Canceled()
    {
        $idcase = $this->receivedVariable;
        $day = substr($idcase, 0, 3);
        $day_part = substr($idcase, 3, 5);
        $group_id = substr($idcase, 11);
        $user_id = substr($idcase, 11);
        $dure_sission = substr($idcase, 8, 3);
        if (is_numeric($user_id)) {

            $session = sission::where([
                'main_emploi_id' => $this->selectedValue,
                'day' => $day,
                'day_part' => $day_part,
                'user_id' => $this->formateurId,
                'dure_sission' => $dure_sission,
            ])->first(); // Use first() to get a single instance
        }else{
            $session = sission::where([
                'main_emploi_id' => $this->selectedValue,
                'day' => $day,
                'day_part' => $day_part,
                'group_id' => $group_id,
                'dure_sission' => $dure_sission,
            ])->first();
        }

        if ($session) {
            $session->status_sission = 'Cancelled';
            $session->save();
            $this->alert('success', 'Session Cancelled successfully.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        } else {
            $this->alert('error', 'Session not found.', [
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,
            ]);
        }
    }

    public function Accepte()
{
    $idcase = $this->receivedVariable;
    $day = substr($idcase, 0, 3);
    $day_part = substr($idcase, 3, 5);
    $dure_sission = substr($idcase, 8, 3);
    $group_id = substr($idcase, 11);
    $user_id = substr($idcase, 11);

    if (is_numeric($user_id)) {
        $session = sission::where([
            'main_emploi_id' => $this->selectedValue,
            'day' => $day,
            'day_part' => $day_part,
            'user_id' => $this->formateurId,
            'dure_sission' => $dure_sission,
        ])->first();
    }else{

        $session = sission::where([
            'main_emploi_id' => $this->selectedValue,
            'day' => $day,
            'day_part' => $day_part,
            'group_id' => $group_id,
            'dure_sission' => $dure_sission,
        ])->first(); // Use first() to get a single instance
    }

    if ($session) {
        $session->status_sission = 'Accepted';
        $session->save();
        $this->alert('success', 'Session accepted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    } else {
        $this->alert('error', 'Session not found.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);
    }
}
//--------------------------------------------------------------- NEWADD

public function receiveidEmploiid($variable){
     session(['idEmploiSelected' => $variable]);
}

public function UpdateSession()
{
    try {
        $idcase = $this->receivedVariable;
        $day = substr($idcase, 0, 3);
        $day_part = substr($idcase, 3, 5);
        $group_id = substr($idcase, 11);
        $user_id = substr($idcase, 11);
        $dure_sission = substr($idcase, 8, 3);


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
            'status_sission' => 'Accepted',
        ];
        // dd($sessionData);

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
        $this->alert('error', $e->getMessage() , [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);


    }
}


    public function DeleteSession()
    {
        $idcase = $this->receivedVariable;
        $day = substr($idcase, 0, 3);
        $day_part = substr($idcase, 3, 5);
        $group_id = substr($idcase, 11);
        $user_id = substr($idcase, 11);
        $dure_sission = substr($idcase,8,3);

    if ($this->selectedType === "Group") {
    sission::where([
        'main_emploi_id' => session()->get('id_main_emploi'),
        'day' => $day,
        'day_part' => $day_part,
        'group_id' => $group_id,
        'dure_sission' => $dure_sission
    ])->delete();
    }else{
        sission::where([
            'main_emploi_id' => session()->get('id_main_emploi'),
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
        session(['idEmploiSelected' => $value]);
        $this->selectedValue = $value;
    }
    public function findSeance()
{
    $idcase = $this->receivedVariable;
    $day = substr($idcase, 0, 3);
    $day_part = substr($idcase, 3, 5);
    $user_id = substr($idcase, 11);
    $group_id = substr($idcase, 11);
    $dure_sission = substr($idcase, 8, 3);

    $seance = null;

    // Check if $user_id is numeric to determine if it's a formateur ID
    if (is_numeric($user_id)) {
        // Query using user ID
        $seance = sission::where([
            'main_emploi_id' => $this->selectedValue,
            'day' => $day,
            'day_part' => $day_part,
            'user_id' => $user_id,
            'dure_sission' => $dure_sission
        ])->get();
    } else {
        // Query using group ID
        $seance = sission::where([
            'main_emploi_id' => $this->selectedValue,
            'day' => $day,
            'day_part' => $day_part,
            'group_id' => $group_id,
            'dure_sission' => $dure_sission
        ])->get();
    }

    return $seance ?: collect(); // Return an empty collection if $seance is null
}


  // Livewire component method
    public function AccepteAlll($groupID)
    {
        // Find all sessions for the current group and main_emploi
        $sessions = Sission::where([
            'group_id' => $groupID,
            'main_emploi_id' => $this->selectedValue
        ])->get();

        // Update the status of each session to "Accepted"
        foreach ($sessions as $session) {
            $session->status_sission = 'Accepted';
            $session->save();
        }

        // Show a success message
        $this->alert('success', 'All sessions accepted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        // Refresh the page
        $this->render();
    }

    public function AccepteAll($formateurID)
    {
        // Find all sessions for the current formateur and main_emploi
        $sissions = Sission::where([
            'user_id' => $formateurID,
            'main_emploi_id' => $this->selectedValue
        ])->get();

        // Update the status of each session to "Accepted"
        foreach ($sissions as $sission) {
            $sission->status_sission = 'Accepted';
            $sission->save();
        }

        // Show a success message
        $this->alert('success', 'All sessions accepted successfully.', [
            'position' => 'center',
            'timer' => 3000,
            'toast' => true,
        ]);

        // Refresh the page
        $this->render();
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
       return redirect()->route('toutlesEmploi');
    }

    public function render()
    {

        // Initialize variables
        $establishment_id = session()->get('establishment_id');
        $this->yearFilter = DB::table('groups')
        ->where('establishment_id', $establishment_id)
        ->select('year')
        ->distinct()
        ->pluck('year');


        $this->checkValues = Setting::select('typeSession','branch','year','module','formateur','salle','typeSalle')
                            ->where('userId', Auth::id())->get();

        // Fetch data from branches table
        $this->baranches = DB::table('branches')
                        ->select('branches.*')
                        ->join('formateur_has_filier', 'formateur_has_filier.barnch_id', '=', 'branches.id')
                        ->where('formateur_has_filier.formateur_id', substr($this->receivedVariable, 11))
                        ->get();

        // Fetch data related to formateurs
        $allFormateursByGroup = User::select('users.*')
                            ->join('formateur_has_groups as f', 'f.formateur_id', '=', 'users.id')
                            ->where('users.status', '=', 'active')
                            ->where('f.group_id', substr($this->receivedVariable, 11))
                            ->get();

        // Fetch main emploi data
        $this->Main_emplois  = DB::table('main_emploi')
                            ->where('establishment_id', $establishment_id)
                            ->orderBy('datestart', 'desc')
                            ->get();

        // Fetch modules data
      if($this->selectedType !== 'Group'){
                $this->modules = Module::join('module_has_formateur as MHF', 'MHF.module_id', '=', 'modules.id')
                ->join('groupe_has_modules as GHM', 'GHM.module_id', '=', 'modules.id')
                ->where('modules.establishment_id', $establishment_id)
                ->where('MHF.formateur_id', substr($this->receivedVariable, 11))
                ->where('GHM.group_id', $this->group)
                ->select('modules.*')
                ->get();
      }else{
                $this->modules = Module::join('module_has_formateur as MHF', 'MHF.module_id', '=', 'modules.id')
                ->join('groupe_has_modules as GHM', 'GHM.module_id', '=', 'modules.id')
                ->where('modules.establishment_id', $establishment_id)
                ->where('MHF.formateur_id', $this->formateur)
                ->where('GHM.group_id', substr($this->receivedVariable, 11))
                ->select('modules.*')
                ->get();
      }

        // Fetch class rooms data
        $this->salles = Class_room::where('id_establishment', $establishment_id)->get();
        $this->classType = Class_room_type::where('establishment_id', $establishment_id)->get();

        // Fetch sissions data
        $sissions = DB::table('sissions')
                        ->select('sissions.*', 'modules.id as module_name', 'groups.group_name', 'users.*', 'class_rooms.class_name')
                        ->leftJoin('modules', 'modules.id', '=', 'sissions.module_id')
                        ->join('groups', 'groups.id', '=', 'sissions.group_id')
                        ->join('users', 'users.id', '=', 'sissions.user_id')
                        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
                        ->where('sissions.establishment_id', $establishment_id)
                        ->where('sissions.main_emploi_id', $this->selectedValue)
                        ->get();

        // Fetch groups data
        $groupsQuery = Group::join('formateur_has_groups as f', 'f.group_id', '=', 'groups.id')
                        ->where('groups.establishment_id', $establishment_id)
                        ->where('f.formateur_id', substr($this->receivedVariable, 11))
                        ->select('groups.id', 'groups.group_name');

        if ($this->brancheId !== 'Filiére' && $this->brancheId  ) {
            $groupsQuery->where('groups.barnch_id', $this->brancheId);

        }
        if($this->selectedYear !=='année' && $this->selectedYear ){

            $groupsQuery->where('groups.year', "{$this->selectedYear}");
        }

        $this->groupes = $groupsQuery->get();

        // Remove unnecessary data
        $removeSalles = [];
        $removeGroupes = [];
        $removeFormateur = [];

        foreach ($sissions as $session) {
            $combinedValue = $session->day . $session->day_part . $session->dure_sission;
            if ($combinedValue === substr($this->receivedVariable, 0, 11)) {
                $removeFormateur[] = $session->user_id;
                $removeSalles[] = $session->class_room_id;
                $removeGroupes[] = $session->group_id;
            }
        }


        // Filter data
        $this->Group_has_formateurs = $allFormateursByGroup->reject(function($formateur) use ($removeFormateur){
            return in_array($formateur->id , $removeFormateur);
        });

        $this->salles = $this->salles->reject(function ($salle) use ($removeSalles) {
            return in_array($salle->id, $removeSalles);
        });

        $this->groupes = $this->groupes->reject(function ($groupe) use ($removeGroupes) {
            return in_array($groupe->id, $removeGroupes);
        });

        // Fetch additional data
        $this->sissions = $sissions ;
        $this->groups = Group::where('group_name' ,'like','%'.$this->SearchValue.'%')->where('establishment_id', $establishment_id)->get();
        $this->formateurs = User::where('user_name','like','%'.$this->SearchValue.'%')->where(['establishment_id' => $establishment_id, 'role' => 'formateur'])->get();

        // NEWADD
        $allseances = sission::where('main_emploi_id', $this->selectedValue)->get();

        $seance = $this->findSeance()->first();
        // Render view
        return view('livewire.tous-les-demandes',['seance' => $seance,'allseances'=>$allseances]);
    }

  }
