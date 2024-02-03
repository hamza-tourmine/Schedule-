<?php

namespace App\Http\Controllers;

use App\Models\formateur;
use Illuminate\Http\Request;
use App\Models\group;
use App\Models\module;
use App\Models\formateur_has_group;
use App\Models\User;

class FormateurHasGroup extends Controller
{
    public function displaygroups(Request $request)
{
    if ($request->isMethod('post')) {
        // Handle the form submission here
        $establishment_id = session()->get('establishment_id');
        $formateur_id = session()->get('user_id');

        foreach ($request->group as $item) {
            formateur_has_group::create([
                'establishment_id' => $establishment_id,
                'group_id' => $item,
                'formateur_id' => $formateur_id
            ]);
        }

        // Additional logic if needed

        // Redirect or return a response
        return redirect()->back()->with('success', 'Groups assigned successfully');
    }

    // If it's a GET request, display the form
    $establishment_id = session()->get('establishment_id');
    $groups = group::all()->where('establishment_id', $establishment_id);
    $formateurs = User::where('role', 'formateur')->get();

    return view('adminDashboard.affectation.GroupList', ['groups' => $groups, 'formateurs' => $formateurs]);
}


    

    public function diesplayMyGroups(){

        $establishment_id = session()->get('establishment_id');
        $groups = group::all()->where('establishment_id',$establishment_id);
        $modules = module::all()->where('establishment_id',$establishment_id);
        return view('formateurDashboard.my_groups_Modules',['groupes'=>$groups,'modules'=>$modules]);
    }

    //insert groups that selected by formateur
    public function insertMygroups(Request $request){
       

        
    }

    public function insertgroups_modules(Request $request){
        return $request ;
    }


    
}
