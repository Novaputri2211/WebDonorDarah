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

}else if (!isset($_POST['id_pendonor']) ||  !isset($_POST['jlh_kantong_kurang']) ||
    empty(trim($_POST['id_pendonor'])) ||  empty(trim($_POST['jlh_kantong_kurang']))
){
    $returnData = msg(0,422,'Isi Semua Data');
}else{
    $id_pendonor = $_POST['id_pendonor'];
    $kurang = $_POST['jlh_kantong_kurang'];

    $q = "SELECT * FROM tb_pendonor WHERE id_pendonor = :id";
    $cekstok = $conn->prepare($q);
    $cekstok->bindParam(":id", $id_pendonor);
    $cekstok->execute();
    $row = $cekstok->fetch(PDO::FETCH_ASSOC);

    $kurang_stok = $row['jlh_kantong'] - $kurang;

    $query = "UPDATE tb_pendonor SET jlh_kantong = :kurang_stok
              WHERE id_pendonor = :id";

    $set = $conn->prepare($query);
    $set->bindParam(":kurang_stok", $kurang_stok);
    $set->bindParam(":id", $id_pendonor);
    $set->execute();

    $returnData = msg(1,200,'Stok Darah User Dikurangi');

}
echo json_encode($returnData);
?>