<?php

namespace App\Http\Controllers;
use App\Models\module_has_formateur;
use Illuminate\Http\Request;

class ShowModuleAffected extends Controller
{
    //
    function Show (){
        $modulesList = module_has_formateur::all();
        return view('formateurDashboard.FormateurModule.FormateurModuleList',['modulesList'=> $modulesList]);
    }
}
