<?php

namespace App\Controllers;

class NhanVienController
{

    public function nhanVienView()
    {

        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ],
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
