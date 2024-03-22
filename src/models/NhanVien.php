<?php

namespace App\Models;

class NhanVien extends Model
{



    public function exist(string $email)
    {

        $statement = $this->conn->prepare("select * from nhan_vien where email=:email limit 1");

        $statement->execute([
            'email' => $email
        ]);
        $nhan_vien = $statement->fetch();
        return  empty($nhan_vien) ? NULL : $nhan_vien;
    }

    public function insert($arr)
    {
        $statement = $this->conn->prepare("insert into nhan_vien(ho_ten, ngay_sinh,so_dien_thoai,email,mat_khau)
         values(:ho_ten,:ngay_sinh,:so_dien_thoai,:email,:mat_khau)");
        $statement->execute($arr);
        $ma_nv = $this->conn->lastInsertId();
        return empty($ma_nv) ? NULL : $ma_nv;
    }
    public function all($query)
    {
        $q = $query['q'];
        $order = $query['order'] == 'asc' ? 'asc' : 'desc';
        $statement = $this->conn->query(
            "select ma_nv,ho_ten,ngay_sinh,so_dien_thoai,email
            from nhan_vien
            where 
            ho_ten like '%$q%'
            order by ho_ten $order
            "
        );
        return $statement->fetchAll();
    }
    public function findOne($ma)
    {
        $statement = $this->conn->prepare(
            "select ma_nv,ho_ten,ngay_sinh,so_dien_thoai,email
            from nhan_vien 
            where ma_nv=:ma_nv limit 1"
        );
        $statement->execute([
            'ma_nv' => $ma
        ]);
        return $statement->fetch();
    }
    public function updateOne($ma, $arr)
    {
        $statement = $this->conn->prepare(
            "update nhan_vien set
            ho_ten=:ho_ten,
            ngay_sinh=:ngay_sinh,
            so_dien_thoai=:so_dien_thoai
            where
            ma_nv='$ma'
            "
        );
        $statement->execute($arr);
        return $statement->rowCount();
    }
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from nhan_vien where ma_nv='$ma'");
    }
}
