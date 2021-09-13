<?php
    include_once '../class/database.php';

    $database = new Database();
    $conn = $database->dbConnection();

    $id_pendonor = isset($_POST['idpendonor']) ? $_POST['idpendonor'] : die();

    $query = "UPDATE tb_pendonor SET konfirmasi = 1 WHERE id_pendonor = :id";
    $statement = $conn->prepare($query);
    $statement->bindParam(":id", $id_pendonor);
    $statement->execute();

?>