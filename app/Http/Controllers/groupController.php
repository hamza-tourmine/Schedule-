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

    public function GetDataGroupe($id) {
        $establishment = session()->get('establishment_id');
        $dataGroup = DB::table('groups')
            ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
            ->join('modules as m', 'm.id', '=', 'ghm.module_id')
            ->select('m.id as module_id', 'groups.*')
            ->where('groups.establishment_id', $establishment)
            ->where('groups.id', $id)
            ->get();

             // Create a collection
            $collection = collect($dataGroup);
            // Extract common attributes
            $result['group_name'] = $collection->pluck('group_name')->first();
            $result['year'] = $collection->pluck('year')->first();
            $result['id'] = $collection->pluck('id')->first();
            $result['branch_id'] = $collection->pluck('barnch_id')->first();
            // Extract module names
            $modules = $collection->pluck('module_id')->toArray();

            // Map module names to desired format
            $modules = collect($modules)->map(function ($module) {
                // Convert module names to lowercase
                return strtolower($module);
            })->unique()->sort()->values()->toArray();

            // Assign modules to the result array
            $result['modules'] = $modules;
            return response()->json(['data' => $result, 'status'=>200]);
    }



    public function updateGroupes(Request $req , $id)
    {
        $group = Group::find($id);

        if(!$group) {
            return response()->json(['status' => 400, 'message' => 'Group not found']);
        }

        try {
            $data = $req->json()->all();
            $modules = $data['modules_id'];

            $group->modules()->sync($modules);

            return response()->json(['status' => 200, 'message' => 'Group updated successfully']);
        } catch (\Exception $e) {
            // Log the error or return an error response
            return response()->json(['status' => 500, 'message' => 'Error updating group: ' . $e->getMessage()]);
        }
    }



    // public function displayPageUpdate(){
    //     $establishment = session()->get('establishment_id');
    //     $branches = branch::where('establishment_id',$establishment)->get();
    //     $groupesModules = DB::table('groups')
    //         ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
    //         ->join('modules as m', 'm.id' , '=', 'ghm.module_id')
    //         ->select('m.*', 'groups.*')
    //         ->where('groups.establishment_id', $establishment)
    //         ->get();
    //     $modules = module::where('establishment_id',$establishment)->get();
    //     $dataGroups = DB::table('groups')
    //     ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
    //     ->join('modules as m', 'm.id', '=', 'ghm.module_id')
    //     ->select('groups.id as group_id', 'groups.group_name', 'groups.year', 'groups.barnch_id', 'm.*')
    //     ->where('groups.establishment_id', $establishment)
    //     ->get();
    // // Group modules by group_id
    // $groups = $dataGroups->groupBy('group_id')->map(function ($group) {
    //     return view('adminDashboard.addGroups.add_groups') ;
    // });
    //     return view('adminDashboard.addGroups.update_group' , ['group'=>$groups ,'modules'=>$modules , 'groupesModules'=>$groupesModules , 'branches'=>$branches]);
    // }
    // public function showGroupeWithModules(){
    //     $establishment = session()->get('establishment_id');
    //     $groupesModules = DB::table('groups')
    //         ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
    //         ->join('modules as m', 'm.id' , '=', 'ghm.module_id')
    //         ->select('m.*', 'groups.*')
    //         ->where('groups.establishment_id', $establishment)
    //         ->get();
    //     // dd($groupesModules);
    //     return view('adminDashboard.addGroups.group_has_models' , ['groupesModules'=>$groupesModules]);
    // }





    //display page setting
    public function settingView(){
        return view('adminDashboard.setting.setting');
    }

}
