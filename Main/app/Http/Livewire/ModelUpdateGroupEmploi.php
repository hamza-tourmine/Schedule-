<?php
// ModelUpdateGroupEmploi.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\sission;
use Mockery\ReceivedMethodCalls;
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
        $this->receivedVariable = [
            // 'emploidateid' =>null,
            'idcase' => null
        ];
    }

    public function receiveidEmploiid($variable){
        // dd($variable);
         // Access the variable emitted from the event
            $receivedValue = $variable;

            // Perform any necessary operations with the received value
            session(['idEmploiSelected' => $receivedValue]);

        // return $this->receivedVariable['emploidateid'] = $variable;
    }
    public function receiveVariable($variable)
    {
        //  dd($variable);
        // $this->receivedVariable['idcase'] = $variable;
        // return $variable;
        // Access the variable emitted from the event
    $receivedValue = $variable;
    // Perform any necessary operations with the received value
    $this->receivedVariable['idcase'] = $receivedValue;
    // Optionally, you can return the received value
    return $receivedValue;
    }


      public function UpdateSession()
    {
        // $this->data->update([...]);
        //   dd(session()->get('idEmploiSelected'));

        try{
            $day = substr($this->receivedVariable['idcase'], 0, 3);
            $day_part = substr($this->receivedVariable['idcase'], 3, 5);
            $group_id = substr($this->receivedVariable['idcase'], 10);
            $dure_sission = substr($this->receivedVariable['idcase'], 8, 2);
            $session = sission::where([
                'main_emploi_id' => session()->get('idEmploiSelected'),
                'day' => $day,
                'day_part' => $day_part,
                'group_id' => $group_id,
                'dure_sission' => $dure_sission
            ])->get();

            // dd( $session);
            // if ($session) {
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
                // return redirect()->route('toutlesEmploi');
                $this->emit('UpdateSession');
            // }
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

        $day = substr($this->receivedVariable['idcase'], 0, 3);
        $day_part = substr($this->receivedVariable['idcase'], 3, 5);
        $group_id = substr($this->receivedVariable['idcase'], 10);
        $dure_sission = substr($this->receivedVariable['idcase'], 8, 2);
         sission::where([
            'main_emploi_id' => Session::get('idEmploiSelected'),
            'day' => $day,
            'day_part' => $day_part,
            'group_id' => $group_id,
            'dure_sission' => $dure_sission
        ])->delete();
        // return redirect()->route('toutlesEmploi');


    }



    public function render()
    {
        return view('livewire.model-update-group-emploi');
    }
}






