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
include_once '../class/jwthandler.php';

$database = new Database();
$conn = $database->dbConnection();

$returnData = [];

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    $returnData = msg(0,404,'Page Not Found');
}else if (!isset($_POST['username']) || !isset($_POST['password']) || empty(trim($_POST['username'])) || empty(trim($_POST['password']))
){
    $returnData = msg(0,422,'Harap Isi Username dan Password');
}else {
    $username = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if (strlen($pass) < 6) {
        $returnData = msg(0,201,'Password Minimal 6 Karakter');
    }else {
        $query = "SELECT * FROM tb_user WHERE username = :uname";
        $set = $conn->prepare($query);
        $set->bindParam(":uname",$username);
        $set->execute();
        
        if ($set->rowCount()) {
            $row = $set->fetch(PDO::FETCH_ASSOC);
            $chk_pass = password_verify($pass, $row['password']);

            if ($chk_pass) {
                $jwt = new JwtHandler();
                $token = $jwt->_jwt_encode_data(
                    'http://172.25.41.22/db_donor_darah',
                    array("user_id" => $row['id_user'])
                );
                
                $update = "UPDATE tb_user SET token = :token WHERE username = :uname";
                $statement = $conn->prepare($update);
                $statement->bindParam(":token", $token);
                $statement->bindParam(":uname", $username);
                $statement->execute();

                $returnData = [
                    'status' => 200,
                    'message' => 'Login Berhasil',
                    'DATA' => array(
                        'id_user' => $row['id_user'],
                        'nama_user' => $row['nama'],
                        'jekel' => $row['jenis_kelamin'],
                        'username' => $row['username'],
                        'token' => $token
                    )
                    ];
            }else {
                $returnData = msg(0,422,'Password Salah');
            }
        }else {
            $returnData = msg(0,422,'User Tidak Ada');
        }
    }
}
echo json_encode($returnData);
?>