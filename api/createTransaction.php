<?php
include_once '../objects/database.php';
include_once '../objects/transaction.php';
$dataInput = json_decode(file_get_contents("php://input"));
$response = array();
$invoice_id = "";
$status = "pending";
$database = new Database();
$db = $database->getConnection();
// echo var_dump($db);
$transaksi = new Transaksi($db);
if(empty($dataInput)){
    $response['message'] = "Data tidak ditemukan";
    echo json_encode($response);
} else {
    // echo $dataInput->merchant_id;
    $references_id = "demo_".rand();
    // echo var_dump($transaksi);
    $result = $transaksi->createTransaksi($invoice_id,$references_id, $dataInput->item_name,
    $dataInput->amount, $dataInput->payment_type,
    $dataInput->customer_name,$dataInput->merchant_id,$status);
    
    if($result == 0){
        $response['references_id'] = $references_id;
        if($dataInput->payment_type == "virtual_account"){
            $response['number_va'] = rand();
        } else {
            $response['number_va'] = "";
        }
        $response['status'] = $status;

        echo json_encode($response);
    } else {
        $response['message'] = "data gagal disimpan";
        echo json_encode($response);
    }
}

?>