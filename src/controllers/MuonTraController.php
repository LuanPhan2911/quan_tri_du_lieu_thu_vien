<?php

namespace App\Controllers;

use App\Models\ChiTietMuonTra;
use App\Models\DocGia;
use App\Models\MuonTra;
use App\Models\Sach;

class MuonTraController
{

    public function muonTraView()
    {

        $q = $_GET['q'] ?? '';
        $breadcrumb = [

            [
                'url' => '/muon-tra',
                'name' => "Mượn trả"
            ],
        ];
        $muonTraModel = new MuonTra();

        [
            'data' => $ds_mt,
            'total_page' => $total_page,
            'total_record' => $total_record,
            'page' => $page

        ] = $muonTraModel->paginate($q, 10);


        return view('muon_tra', [
            'breadcrumb' => $breadcrumb,
            'ds_mt' => $ds_mt,
            'total_page' => $total_page,
            'total_record' => $total_record,
            'page' => $page
        ]);
    }
    public function thongKeMuonTra()
    {
        $q = $_GET['type'] ?? 'day';
        $proc = match ($q) {
            'day' => 'muon_tra_trong_ngay',
            'week' => 'muon_tra_trong_tuan',
            'month' => 'muon_tra_trong_thang',
            default => 'muon_tra_trong_ngay'
        };
        $muonTraModel = new MuonTra();
        $data = $muonTraModel->thong_ke_muon_tra($proc);
        echo json_encode([
            'success' => true,
            'data' => $data
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
            redirect('/muon-tra');
            exit;
        }
        $muonTraModel = new MuonTra();
        $chiTietMuontraModel = new ChiTietMuonTra();


        try {
            $muonTraModel->beginTransaction();
            $ma_mt =  $muonTraModel->insert([
                'so_the' => $_POST['so_the'],
                'ma_nv' => ma_nv()
            ]);
            $muonTraModel->commit();

            $chiTietMuontraModel->beginTransaction();
            foreach ($_POST['ds_ma_sach'] as $ma_sach) {
                $chiTietMuontraModel->insert([
                    'ma_mt' => $ma_mt,
                    'ma_sach' => $ma_sach,
                    'ghi_chu' => $_POST['ghi_chu']
                ]);
            }
            $chiTietMuontraModel->commit();
        } catch (\Throwable $th) {
            $muonTraModel->rollback();
            $chiTietMuontraModel->rollback();
            $_SESSION['err'] = "Đăng ký mượn sách thất bại!";
            redirect('/muon-tra');
            exit;
            //throw $th;
        }
        $_SESSION['msg'] = "Đăng ký mượn sách thành công!";
        redirect('/muon-tra');
    }
    public function update($ma_mt, $ma_sach)
    {
        $chiTietMuontraModel = new ChiTietMuonTra();

        $chiTietMuontraModel->updateTraSach($ma_mt, $ma_sach);

        $_SESSION['msg'] = "Trả sách thành công";
        redirect('/muon-tra');
    }
    public function destroy($ma_mt, $ma_sach)
    {
        $muonTraModel = new MuonTra();
        $chiTietMuontraModel = new ChiTietMuonTra();
        $row_affected =   $chiTietMuontraModel->deleteOne($ma_mt, $ma_sach);
        if ($row_affected == 0) {
            $_SESSION['err'] = "Xóa mượn trả sách chỉ được thực hiện khi đã trả sách";
            redirect('/muon-tra');
            exit;
        }
        $count_muon_tra = $muonTraModel->count_muon_tra($ma_mt);
        if ($count_muon_tra == 0) {
            $muonTraModel->deleteOne($ma_mt);
        }
        $_SESSION['msg'] = "Xóa mượn trả sách thành công!";
        redirect('/muon-tra');
    }
}
