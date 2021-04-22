<?php 
include_once '../objects/database.php';
include_once '../objects/transaction.php';
$database = new Database;
$db = $database->getConnection();
$transaksi = new Transaksi($db);
$dataInput = json_decode(file_get_contents("php://input"));
$response = array();

$query = $transaksi->getTransaksi($dataInput->references_id,$dataInput->merchant_id);
$response_data = null;
// echo var_dump($query);
if($query == true){
    
              $response['status']= true;
              $response['data'] = $query;
              echo json_encode($response);
             
} else {
    http_response_code(401);
    echo json_encode(array(
        "status" => false,
        "message" => "tidak ada data."));
}



?>