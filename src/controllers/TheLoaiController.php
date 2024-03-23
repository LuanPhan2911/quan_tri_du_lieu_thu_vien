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
            redirect('/the-loai');
            exit;
        }
        $slugGenerator = new SlugGenerator();
        $_POST['slug'] = $slugGenerator->generate($_POST['ten_tl']);
        $theLoaiModel = new TheLoai();
        $ma_tl =  $theLoaiModel->insert($_POST);
        if (empty($ma_tl)) {
            $_SESSION['err'] = "Lỗi thêm thể loại!";
            post_to_session();
            redirect('/the-loai');
            exit;
        };
        $_SESSION['msg'] = "Thêm thể loại thành công!";
        return redirect('/the-loai');
    }
    public function edit($ma)
    {
        $breadcrumb = [
            [
                'url' => '/the-loai',
                'name' => "Thể loại"
            ],
            [
                'url' => "/the-loai/edit/$ma",
                'name' => "Chỉnh sửa"
            ],
        ];
        $theLoaiModel = new TheLoai();
        $the_loai = $theLoaiModel->findOne($ma);
        return view('the_loai.edit', [
            'breadcrumb' => $breadcrumb,
            'the_loai' => $the_loai
        ]);
    }
    public function update($ma)
    {
        $theLoaiModel = new TheLoai();
        $requires = ['ten_tl'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect("/the-loai/edit/$ma");
            exit;
        }
        $theLoaiModel->updateOne($ma, $_POST);
        $_SESSION['msg'] = "Cập nhật thể loại thành công!";
        return redirect('/the-loai');
    }
    public function destroy($ma_tl)
    {
        $theLoaiModel = new TheLoai();
        $sach_count = $theLoaiModel->count_sach($ma_tl);
        if ($sach_count > 0) {
            $_SESSION['err'] = "Có $sach_count sách sử dụng thể loại này, không thể xóa!";
            redirect("/the-loai");
            exit;
        }
        $theLoaiModel->deleteOne($ma_tl);
        $_SESSION['msg'] = "Xóa thể loại thành công!";
        return redirect('/the-loai');
    }
}
