<?php

namespace App\Controllers;

class HomeController
{

    public function homeView()
    {

        $breadcrumb = [];
        return view('home', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
