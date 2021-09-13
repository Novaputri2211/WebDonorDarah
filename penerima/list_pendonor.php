<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

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

if ($_SERVER["REQUEST_METHOD"] != "GET") {
    $returnData = msg(0,404,'Page Not Found');  
}else {
    $query = "SELECT * from tb_pendonor ORDER BY gol_darah";
    $set = $conn->prepare($query);
    $set->execute();

if ($set->rowCount() > 0){
    $data["DATA"] = array();

    while ($row = $set->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
            "id_pendonor" => $row['id_pendonor'],
            "id_user" => $row['id_user'],
            "nama" => $row['nama_pendonor'],
            "tmpt_lahir" => $row['tempat_lahir'],
            "tanggal_lahir" => $row['tgl_lahir'],
            "umur" => $row['umur'],
            "jekel" => $row['jekel'],
            "alamat" => $row['alamat'],
            "lat" => $row['lat'],
            "lng" => $row['lng'],
            "no_hp" => $row['no_hp'],
            "gol_darah" => $row['gol_darah'],
            "bb" => $row['bb'],
            "tensi" => $row['tensi'],
            "kadar_hb" => $row['kadar_hb'],
            "tanggal_donor" => $row['tanggal_donor'],
            "jlh_kantong_pendonor" => $row['jlh_kantong']
        );

        array_push($data["DATA"], $item);
    }
    $returnData = msg(1,200,'Data Ada',$data);
}else{
    $returnData = msg(0,201,'Data Tidak Ada');
}

}

echo json_encode($returnData);
?>