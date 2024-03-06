<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\group;

class groupController extends Controller
{
     //show all groups
    public function index(){
        $establishment = session()->get('establishment_id');
        $groups = group::all()->where('establishment_id',$establishment);
        return view('adminDashboard.addGroups.add_groups',['groups'=>$groups]) ;
    }

     // insertv groups
    public function insert_group(Request $request){
        $establishment = session()->get('establishment_id');
       try{
        $group = group::create(
            [ 'group_name' =>$request->group_name,
               'branch'=>$request->branch,
               'year'=>$request->year,
              'establishment_id'=>$establishment
            ]
         );
         if($group){
              return redirect()->back()->with(['success'=>'vous ete ajoute un nouveux group']);
         }else{
             return redirect()->back()->withErrors(['errors'=>'there are some thing wrang']); ;
         }
       }catch(\Illuminate\Database\QueryException $e){
        return  redirect()->back()->withErrors(['insertion_error'=>$e->errorInfo[2]]);
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
}
