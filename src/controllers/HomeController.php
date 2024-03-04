<?php

namespace App\Controllers;

class HomeController
{

    public function homeView()
    {

        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ]
        ];
        return view('home', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
