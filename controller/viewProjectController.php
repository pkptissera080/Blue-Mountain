<?php
include_once '../classes/DbConnecter.php';

if (isset($_GET['delete_pro_id'])){
    $con = mysqli_connect(Database::$host, Database::$username, Database::$password, Database::$dbname);
    if (!$con) {
        die('Not connected : ' . mysqli_connect_error());
    }
    $pro_id = $_GET['delete_pro_id'];
    // sql to delete a record
    $sql = "DELETE FROM projects WHERE pro_id=$pro_id";

    if ($con->query($sql) === TRUE) {
        echo json_encode(['status' => 'success', 'msg' => '../view/index.php#projects']);
    } else {
        echo json_encode(['status' => 'error', 'msg' => 'Error deleting record :'.$con->error.'']);
    }
}
