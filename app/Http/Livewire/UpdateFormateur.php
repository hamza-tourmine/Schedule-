<?php

namespace App\Http\Livewire;
use App\Models\formateur;
use App\Models\branch;
use App\Models\group;
use App\Models\module;
use Livewire\Component;

class UpdateFormateur extends Component
{
    // form var
    public $formateur_name;
    public $idFormateur;
    public $selectedBranches = [];
    public $selectedGroupes = [];
    public $selectedModules = [];


    public $formateur;
    public $branches;
    public $groupes;
    public $modules;
    public $productId;
    public $formateurId;

    public function mount()
    {
        $this->formateurId = $this->route()->parameter('id'); // Corrected variable name
    }




    public function update(){
        dd($this);
    }

    // public function mount($parameter)
    // {
    //     // Debugging output to check the parameter
    //     $this->parameter = $parameter;
    // }

    public function render()
    {

            $establishment_id = session()->get('establishment_id');
            // $this->formateur = formateur::find($this->parameter);
            $this->formateur  =  [] ;

            $this->branches = branch::where('establishment_id', $establishment_id)->get();
            $this->groupes = group::where('establishment_id', $establishment_id)->get();
            $this->modules = module::where('establishment_id', $establishment_id)->get();


        return view('livewire.update-formateur');
    }
}
