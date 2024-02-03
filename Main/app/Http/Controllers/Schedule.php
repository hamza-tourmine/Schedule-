<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\main_emploi;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
class Schedule extends Controller
{
    public function index(){
        return  view('adminDashboard.main.main');
    }

    //creating new schadule
    public function createNewSchedule(Request $request){
        //we need to  create  new id for new shadule
        $dateStart = $request->dateStart;
        $initialDate = Carbon::parse($dateStart);
        $numberOfDaysToAdd = 7;
        $modifiedDate = $initialDate->addDays($numberOfDaysToAdd);
        $dateEnd =  $modifiedDate->format('Y-m-d');
        $establishment_id = session()->get('establishment_id');
        try {
            $main_emploi = main_emploi::create([
                'datestart' => $dateStart,
                'dateend' => $dateEnd,
                'establishment_id' => $establishment_id,
            ]);
           if($main_emploi){
            // create a session for last Main emploi created
            $main_emploi_data = DB::table('main_emploi')
            ->select(['id', 'datestart'])
            ->where('establishment_id', $establishment_id)
            ->orderBy('id', 'desc')
            ->limit(1)
            ->first();
            session(['id_main_emploi' => $main_emploi->id,'datestart'=>$main_emploi->datestart]);
            return redirect()->back()->with('success', "Commencez à créer l'emploi du temps maintenant.");
           }
         } catch (\Exception $e) {
            session()->forget('id_main_emploi');
            session()->forget('datestart');
             return redirect()->back()->withErrors(['error' => "select date start"]);
        }
    }

    // return all emploi  created
    public function toutlesEmploi(){
        return view('adminDashboard.Main.toutEmplois');
    }



}
