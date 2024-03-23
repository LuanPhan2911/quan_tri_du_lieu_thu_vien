<?php

namespace App\Models;

class ChiTietMuonTra extends Model
{
    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into chi_tiet_muon_tra(ma_mt,ma_sach,ghi_chu)
         values(:ma_mt,:ma_sach,:ghi_chu)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function findOne($ma_mt)
    {
        $statement = $this->conn->prepare(
            "select * from chi_tiet_muon_tra
            where ma_mt=:ma_mt"
        );
        $statement->execute([
            'ma_mt' => $ma_mt
        ]);
        return $statement->fetch();
    }
    public function updateTraSach($ma_mt, $ma_sach)
    {
        $statement = $this->conn->prepare(
            "
            update chi_tiet_muon_tra set
            da_tra=1,
            ngay_tra=CURDATE()
            where
            ma_mt=:ma_mt
            and
            ma_sach=:ma_sach
            "
        );
        $statement->execute([
            'ma_mt' => $ma_mt,
            'ma_sach' => $ma_sach
        ]);
        return $statement->rowCount();
    }
    public function deleteOne($ma_mt, $ma_sach)
    {
        $statement = $this->conn->query("
        delete from chi_tiet_muon_tra
        where 
        ma_mt='$ma_mt'
        and
        ma_sach='$ma_sach'
        and
        da_tra=1
        ");
        return $statement->rowCount();
    }
}
