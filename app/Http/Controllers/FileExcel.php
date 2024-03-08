<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Models
use App\Models\formateur;
use App\Models\establishment;
use App\Models\group;
use App\Models\module;
use Illuminate\Support\Facades\DB;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\class_has_type;
use App\Models\user;
use App\Models\main_emploi;
use App\Models\formateur_has_group;
use App\Models\module_has_formateur;



class FileExcel extends Controller
{
    public function index(){
        return view('adminDashboard.Excel.Uploed');
    }

    // uploed  file and  inserd data into db
    public function upload(Request $req){
        $filePath = $req->file('file')->path();
        $data = file_get_contents($filePath);
        $rows = array_map('str_getcsv', explode("\n", $data));

        $rows = array_slice($rows , 1);
        $Formateurs = [];
        $Groups = []    ;
        $Modules = []   ;
        $ModulesForEashFormateur = [];
        try{
        // Filter Formateur
        foreach ($rows as $row) {
            $found = false;
            foreach ($Formateurs as $item) {
                // Ensure both $row and $item have key '20'
                if (isset($row[20]) && isset($item[20]) && $row[20] === $item[20]) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $Formateurs[] = $row;
            }
        }
        // Filter groups
        foreach($rows as $row){
            $found = false;
            foreach ($Groups as $item) {
                // Ensure both $row and $item have key '20'
                if (isset($row[8]) && isset($item[8]) && $row[8] === $item[8]) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $Groups[] = $row;
            }
        }
        // Filter Modules
        foreach($rows as $row){
            $found = false;
            foreach ($Modules as $item) {
                // Ensure both $row and $item have key '20'
                if (isset($row[17]) && isset($item[17]) && $row[17] === $item[17]) {
                    $found = true;
                    break;
                }
            }
            if (!$found) {
                $Modules[] = $row;
            }
        }


        // dd($rows);

       if(!empty($Groups) && !empty($Formateurs) && !empty($Modules)){
         $this->createModuls($Modules);
         $this->createGroup($Groups);
         $this->createFormateur($Formateurs);
         $this->assigneModuleForEashFormateur($rows);

            // Filter Formateur and hes groupes

       }
    }catch(\Exception $e){
        return redirect()->route('UploedFileExcelView')->withErrors(['errors'=>$e->getMessage()]);
    }
    }


    // create account  Formateur
    function createFormateur($data){
        try{
        $establishment_id = session()->get('establishment_id');
        $establishment = establishment::select(['name_establishment'])->where('id',$establishment_id)->get();
            foreach($data as $item){
                $password = $this->generatePassword();
                $email = $this->removeSpaces($item[20]).$this->removeSpaces($establishment[0]->name_establishment ).rand(1,100).$establishment_id.'@ofppt.ma';
             formateur::create([

                    'email'=>$email,
                    'passwordClone'=>$password,
                    'password'=>bcrypt($password),
                    'role'=>'formateur',
                    'status'=>'active',
                    'user_name'=> $item[20],
                    'establishment_id'=>$establishment_id,
                    'id'=>$item[19]

            ]);
        }
        return redirect()->route('UploedFileExcelView')->with(['succes'=>'you are add a new formateur']);
    }catch(\Illuminate\database\QueryException $e){
        return  redirect()->route('UploedFileExcelView')->withErrors(['errors'=>$e->errorInfo[2]]);
    }

    }
     // generate password
     function generatePassword($length = 8) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomPassword = '';
        for ($i = 0; $i < $length; $i++) {
            $randomPassword .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomPassword;
    }
    // Generate email
    function removeSpaces($Name){

        $lastestaname ="";
        for($i=0 ;$i<strlen($Name) ;$i++){
            if($Name[$i]!=' '){
                $lastestaname .= $Name[$i] ;
            };
        };
        if(strlen($lastestaname)>15){
            return substr($lastestaname ,0,10);
        }else{
            return $lastestaname ;
        }

    }
    // insert groups
    function createGroup($group){
        $establishment = session()->get('establishment_id');
        try{
            foreach($group as $item){
            $group = group::create(
                [   'id'=>$establishment.$item[8],
                    'group_name' => $item[8],
                    'branch'=>$item[5],
                    'year'=>$item[2],
                    'establishment_id'=>$establishment
                ]
             );
            }
             if($group){
                  return redirect()->route('UploedFileExcelView')->with(['success'=>'vous ete ajoute un nouveux group']);
             }else{
                 return redirect()->route('UploedFileExcelView')->withErrors(['errors'=>'there are some thing wrang']); ;
             }
           }catch(\Illuminate\Database\QueryException $e){
            return  redirect()->route('UploedFileExcelView')->withErrors(['errors'=>$e->errorInfo[2]]);
           }
    }
    // insert Models
    function createModuls($moduls){
        $establishment  = session()->get('establishment_id');
        try{
            foreach($moduls as $modul){
                 module::create([
                'id' => $establishment.$modul[16],
                'module_name'=>$modul[17],
                'establishment_id'=>$establishment
                 ]);
        }
            return  redirect()->route('UploedFileExcelView')->with(['success'=>'you createa new module']) ;
        }catch(\Illuminate\database\QueryException $e){
             return redirect()->route('UploedFileExcelView')->withErrors(['errors'=>$e->errorInfo[2]]);
        }
    }

    // assigne  for eash formateur hes models
  function assigneModuleForEashFormateur($rows){
    try{
        $establishment_id = session()->get('establishment_id');
        foreach($rows as $row){
            // Check if module exists before creating the record
                 $group = group::where('id', $establishment_id.$row[8])->first();
            $module = Module::where('id', $establishment_id . $row[16])->first();
            if($module) {

                module_has_formateur::create([
                    'establishment_id' => $establishment_id,
                    'module_id' => $establishment_id . $row[16],
                    'formateur_id' => $row[19],
                ]);

            }elseif($group)
                formateur_has_group::create([
                    'establishment_id' => $establishment_id,
                    'group_id' => $establishment_id.$row[8],
                    'formateur_id' => $row[19],
                ]);
         }
                // $this->assigneGroupsForEashFormateur($rows);
                // Handle the case where the module doesn't exist
                // You can log an error, skip this record, or handle it in a way that fits your application's logic
                // For example:
                // Log::error('Module with ID ' . $establishment_id . $row[16] . ' does not exist.');


    }catch(\Exception $e){
        // dd($e);
    }
    }

    // function assigneGroupsForEashFormateur($rows){
    //    try{
    //     $establishment_id = session()->get('establishment_id');
    //     foreach($rows as $row){
    //         $group = group::where('id', $establishment_id.$row[8])->first();
    //         if($group) {
    //             formateur_has_group::create([
    //                 'establishment_id' => $establishment_id,
    //                 'group_id' => $establishment_id.$row[8],
    //                 'formateur_id' => $row[19],
    //             ]);
    //         } else {
    //             // dd('from  assgine groups  to eash formateur ');
    //             // Handle the case where the group doesn't exist
    //             // You can log an error, skip this record, or handle it in a way that fits your application's logic
    //             // For example:
    //             // Log::error('Group with ID ' . $establishment_id . $row[8] . ' does not exist.');
    //         }
    //     }
    //    }catch(\Exception $e){
    //     dd($e->getMessage());
    //    }
    // }


}
