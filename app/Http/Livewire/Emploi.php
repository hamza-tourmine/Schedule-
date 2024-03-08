<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\group;
use App\Models\module;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\user;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Emploi extends Component
{
    use LivewireAlert;
    public $modulee;
    public $group;
    public $formateur;
    public $salle ;
    public $salleClasstyp;
    public $dure ;
    public $dayPart;
    public $TypeSession;

    public function AddAutherEmploi(){
        Session::forget('id_main_emploi');
        Session::forget('datestart');
        $this->Alert('success','Maintenant, vous pouvez créer un autre emploi du temps en
        sélectionnant simplement la date de début.', [
            'position' => 'center',
            'timer' => 12000,
            'toast' => false,
            'width' =>650,
           ]);
        return redirect()->route('CreateEmploi');

    }
    public function deleteAllSessions(){

        DB::table('sissions')->where('establishment_id', session()->get('establishment_id'))
        ->where('main_emploi_id', session()->get('id_main_emploi'))->delete();
        DB::table('main_emploi')->where('establishment_id', session()->get('establishment_id'))
        ->where('id', session()->get('id_main_emploi'))->delete();
        $this->Alert('success', "Vous supprimez toutes les séances.", [
            'position' => 'center',
            'timer' => 12000,
            'toast' => false,
            'width' =>650,
           ]);
        Session::forget('id_main_emploi');
        Session::forget('datestart');
        return redirect()->route('CreateEmploi');

    }
    public function render()
    {
         // data for  model form
        $establishment_id = session()->get('establishment_id');
        $groups = group::where('establishment_id', $establishment_id)->get();
        $modules = module::where('establishment_id', $establishment_id)->get();
        $salles = class_room::where('id_establishment', $establishment_id)->get();
        $formateurs = user::where('establishment_id', $establishment_id)
                          ->where('role', 'formateur')
                          ->where('status', 'active')->get();
        $classType = class_room_type::where('establishment_id', $establishment_id)->get();

        $sissions = DB::table('sissions')
        ->select('sissions.*', 'modules.module_name', 'groups.group_name', 'users.user_name', 'class_rooms.class_name')
        ->join('modules', 'modules.id', '=', 'sissions.module_id')
        ->join('groups', 'groups.id', '=', 'sissions.group_id')
        ->join('users', 'users.id', '=', 'sissions.user_id')
        ->join('class_rooms', 'class_rooms.id', '=', 'sissions.class_room_id')
        ->where('sissions.establishment_id', $establishment_id)
        ->where('sissions.main_emploi_id', session()->get('id_main_emploi'))
        ->get();

        return view('livewire.emploi', [
            'sissions'=>$sissions,
            'formateurs' => $formateurs,
            'groups' => $groups,
            'modules' => $modules,
            'salles' => $salles,
            'classType' => $classType,
        ]);
    }
}
