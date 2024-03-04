<?php

namespace App\Controllers;

class TacGiaController
{

    public function tacGiaView()
    {

        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ],
            [
                'url' => '/tac-gia',
                'name' => "Tác giả"
            ],
        ];
        return view('tac_gia', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
