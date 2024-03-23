<?php

namespace App\Models;

class DocGia extends Model
{
    public function insert($arr)
    {
        $statement = $this->conn->prepare(
            "
        insert into doc_gia(ten_dg,dia_chi,so_the)
         values(:ten_dg,:dia_chi,:so_the)"
        );
        $statement->execute($arr);
        return $this->conn->lastInsertId();
    }
    public function all($q)
    {
        $statement = $this->conn->query("
        select *
        from doc_gia
        join the_thu_vien
        on doc_gia.so_the= the_thu_vien.so_the
        where 
        ten_dg like '%$q%'
        or
        dia_chi like '%$q%'
        ");

        return $statement->fetchAll();
    }
    public function paginate($q, $limit = 10)
    {
        $page =  htmlspecialchars($_GET['page'] ?? 1);
        $offset = ($page - 1) * $limit;


        $statement = $this->conn->prepare("call 
        phan_trang_doc_gia(:q,:limit,:offset,@total_record,@total_page)
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
        select *
        from doc_gia
        join the_thu_vien
        on doc_gia.so_the= the_thu_vien.so_the
        ");

        return $statement->fetchAll();
    }
    public function findOne($ma)
    {
        $statement = $this->conn->prepare("
        select 
        doc_gia.ma_dg,doc_gia.ten_dg, doc_gia.dia_chi,
        the_thu_vien.*
        from doc_gia
        join the_thu_vien
        on doc_gia.so_the= the_thu_vien.so_the
        where ma_dg=:ma_dg limit 1");
        $statement->execute([
            'ma_dg' => $ma
        ]);
        return $statement->fetch();
    }
    public function updateOne($ma, $arr)
    {
        $statement = $this->conn->prepare(
            "update doc_gia set
            ten_dg=:ten_dg,
            dia_chi=:dia_chi,
            so_the=:so_the
            where
            ma_dg='$ma'
            "
        );
        $statement->execute($arr);
        return $statement->rowCount();
    }
    public function deleteOne($ma)
    {
        return $this->conn->query("delete from doc_gia where ma_dg='$ma'");
    }
}
