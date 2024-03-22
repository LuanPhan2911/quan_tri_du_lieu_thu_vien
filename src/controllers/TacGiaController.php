<?php

namespace App\Controllers;

use App\Models\TacGia;

class TacGiaController
{

    public function tacGiaView()
    {

        $breadcrumb = [

            [
                'url' => '/tac-gia',
                'name' => "Tác giả"
            ],
        ];
        $tacGiaModel = new TacGia();
        $ds_tg = $tacGiaModel->all();
        return view('tac_gia', [
            'breadcrumb' => $breadcrumb,
            'ds_tg' => $ds_tg
        ]);
    }
    public function create()
    {

        $requires = ['ten_tg'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu nhà xuất bản";
            post_to_session();
            return redirect('/tac-gia');
        }
        $tacGiaModel = new TacGia();
        $ma =  $tacGiaModel->insert($_POST);
        if (empty($ma)) {
            $_SESSION['err'] = "Lỗi thêm tác giả!";
            post_to_session();
            return redirect('/tac-gia');
        };
        $_SESSION['msg'] = "Thêm tác giả thành công!";
        return redirect('/tac-gia');
    }
    public function edit($ma_tg)
    {
        $breadcrumb = [

            [
                'url' => '/tac-gia',
                'name' => "Tác giả"
            ],
            [
                'url' => "/tac-gia/edit/$ma_tg",
                'name' => "Chỉnh sửa"
            ],

        ];
        $tacGiaModel = new TacGia();
        $tac_gia = $tacGiaModel->findOne($ma_tg);
        return view('tac_gia.edit', [
            'breadcrumb' => $breadcrumb,
            'tac_gia' => $tac_gia
        ]);
    }
    public function update($ma)
    {
        $tacGiaModel = new TacGia();
        $requires = ['ten_tg'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu tác giả";
            post_to_session();
            return redirect("/tac-gia/edit/$ma");
        }
        $tacGiaModel->updateOne($ma, $_POST);
        $_SESSION['msg'] = "Cập nhật tác giả thành công!";
        return redirect('/tac-gia');
    }
    public function destroy($ma)
    {
        $tacGiaModel = new TacGia();

        $tacGiaModel->deleteOne($ma);
        $_SESSION['msg'] = "Xóa tác giả thành công!";
        return redirect('/tac-gia');
    }
}
