<?php
include_once 'class/database.php';

$database = new Database();
$conn = $database->dbConnection();

$goldar = isset($_POST['select-darah']) ? $_POST['select-darah'] : die();


//getbindo
$query = "SELECT * 
         FROM tb_stock_darah
         WHERE gol_darah = :goldar" ;
$statement = $conn->prepare($query);
$statement->bindParam(":goldar", $goldar);
$statement->execute();


?>