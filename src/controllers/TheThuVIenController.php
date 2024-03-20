<?php

namespace App\Controllers;

class TheThuVienController
{

    public function theThuVienView()
    {

        $breadcrumb = [

            [
                'url' => '/the-thu-vien',
                'name' => "Thẻ thư viện"
            ],
        ];
        return view('the_thu_vien', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
