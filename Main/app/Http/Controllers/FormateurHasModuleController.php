<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\module;

class FormateurHasModuleController extends Controller
{
    public function displaymodules(){
        $establishment_id = session()->get('establishment_id');
        $modules = module::all()->where('establishment_id',$establishment_id);
        return view('adminDashboard.ModuleList',['modules'=>$modules]);
    }
    public function insertMyModules(Request $request){
        return $request ;
        
    }
}
