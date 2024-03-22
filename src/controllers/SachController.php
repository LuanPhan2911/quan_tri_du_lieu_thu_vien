<?php

namespace App\Controllers;

use App\Models\NhaXuatBan;
use App\Models\Sach;
use App\Models\TacGia;
use App\Models\TheLoai;
use Ausi\SlugGenerator\SlugGenerator;

class SachController
{

    public function sachView()
    {
        $q = $_GET['q'] ?? '';

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
        $theLoaiModel = new TheLoai();
        $nhaXuatbanModel = new NhaXuatBan();
        $tacGiaModel = new TacGia();
        $sachModel = new Sach();

        $ds_tg = $tacGiaModel->get();
        $ds_nxb = $nhaXuatbanModel->get();
        $ds_tl = $theLoaiModel->get();

        $ds_sach = $sachModel->all($q);
        return view('sach', [
            'breadcrumb' => $breadcrumb,
            'ds_tg' => $ds_tg,
            'ds_nxb' => $ds_nxb,
            'ds_tl' => $ds_tl,
            'ds_sach' => $ds_sach
        ]);
    }
    public function create()
    {
        $requires = ['ten_sach', 'nam_xuat_ban', 'ma_tg', 'ma_nxb', 'ma_tl'];
        post_to_html_escape();
        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect('/sach');
            exit;
        }
        $hinh_anh = $_FILES['hinh_anh'];
        $path = upload_file($hinh_anh, "sach/");
        $_POST['hinh_anh'] = $path;

        $slugGenerate = new SlugGenerator();
        $_POST['slug'] = $slugGenerate->generate($_POST['ten_sach']);
        $sachModel = new Sach();
        $ma =  $sachModel->insert($_POST);
        if (empty($ma)) {
            $_SESSION['err'] = "Lỗi thêm sách!";
            post_to_session();
            redirect('/sach');
            exit;
        };
        $_SESSION['msg'] = "Thêm sách thành công!";
        return redirect('/sach');
    }
    public function edit($ma)
    {
        $breadcrumb = [

            [
                'url' => '/sach',
                'name' => "Sách"
            ],
            [
                'url' => "/sach/edit/$ma",
                'name' => "Chỉnh sửa"
            ],

        ];
        $sachModel = new Sach();
        $theLoaiModel = new TheLoai();
        $nhaXuatbanModel = new NhaXuatBan();
        $tacGiaModel = new TacGia();
        $sachModel = new Sach();

        $ds_tg = $tacGiaModel->get();
        $ds_nxb = $nhaXuatbanModel->get();
        $ds_tl = $theLoaiModel->get();
        $sach = $sachModel->findOne($ma);
        return view('sach.edit', [
            'breadcrumb' => $breadcrumb,
            'ds_tg' => $ds_tg,
            'ds_nxb' => $ds_nxb,
            'ds_tl' => $ds_tl,
            'sach' => $sach
        ]);
    }
    public function update($ma)
    {
        $sachModel = new Sach();

        $requires = ['ten_sach', 'nam_xuat_ban', 'ma_tg', 'ma_nxb', 'ma_tl', 'hinh_anh'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect("/sach/edit/$ma");
            exit;
        }
        $hinh_anh = $_FILES['hinh_anh'];
        if (is_uploaded_file($hinh_anh['tmp_name'])) {
            $path = upload_file($hinh_anh, "sach/");
            remove_file($_POST['hinh_anh']);
            $_POST['hinh_anh'] = $path;
        }
        $slugGenerate = new SlugGenerator();
        $_POST['slug'] = $slugGenerate->generate($_POST['ten_sach']);

        $sachModel->updateOne($ma, $_POST);
        $_SESSION['msg'] = "Cập nhật sách thành công!";
        return redirect('/sach');
    }
    public function destroy($ma)
    {
        $sachModel = new Sach();
        $sach = $sachModel->findOne($ma);

        remove_file($sach['hinh_anh']);
        $sachModel->deleteOne($ma);
        $_SESSION['msg'] = "Xóa sách thành công!";
        redirect('/sach');
    }
}
