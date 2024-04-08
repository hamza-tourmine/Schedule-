<?php
namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class modelSetting extends Controller
{
    public function index()
    {
        return view('adminDashboard.SettingModels.ModelSetting');
    }

    public function createOrUpdate(Request $request)
    {
        try {
            $isExiste = Setting::where('userId', Auth::user()->id)->first();
            if ($isExiste) {
                Setting::where('userId', Auth::user()->id)->update([
                    'typeSession' => $request->input('TypeSeance'),
                    'module'      => $request->input('Module'),
                    'formateur'   => $request->input('Formateur'),
                    'salle'       => $request->input('Salle'),
                    'typeSalle'   => $request->input('TypeSalle'),
                    'branch'      => $request->input('branch')
                ]);
            } else {
                Setting::create([
                    'userId'      => Auth::user()->id,
                    'typeSession' => $request->input('TypeSeance'),
                    'module'      => $request->input('Module'),
                    'formateur'   => $request->input('Formateur'),
                    'salle'       => $request->input('Salle'),
                    'typeSalle'   => $request->input('TypeSalle'),
                    'branch'      =>$request->input('branch')
                ]);
            }

            return response()->json('Settings updated  successfully');
        } catch (\Exception $e) {
            return response()->json($e->getMessage());

            // return response()->json('Failed to update or create settings', 500);
        }
    }

    public function getCheckedValue (){
        $checkValues = Setting::select('typeSession','module','formateur',
        'salle','typeSalle' , 'branch')->where('userId', Auth::user()->id)->get();
        return response()->json($checkValues);
    }

}
