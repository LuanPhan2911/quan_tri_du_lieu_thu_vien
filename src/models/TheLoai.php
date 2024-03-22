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
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from the_loai where ma_tl='$ma'");
    }
}
