<?php
include_once 'objects/database.php';

$database = new Database;
$db = $database->getConnection();


$createTable = $db->prepare("CREATE TABLE transaksi(
    invoice_id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    references_id VARCHAR(30) UNIQUE,
    item_name VARCHAR(30), 
    amount INT,
    payment_type VARCHAR(30),
    customer_name VARCHAR(30),
    merchant_id INT,
    status VARCHAR(30) 
)");

$createHistori = $db->prepare("CREATE TABLE histori_transaksi(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    references_id VARCHAR(30),
    status VARCHAR(30),
    created_at VARCHAR(30)
)");

$insertTransaksi = $db->prepare("INSERT INTO transaksi (references_id,item_name,amount,payment_type,customer_name,merchant_id,status) VALUES
                ('demo_1234','koran',1000,'virtual_account','shendy',2,'pending'),
                ('demo_1345','buku',4000,'virtual_account','pratama',2,'pending'),
                ('demo_6332','majalah',5000,'virtual_account','junianto',2,'pending')");

$insertHistori = $db->prepare("INSERT INTO histori_transaksi (references_id,status,created_at) VALUES
                ('demo_1234','pending','2021-04-22 09:25:25'),
                ('demo_1234','pending','2021-04-22 09:25:25'),
                ('demo_1234','pending','2021-04-22 09:25:25')");

$createTable->execute();
$createHistori->execute();
$insertTransaksi->execute();
$insertHistori->execute();


?>