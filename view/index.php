<?php include_once '../shared/headerLinkRel.php'; ?>

<body>

    <?php include_once '../shared/header.php'; ?>

    <!-- !PAGE CONTENT! ------------------------------------------------------------------------------------------------------>
    <div class="w3-main" style="margin-left:340px;margin-right:40px">

        <!-- Header -->
        <div class="w3-container" style="margin-top:80px" id="projects">
            <h1 class="w3-xxxlarge w3-text-blue"><b>Projects. <b class="w3-small">( <b id="pCountDis"></b> )</b></b></h1>
            <hr style="width:50px;border:5px solid teal" class="w3-round">
        </div>
        
        <!-- Photo grid (modal) -->
        <div class="w3-row-padding" style="max-height: 600px;overflow:auto;">
            <?php
            // Create connection
            $conn = mysqli_connect(Database::$host, Database::$username, Database::$password, Database::$dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM projects ORDER BY pro_datentime DESC ";
            $result = $conn->query($sql);
            $result2 = $conn->query($sql);

            if ($result->num_rows > 0) {
                $rowCount = $result->num_rows;
                $modCount = ($rowCount % 2);

                echo '<script>document.getElementById("pCountDis").innerHTML = "'.$rowCount.'";</script>';

                echo '<div class="w3-half">';
                if ($modCount == 1) {
                    $firsthalf = (($rowCount / 2) + 0.5);

                    $fetchfirstRowCount = 0;
                    while ($row = $result->fetch_assoc()) {
                        $fetchfirstRowCount++;
                        if ($firsthalf <= $fetchfirstRowCount) {
                            echo '
                        <div class="container">
                            <img src="../res/ServerUploadedImages/' . $row["pro_imgurl1"] . '" class="image" style="width:100%" onclick="onClick(this)" alt="Project Image">
                            <div class="overlay bottom">
                                <div class="text">
                                    <p>' . $row["pro_name"] . '</p>
                                    <p>' . $row["pro_tpc"] . '</p>
                                    <p><a href="viewProject.php?viewid=' . $row["pro_id"] . '" class="w3-small w3-button w3-border w3-padding">View more <i class="fa fa-angle-up w3-margin-left" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                        </div>
                        ';
                        }
                    }
                } else {
                    $firsthalf = ($rowCount / 2);
                    $fetchfirstRowCount = 0;
                    while ($row = $result->fetch_assoc()) {
                        $fetchfirstRowCount++;
                        if ($firsthalf < $fetchfirstRowCount) {
                            echo '
                        <div class="container">
                            <img src="../res/ServerUploadedImages/' . $row["pro_imgurl1"] . '" class="image" style="width:100%" onclick="onClick(this)" alt="Project Image">
                            <div class="overlay bottom">
                                <div class="text">
                                    <p>' . $row["pro_name"] . '</p>
                                    <p>' . $row["pro_tpc"] . '</p>
                                    <p><a href="viewProject.php?viewid=' . $row["pro_id"] . '" class="w3-small w3-button w3-border w3-padding">View more <i class="fa fa-angle-up w3-margin-left" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                        </div>
                        ';
                        }
                    }
                }
                $secondhalf = $rowCount - $firsthalf;
                echo '</div>';
                echo '<div class="w3-half">';
                $fetchlastRowCount = 0;
                while ($row2 = $result2->fetch_assoc()) {
                    $fetchlastRowCount++;
                    if ($secondhalf >= $fetchlastRowCount) {
                        echo '
                        <div class="container">
                            <img src="../res/ServerUploadedImages/' . $row2["pro_imgurl1"] . '" class="image" style="width:100%" onclick="onClick(this)" alt="Project Image">
                            <div class="overlay top">
                                <div class="text">
                                    <p>' . $row2["pro_name"] . '</p>
                                    <p>' . $row2["pro_tpc"] . '</p>
                                    <p><a href="viewProject.php?viewid=' . $row2["pro_id"] . '" class="w3-small w3-button w3-border w3-padding">View more <i class="fa fa-angle-down w3-margin-left" aria-hidden="true"></i></a></p>
                                </div>
                            </div>
                        </div>
                        ';
                    }
                }
                echo '</div>';
            } else {
                echo '
                <center>
                <img src="../res/img/notfound.jpg" alt="" style="height: 200px;width :auto;">
                <h5>Whoops! No Projects yet!</h5>
                </center>
                ';
            }
            ?>

        </div>

        <?php
        if ($loginState == 'true') {
            echo '
                <!-- add project -->
                <div class="w3-container" id="addproject" style="margin-top:75px">
                    <h1 class="w3-xxxlarge w3-text-blue"><b>Add Project.</b></h1>
                    <hr style="width:50px;border:5px solid teal" class="w3-round">
                    <form action="../controller/addProjectController.php" method="POST" enctype="multipart/form-data">
                        <div class="w3-row w3-card">
                            <div class="w3-half w3-padding">
                                <p><b><i class="fa fa-circle-o-notch w3-margin-right" aria-hidden="true"></i>Project Name</b></p>
                                <input class="w3-input w3-border" type="text" placeholder="Project Name" name="pname" required>
                                <p><b><i class="fa fa-globe w3-margin-right" aria-hidden="true"></i> Country</b></p>
                                <input class="w3-input w3-border" type="text" placeholder="Country" name="country" required>
                                <p><b><i class="fa fa-globe w3-margin-right" aria-hidden="true"></i>Region</b></p>
                                <input class="w3-input w3-border" type="text" placeholder="Region" name="region" required>
                                <p><b><i class="fa fa-calendar-o w3-margin-right" aria-hidden="true"></i>Approval Date</b></p>
                                <input class="w3-input w3-border" type="date" placeholder="Approval Date" name="apdate" required>
                                <p><b><i class="fa fa-calendar-o w3-margin-right" aria-hidden="true"></i>Closing Date</b></p>
                                <input class="w3-input w3-border" type="date" placeholder="Closing Date" name="cdate" required>
                                <p><b><i class="fa fa-user-o w3-margin-right" aria-hidden="true"></i>Team Leader</b></p>
                                <input class="w3-input w3-border" type="text" placeholder="Team Leader" name="teamleader" required>
                                <p><b><i class="fa fa-money w3-margin-right" aria-hidden="true"></i>Total Project Cost</b></p>
                                <input class="w3-input w3-border" type="text" placeholder="LKR" name="tpc" required>
                                <p><b><i class="fa fa-money w3-margin-right" aria-hidden="true"></i>Commitment Amount</b></p>
                                <input class="w3-input w3-border" type="text" placeholder="LKR" name="ca" required>
                            </div>
                            <div class="w3-half w3-padding">
                                <p><b><i class="fa fa-map-marker w3-margin-right" aria-hidden="true"></i>Location</b></p>
                                <div class="w3-row">
                                    <input class="w3-input w3-border w3-half" type="text" placeholder="Latitude" name="lat" id="latinfo" required>
                                    <input class="w3-input w3-border w3-half" type="text" placeholder="Longitude" name="lng" id="lnginfo" required>
                                </div>
                                <br>
                                <div id="map" class="w3-card w3-border w3-rest" style="height: 300px;">
                            </div>
                ';
            include_once("../controller/adminmap.php");
            echo '
                                <p><b><i class="fa fa-commenting-o w3-margin-right" aria-hidden="true"></i>Note</b></p>
                                <textarea class="w3-input w3-border" placeholder="Type here ..." name="note" id="" cols="30" rows="5"></textarea>
                            <div>
                                <p><b><i class="fa fa-picture-o w3-margin-right" aria-hidden="true"></i>Project pictures</b></p>
                                <div class="w3-padding" id="proImgdiv1">
                                    <label for=""><i class="fa fa-circle-o w3-margin-right" aria-hidden="true"></i>Image 1</label>
                                    <input class="w3-input w3-border" type="file" name="proimg1" accept=".png, .jpg, .jpeg" required>
                                </div>
                                <div class="w3-padding" id="proImgdiv2" style="display: none;">
                                    <label for=""><i class="fa fa-circle-o w3-margin-right" aria-hidden="true"></i>Image 2</label>
                                    <input class="w3-input w3-border" type="file" name="proimg2" accept=".png, .jpg, .jpeg">
                                </div>
                                <div class="w3-padding" id="proImgdiv3" style="display: none;">
                                    <label for=""><i class="fa fa-circle-o w3-margin-right" aria-hidden="true"></i>Image 3</label>
                                    <input class="w3-input w3-border" type="file" name="proimg3" accept=".png, .jpg, .jpeg">
                                </div>
                                <div class="w3-right w3-padding">
                                    <button type="button" class="w3-button w3-border" id="minImg" onclick="toggleimginput(-1)" style="display: none;">&#9472;</button>
                                    <button type="button" class="w3-button w3-border" id="plusImg" onclick="toggleimginput(1)">&#10010;</button>
                                    <p id="stateimgdiv" style="display: none;">1</p>
                                </div>
                            </div>
                        </div>
                        <div class="w3-half w3-padding">
                            <button type="submit" class="w3-button w3-block w3-padding-large w3-green w3-margin-bottom w3-round" name="addproject">Add project</button>
                        </div>

                    </form>
                </div>
                ';
        }
        ?>


        <!-- Services -->
        <div class="w3-container" id="services" style="margin-top:75px">
            <h1 class="w3-xxxlarge w3-text-blue"><b>Services.</b></h1>
            <hr style="width:50px;border:5px solid teal" class="w3-round">
            <p>We offer an island wide service covering areas of the West Coast, the South Coast, the East Coast as well as the spectacular Highlands. Over the past 15 years we have established a fine network of reliable contacts all over the country enabling us to offer exceptional property island wide. Colombo and its periphery are the only areas that we do not operate in. We have also ventured into Property Development, Property Investment, Property Management, Luxury Villa Management, Plantation Management and Luxury Villa Rentals as well as Project Management.</p>
            <p>Do give us a call on +94 777 760 615 (office hours 9am to 5pm - 5 hours and 30 minutes ahead of GMT/UTC (UTC+05:30)) or drop an email to sales@lankarealestate.com if you would like to arrange an appointment to discuss any of our services.</p>
        </div>

        <!-- Designers -->
        <div class="w3-container" id="theteam" style="margin-top:75px">
            <h1 class="w3-xxxlarge w3-text-blue"><b>The Team.</b></h1>
            <hr style="width:50px;border:5px solid teal" class="w3-round">
            <p>The best team in the world.</p>
            <p>Blue Mountain started as a small service helping friends from abroad find small gems in the form of land and old colonial houses through our contacts in the Hill Country. It wasn’t long before we discovered we had an invaluable service to offer, not only in finding suitable properties for buyers, but also in helping our clients wade through the bureaucratic red tape involved in buying property in Sri Lanka, and ensuring they got exactly what they paid for. Word of mouth soon helped spread our reputation to other areas of Sri Lanka. Our head office is now based in the 16th century Portugese Fort of Galle, a Unesco World Heritage site located in the Southern Province, close to some of the Island's most popular beaches.
            </p>
        </div>

        <!-- The Team -->
        <div class="w3-row-padding w3-grayscale">
            <div class="w3-col m4 w3-margin-bottom">
                <div class="w3-light-grey">
                    <img src="../res/img/team2.jpg" alt="John" style="width:100%">
                    <div class="w3-container">
                        <h3>Ivan Robinson</h3>
                        <p class="w3-opacity">Managing Director</p>
                        <p style="max-height: 200px;overflow:auto;">With over 28 years of experience in the Real Estate business, Ivan’s early career was spent in the UK London property market and then in France under the umbrella of the Aprim-Deromedi condominium development company, at that time the largest property development company operating in the south of France and in the principality of Monaco. In 2004 he relocated to Sri Lanka where he joined his long standing friend Giles Scott whom in 2002 founded LankaRealEstate.com, and remains a director. By offering a world class level of professionalism in a developing market, Ivan has established an extensive network and an unparalleled knowledge of the country. He lives in Galle with his wife and kids and spends his free time up-country learning how to cultivate tea, spices, rice and other wonderful crops!</p>
                    </div>
                </div>
            </div>
            <div class="w3-col m4 w3-margin-bottom">
                <div class="w3-light-grey">
                    <img src="../res/img/team1.jpg" alt="Jane" style="width:100%">
                    <div class="w3-container">
                        <h3>Jane Doe</h3>
                        <p class="w3-opacity">PA and Accounts Manager</p>
                        <p style="max-height: 200px;overflow:auto;">Having been with Lanka Real Estate since the start of the company, Dilini has been the backbone and a tremendous support, not only to LRE but also all our clients, who rely on her to keep all their accounts up to date. First into the office and last out in the evening, she keeps everyone in the office on their toes. We simply cannot do without her!</p>
                    </div>
                </div>
            </div>
            <div class="w3-col m4 w3-margin-bottom">
                <div class="w3-light-grey">
                    <img src="../res/img/team3.jpg" alt="Mike" style="width:100%">
                    <div class="w3-container">
                        <h3>Mike Ross</h3>
                        <p class="w3-opacity">Operations Manager</p>
                        <p style="max-height: 200px;overflow:auto;">Mike Ross has worked for Lanka Real Estate for over two years. Previously he was a front-line Intelligence Officer in the Sri Lankan Army which, amongst other things, means that he has great attention to detail and nothing gets past him. As our Operations Manager his day-to-day duties are to manage all of our clients properties from building sites to plantations, and through direct contact with the local authorities to obtain approvals for all developments. Azam is also our troubleshooter in any situation as well as he being an invaluable personal advisor in terms of local cultural differences.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Packages / Pricing Tables -->
        <div class="w3-container" id="packages" style="margin-top:75px">
            <h1 class="w3-xxxlarge w3-text-blue"><b>Packages.</b></h1>
            <hr style="width:50px;border:5px solid teal" class="w3-round">
            <p>Our packages</p>
        </div>

        <div class="w3-row-padding">
            <div class="w3-half w3-margin-bottom">
                <ul class="w3-ul w3-light-grey w3-center">
                    <li class="w3-dark-grey w3-xlarge w3-padding-32">Basic</li>
                    <li class="w3-padding-16">Floorplanning</li>
                    <li class="w3-padding-16">10 hours support</li>
                    <li class="w3-padding-16">Photography</li>
                    <li class="w3-padding-16">20% furniture discount</li>
                    <li class="w3-padding-16">Good deals</li>
                    <li class="w3-padding-16">
                        <h2>$ 199</h2>
                        <span class="w3-opacity">per room</span>
                    </li>
                </ul>
            </div>

            <div class="w3-half">
                <ul class="w3-ul w3-light-grey w3-center">
                    <li class="w3-blue w3-xlarge w3-padding-32">Pro</li>
                    <li class="w3-padding-16">Floorplanning</li>
                    <li class="w3-padding-16">50 hours support</li>
                    <li class="w3-padding-16">Photography</li>
                    <li class="w3-padding-16">50% furniture discount</li>
                    <li class="w3-padding-16">GREAT deals</li>
                    <li class="w3-padding-16">
                        <h2>$ 249</h2>
                        <span class="w3-opacity">per room</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Contact -->
        <div class="w3-container" id="contact" style="margin-top:75px">
            <h1 class="w3-xxxlarge w3-text-blue"><b>Contact.</b></h1>
            <hr style="width:50px;border:5px solid teal" class="w3-round">
            <p>Do you want us to find your home? Fill out the form and fill me in with the details :) We love meeting new people!</p>
            <form action="/action_page.php" target="_blank">
                <div class="w3-section">
                    <label>Name</label>
                    <input class="w3-input w3-border" type="text" name="Name" required>
                </div>
                <div class="w3-section">
                    <label>Email</label>
                    <input class="w3-input w3-border" type="text" name="Email" required>
                </div>
                <div class="w3-section">
                    <label>Message</label>
                    <input class="w3-input w3-border" type="text" name="Message" required>
                </div>
                <button type="submit" class="w3-button w3-block w3-padding-large w3-blue w3-margin-bottom">Send Message</button>
            </form>
        </div>

        <!-- End page content -->
    </div>
    <!-- End page content ------------------------------------------------------------------------------------------------------>

    <?php include_once '../shared/footer.php'; ?>

</body>

</html>