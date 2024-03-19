<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\group;
use App\Models\branch;
use App\Models\module;
use App\models\group_has_module;
use Illuminate\Support\Facades\DB;

class groupController extends Controller
{
     //show all groups
    public function index(){

        return view('adminDashboard.addGroups.add_groups') ;
    }


    public function displayPageUpdate(){
        $establishment = session()->get('establishment_id');

        $branches = branch::where('establishment_id',$establishment)->get();


        $groupesModules = DB::table('groups')
            ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
            ->join('modules as m', 'm.id' , '=', 'ghm.module_id')
            ->select('m.*', 'groups.*')
            ->where('groups.establishment_id', $establishment)
            ->get();

        $modules = module::where('establishment_id',$establishment)->get();

        $dataGroups = DB::table('groups')
        ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
        ->join('modules as m', 'm.id', '=', 'ghm.module_id')
        ->select('groups.id as group_id', 'groups.group_name', 'groups.year', 'groups.barnch_id', 'm.*')
        ->where('groups.establishment_id', $establishment)
        ->get();

    // Group modules by group_id
    $groups = $dataGroups->groupBy('group_id')->map(function ($group) {
        return view('adminDashboard.addGroups.add_groups') ;
    });
        return view('adminDashboard.addGroups.update_group' , ['group'=>$groups ,'modules'=>$modules , 'groupesModules'=>$groupesModules , 'branches'=>$branches]);
    }

    public function showGroupeWithModules(){
        $establishment = session()->get('establishment_id');
        $groupesModules = DB::table('groups')
            ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
            ->join('modules as m', 'm.id' , '=', 'ghm.module_id')
            ->select('m.*', 'groups.*')
            ->where('groups.establishment_id', $establishment)
            ->get();
        // dd($groupesModules);
        return view('adminDashboard.addGroups.group_has_models' , ['groupesModules'=>$groupesModules]);
    }
}
