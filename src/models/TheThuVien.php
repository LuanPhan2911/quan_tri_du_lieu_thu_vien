<?php

namespace App\Models;

class TheThuVien extends Model
{
    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into the_thu_vien(ngay_bat_dau,ngay_het_han,ghi_chu)
         values(:ngay_bat_dau,:ngay_het_han,:ghi_chu)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function all()
    {
        $statement = $this->conn->query("select * from the_thu_vien");

        return $statement->fetchAll();
    }
    public function findOne($ma)
    {
        $statement = $this->conn->prepare("select * from the_thu_vien where so_the=:so_the limit 1");
        $statement->execute([
            'so_the' => $ma
        ]);
        return $statement->fetch();
    }
    public function updateOne($ma, $arr)
    {
        $statement = $this->conn->prepare(
            "update the_thu_vien set
            ngay_bat_dau=:ngay_bat_dau,
            ngay_het_han=:ngay_het_han,
            ghi_chu=:ghi_chu
            where
            so_the='$ma'
            "
        );
        $statement->execute($arr);
        return $statement->rowCount();
    }
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from the_thu_vien where so_the='$ma'");
    }
}
