<?php

namespace App\Controllers;

use App\Models\NhaXuatBan;



class NhaXuatBanController
{

    public function nhaXuatBanView()
    {
        $breadcrumb = [

            [
                'url' => '/nha-xuat-ban',
                'name' => "Nhà xuất bản"
            ],
        ];
        $nhaXuatBanModel = new NhaXuatBan();
        $ds_nxb = $nhaXuatBanModel->all();
        return view('nha_xuat_ban', [
            'breadcrumb' => $breadcrumb,
            'ds_nxb' => $ds_nxb
        ]);
    }
    public function create()
    {

        $requires = ['ten_nxb', 'dia_chi', 'email', 'thong_tin_nguoi_dai_dien'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu nhà xuất bản";
            post_to_session();
            redirect('/nha-xuat-ban');
            exit;
        }
        $nhaXuatBanModel = new NhaXuatBan();
        $ma_nxb =  $nhaXuatBanModel->insert($_POST);
        if (empty($ma_nxb)) {
            $_SESSION['err'] = "Lỗi tạo nhà xuất bản!";
            post_to_session();
            redirect('/nha-xuat-ban');
            exit;
        };
        $_SESSION['msg'] = "Tạo nhà xuất bản thành công!";
        redirect('/nha-xuat-ban');
        exit;
    }
    public function edit($ma_nxb)
    {
        $breadcrumb = [
            [
                'url' => '/nha-xuat-ban',
                'name' => "Nhà xuất bản"
            ],
            [
                'url' => "/nha-xuat-ban/edit/$ma_nxb",
                'name' => "Chỉnh sửa"
            ],
        ];
        $nhaXuatBanModel = new NhaXuatBan();
        $nxb = $nhaXuatBanModel->findOne($ma_nxb);
        return view('nha_xuat_ban.edit', [
            'breadcrumb' => $breadcrumb,
            'nxb' => $nxb
        ]);
    }
    public function update($ma_nxb)
    {
        $nhaXuatBanModel = new NhaXuatBan();
        $requires = ['ten_nxb', 'dia_chi', 'email', 'thong_tin_nguoi_dai_dien'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu nhà xuất bản";
            post_to_session();
            redirect("/nha-xuat-ban/edit/$ma_nxb");
            exit;
        }
        $nhaXuatBanModel->updateOne($ma_nxb, $_POST);
        $_SESSION['msg'] = "Cập nhật nhà xuất bản thành công!";
        redirect('/nha-xuat-ban');
        exit;
    }
    public function destroy($ma_nxb)
    {
        $nhaXuatBanModel = new NhaXuatBan();

        $nhaXuatBanModel->deleteOne($ma_nxb);
        $_SESSION['msg'] = "Xóa nhà xuất bản thành công!";
        redirect('/nha-xuat-ban');
        exit;
    }
}
