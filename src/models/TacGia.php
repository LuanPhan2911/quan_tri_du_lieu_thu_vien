<?php

namespace App\Models;

class TacGia extends Model
{
    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into tac_gia(ten_tg,website,ghi_chu)
         values(:ten_tg,:website,:ghi_chu)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function all($q)
    {
        $statement = $this->conn->query("select * from tac_gia where ten_tg like '%$q%'");

        return $statement->fetchAll();
    }
    public function findOne($ma)
    {
        $statement = $this->conn->prepare("select * from tac_gia where ma_tg=:ma_tg limit 1");
        $statement->execute([
            'ma_tg' => $ma
        ]);
        return $statement->fetch();
    }
    public function updateOne($ma, $arr)
    {
        $statement = $this->conn->prepare(
            "update tac_gia set
            ten_tg=:ten_tg,
            website=:website,
            ghi_chu=:ghi_chu
            where
            ma_tg='$ma'
            "
        );
        $statement->execute($arr);
        return $statement->rowCount();
    }
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from tac_gia where ma_tg='$ma'");
    }
}
