<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// Models
use App\Models\formateur;
use App\Models\establishment;
use App\Models\group;
use Illuminate\Support\Facades\DB;
use App\Models\class_room;
use App\Models\class_room_type;
use App\Models\class_has_type;

use App\Models\user;
use App\Models\main_emploi;

use App\Models\formateur_has_group;

use App\Models\module;
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
        $Formateurs = [];
        $Groups = [] ;
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
       if(!empty($Groups) && !empty($Formateurs)){
         // dd($Groups);
         $this->createGroup($Groups);
         $this->createFormateur($Formateurs);
       }
    }


    // create account  Formateur
    function createFormateur($data){
        // dd($data);
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
                    'matricule'=>$item[19]

            ]);
        }
            return redirect()->route('UploedFileExcelView')->with(['succes'=>'you are add a new formateur']);


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
                [ 'group_name' => $item[8],
                   'branch'=>$item[5],
                   'year'=>$item[2],
                  'establishment_id'=>$establishment
                ]
             );
            }
             if($group){
                  return redirect()->back()->with(['success'=>'vous ete ajoute un nouveux group']);
             }else{
                 return redirect()->back()->withErrors(['errors'=>'there are some thing wrang']); ;
             }
           }catch(\Illuminate\Database\QueryException $e){
            return  redirect()->back()->withErrors(['insertion_error'=>$e->errorInfo[2]]);
           }
    }

    // insert Models 


}
