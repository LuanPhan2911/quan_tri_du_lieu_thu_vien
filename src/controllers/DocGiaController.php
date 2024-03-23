<?php

namespace App\Controllers;

use App\Models\DocGia;
use App\Models\TheThuVien;


class DocGiaController
{

    public function docGiaView()
    {
        $q = $_GET['q'] ?? '';
        $breadcrumb = [

            [
                'url' => '/doc-gia',
                'name' => "Đọc giả"
            ],
        ];
        $docGiaModel = new DocGia();
        $ds_dg = $docGiaModel->all($q);
        return view('doc_gia', [
            'breadcrumb' => $breadcrumb,
            'ds_dg' => $ds_dg
        ]);
    }
    public function create()
    {

        $requires = ['ten_dg', 'dia_chi', 'ngay_bat_dau', 'ngay_het_han'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect('/doc-gia');
            exit;
        }
        try {
            $theThuVienModel = new TheThuVien();
            $theThuVienModel->beginTransaction();
            $so_the = $theThuVienModel->insert([
                'ngay_bat_dau' => $_POST['ngay_bat_dau'],
                'ngay_het_han' => $_POST['ngay_het_han'],
                'ghi_chu' => $_POST['ghi_chu'],
            ]);
            $theThuVienModel->commit();

            $docGiaModel = new DocGia();
            $docGiaModel->beginTransaction();
            $_POST['so_the'] = $so_the;
            $docGiaModel->insert([
                'ten_dg' => $_POST['ten_dg'],
                'dia_chi' => $_POST['dia_chi'],
                'so_the' => $so_the
            ]);
            $docGiaModel->commit();
        } catch (\Throwable $th) {
            $theThuVienModel->rollBack();
            $docGiaModel->rollBack();
            $_SESSION['err'] = "Thêm độc giả thất bại!";
            redirect('/doc-gia');
            exit;
        }

        $_SESSION['msg'] = "Thêm độc giả thành công!";
        redirect('/doc-gia');
    }
    public function edit($ma)
    {
        $breadcrumb = [

            [
                'url' => '/doc-gia',
                'name' => "Độc giả"
            ],
            [
                'url' => "/doc-gia/edit/$ma",
                'name' => "Chỉnh sửa"
            ],

        ];
        $docGiaModel = new DocGia();
        $dg = $docGiaModel->findOne($ma);
        return view('doc_gia.edit', [
            'breadcrumb' => $breadcrumb,
            'dg' => $dg
        ]);
    }
    public function update($ma_dg, $so_the)
    {
        $docGiaModel = new DocGia();
        $theThuVienModel = new TheThuVien();
        $requires = ['ten_dg', 'dia_chi', 'ngay_bat_dau', 'ngay_het_han'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect("/doc-gia/edit/$ma_dg");
            exit;
        }
        try {
            $docGiaModel->beginTransaction();
            $docGiaModel->updateOne($ma_dg, [
                'ten_dg' => $_POST['ten_dg'],
                'dia_chi' => $_POST['dia_chi'],
                'so_the' => $so_the

            ]);
            $docGiaModel->commit();

            $theThuVienModel->beginTransaction();
            $theThuVienModel->updateOne($so_the, [
                'ngay_bat_dau' => $_POST['ngay_bat_dau'],
                'ngay_het_han' => $_POST['ngay_het_han'],
                'ghi_chu' => $_POST['ghi_chu'],
            ]);
            $theThuVienModel->commit();
        } catch (\Throwable $th) {
            $theThuVienModel->rollBack();
            $docGiaModel->rollBack();
            $_SESSION['err'] = "Cập nhật độc giả thất bại!";
            redirect('/doc-gia');
            exit;
        }

        $_SESSION['msg'] = "Cập nhật độc giả thành công!";
        return redirect('/doc-gia');
    }
    public function destroy($ma_dg, $so_the)
    {
        $docGiaModel = new DocGia();
        $theThuVienModel = new TheThuVien();
        $docGiaModel->deleteOne($ma_dg);
        $theThuVienModel->deleteOne($so_the);
        $_SESSION['msg'] = "Xóa độc giả thành công!";
        redirect('/doc-gia');
    }
}
