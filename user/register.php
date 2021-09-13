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
 if ($_SERVER["REQUEST_METHOD"] != "POST"){
     $returnData = msg(0,404,'Page Not Found');
 }else if (!isset($_POST['nama']) || !isset($_POST['email']) || !isset($_POST['jenis_kelamin']) || !isset($_POST['username']) || !isset($_POST['password']) || empty(trim($_POST['nama'])) || empty(trim($_POST['email'])) || empty(trim($_POST['jenis_kelamin'])) || empty(trim($_POST['username'])) || empty(trim($_POST['password']))
 ){
     $returnData = msg(0,422,'Isi Semua Data');
 }else{
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $token = "";
    $hash = password_hash($password, PASSWORD_DEFAULT);

    $q = "SELECT * FROM tb_user WHERE username = :username";
    $chkuser = $conn->prepare($q);
    $chkuser->bindParam(":username", $username);
    $chkuser->execute();
    $row = $chkuser->fetch(PDO::FETCH_ASSOC);

    if (strlen($password) <  6) {
        $returnData = msg(0,202,'Password minimal 6 karakter');
    }elseif ($row['username'] == $username) {
        $returnData = msg(0,201,'Username sudah ada');
    }else {
        $query = "INSERT INTO tb_user(nama,email,jenis_kelamin,username,password,token) 
              VALUES(:nama,:email,:jenis_kelamin,:uname,:pwd,:token)";

        $set = $conn->prepare($query);
        $set->bindParam(":nama",$nama);
        $set->bindParam(":email",$email);
        $set->bindParam(":jenis_kelamin",$jenis_kelamin);
        $set->bindParam(":uname",$username);
        $set->bindParam(":pwd",$hash);
        $set->bindParam(":token", $token);
        $set->execute();

        $returnData = msg(1,200,'Register Berhasil');

    }

 }
 echo json_encode($returnData);
?>