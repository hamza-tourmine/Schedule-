<?php
// ModelUpdateGroupEmploi.php

namespace App\Http\Livewire;

use Livewire\Component;

class ModelUpdateGroupEmploi extends Component
{
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

    public function UpdateSession()
    {
        // Dump data for debugging
        dd([
            'modules' => $this->modules,
            'formateurs' => $this->formateurs,
            'salles' => $this->salles,
            'classType' => $this->classType,
            'receivedVariable' => $this->receivedVariable,
            'formateur' => $this->formateur,
            'salle' => $this->salle,
            'TypeSesion' => $this->TypeSesion,
            'module' => $this->module,
            'salleclassTyp' => $this->salleclassTyp,
        ]);
    }

    public function render()
    {
        return view('livewire.model-update-group-emploi');
    }
}

