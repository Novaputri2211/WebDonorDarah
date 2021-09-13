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
    $query = "SELECT * FROM tb_stock_darah";
    $set = $conn->prepare($query);
    $set->execute();

if ($set->rowCount() > 0){
    $data["DATA"] = array();

    while ($row = $set->fetch(PDO::FETCH_ASSOC)) {
        extract($row);

        $item = array(
            "gol_darah" => $row['gol_darah'],
            "jlh_kantong_darah" => $row['jlh_kantong_darah']
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