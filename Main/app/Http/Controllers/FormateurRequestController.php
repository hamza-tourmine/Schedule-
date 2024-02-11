<?php

namespace App\Http\Controllers;
use App\Models\main_emploi;

class FormateurRequestController extends Controller
{
    function show(){
        $main_emplois = main_emploi::all();
        $daysOfWeek = ["Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi"];
        $daysPart = ["Matin","A.Midi"];
        $seancesPart =["SE1","SE2","SE3","SE4"];
        return view('formateurDashboard.FormateurRequest.Request',
        [
            'main_emplois' => $main_emplois,
            'days_of_week'=>$daysOfWeek,
            'days_part'=>$daysPart,
            'seances_part'=>$seancesPart,
        ]
    );
    }
}
