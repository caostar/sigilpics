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
        $url = $googl->authenticateOnDrive($request);
        
        if($url == 'dashboard')flash('You are now logged in.');

        return redirect($url);
   }
}