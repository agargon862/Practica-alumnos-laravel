<?php
namespace App\Http\Controllers;

use App\Models\Alumno;          
use Illuminate\Http\Request;      
use Illuminate\View\View;        

class MainController extends Controller
{
    function main(): View 
    {
        $alumnos = Alumno::all();
        return view('main.main', ['alumnos' => $alumnos]);
    }
    function about(): View
    {
        return view('main.about');
    }
}