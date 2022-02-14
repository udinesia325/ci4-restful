<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
	session()->set("tes","tesi");
	echo "wes";
        //return view('welcome_message');
    }
    public function coba(){
	echo session()->get("coba");
    }
}
