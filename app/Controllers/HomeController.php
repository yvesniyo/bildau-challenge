<?php

namespace App\Controllers;

class HomeController extends Controller
{

    public function home()
    {


        $this->view("home", ["user" => "yves"]);

        return;
    }
}
