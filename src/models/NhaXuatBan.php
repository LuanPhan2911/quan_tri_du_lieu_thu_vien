<?php

namespace App\Models;

class NhaXuatBan extends Model
{


    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into nha_xuat_ban(ten_nxb,dia_chi,email,thong_tin_nguoi_dai_dien)
         values(:ten_nxb,:dia_chi,:email,:thong_tin_nguoi_dai_dien)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function all()
    {
        $statement = $this->conn->query("select * from nha_xuat_ban");
        return $statement->fetchAll();
    }
    public function get()
    {
        $statement = $this->conn->query("select * from nha_xuat_ban");
        return $statement->fetchAll();
    }
    public function findOne($ma)
    {
        $statement = $this->conn->prepare("select * from nha_xuat_ban where ma_nxb=:ma_nxb limit 1");
        $statement->execute([
            'ma_nxb' => $ma
        ]);
        return $statement->fetch();
    }
    public function updateOne($ma, $arr)
    {
        $statement = $this->conn->prepare(
            "update nha_xuat_ban set
            ten_nxb=:ten_nxb,
            dia_chi=:dia_chi,
            email=:email,
            thong_tin_nguoi_dai_dien=:thong_tin_nguoi_dai_dien
            where
            ma_nxb='$ma'
            "
        );
        $statement->execute($arr);
        return $statement->rowCount();
    }
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from nha_xuat_ban where ma_nxb='$ma'");
    }
}
