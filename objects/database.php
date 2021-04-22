<?php
class Database{
 
    private $host = "localhost";
    private $db_name = "detikcom_soal";
    private $username = "root";
    private $password = "";
    public $con;
 
    
    public function getConnection(){
 
        $this->con = null;
 
        try{
            $this->con = new PDO('mysql:host=localhost;dbname=detikcom_soal', $this->username, $this->password);
        }catch(PDOException $exception){
            echo "Connection error: " . $exception->getMessage();
        }
 
        return $this->con;
    }

}
?>