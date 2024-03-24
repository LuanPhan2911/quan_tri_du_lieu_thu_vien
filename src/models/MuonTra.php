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
    public function paginate($q, $limit = 10)
    {
        $page =  htmlspecialchars($_GET['page'] ?? 1);
        $offset = ($page - 1) * $limit;


        $statement = $this->conn->prepare("call 
        phan_trang_muon_tra(:q,:limit,:offset,@total_record,@total_page)
        ");
        $statement->execute([
            'q' => $q,
            'limit' => $limit,
            'offset' => $offset
        ]);
        $data = $statement->fetchAll();
        $statement->closeCursor();
        $total_record = $this->getVar('@total_record');
        $total_page = $this->getVar('@total_page');
        return [
            'data' => $data,
            'total_record' => $total_record,
            'total_page' => $total_page,
            'page' => $page,
        ];
    }
    public function get()
    {
        $statement = $this->conn->query("
        select 
        muon_tra.*,
        chi_tiet_muon_tra.*,
        sach.* 
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
    public function count_muon_tra($ma_mt)
    {
        $statement = $this->conn->query("select count(*) from chi_tiet_muon_tra where ma_mt='$ma_mt'");
        return $statement->fetchColumn();
    }

    public function thong_ke_muon_tra(string $proc)
    {
        $statement = $this->conn->prepare(
            "call $proc(@count_muon,@count_tra)"
        );
        $statement->execute();
        $statement->closeCursor();

        $count_muon = $this->getVar("@count_muon");
        $count_tra = $this->getVar("@count_tra");

        return [
            'count_muon' => $count_muon,
            'count_tra' => $count_tra
        ];
    }
}
