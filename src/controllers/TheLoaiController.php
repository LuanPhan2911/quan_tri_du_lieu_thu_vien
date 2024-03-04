<?php

namespace App\Controllers;

class TheLoaiController
{

    public function theLoaiView()
    {

        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ],
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
