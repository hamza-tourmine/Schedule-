<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\group;
use App\Models\module;
use App\Models\formateur_has_group;

class FormateurHasGroup extends Controller
{
    public function displaygroups()
    {
        $establishment_id = session()->get('establishment_id');
        $groups = group::all()->where('establishment_id',$establishment_id);
        return view('formateurDashboard.GroupList',['groups'=>$groups]);
    }

    public function displaymodules(){
        $establishment_id = session()->get('establishment_id');
        $modules = module::all()->where('establishment_id',$establishment_id);
        return view('formateurDashboard.ModuleList',['modules'=>$modules]);
    }

    public function diesplayMyGroups(){

        $establishment_id = session()->get('establishment_id');
        $groups = group::all()->where('establishment_id',$establishment_id);
        $modules = module::all()->where('establishment_id',$establishment_id);
        return view('formateurDashboard.my_groups_Modules',['groupes'=>$groups,'modules'=>$modules]);
    }

    //insert groups that selected by formateur
    public function insertMygroups(Request $request){
        $establishment_id = session()->get('establishment_id');
        $formateur_id = session()->get('user_id');
        foreach($request->group  as $item){
            $formateur_has_group = formateur_has_group::create([
                'establishment_id'=>$establishment_id,
                'group_id' =>$item,
                'formateur_id'=>$formateur_id
            ]);
        }

        // return  $request ;
         return redirect()->back()->with('success','you are  selected you groups successfully');
    }

    public function insertgroups_modules(Request $request){
        return $request ;
    }


    public function insertMyModules(Request $request){
        return $request ;
        
    }
}
