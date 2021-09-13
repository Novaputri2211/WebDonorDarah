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

}else if ( !isset($_POST['id_user']) || !isset($_POST['nama_pendonor']) || !isset($_POST['tempat_lahir']) || !isset($_POST['tgl_lahir']) || !isset($_POST['umur']) || !isset($_POST['jekel']) || !isset($_POST['alamat']) || !isset($_POST['lat']) || !isset($_POST['lng']) || !isset($_POST['no_hp']) || !isset($_POST['gol_darah']) || !isset($_POST['bb']) || !isset($_POST['tensi']) || !isset($_POST['kadar_hb']) || !isset($_POST['tanggal_donor']) || !isset($_POST['jlh_kantong']) ||
        empty(trim($_POST['id_user'])) || empty(trim($_POST['nama_pendonor'])) || empty(trim($_POST['tempat_lahir'])) || empty(trim($_POST['tgl_lahir'])) || empty(trim($_POST['umur'])) || empty(trim($_POST['jekel'])) || empty(trim($_POST['alamat'])) || empty(trim($_POST['lat'])) || empty(trim($_POST['lng'])) || empty(trim($_POST['no_hp'])) || empty(trim($_POST['gol_darah'])) || empty(trim($_POST['bb'])) || empty(trim($_POST['tensi'])) || empty(trim($_POST['kadar_hb'])) || empty(trim($_POST['tanggal_donor'])) || empty(trim($_POST['jlh_kantong']))
){
    $returnData = msg(0,422,'Isi Semua Data');
}else{
    $id_user = $_POST['id_user'];
    $nama_pendonor = $_POST['nama_pendonor'];
    $tempat_lahir = $_POST['tempat_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $umur = $_POST['umur'];
    $jekel = $_POST['jekel'];
    $alamat = $_POST['alamat'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $no_hp = $_POST['no_hp'];
    $gol_darah = $_POST['gol_darah'];
    $bb = $_POST['bb'];
    $tensi = $_POST['tensi'];
    $kadar_hb = $_POST['kadar_hb'];
    $tanggal_donor = $_POST['tanggal_donor'];
    $jlh_kantong = $_POST['jlh_kantong'];

    $query = "INSERT INTO tb_pendonor(id_user,nama_pendonor,tempat_lahir,tgl_lahir,umur,jekel,alamat,lat,lng,no_hp,gol_darah,bb,tensi,kadar_hb,tanggal_donor,jlh_kantong)
                VALUES(:iduser, :nama_pendonor, :tempat_lahir, :tgl_lahir, :umur, :jekel, :alamat, :lat, :lng, :no_hp, :gol_darah, :bb, :tensi, :kadar_hb, :tanggal_donor, :jlh_kantong) ";
    $set = $conn->prepare($query);
    $set->bindParam(":iduser", $id_user);
    $set->bindParam(":nama_pendonor", $nama_pendonor);
    $set->bindParam(":tempat_lahir", $tempat_lahir);
    $set->bindParam(":tgl_lahir", $tgl_lahir);
    $set->bindParam(":umur", $umur);
    $set->bindParam(":jekel", $jekel);
    $set->bindParam(":alamat", $alamat);
    $set->bindParam(":lat", $lat);
    $set->bindParam(":lng", $lng);
    $set->bindParam(":no_hp", $no_hp);
    $set->bindParam(":gol_darah", $gol_darah);
    $set->bindParam(":bb", $bb);
    $set->bindParam(":tensi", $tensi);
    $set->bindParam(":kadar_hb", $kadar_hb);
    $set->bindParam(":tanggal_donor", $tanggal_donor);
    $set->bindParam(":jlh_kantong", $jlh_kantong);
    $set->execute();

    $returnData = msg(1,200,'Input Pendonor Berhasil');

}
echo json_encode($returnData);
?>