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
}else if (!isset($_POST['id_user']) || empty(trim($_POST['id_user'])) 
){
    $returnData = msg(0,422,'ID User Kosong');
}else {
    $id_user = trim($_POST['id_user']);

    $query = "SELECT * FROM tb_pendonor WHERE id_user = :iduser";
        $set = $conn->prepare($query);
        $set->bindParam(":iduser",$id_user);
        $set->execute();
        
        if ($set->rowCount()) {
            $row = $set->fetch(PDO::FETCH_ASSOC);

            $returnData = [
                'status' => 200,
                'message' => 'Pendonor Ada',
                'DATA' => array(
                    'id_pendonor' => $row['id_pendonor'],
                    'id_user' => $row['id_user'],
                    'nama_pendonor' => $row['nama_pendonor'],
                    'tempat_lahir' => $row['tempat_lahir'],
                    'tgl_lahir' => $row['tgl_lahir'],
                    'umur' => $row['umur'],
                    'jekel' => $row['jekel'],
                    'no_hp' => $row['no_hp'],
                    'gol_darah' => $row['gol_darah'],
                    'bb' => $row['bb'],
                    'tensi' => $row['tensi'],
                    'hb' => $row['kadar_hb'],
                    'tgl_donor' => $row['tanggal_donor'],
                    'jlh_kantong' => $row['jlh_kantong']
                )
                ];
           
        }else {
            $returnData = msg(0,422,'Pendonor Tidak Ada');
        }
}
echo json_encode($returnData);
?>