<?php

namespace App\Controllers;

class DocGiaController
{

    public function docGiaView()
    {

        $breadcrumb = [
            [
                'url' => '/',
                'name' => "Trang chủ"
            ],
            [
                'url' => '/doc-gia',
                'name' => "Đọc giả"
            ],
        ];
        return view('doc_gia', [
            'breadcrumb' => $breadcrumb
        ]);
    }
}
