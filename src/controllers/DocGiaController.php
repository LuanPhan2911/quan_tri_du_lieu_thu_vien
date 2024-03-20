<?php

namespace App\Controllers;

class DocGiaController
{

    public function docGiaView()
    {

        $breadcrumb = [

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
