<?php include_once '../shared/headerLinkRel.php'; ?>

<body>

    <?php include_once '../shared/header.php'; ?>

    <!-- !PAGE CONTENT! ------------------------------------------------------------------------------------------------------>
    <div class="w3-main" style="margin-left:340px;margin-right:40px">

        <!-- Header -->
        <div class="w3-container" style="margin-top:80px" id="projects">
            <a class="w3-xxxlarge w3-text-yellow w3-button w3-hover-white" href="index.php#projects"><i class="fa fa-angle-left w3-margin-right" aria-hidden="true"></i>Projects</a>
        </div>
        <div class="w3-padding w3-margin w3-card">
            <?php
            if (isset($_GET['viewid'])) {

                $pro_id = $_GET['viewid'];
                // Create connection
                $conn = mysqli_connect(Database::$host, Database::$username, Database::$password, Database::$dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT * FROM projects where pro_id = '" . $pro_id . "' ";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $rowCount = $result->num_rows;
                    while ($row = $result->fetch_assoc()) {
                        $pro_lat = $row["pro_lat"];
                        $pro_lng = $row["pro_lng"];
                        echo ' 
                        <table style="width:100%;">
                            <tr>
                                <td>
                                    <h2 class="w3-text-blue"><i class="fa fa-circle-o-notch w3-margin-right" aria-hidden="true"></i>' . $row["pro_name"] . '</h2>
                                    <p class="w3-margin-left w3-small w3-text-gray">' . $row["pro_datentime"] . '</p>
                                </td>
                        ';

                        if ($loginState == 'true') {
                            echo '
                                <td>
                                    <div class="w3-right">
                                        <button class="w3-button w3-green w3-round" onclick="openEditProjectModel()"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                        <button class="w3-button w3-red w3-round" onclick="deleteProject(' . $pro_id . ')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                    </div>
                                </td>
                        ';
                        }
                        echo '
                            </tr>
                        </table>
                        <hr>

                        <div class="w3-row-padding w3-margin">
                        ';
                        $imgCount = 0;
                        if ($row["pro_imgurl1"] != '') {
                            $imgCount++;
                        }
                        if ($row["pro_imgurl2"] != '') {
                            $imgCount++;
                        }
                        if ($row["pro_imgurl3"] != '') {
                            $imgCount++;
                        }
                        if ($imgCount == 1) {
                            $divtag = 'rest';
                        } else if ($imgCount == 2) {
                            $divtag = 'half';
                        } else if ($imgCount == 3) {
                            $divtag = 'third';
                        }

                        if ($row["pro_imgurl1"] != '') {
                            echo '
                            <div class="w3-' . $divtag . '">
                                <img src="../res/ServerUploadedImages/' . $row["pro_imgurl1"] . '" class="image" style="width:100%" onclick="onClick(this)" alt="Project Image 1">
                            </div>
                            ';
                        }
                        if ($row["pro_imgurl2"] != '') {
                            echo '
                            <div class="w3-' . $divtag . '">
                                <img src="../res/ServerUploadedImages/' . $row["pro_imgurl2"] . '" class="image" style="width:100%" onclick="onClick(this)" alt="Project Image 2">
                            </div>
                            ';
                        }
                        if ($row["pro_imgurl3"] != '') {
                            echo '
                            <div class="w3-' . $divtag . '">
                                <img src="../res/ServerUploadedImages/' . $row["pro_imgurl3"] . '" class="image" style="width:100%" onclick="onClick(this)" alt="Project Image 3">
                            </div>
                            ';
                        }

                        echo '
                        </div>
                        <hr>
                        <div class="w3-row-padding w3-margin">
                            <table style="width: 100%;">
                                <tr>
                                    <td><p class="w3-margin-right"><b>Country</b></p><p>' . $row["pro_country"] . '</p></td>
                                    <td><p class="w3-margin-right"><b>Total Project Cost</b></p><p>' . $row["pro_tpc"] . '</p></td>
                                    <td><p class="w3-margin-right"><b>Approval Date</b></p><p>' . $row["pro_apdate"] . '</p></td>
                                </tr>
                                <tr>
                                    <td><p class="w3-margin-right"><b>Region</b></p><p>' . $row["pro_region"] . '</p></td>
                                    <td><p class="w3-margin-right"><b>Commitment Amount</b></p><p>' . $row["pro_ca"] . '</p></td>
                                    <td><p class="w3-margin-right"><b>Closing Date</b></p><p>' . $row["pro_cdate"] . '</p></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><p class="w3-margin-right"><b>Team Leader</b></p><p>' . $row["pro_teamleader"] . '</p></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><p class="w3-margin-right"><b>Note</b></p><p>' . $row["pro_note"] . '</p></td>
                                </tr>
                                <tr>
                                    <td colspan="3"><p class="w3-margin-right"><b>Location</b></p><p>Latitude : ' . $row["pro_lat"] . ' , Longitude : ' . $row["pro_lng"] . '</p></td>
                                </tr>
                            </table>
                        </div>

                        <div id="viewmap" class="w3-card w3-rest w3-margin" style="height: 200px;"></div>



                        <div id="editProjectModel" class="w3-modal">
                            <div class="w3-modal-content" style="width: 500px;">
                                <div class="w3-container w3-padding">
                                    <h3 class="w3-green w3-padding">Edit Details <b onclick="closeEditProjectModel()" class="w3-right" style="cursor: pointer;">&times;</b></h3>
                                    <form action="../controller/saveprojectContrroller.php" method="POST" enctype="multipart/form-data">
                                        <div class="w3-padding" style="max-height:600px;overflow:auto;">
                                                <input type="text" name="pid" value="' . $row["pro_id"] . '" style="display :none;">
                                                <p><b><i class="fa fa-circle-o-notch w3-margin-right" aria-hidden="true"></i>Project Name</b></p>
                                                <input class="w3-input w3-border" type="text" placeholder="Project Name" name="pname" required value="' . $row["pro_name"] . '">
                                                <p><b><i class="fa fa-globe w3-margin-right" aria-hidden="true"></i> Country</b></p>
                                                <input class="w3-input w3-border" type="text" placeholder="Country" name="country" required value="' . $row["pro_country"] . '">
                                                <p><b><i class="fa fa-globe w3-margin-right" aria-hidden="true"></i>Region</b></p>
                                                <input class="w3-input w3-border" type="text" placeholder="Region" name="region" required value="' . $row["pro_region"] . '">
                                                <p><b><i class="fa fa-calendar-o w3-margin-right" aria-hidden="true"></i>Approval Date</b></p>
                                                <input class="w3-input w3-border" type="date" placeholder="Approval Date" name="apdate" required value="' . $row["pro_apdate"] . '">
                                                <p><b><i class="fa fa-calendar-o w3-margin-right" aria-hidden="true"></i>Closing Date</b></p>
                                                <input class="w3-input w3-border" type="date" placeholder="Closing Date" name="cdate" required value="' . $row["pro_cdate"] . '">
                                                <p><b><i class="fa fa-user-o w3-margin-right" aria-hidden="true"></i>Team Leader</b></p>
                                                <input class="w3-input w3-border" type="text" placeholder="Team Leader" name="teamleader" required value="' . $row["pro_teamleader"] . '">
                                                <p><b><i class="fa fa-money w3-margin-right" aria-hidden="true"></i>Total Project Cost</b></p>
                                                <input class="w3-input w3-border" type="text" placeholder="LKR" name="tpc" required value="' . $row["pro_tpc"] . '">
                                                <p><b><i class="fa fa-money w3-margin-right" aria-hidden="true"></i>Commitment Amount</b></p>
                                                <input class="w3-input w3-border" type="text" placeholder="LKR" name="ca" required value="' . $row["pro_ca"] . '">
                                                <p><b><i class="fa fa-map-marker w3-margin-right" aria-hidden="true"></i>Location</b></p>
                                                <div class="w3-row">
                                                    <input class="w3-input w3-border w3-third" type="text" placeholder="Latitude" name="lat" id="latinfo" required value="' . $row["pro_lat"] . '">
                                                    <input class="w3-input w3-border w3-third" type="text" placeholder="Longitude" name="lng" id="lnginfo" required value="' . $row["pro_lng"] . '">
                                                    <button class="w3-button w3-border w3-third" onclick="reloadMap()"><i class="fa fa-refresh" aria-hidden="true"></i></button>
                                                </div>
                                                <div id="map" class="w3-card w3-rest w3-margin" style="height: 200px;"></div>
                                                <p><b><i class="fa fa-commenting-o w3-margin-right" aria-hidden="true"></i>Note</b></p>
                                                <textarea class="w3-input w3-border" placeholder="Type here ..." name="note" id="" cols="30" rows="5">' . $row["pro_note"] . '</textarea>
                                            <div>
                                                    <p><b><i class="fa fa-picture-o w3-margin-right" aria-hidden="true"></i>Project pictures</b></p>
                            ';
                                                /********************************************************/
                        echo '
                                                <div class="w3-padding" id="proImgdiv1">
                                                    <label for=""><i class="fa fa-circle-o w3-margin-right" aria-hidden="true"></i>Image 1</label>
                            ';
                        if ($row["pro_imgurl1"] != '') {
                        echo '
                                                    <input type="text" name="keepimg1" value="' . $row["pro_imgurl1"] . '" style="display :none;">
                                                    <table style="width:100%;">
                                                        <tr id="trkeepimg1">
                                                            <td><img src="../res/ServerUploadedImages/' . $row["pro_imgurl1"] . '" class="image" style="width:200px" onclick="onClick(this)" alt="Project Image 1"></td>
                                                            <td><button class="w3-button w3-blue w3-round" onclick="toggle(-1)" type="button">Change</button></td>
                                                        </tr>
                                                        <tr id="trnewimg1" style="display:none;">
                                                            <td><input class="w3-input w3-border" type="file" name="newimg1" accept=".png, .jpg, .jpeg," ></td>
                                                            <td><button class="w3-button w3-blue w3-round" onclick="toggle(1)" type="button">Cancle</button></td>
                                                        </tr>
                                                    </table>
                            ';
                        } else {
                        echo '
                                                    <input class="w3-input w3-border" type="file" name="newimg1" accept=".png, .jpg, .jpeg," >
                                                    <input type="text" name="keepimg1" style="display :none;">
                            ';
                        }
                        echo '                   </div>
                            ';
                                                /********************************************************/
                        echo '
                                                <div class="w3-padding" id="proImgdiv2">
                                                    <label for=""><i class="fa fa-circle-o w3-margin-right" aria-hidden="true"></i>Image 2</label>
                            ';
                        if ($row["pro_imgurl2"] != '') {
                        echo '
                                                    <input type="text" name="keepimg2" value="' . $row["pro_imgurl2"] . '" style="display :none;">
                                                    <table style="width:100%;">
                                                        <tr id="trkeepimg2">
                                                            <td><img src="../res/ServerUploadedImages/' . $row["pro_imgurl2"] . '" class="image" style="width:200px" onclick="onClick(this)" alt="Project Image 2"></td>
                                                            <td><button class="w3-button w3-blue w3-round" onclick="toggle(-2)" type="button">Change</button></td>
                                                        </tr>
                                                        <tr id="trnewimg2" style="display:none;">
                                                            <td><input class="w3-input w3-border" type="file" name="newimg2" accept=".png, .jpg, .jpeg," ></td>
                                                            <td><button class="w3-button w3-blue w3-round" onclick="toggle(2)" type="button">Cancle</button></td>
                                                        </tr>
                                                    </table>
                            ';
                        } else {
                        echo '
                                                    <input class="w3-input w3-border" type="file" name="newimg2" accept=".png, .jpg, .jpeg," >
                                                    <input type="text" name="keepimg2" style="display :none;">
                            ';
                        }
                        echo '                  </div>
                        ';
                                                /********************************************************/
                        echo '
                                                <div class="w3-padding" id="proImgdiv3">
                                                    <label for=""><i class="fa fa-circle-o w3-margin-right" aria-hidden="true"></i>Image 3</label>
                        ';
                        if ($row["pro_imgurl3"] != '') {
                        echo '
                                                    <input type="text" name="keepimg3" value="' . $row["pro_imgurl3"] . '" style="display :none;">
                                                    <table style="width:100%;">
                                                        <tr id="trkeepimg3">
                                                            <td><img src="../res/ServerUploadedImages/' . $row["pro_imgurl3"] . '" class="image" style="width:200px" onclick="onClick(this)" alt="Project Image 3"></td>
                                                            <td><button class="w3-button w3-blue w3-round" onclick="toggle(-3)" type="button">Change</button></td>
                                                        </tr>
                                                        <tr id="trnewimg3" style="display:none;">
                                                            <td><input class="w3-input w3-border" type="file" name="newimg3" accept=".png, .jpg, .jpeg," </td>
                                                            <td><button class="w3-button w3-blue w3-round" onclick="toggle(3)" type="button">Cancle</button></td>
                                                        </tr>
                                                    </table>
                            ';
                        } else {
                        echo '
                                                    <input class="w3-input w3-border" type="file" name="newimg3" accept=".png, .jpg, .jpeg," >
                                                    <input type="text" name="keepimg3" style="display :none;">
                            ';
                        }
                        echo '                  </div>
                        ';
                                                /********************************************************/
                        echo '
                                            </div>
                                        </div>
                                    <div class="w3-rest w3-padding">
                                        <button type="submit" class="w3-button w3-block w3-padding-large w3-green w3-margin-bottom w3-round" name="saveproject" >Save</button>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        ';
                        include_once '../controller/viewProjectMap.php';
                    }
                } else {
                    echo '
                    <center>
                        <img src="../res/img/404.jpg" alt="" style="height: 500px;width :auto;">
                    </center>
                    ';
                }
            }
            ?>
        </div>

    </div>
    <!-- End page content ------------------------------------------------------------------------------------------------------>

    <?php include_once '../shared/footer.php'; ?>

</body>

</html>