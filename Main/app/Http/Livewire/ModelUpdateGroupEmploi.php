<?php
// ModelUpdateGroupEmploi.php

namespace App\Http\Livewire;

use App\Models\group;
use Livewire\Component;
use App\Models\sission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ModelUpdateGroupEmploi extends Component
{
    use LivewireAlert;
    public $modules;
    public $formateurs;
    public $salles;
    public $classType;
    public $receivedVariable;
    public $formateur;
    public $salle;
    public $TypeSesion;
    public $module;
    public $salleclassTyp;
    public $sissions;

    protected $listeners = ['receiveVariable' => 'receiveVariable','receiveidEmploiid'=>'receiveidEmploiid'];

    public function mount()
    {

    }

    public function receiveidEmploiid($variable){
            $receivedValue = $variable;
            session(['idEmploiSelected' => $receivedValue]);
    }
    // receive  id case
    public function receiveVariable($variable)
    {
    $receivedValue = $variable;
    $this->receivedVariable = $receivedValue;
    return $receivedValue;
    }

      public function UpdateSession()
    {
        try{
            $day = substr($this->receivedVariable, 0, 3);
            $day_part = substr($this->receivedVariable, 3, 5);
            $group_id = substr($this->receivedVariable, 10);
            $dure_sission = substr($this->receivedVariabl, 8, 2);
            $session = sission::where([
                'main_emploi_id' => session()->get('idEmploiSelected'),
                'day' => $day,
                'day_part' => $day_part,
                'group_id' => $group_id,
                'dure_sission' => $dure_sission
            ])->get();
                    $session->day = $day;
                    $session->day_part = $day_part;
                    $session->group_id = $group_id;
                    $session->dure_session = $dure_sission;
                    $session->module_id = $this->module;
                    $session->establishment_id = session()->get('establishment_id');
                    $session->user_id = $this->formateur;
                    $session->class_room_id = $this->salle;
                    $session->main_emploi_id = session()->get('idEmploiSelected');
                    $session->demand_emploi_id = null;
                    $session->message = null;
                    $session->session_type = $this->TypeSesion;
                    $session->status_session = null;
                    $session->validate_date = null;
        }catch(\Exception $e){
            dd($e->getMessage());
        }
            // $this->alert("error", "Vous avez supprimé la seance .", [
            //     'position' => 'center',
            //     'timer' => 1600,
            //     'toast' => false,
            //     'width' =>650,
            //    ]);
        // Emit event to notify parent component

    }
    public function DeleteSession()
    {

        $day = substr($this->receivedVariable, 0, 3);
        $day_part = substr($this->receivedVariable, 3, 5);
        $group_id = substr($this->receivedVariable, 10);
        $dure_sission = substr($this->receivedVariable, 8, 2);
        dd($this->receivedVariable);
        dd( $day .'-'.$day_part.'-'.$group_id.'-'.$dure_sission);
         sission::where([
            'main_emploi_id' => Session::get('idEmploiSelected'),
            'day' => $day,
            'day_part' => $day_part,
            'group_id' => $group_id,
            'dure_sission' => $dure_sission
        ])->delete();
        return redirect()->route('toutlesEmploi');
    }

    public function render()
    {
        $establishment_id = session()->get('establishment_id');
        $groups = group::where('establishment_id', $establishment_id)->get();
        return view('livewire.model-update-group-emploi',['groups'=>$groups]);
    }
}






