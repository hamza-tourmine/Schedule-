<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\sission;
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
    public $module ;
    public $formateur;
    public $salle ;
    public $dure ;
    public $idCase;
    public $TypeSesion;
    public $group;
    public $receivedVariable;

    protected $listeners = ['receiveVariable' => 'receiveVariable','closeModal'=>'closeModal'];

    public function receiveVariable($variable)
    {
        $this->receivedVariable = $variable;
    }







    protected $rules = [
        'group' => 'required', // Add appropriate validation rules for 'group'
    ];
    public function createSession()
{
    try{

        // $day = substr($request->idCase,0,3);
        $establishment_id = session()->get('establishment_id');
        $sission = sission::create([
            'day'=>substr($this->receivedVariable,0,3),
            'day_part'=>$this->dayPart,
            'dure_sission'=>$this->dure,
            'module_id'=>$this->module,
            'group_id'=>$this->group,
        	'establishment_id'=>$establishment_id,
            'user_id'=>$this->formateur,
            'class_room_id'=>$this->salle,
            'validate_date'=>null,
            'main_emploi_id'=>session()->get('id_main_emploi'),
            "demand_emploi_id"=>null,
            'message'=>null,
            'sission_type'=>$this->TypeSesion,
        	'status_sission'=>null,
        ]);
        // return dd($this);
        if($sission){
          
            return back();
        }



     }catch(\Exception  $e){
        dd($e->getMessage());
     }
        // dd(session());
        return session()->get('id_main_emploi');
    }
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









}
