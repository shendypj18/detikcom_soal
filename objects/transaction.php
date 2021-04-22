<?php

class Transaksi{
    private $conn;
 

    public function  __construct($db){
        $this->conn = $db;
    }


    public function createTransaksi($invoice_id,$references_id,$item_name,
    $amount,$payment_type,$customer_name,$merchant_id,$status){
        // echo var_dump($this->conn);
        $stmt = $this->conn->prepare("INSERT INTO transaksi VALUES (?,?,?,?,?,?,?,?);");
        $stmt->bindParam(1,$invoice_id,PDO::PARAM_INT);
        $stmt->bindParam(2,$references_id,PDO::PARAM_STR);
        $stmt->bindParam(3,$item_name,PDO::PARAM_STR);
        $stmt->bindParam(4,$amount,PDO::PARAM_INT);
        $stmt->bindParam(5,$payment_type,PDO::PARAM_STR);
        $stmt->bindParam(6,$customer_name,PDO::PARAM_STR);
        $stmt->bindParam(7,$merchant_id,PDO::PARAM_INT);
        $stmt->bindParam(8,$status,PDO::PARAM_STR);
        if($stmt->execute()){
            $date = date_format(date_create(),'Y-m-d H:i:s');
            $histori = $this->conn->prepare("INSERT INTO histori_transaksi VALUES (?,?,?,?);");
            $histori->bindParam(1,$invoice_id,PDO::PARAM_INT);
            $histori->bindParam(2,$references_id,PDO::PARAM_STR);
            $histori->bindParam(3,$status,PDO::PARAM_STR);
            $histori->bindParam(4,$date,PDO::PARAM_STR);
            $histori->execute();
            return 0;
        }
        return 1;
    }

    public function getTransaksi($references_id,$merchant_id){
        $stmt = $this->conn->prepare("SELECT references_id, invoice_id, status FROM transaksi WHERE references_id = '$references_id' AND merchant_id = $merchant_id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function setHistori($references_id,$status){
        $date = date_format(date_create(),'Y-m-d H:i:s');
        $stmt = $this->conn->prepare("UPDATE transaksi SET status = '$status' WHERE references_id = '$references_id'");
        // echo var_dump($stmt);
        if($stmt->execute()){
            $invoice_id = "";
            $date = date_format(date_create(),'Y-m-d H:i:s');
            $histori = $this->conn->prepare("INSERT INTO histori_transaksi VALUES (?,?,?,?);");
            $histori->bindParam(1,$invoice_id,PDO::PARAM_INT);
            $histori->bindParam(2,$references_id,PDO::PARAM_STR);
            $histori->bindParam(3,$status,PDO::PARAM_STR);
            $histori->bindParam(4,$date,PDO::PARAM_STR);
            $histori->execute();
            return 0;
        }
        return 1;
    }

    public function getHistori($references_id){
        $stmt = $this->conn->prepare("SELECT references_id,status,created_at FROM histori_transaksi WHERE references_id = '$references_id'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}


?>