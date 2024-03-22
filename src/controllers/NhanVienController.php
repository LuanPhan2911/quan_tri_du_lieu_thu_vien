<?php

namespace App\Controllers;

use App\Models\NhanVien;

class NhanVienController
{

    public function nhanVienView()
    {
        $q = $_GET['q'] ?? '';
        $order = $_GET['order'] ?? 'asc';

        $query = [
            'q' => $q,
            'order' => $order
        ];
        $breadcrumb = [

            [
                'url' => '/nhan-vien',
                'name' => "Nhân viên"
            ],
        ];
        $nhanVienModel = new NhanVien();

        $ds_nv = $nhanVienModel->all($query);
        return view('nhan_vien', [
            'breadcrumb' => $breadcrumb,
            'ds_nv' => $ds_nv,
            'qs' => $query
        ]);
    }
    public function edit($ma)
    {
        $breadcrumb = [

            [
                'url' => '/nhan-vien',
                'name' => "Nhân viên"
            ],
            [
                'url' => "/nhan-vien/edit/$ma",
                'name' => "Chỉnh sửa"
            ],

        ];
        $nhanVienModel = new NhanVien();
        $nhan_vien = $nhanVienModel->findOne($ma);
        return view('nhan_vien.edit', [
            'breadcrumb' => $breadcrumb,
            'nhan_vien' => $nhan_vien
        ]);
    }
    public function update($ma)
    {
        $nhanVienModel = new NhanVien();
        $requires = ['ho_ten', 'ngay_sinh', 'so_dien_thoai'];
        post_to_html_escape();
        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu nhân viên";
            post_to_session();
            redirect("/nhan-vien/edit/$ma");
            exit;
        }
        $nhanVienModel->updateOne($ma, $_POST);
        $_SESSION['msg'] = "Cập nhật nhân viên thành công!";
        redirect('/nhan-vien');
        exit;
    }
    public function destroy($ma)
    {
        $nhanVienModel = new NhanVien();

        $nhanVienModel->deleteOne($ma);
        $_SESSION['msg'] = "Xóa nhân viên thành công!";
        redirect('/nhan-vien');
        exit;
    }
}
