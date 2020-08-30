<?php

session_start();
include_once '../classes/DbConnecter.php';

if (isset($_GET['register']) && $_GET['register'] == 'true') {

    $con = Database::connectDB();

    $ufname    = $_POST['ufname'];
    $ulname = $_POST['ulname'];
    $uemail    = $_POST['uemail'];
    $upass    = $_POST['upass'];

    $md5_pass = md5($upass);
    $shal_pass = Sha1($md5_pass);
    $crypt_pass = crypt($shal_pass, "bm");


    $QueryEMAIL = $con->prepare("SELECT  uemail FROM users WHERE uemail = ?");
    $QueryEMAIL->execute(array($uemail));
    if ($QueryEMAIL->rowCount() == 0) {
        $Query = $con->prepare("INSERT INTO users (ufname, ulname, uemail, upassword, utype) VALUES (?,?,?,?,?)");
        $Query->execute([$ufname, $ulname, $uemail, $crypt_pass ,'admin']);
        if ($Query) {
            echo json_encode(['status' => 'success', 'msg' => 'login.php']);
        }
    } else {
        echo json_encode(array('status' => 'email_fail'));
    }
}
