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
}
