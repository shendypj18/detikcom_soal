<?php
include_once '../objects/database.php';
include_once '../objects/transaction.php';
$database = new Database;
$db = $database->getConnection();
$transaksi = new Transaksi($db);
$response = array();
    if (isset($argv)){
        // echo var_dump($argv);
        if($argv[2] == "Paid" ||$argv[2] == "paid" || $argv[2] == "Failed" || $argv[2] == "failed" ){
            $query = $transaksi->setHistori($argv[1],$argv[2]);
            $response_data = null;
            // echo var_dump($query);
            if($query == 0){
                $data = $transaksi->getHistori($argv[1]);
                $response['status']= true;
                $response['data'] = $data;
                echo json_encode($response);
                     
            } else {
                echo json_encode(array(
                "status" => false,
                "message" => "tidak ada data."));
            }
        } else {
                echo json_encode(array(
                "status" => false,
                "message" => "periksa kembali statusnya"));
        }
    } else {
            $parse = "";
            $data = $transaksi->getHistori($parse);
            $response['status']= true;
            $response['data'] = $data;
            echo json_encode($response);
    }





?>