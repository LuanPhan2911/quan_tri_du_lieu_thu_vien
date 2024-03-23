<?php

namespace App\Models;

class MuonTra extends Model
{
    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into muon_tra(so_the,ma_nv)
         values(:so_the,:ma_nv)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function all($q)
    {
        $statement = $this->conn->query("
        select 
        muon_tra.*,
        chi_tiet_muon_tra.*,
        sach.ten_sach,
        doc_gia.ten_dg
        from muon_tra
        join chi_tiet_muon_tra
        on muon_tra.ma_mt = chi_tiet_muon_tra.ma_mt
        join sach
        on chi_tiet_muon_tra.ma_sach=sach.ma_sach
        join doc_gia
        on doc_gia.so_the= muon_tra.so_the
        where
        ten_sach like '%$q%'
        or
        ten_dg like '%$q%'
        order by da_tra asc, ngay_tra desc
        ");

        return $statement->fetchAll();
    }
    public function get()
    {
        $statement = $this->conn->query("
        select 
        muon_tra.*,
        chi_tiet_muon_tra.*,
        sach.ten_sach 
        from muon_tra
        join chi_tiet_muon_tra
        on muon_tra.ma_mt = chi_tiet_muon_tra.ma_mt
        join sach
        on chi_tiet_muon_tra.ma_sach=sach.ma_sach
        ");

        return $statement->fetchAll();
    }

    public function deleteOne($ma)
    {
        return $this->conn->query("delete from muon_tra where ma_mt='$ma'");
    }
}
