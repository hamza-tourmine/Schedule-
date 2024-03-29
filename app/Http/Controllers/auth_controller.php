<?php

namespace App\Http\Controllers;
use App\Models\user;
use App\Models\establishment;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class auth_controller extends Controller

{
    public function index(){
        return view('auth.create-account');
    }

// create an  account
    public function create_account(Request $request){
        $validatedData = $request->validate([
            'id'=> 'required',
            'user_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role' => 'required',
            'name_establishment' => 'required'
        ]);
        $establishment = Establishment::create([
            'name_establishment' => $validatedData['name_establishment']
        ]);
        $user = User::create([
            'id'=>$validatedData['id'],
            'user_name' => $validatedData['user_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => $validatedData['role'],
            'establishment_id' => $establishment->id // Assigning the establishment's ID to the user's establishment_id
        ]);
        Setting::create([
            'userId'      => $validatedData['id'],
            'typeSession' => false,
            'module'      => false,
            'formateur'   => false,
            'salle'       => false,
            'typeSalle'   => false
        ]);

        if ($user) {
            return redirect()->route('login')->with('success', 'Account created successfully');
        } else {
            return redirect()->route('create-account')->with('error', 'Failed to create account');
        }
    }
// login
public function login(Request $request){
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'role' => 'admin'])) {
        $request->session()->regenerate();
         // store id in session
        $user = auth::user();
        session(['user_name'=>$user->user_name,'user_id'=>$user->id,'establishment_id'=>$user->establishment_id]);
        return redirect()->route('dashboardAdmin');
    } elseif (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password'], 'role' => 'formateur'])) {
        $user = Auth::user();
        if ($user->status == 'active'){
            $request->session()->regenerate();
            // store id in session
            $user = auth::user();
            session(['user_id'=>$user->id,'establishment_id'=>$user->establishment_id]);
            return redirect()->route('dashboard_formateur');
        }else {
            return redirect()->back()->withErrors(['errors'=>'Votre compte est suspendu, veuillez contacter le directeur']);
        }
    } else {
          return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }
}
}
