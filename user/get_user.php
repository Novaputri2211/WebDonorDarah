<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json, charset=UTF-8");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

function msg($success,$status,$message,$extra = []){
    return array_merge([
        'success' => $success,
        'status' => $status,
        'message' => $message
    ],$extra);
}

include_once '../class/database.php';

$database = new Database();
$conn = $database->dbConnection();

$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $returnData = msg(0,404,'Page Not Found');
}else if (!isset($_POST['id_user']) ||  empty(trim($_POST['id_user']))
){
    $returnData = msg(0,422,'ID User tidak ada');
}else {
    $id = trim($_POST['id_user']);
    
    $query = "SELECT * FROM tb_user WHERE id_user = :id";
    $set = $conn->prepare($query);
    $set->bindParam(":id",$id);
    $set->execute();
    
    if ($set->rowCount()) {
        $row = $set->fetch(PDO::FETCH_ASSOC);

        $returnData = [
            'status' => 200,
            'message' => 'Login Berhasil',
            'DATA' => array(
                'token' => $row['token']
            )
            ];
    }else {
        $returnData = msg(0,422,'User Tidak Ada');
    }
}
echo json_encode($returnData);
?>