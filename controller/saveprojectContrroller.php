<?php
include_once '../classes/DbConnecter.php';

if (isset($_POST['saveproject'])) {
    echo "<br>athule enne";
    $pid = $_POST['pid'];
    $pname = $_POST['pname'];
    $country = $_POST['country'];
    $region = $_POST['region'];
    $apdate = $_POST['apdate'];
    $cdate = $_POST['cdate'];
    $teamleader = $_POST['teamleader'];
    $tpc = $_POST['tpc'];
    $ca = $_POST['ca'];
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $note = $_POST['note'];
    $keepimg1 = $_POST['keepimg1'];
    $keepimg2 = $_POST['keepimg2'];
    $keepimg3 = $_POST['keepimg3'];
    $newimg1 = $_FILES['newimg1'];
    $newimg2 = $_FILES['newimg2'];
    $newimg3 = $_FILES['newimg3'];

    $newimg1url = $_FILES['newimg1']['name'];
    $newimg2url = $_FILES['newimg2']['name'];
    $newimg3url = $_FILES['newimg3']['name'];

    $conn = mysqli_connect(Database::$host, Database::$username, Database::$password, Database::$dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if($newimg1url != ''){
        /*new*/
        $target1 = "../res/ServerUploadedImages/" . basename($newimg1url);
        $finalimg1 = $newimg1url;
    }else{
        if($keepimg1 != ''){
            /*keep*/
            $target1 = "../res/ServerUploadedImages/" . $keepimg1;
            $finalimg1 = $keepimg1;
        }else{
            /*null*/
            $finalimg1 = '';
            $target1 = '';
        }
    }
    

    if($newimg2url != ''){
        /*new*/
        $target2 = "../res/ServerUploadedImages/" . basename($newimg2url);
        $finalimg2 = $newimg2url;
    }else{
        if($keepimg2 != ''){
            /*keep*/
            $target2 = "../res/ServerUploadedImages/" . $keepimg2;
            $finalimg2 = $keepimg2;
        }else{
            /*null*/
            $finalimg2 = '';
            $target2 = '';
        }
    }


    if($newimg3url != ''){
        /*new*/
        $target3 = "../res/ServerUploadedImages/" . basename($newimg3url);
        $finalimg3 = $newimg3url;
    }else{
        if($keepimg3 != ''){
            /*keep*/
            $target3 = "../res/ServerUploadedImages/" . $keepimg3;
            $finalimg3 = $keepimg3;
        }else{
            /*null*/
            $finalimg3 = '';
            $target3 = '';
        }
    }

    $sql = "UPDATE projects SET pro_name='$pname',pro_country='$country',pro_region='$region',pro_apdate='$apdate',pro_cdate='$cdate',pro_teamleader='$teamleader',pro_tpc='$tpc',pro_ca='$ca',pro_lat='$lat',pro_lng='$lng',pro_note='$note',pro_imgurl1='$finalimg1',pro_imgurl2='$finalimg2',pro_imgurl3='$finalimg3' WHERE pro_id=$pid";

    if ($conn->query($sql) === TRUE) {
        $imgcount=0;
        
        if($finalimg1 != ''){
            $imgcount++;
            if (move_uploaded_file($_FILES['newimg1']['tmp_name'], $target1)) {
            } else {
                /*echo '<br>'.$finalimg1 .' Image upload failed';*/
            }
        }
        if($finalimg2 != ''){
            $imgcount++;
            if (move_uploaded_file($_FILES['newimg2']['tmp_name'], $target2)) {
            } else {
               /* echo '<br>'.$finalimg2 .' Image upload failed';*/
            }
        }
        if($finalimg3 != ''){
            $imgcount++;
            if (move_uploaded_file($_FILES['newimg3']['tmp_name'], $target3)) {
            } else {
                /*echo '<br>'.$finalimg3 .' Image upload failed';*/
            }
        }

        /*echo '<br>'.$imgcount.' Images Uploaded';*/
        echo "<script>location = '../view/viewProject.php?viewid=".$pid." ';</script>";
        
    } else {
        echo "Error: <hr>" . $sql . "<hr>" . $conn->error;
    }
}
else{
    echo "<script>location = '../view/index.php';</script>";
}
