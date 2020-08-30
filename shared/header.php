<!-- header------------------------------------------------------------------------------------------------------>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-blue w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold;" id="mySidebar"><br>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px;"><i class="fa fa-times" aria-hidden="true"></i></a>
    <div class="w3-container">
        <h3 class="w3-padding-64">
            <center>
                <img src="../res/logo/logo_ico_outline_white.png" alt="" style="height: 50px;width:50px;">
                <br>
                <b>Blue Mountain</b>
                <hr>
                <?php
                if ($loginState == 'true') {
                    echo '
                        <div class="chip">
                            <img src="../res/img/img_avatar.png" alt="Person" width="96" height="96">
                            ' . $firstName . ' ' . $lastName . '
                        </div>
                        ';
                }
                ?>

            </center>
        </h3>
    </div>

    <div class="w3-bar-block w3-padding">
        <a href="index.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-yellow w3-round"><i class="fa fa-home w3-margin-right" aria-hidden="true"></i>Home</a>
        <a href="index.php#projects" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-yellow w3-round"><i class="fa fa-circle-o-notch w3-margin-right" aria-hidden="true"></i>Projects</a>
        <?php
        if ($loginState == 'true') {
            echo '<a href="index.php#addproject" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-yellow"><i class="fa fa-plus-square-o w3-margin-right" aria-hidden="true"></i>Add Project</a>';
        }
        ?>
        <a href="index.php#services" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-yellow w3-round"><i class="fa fa-bookmark-o w3-margin-right" aria-hidden="true"></i>Services</a>
        <a href="index.php#theteam" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-yellow w3-round"><i class="fa fa-users w3-margin-right" aria-hidden="true"></i>The Team</a>
        <a href="index.php#packages" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-yellow w3-round"><i class="fa fa-cube w3-margin-right" aria-hidden="true"></i>Packages</a>
        <a href="index.php#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-yellow w3-round"><i class="fa fa-phone w3-margin-right" aria-hidden="true"></i>Contact</a>
        
        <?php
        if ($loginState == 'false') {
            echo '<hr><a href="../access/login.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-round"><i class="fa fa-sign-in w3-margin-right" aria-hidden="true"></i>Login</a>';
        }else{
            echo '<hr><a href="../access/login.php" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white w3-round"><i class="fa fa-sign-out w3-margin-right" aria-hidden="true"></i>Logout</a>';
        }
        ?>
    </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-blue w3-xlarge w3-padding">
    <a href="javascript:void(0)" class="w3-button w3-blue w3-margin-right" onclick="w3_open()">☰</a>
    <span>Blue Mountain</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!--/.header------------------------------------------------------------------------------------------------------>
