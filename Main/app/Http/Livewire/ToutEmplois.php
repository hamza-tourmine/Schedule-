<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\main_emploi;
use Illuminate\Support\Facades\DB;
use App\Models\group;
use App\Models\user;
use App\Models\module;
use App\Models\class_room;
use App\Models\class_room_type;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ToutEmplois extends Component
{
    use LivewireAlert;
    public $idMainEmploi;
    public $sissions ;
    public $formateurs;
    public $selectedValue ;
    public $selectedType;
    public $groups;
    public $receivedVariable;

    protected $listeners =['changeEmploiId'=>'$refresh'];



    // Method to update selected type emploi
    public function updateSelectedType($value)
    {
        $this->selectedType = $value;

    }

    // Method to update selected id emploi
    public function updateSelectedIDEmploi($value)
    {
        $this->selectedValue = $value;

    }


    public function deleteAllSessions(){
        DB::table('sissions')->where('establishment_id', session()->get('establishment_id'))
        ->where('main_emploi_id',  $this->selectedValue)->delete();
        DB::table('main_emploi')->where('establishment_id', session()->get('establishment_id'))
        ->where('id',  $this->selectedValue)->delete();
       $this->Alert("success","Vous avez supprimé l'emploi du template.", [
        'position' => 'center',
        'timer' => 12000,
        'toast' => false,
        'width' =>650,
       ]);
        return redirect()->route('toutlesEmploi');
    }

    public function render()
    {
        $establishment_id = Session::get('establishment_id');
        $Main_emplois = DB::table('main_emploi')
            ->where('establishment_id', $establishment_id) ->orderBy('datestart')->get();
        $modules = Module::where('establishment_id', $establishment_id)->get();
        $salles = Class_room::where('id_establishment', $establishment_id)->get();
        $classType = Class_room_type::where('establishment_id', $establishment_id)->get();

        $session =  DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->leftJoin('groups', 'groups.id', '=', 'sissions.group_id') // Use leftJoin to include NULL values
        ->leftJoin('users', 'users.id', '=', 'sissions.user_id')
        ->leftJoin('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', $this->selectedValue)
        ->get();


        if ($this->selectedType === 'Group') {
            $this->groups = group::where('establishment_id', $establishment_id)->get();
            $this->sissions = $session;

        }else{
            $this->formateurs = user::where(['establishment_id'=> $establishment_id,'role'=>'formateur'])->get();
            $this->sissions = $session;
        }

        return view('livewire.tout-emplois', [
            'modules' => $modules,
            'salles' => $salles,
            'classType' => $classType,
            'Main_emplois' => $Main_emplois,
        ]);
    }



}
