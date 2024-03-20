<?php

namespace App\Controllers;

class NhanVienController
{

    public function nhanVienView()
    {

        $breadcrumb = [

            [
                'url' => '/nhan-vien',
                'name' => "Nhân viên"
            ],
        ];
        return view('nhan_vien', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
