<?php

namespace App\Http\Controllers;

class DashboardController extends Controller
{

    public function pageIndex(){
        $title = 'Home';
        $teks = 'anjay';
        return view('v_home',compact('title','teks'));
    }

}
