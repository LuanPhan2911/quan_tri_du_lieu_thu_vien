<?php

namespace App\Controllers;

use App\Models\TheThuVien;

class TheThuVienController
{

    public function theThuVienView()
    {

        $breadcrumb = [

            [
                'url' => '/the-thu-vien',
                'name' => "Thẻ thư viện"
            ],
        ];
        $theThuVienModel = new TheThuVien();
        $ds_ttv = $theThuVienModel->all();
        return view('the_thu_vien', [
            'breadcrumb' => $breadcrumb,
            'ds_ttv' => $ds_ttv
        ]);
    }
    public function create()
    {

        $requires = ['ngay_bat_dau', 'ngay_het_han'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect('/the-thu-vien');
            exit;
        }
        $theThuVienModel = new TheThuVien();
        $ma =  $theThuVienModel->insert($_POST);
        if (empty($ma)) {
            $_SESSION['err'] = "Lỗi thêm thẻ thư viện!";
            post_to_session();
            redirect('/the-thu-vien');
            exit;
        };
        $_SESSION['msg'] = "Thêm thẻ thư viện thành công!";
        redirect('/the-thu-vien');
    }
    public function edit($ma)
    {
        $breadcrumb = [

            [
                'url' => '/the-thu-vien',
                'name' => "Thẻ thư viện"
            ],
            [
                'url' => "/the-thu-vien/edit/$ma",
                'name' => "Chỉnh sửa"
            ],

        ];
        $theThuVienModel = new TheThuVien();
        $ttv = $theThuVienModel->findOne($ma);
        return view('the_thu_vien.edit', [
            'breadcrumb' => $breadcrumb,
            'ttv' => $ttv
        ]);
    }
    public function update($ma)
    {
        $theThuVienModel = new TheThuVien();
        $requires = ['ngay_bat_dau', 'ngay_het_han'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect("/the-thu-vien/edit/$ma");
            exit;
        }
        $theThuVienModel->updateOne($ma, $_POST);
        $_SESSION['msg'] = "Cập nhật thẻ thư viện thành công!";
        return redirect('/the-thu-vien');
    }
    public function destroy($ma)
    {
        $theThuVienModel = new TheThuVien();

        $theThuVienModel->deleteOne($ma);
        $_SESSION['msg'] = "Xóa thẻ thư viện thành công!";
        redirect('/the-thu-vien');
    }
}
