<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontController extends Controller
{
    // Method to handle the /view-page route
    public function viewPage()
    {
        return view('homePage');
    }   

   
}
