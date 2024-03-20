<?php

namespace App\Controllers;

class TheLoaiController
{

    public function theLoaiView()
    {

        $breadcrumb = [

            [
                'url' => '/the-loai',
                'name' => "Thể loại"
            ],
        ];
        return view('the_loai', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
