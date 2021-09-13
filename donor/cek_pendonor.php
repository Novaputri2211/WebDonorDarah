<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Method: POST");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers,Authorization,X-Requested-With");

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message'=> $message
    ],$extra);
}

include_once '../class/database.php';

$database = new Database();
$conn = $database->dbConnection();

$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $returnData = msg(0,404,'Page Not Found');

}else if ( !isset($_POST['id_user']) || empty(trim($_POST['id_user'])) 
){
    $returnData = msg(0,422,'Id user kosong');
}else{
    $id_user = $_POST['id_user'];


    $query = "SELECT * FROM tb_pendonor WHERE id_user = :id ";
    $set = $conn->prepare($query);
    $set->bindParam(":id", $id_user);
    $set->execute();

    if ($set->rowCount() > 0) {
        $returnData = msg(1,200,'Pendonor Sudah ada');
    }else {
        $returnData = msg(0,201,'Pendonor Belum ada');
    }   

}
echo json_encode($returnData);
?>