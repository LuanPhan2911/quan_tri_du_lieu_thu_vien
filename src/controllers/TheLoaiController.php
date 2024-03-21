<?php

namespace App\Controllers;

use App\Models\TheLoai;
use Ausi\SlugGenerator\SlugGenerator;

class TheLoaiController
{

    public function theLoaiView()
    {

        $breadcrumb = [

            [
                'url' => '/the-loai',
                'name' => "Thể loại"
            ],
        ];
        $theLoaiModel = new TheLoai();
        $ds_tl = $theLoaiModel->all();
        return view('the_loai', [
            'breadcrumb' => $breadcrumb,
            'ds_tl' => $ds_tl
        ]);
    }
    public function create()
    {
        $requires = ['ten_tl',];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu thể loại";
            post_to_session();
            return redirect('/the-loai');
        }
        $slugGenerator = new SlugGenerator();
        $_POST['slug'] = $slugGenerator->generate($_POST['ten_tl']);
        $theLoaiModel = new TheLoai();
        $ma_tl =  $theLoaiModel->insert($_POST);
        if (empty($ma_tl)) {
            $_SESSION['err'] = "Lỗi thêm thể loại!";
            post_to_session();
            return redirect('/the-loai');
        };
        $_SESSION['msg'] = "Thêm thể loại thành công!";
        return redirect('/the-loai');
    }
    public function destroy($ma_tl)
    {
        $theLoaiModel = new TheLoai();
        $theLoaiModel->deleteOne($ma_tl);
        $_SESSION['msg'] = "Xóa thể loại thành công!";
        return redirect('/the-loai');
    }
}
