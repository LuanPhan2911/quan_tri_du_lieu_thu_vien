<?php

namespace App\Controllers;

class SachController
{

    public function sachView()
    {

        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ],
            [
                'url' => '/sach',
                'name' => "Sách"
            ],
        ];
        return view('sach', [
            'breadcrumb' => $breadcrumb
        ]);
    }
    public function themSachView()
    {
        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ],
            [
                'url' => '/sach',
                'name' => "Sách"
            ],
            [
                'url' => '/sach/them',
                'name' => "Thêm sách"
            ],
        ];
        return view('sach.them_sach', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
