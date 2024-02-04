<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\main_emploi;
use Illuminate\Support\Facades\DB;
use App\Models\group;
use Illuminate\Support\Facades\Session;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class ToutEmplois extends Component
{
    use LivewireAlert;
    public $idMainEmploi;
    public $sissions ;
    public $selectedValue ;
    public $selectedType;
    // public $groups;
    // public $formateur;


    // public function updateSelectedtype(){
    //     if($this->selectedType = 'Formateur'){

    //         // $this->Formateur = DB::table('users')->where('establishment_id', session()->get('establishment_id'))->get();
    //     }
    // }

    public function updateSelectedValue()
    {
        $establishment_id = Session::get('establishment_id');
        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', $this->selectedValue)
        ->get();
        $this->sissions=$sissions;
    }

    public function deleteAllSessions(){

        DB::table('sissions')->where('establishment_id', session()->get('establishment_id'))
        ->where('main_emploi_id', $this->selectedValue)->delete();
        DB::table('main_emploi')->where('establishment_id', session()->get('establishment_id'))
        ->where('id', $this->selectedValue)->delete();
       $this->Alert("success","Vous avez supprimé l'emploi du template.", [
        'position' => 'center',
        'timer' => 12000,
        'toast' => false,
        'width' =>650,
       ]);
        return redirect()->route('CreateEmploi');

    }

    public function mount()
    {
        $establishment_id = Session::get('establishment_id');
        // $this->selectedValue = Session::get('id_main_emploi');
        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', Session::get('id_main_emploi'))
        ->get();
        $this->sissions=$sissions;
    }

    public function render()
    {



        $establishment_id = Session::get('establishment_id');

        $Main_emplois =  DB::table('main_emploi')->select('*')->where('establishment_id', $establishment_id)->orderBy('datestart')->get();
        $groups = group::where('establishment_id', $establishment_id)->get();

        return view('livewire.tout-emplois', ['groups' => $groups, 'Main_emplois' => $Main_emplois]);
    }
}
