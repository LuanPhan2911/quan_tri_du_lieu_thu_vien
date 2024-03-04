<?php

namespace App\Controllers;

class NhaXuatBanController
{

    public function nhaXuatBanView()
    {

        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ],
            [
                'url' => '/nha-xuat-ban',
                'name' => "Nhà xuất bản"
            ],
        ];
        return view('nha_xuat_ban', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
