<?php
    include_once 'class/database.php';

    $database = new Database();
    $conn = $database->dbConnection();

    $goldar = isset($_POST['select-goldar']) ? $_POST['select-goldar'] : die();

    $query = "SELECT * FROM tb_pendonor WHERE gol_darah = :goldar AND konfirmasi = 0 ORDER BY tanggal_donor ASC";
    $statement = $conn->prepare($query);
    $statement->bindParam(":goldar", $goldar);
    $statement->execute();

?>