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
        $establishment = session()->get('establishment_id');

        $branches = branch::where('establishment_id',$establishment)->get();
        $groups = Group::select('groups.*', 'branches.*')
        ->join('branches', 'branches.id', '=', 'groups.barnch_id')
        ->where('groups.establishment_id', $establishment)
        ->get();

        $groupesModules = DB::table('groups')
            ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
            ->join('modules as m', 'm.id' , '=', 'ghm.module_id')
            ->select('m.*', 'groups.*')
            ->where('groups.establishment_id', $establishment)
            ->get();

        $modules = module::where('establishment_id',$establishment)->get();

        $dataGroup = DB::table('groups')
        ->join('groupe_has_modules as ghm', 'ghm.group_id', '=', 'groups.id')
        ->join('modules as m', 'm.id' , '=', 'ghm.module_id')
        ->select('m.*', 'groups.*')
        ->where('groups.establishment_id', $establishment)
        ->get();
        dd($dataGroup);

        return view('adminDashboard.addGroups.add_groups',
        ['groups'=>$groups ,
         'groupesModules'=>$groupesModules,
         'branches'=>$branches ,
         'modules'=>$modules
         ]) ;
    }

     // insertv groups
     public function insert_group(Request $request)
     {
         $establishment = session()->get('establishment_id');

         try {
             $group = Group::create([
                 'id' => $establishment . $request->group_name,
                 'group_name' => $request->group_name,
                 'year'       => $request->year,
                 'barnch_id'  => $request->branch,
                 'establishment_id' => $establishment
             ]);

             $modules = $request->modules;

             if ($group && $modules) {
                 foreach ($modules as $module) {
                     // Check if the group has already been assigned this module
                     $isExist = group_has_module::where([
                         'module_id' => $module,
                         'group_id' => $group->id // Use the newly created group's ID here
                     ])->exists();

                     if (!$isExist) {
                        group_has_module::create([
                             'module_id' => $module,
                             'group_id' => $group->id // Use the newly created group's ID here
                         ]);
                     }
                 }

                 return redirect()->back()->with(['success' => 'Vous avez ajouté un nouveau groupe']);
             } else {
                 if ($group) {
                     return redirect()->back()->with(['success' => 'Vous avez ajouté un nouveau groupe']);
                 } else {
                     return redirect()->back()->withErrors(['errors' => 'Il y a eu un problème lors de l\'ajout du groupe']);
                 }
             }
         } catch (\Illuminate\Database\QueryException $e) {
             return redirect()->back()->withErrors(['insertion_error' => $e->errorInfo[2]]);
         }
     }

    //delate groups
    public function delate_group(Request $request){
        $group = group::destroy($request->id);
        if($group){
            return redirect()->route('addGroups')->with(['success'=>'you are delated  group succesfuly']);
        }

    }

    // desplay  page  updaet in the ui
    public function display_update_page($id){

        $group = group::find($id);
        return view('adminDashboard.addGroups.update_group',['group'=>$group]);
    }

    // update  groups
    public function update(Request $request,$id){
               $group =  group::find($id);
               $group->group_name = $request->group_name;
               $group->branch = $request->branch;
               $group->year = $request->year;
               $group->save() ;
               if($group){
                  return redirect()->route('addGroups')->with(['success'=>'you are update group successfulty']);
               }

    }

    // retun view
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
}
