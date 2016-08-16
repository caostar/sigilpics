<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Googl;

use App\Token;

class HomeController extends Controller
{
    public function index()
    {
        return view('login');
    }


    public function login(Googl $googl, Request $request)
    {
        return redirect($googl->authenticateOnDrive($request));
   }
}