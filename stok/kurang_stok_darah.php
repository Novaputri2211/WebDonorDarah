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

}else if (!isset($_POST['gol_darah']) || !isset($_POST['jlh_kantong_darah']) ||
    empty(trim($_POST['gol_darah'])) || empty(trim($_POST['jlh_kantong_darah']))
){
    $returnData = msg(0,422,'Isi Semua Data');
}else{
    $gol_darah = $_POST['gol_darah'];
    $jlh_kantong_kurang = $_POST['jlh_kantong_darah'];

    $q = "SELECT * FROM tb_stock_darah WHERE gol_darah = :gd";
    $cekstok = $conn->prepare($q);
    $cekstok->bindParam(":gd", $gol_darah);
    $cekstok->execute();
    $row = $cekstok->fetch(PDO::FETCH_ASSOC);

    $kurang_stok = $row['jlh_kantong_darah'] - $jlh_kantong_kurang;

    $query = "UPDATE tb_stock_darah SET jlh_kantong_darah = :jlh_kantong_darah
              WHERE gol_darah = :gol_darah";

    $set = $conn->prepare($query);
    $set->bindParam(":gol_darah", $gol_darah);
    $set->bindParam(":jlh_kantong_darah", $kurang_stok);
    $set->execute();

    $returnData = msg(1,200,'Pengurangan Stok Darah Berhasil');

}
echo json_encode($returnData);
?>