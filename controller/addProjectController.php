<?php
include_once '../classes/DbConnecter.php';

if (isset($_POST['addproject'])) {
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
    $proimg1 = $_FILES['proimg1'];
    $proimg2 = $_FILES['proimg2'];
    $proimg3 = $_FILES['proimg3'];

    $conn = mysqli_connect(Database::$host, Database::$username, Database::$password, Database::$dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $proimg1url = $_FILES['proimg1']['name'];
    $target1 = "../res/ServerUploadedImages/" . basename($proimg1url);

    $proimg2url = $_FILES['proimg2']['name'];
    $target2 = "../res/ServerUploadedImages/" . basename($proimg2url);

    $proimg3url = $_FILES['proimg3']['name'];
    $target3 = "../res/ServerUploadedImages/" . basename($proimg3url);

    $sql = "INSERT INTO projects (pro_name, pro_country, pro_region, pro_apdate, pro_cdate, pro_teamleader, pro_tpc, pro_ca, pro_lat, pro_lng, pro_note, pro_imgurl1, pro_imgurl2, pro_imgurl3) VALUES ('$pname','$country','$region','$apdate','$cdate','$teamleader','$tpc','$ca','$lat','$lng','$note','$proimg1url','$proimg2url','$proimg3url')";

    if ($conn->query($sql) === TRUE) {
        $imgcount=0;
        $successuploadimgcount=0;
        if($proimg1url != ''){
            $imgcount++;
            if (move_uploaded_file($_FILES['proimg1']['tmp_name'], $target1)) {
                $successuploadimgcount++;
            } else {
                echo '<br>'.$proimg1url .' Image upload failed';
            }
        }
        if($proimg2url != ''){
            $imgcount++;
            if (move_uploaded_file($_FILES['proimg2']['tmp_name'], $target2)) {
                $successuploadimgcount++;
            } else {
                echo '<br>'.$proimg2url .' Image upload failed';
            }
        }
        if($proimg3url != ''){
            $imgcount++;
            if (move_uploaded_file($_FILES['proimg3']['tmp_name'], $target3)) {
                $successuploadimgcount++;
            } else {
                echo '<br>'.$proimg3url .' Image upload failed';
            }
        }

        if($imgcount == $successuploadimgcount){
            echo "<script>location = '../view/index.php#addproject'</script>";
        }else{
            echo '<br> Upload failed !!';
        }
        
        
    } else {
        echo "Error: <hr>" . $sql . "<hr>" . $conn->error;
    }
}
