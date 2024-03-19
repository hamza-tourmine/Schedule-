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
}
