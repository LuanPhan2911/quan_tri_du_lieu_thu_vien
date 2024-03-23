<?php

namespace App\Controllers;

use App\Models\ChiTietMuonTra;
use App\Models\DocGia;
use App\Models\MuonTra;
use App\Models\Sach;

class HomeController
{

    public function homeView()
    {

        $q = $_GET['q'] ?? '';
        $breadcrumb = [];
        $muonTraModel = new MuonTra();

        $ds_mt = $muonTraModel->all($q);


        return view('home', [
            'breadcrumb' => $breadcrumb,
            'ds_mt' => $ds_mt
        ]);
    }
    public function create()
    {
        $breadcrumb = [
            [
                'url' => '/muon-tra',
                'name' => "Mượn trả"
            ],
            [
                'url' => "/muon-tra/create",
                'name' => "Thêm"
            ],
        ];
        $docGiaModel = new DocGia();
        $sachModel = new Sach();

        $ds_dg = $docGiaModel->get();
        $ds_sach = $sachModel->get();
        return view('muon_tra.create', [
            'breadcrumb' => $breadcrumb,
            'ds_dg' => $ds_dg,
            'ds_sach' => $ds_sach
        ]);
    }
    public function store()
    {
        $requires = ['so_the', 'ds_ma_sach'];
        post_to_html_escape();

        if (!require_attribute($requires)) {
            $_SESSION['err'] = "Thiếu trường dữ liệu";
            post_to_session();
            redirect('/');
            exit;
        }
        $muonTraModel = new MuonTra();
        $chiTietMuontraModel = new ChiTietMuonTra();
        $ma_mt =  $muonTraModel->insert([
            'so_the' => $_POST['so_the'],
            'ma_nv' => ma_nv()
        ]);

        foreach ($_POST['ds_ma_sach'] as $ma_sach) {
            $chiTietMuontraModel->insert([
                'ma_mt' => $ma_mt,
                'ma_sach' => $ma_sach,
                'ghi_chu' => $_POST['ghi_chu']
            ]);
        }
        $_SESSION['msg'] = "Đăng ký mượn sách thành công!";
        return redirect('/');
    }
    public function update($ma_mt, $ma_sach)
    {
        $chiTietMuontraModel = new ChiTietMuonTra();

        $chiTietMuontraModel->updateTraSach($ma_mt, $ma_sach);

        $_SESSION['msg'] = "Trả sách thành công";
        return redirect('/');
    }
    public function destroy($ma_mt, $ma_sach)
    {
        $muonTraModel = new MuonTra();
        $chiTietMuontraModel = new ChiTietMuonTra();
        $row_affected =   $chiTietMuontraModel->deleteOne($ma_mt, $ma_sach);
        if ($row_affected == 0) {
            $_SESSION['err'] = "Xóa mượn trả sách chỉ được thực hiện khi đã trả sách";
            redirect("/");
            exit;
        }
        $count_muon_tra = $muonTraModel->count_muon_tra($ma_mt);
        if ($count_muon_tra == 0) {
            $muonTraModel->deleteOne($ma_mt);
        }
        $_SESSION['msg'] = "Xóa mượn trả sách thành công!";
        return redirect('/');
    }
}
