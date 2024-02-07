<?php
// ModelUpdateGroupEmploi.php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\sission;
use Mockery\ReceivedMethodCalls;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ModelUpdateGroupEmploi extends Component
{
    use LivewireAlert;
    public $modules;
    public $formateurs;
    public $salles;
    public $classType;
    public $receivedVariable =['emploidateid' => null , 'idcase'=> null];

    public $formateur;
    public $salle;
    public $TypeSesion;
    public $module;
    public $salleclassTyp;





    protected $listeners = ['receiveVariable' => 'receiveVariable','receiveidEmploiid'=>'receiveidEmploiid'];



    public function receiveidEmploiid($variable){
        return $this->receivedVariable['emploidateid'] = $variable;
    }


    public function receiveVariable($variable)
    {
        $this->receivedVariable['idcase'] = $variable;
    }

    public function DeleteSession(){
        dd($this);
        // if(sission::destroy($this->receivedVariable['emploidateid'])){
        //     $this->Alert("success","Vous avez supprimé la seance  .", [
        //         'position' => 'center',
        //         'timer' => 1600,
        //         'toast' => false,
        //         'width' =>650,
        //        ]);
        // }
        // $this->alert('error','Cette séance ne doit pas être supprimée', [
        //     'position' => 'center',
        //     'timer' => 1300,
        //     'toast' => false,
        //     'width' =>650,
        //    ]);
    }


    public function UpdateSession()
    {

        $day =substr($this->receiveidEmploiid,0,3);
        dd($day);
        sission::where('main_emploi_id ',$this->receivedVariable['emploidateid'])->where('day',$day);
    }



    public function render()
    {
        return view('livewire.model-update-group-emploi');
    }
}

