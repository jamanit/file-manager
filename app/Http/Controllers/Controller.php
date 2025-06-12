<?php

namespace App\Http\Controllers;

abstract class Controller
{
    public function __construct()
    {
        //  
    }

    public function index()
    {
        return view('dashboard.index');
    }
}
