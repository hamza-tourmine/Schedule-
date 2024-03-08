<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\sission;
use Jantinnerezo\LivewireAlert\LivewireAlert;
class ModalComponent extends Component
{
    use LivewireAlert;
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
        'group' => 'required',
    ];
    public function createSession()
{
    try{
        dd($this);
        $idcase = $this->receivedVariable;
        $sission = sission::create([
            'day'=>substr($idcase,0,3),
            'day_part'=>substr($idcase,3,5),
            'dure_sission'=>substr($idcase,8,2),
            'module_id'=>$this->module,
            'group_id'=>substr($idcase,10),
        	'establishment_id'=>session()->get('establishment_id'),
            'user_id'=>$this->formateur,
            'class_room_id'=>$this->salle,
            'validate_date'=>null,
            'main_emploi_id'=>session()->get('id_main_emploi'),
            "demand_emploi_id"=>null,
            'message'=>null,
            'sission_type'=>$this->TypeSesion,
        	'status_sission'=>null,
        ]);
        if($sission){
            $this->alert('success', 'Vous créez une nouvelle session',[
                'position' => 'center',
                'timer' => 3000,
                'toast' => true,]);
            return redirect()->route('CreateEmploi');
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
            return redirect()->back()->withErrors(['insertion_error' => $e->errorInfo[2]]);
        }
    }

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
