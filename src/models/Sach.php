<?php

namespace App\Models;

class Sach extends Model
{
    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into sach(ten_sach,nam_xuat_ban,ma_tl,ma_nxb,ma_tg,hinh_anh,slug)
         values(:ten_sach,:nam_xuat_ban,:ma_tl,:ma_nxb,:ma_tg,:hinh_anh,:slug)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function all($q)
    {
        $statement = $this->conn->query("
        select * from sach
        join the_loai
        on the_loai.ma_tl = sach.ma_tl
        join tac_gia
        on tac_gia.ma_tg= sach.ma_tg
        join nha_xuat_ban
        on nha_xuat_ban.ma_nxb= sach.ma_nxb
        where ten_sach like '%$q%'
        ");

        return $statement->fetchAll();
    }
    public function findOne($ma)
    {
        $statement = $this->conn->prepare("
        select * from sach 
        join the_loai
        on the_loai.ma_tl = sach.ma_tl
        join tac_gia
        on tac_gia.ma_tg= sach.ma_tg
        join nha_xuat_ban
        on nha_xuat_ban.ma_nxb= sach.ma_nxb
        where ma_sach=:ma_sach limit 1");
        $statement->execute([
            'ma_sach' => $ma
        ]);
        return $statement->fetch();
    }
    public function updateOne($ma, $arr)
    {
        $statement = $this->conn->prepare(
            "update sach set
            ten_sach=:ten_sach,
            nam_xuat_ban=:nam_xuat_ban,
            ma_tl=:ma_tl,
            ma_tg=:ma_tg,
            ma_nxb=:ma_nxb,
            hinh_anh=:hinh_anh,
            slug=:slug
            where
            ma_sach='$ma'
            "
        );
        $statement->execute($arr);
        return $statement->rowCount();
    }
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from sach where ma_sach='$ma'");
    }
}
