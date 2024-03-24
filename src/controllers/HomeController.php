<?php

namespace App\Controllers;

use App\Models\ChiTietMuonTra;
use App\Models\DocGia;
use App\Models\MuonTra;
use App\Models\NhanVien;
use App\Models\NhaXuatBan;
use App\Models\Sach;
use App\Models\TacGia;

class HomeController
{
    public function homeView()
    {

        $breadcrumb = [];

        $nhanVienModel = new NhanVien();

        $thong_ke_chung = $nhanVienModel->thong_ke_chung();
        return view("home", [
            'breadcrumb' => $breadcrumb,
            'thong_ke_chung' => $thong_ke_chung
        ]);
    }
    public function downloadNhanVienCSV()
    {
        $nhanVienModel = new NhanVien();

        $ds_nv = $nhanVienModel->get();

        echo array_csv_download($ds_nv, "nhan_vien.csv");
    }
    public function downloadDocGiaCSV()
    {
        $docGiaModel = new DocGia();

        $ds_dg = $docGiaModel->get();

        echo array_csv_download($ds_dg, "doc_gia.csv");
    }
    public function downloadSachCSV()
    {
        $sachModel = new Sach();

        $ds_sach = $sachModel->get();

        echo array_csv_download($ds_sach, "sach.csv");
    }
    public function downloadTacGiaCSV()
    {
        $tacGiaModel = new TacGia();

        $ds_tg = $tacGiaModel->get();

        echo array_csv_download($ds_tg, "tac_gia.csv");
    }
    public function downloadNhaXuatBanCSV()
    {
        $nhaXuatBanModel = new NhaXuatBan();

        $ds_nxb = $nhaXuatBanModel->get();

        echo array_csv_download($ds_nxb, "nha_xuat_ban.csv");
    }
    public function downloadMuonTraCSV()
    {
        $muonTraModel = new MuonTra();

        $ds_mt = $muonTraModel->get();

        echo array_csv_download($ds_mt, "muon_tra.csv");
    }
}
