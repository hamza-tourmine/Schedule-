<?php
namespace App\Http\Livewire;
use Livewire\Component;
class ModalComponent extends Component
{
    // this for create a model

    public $groups;
    public $modules ;
    public $formateurs ;
    public $salles;
    public $classType;
    // for catche date from  form Module
    public $salleclassTyp;
    public $dayPart;
    // public $group;
    public $group;
    public $module ;
    public $formateur;
    public $salle ;
    public $dure ;
    public $idCase;
    public $TypeSesion;

    protected $rules = [
        'group' => 'required',
    ];

    public function mount($group,$modules,$formateurs,$salles,$classType ,$groups)
    {
        $this->group = $group;
        $this->groups =$groups;
        $this->modules =$modules;
        $this->formateurs= $formateurs;
        $this->salles= $salles;
        $this->classType = $classType ;
    }


    public function render()
    {
        return view('livewire.modal-component');
    }

    public function save(){
        dd($this);
    }

}
