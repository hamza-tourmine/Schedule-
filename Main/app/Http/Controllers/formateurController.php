<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\formateur;
use App\Models\establishment;
use App\Models\group;
use App\Models\module;
use Illuminate\Support\Facades\Crypt;
class formateurController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        $establishment_id = session()->get('establishment_id');
        // $formateurs = formateur::all()->where('id', $establishment_id);
        $formateurs = formateur::select(['id','email', 'password', 'status', 'user_name','establishment_id','passwordClone'])
        ->where('role','formateur')
        ->where('establishment_id',$establishment_id)
        ->get();
        return view('adminDashboard.addFormateur.add_formateur',['formateurs'=>$formateurs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $establishment_id = session()->get('establishment_id');
        $establishment = establishment::select(['name_establishment'])->where('id',$establishment_id)->get();
        // remove spaces and  cut name if have length biger then 5

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

        };
        // email = formateur name + esta name + esta id + randum number
        $email = removeSpaces($request->formateur_name).removeSpaces($establishment[0]->name_establishment ).rand(1,100).$establishment_id.'@ofppt.ma';

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
        $password = generatePassword();
        try{
                $formateur = formateur::create([
                'email'=>$email,
                'passwordClone'=>$password,
                'password'=>bcrypt($password),
                'role'=>'formateur',
                'status'=>'active',
                'user_name'=>$request->formateur_name,
                'establishment_id'=>$establishment_id
                ]);
                if($formateur){
                return redirect()->back()->with(['succes'=>'you are add a new formateur']);

                }
                else{
                    return redirect()->back()->withErrors(['errors'=>'something wrang']);
                }
    }catch(\Illuminate\Database\QueryException $e){
        return  redirect()->back()->withErrors(['insertion_error'=>$e->errorInfo[2]]);
    }

    }
    public function showHomepage(){
        $id_formateur = session()->get('user_id');
     // Assuming the model name is 'Formateur' and you're looking for a single record.
          $formateur = formateur::select('user_name')->where('id', $id_formateur)->first();

        return view('formateurDashboard.Home.formateur',['formateur'=>$formateur]);
        // return $formateur->user_name ;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    //  thes fn  are calling from  user account


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_update_page($id)
    {
        $formateur = formateur::find($id);
       return view('adminDashboard.addFormateur.update_formateur',['formateur'=>$formateur]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        // return $request ;
        $formateur  = formateur::find($id);
        $formateur->user_name =$request->name;
        $formateur->email  =$request->email;
        $formateur->passwordClone =$request->password;
        $formateur->password =bcrypt($request->password);
        $formateur->status =$request->status;
        $formateur->save();
        if($formateur){
            return redirect()->route('addFormateur')->with(['success'=>'you modified  a  formateur']) ;
        }else{
            return redirect()->back()->withErrors(['errors'=>'some thing wrang']);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $formateur = formateur::destroy($id);
        if($formateur){
            return redirect()->route('addFormateur')->with(['success'=>'you delete a formateur']) ;
        }

    }
}
