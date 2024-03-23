<?php

namespace App\Models;

class TheLoai extends Model
{
    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into the_loai(ten_tl,slug)
         values(:ten_tl,:slug)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function all()
    {
        $statement = $this->conn->query("select * from the_loai");
        return $statement->fetchAll();
    }
    public function get()
    {
        $statement = $this->conn->query("select * from the_loai");
        return $statement->fetchAll();
    }
    public function findOne($ma)
    {
        $statement = $this->conn->query("
        select * from the_loai where ma_tl='$ma'
        limit 1
        ");
        return $statement->fetch();
    }
    public function updateOne($ma, $arr)
    {
        $statement = $this->conn->prepare("
        update the_loai
        set
        ten_tl=:ten_tl,
        slug=:slug
        where ma_tl='$ma'
        ");
        $statement->execute($arr);
        return $statement->rowCount();
    }
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from the_loai where ma_tl='$ma'");
    }

    public function count_sach($ma)
    {
        $statement = $this->conn->query("select count(*) from sach where ma_tl='$ma'");
        return $statement->fetchColumn();
    }
}
