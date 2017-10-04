<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    /**
     * Show the welcome page
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('welcome');
    }

    /**
     * Send quick start form input to user registration
     *
     * @return \Illuminate\Http\Response
     */
    protected function getStarted()
    {
        return redirect()->route('register')->withInput();
    }
}
