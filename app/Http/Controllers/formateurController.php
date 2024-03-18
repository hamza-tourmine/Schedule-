<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\formateur;
class formateurController extends Controller
{

    public function index()
    {
        return view('adminDashboard.addFormateur.add_formateur');
    }


    public function showHomepage(){
        $id_formateur = session()->get('user_id');
     // Assuming the model name is 'Formateur' and you're looking for a single record.
          $formateur = formateur::select('user_name')->where('id', $id_formateur)->first();

        return view('formateurDashboard.Home.formateur',['formateur'=>$formateur]);
        // return $formateur->user_name ;
    }

    public function show_update_page($id)
    {
        $formateur = formateur::find($id);
       return view('adminDashboard.addFormateur.update_formateur',['formateur'=>$formateur]);

    }

    public function update(Request $request , $id)
    {
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

    public function destroy($id)
    {
        $formateur = formateur::destroy($id);
        if($formateur){
            return redirect()->route('addFormateur')->with(['success'=>'you delete a formateur']) ;
        }

    }
}
