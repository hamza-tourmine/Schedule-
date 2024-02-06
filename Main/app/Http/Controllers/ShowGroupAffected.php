<?php

namespace App\Http\Controllers;
use App\Models\formateur_has_group;
use Illuminate\Http\Request;

class ShowGroupAffected extends Controller
{
    //
    function Show (){
        $GroupsList = formateur_has_group::all();
        return view('formateurDashboard.FormateurGroupe.FormateurGroupeList',['GroupsList'=> $GroupsList]);
    }
}
