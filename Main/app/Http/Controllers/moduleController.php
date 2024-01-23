<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\module;

class moduleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $establishment  = session()->get('establishment_id');
        $models = module::all()->where('establishment_id', $establishment );
        return view('adminDashboerd.addModel.add_model' ,['models'=>$models]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $establishment  = session()->get('establishment_id');
        try{
            $model = module::create([
                'module_name'=>$request->module_name,
                'establishment_id'=>$establishment
            ]);
            return  redirect()->back()->with(['success'=>'you createa new model']) ;
        }catch(\Illuminate\database\QueryException $e){
             return redirect()->back()->withErrors(['error'=>$e->errorInfo[2]]);
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function display_update_page($id)
    {
        $model = module::find($id);
        return view('adminDashboerd.addModel.update_model',['model'=>$model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request , $id)
    {
        $model = module::find($id);
        $model->module_name = $request->model_name ;
        $model->save();
        if($model){
            return redirect()->route('addModel')->with(['success'=>'you modefid Model  successfuly']);
        }

    }


    public function destroy($id)
    {
        $modul = module::where('id',$id)->delete();
        if($modul){
            return redirect()->route('addModel')->with(['success'=>'you are delate model successfuly']);
        }

    }

}
