// Script to open and close sidebar
function w3_open() {
    document.getElementById("mySidebar").style.display = "block";
    document.getElementById("myOverlay").style.display = "block";
}

function w3_close() {
    document.getElementById("mySidebar").style.display = "none";
    document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
    document.getElementById("img01").src = element.src;
    document.getElementById("modal01").style.display = "block";
    var captionText = document.getElementById("caption");
    captionText.innerHTML = element.alt;
}

function toggleimginput(xx) {
    var proImgdiv2 = document.getElementById("proImgdiv2");
    var proImgdiv3 = document.getElementById("proImgdiv3");
    var minImg = document.getElementById("minImg");
    var plusImg = document.getElementById("plusImg");
    var stateimgdiv = document.getElementById("stateimgdiv");
    if (xx == 1) {
        if (stateimgdiv.innerHTML == 1) {
            proImgdiv2.style.display = "block";
            stateimgdiv.innerHTML = 2;
            minImg.style.display = "inline"
        } else if (stateimgdiv.innerHTML == 2) {
            proImgdiv3.style.display = "block";
            stateimgdiv.innerHTML = 3;
            plusImg.style.display = "none";
        } else {

        }
    } else if (xx == -1) {
        if (stateimgdiv.innerHTML == 3) {
            proImgdiv3.style.display = "none";
            stateimgdiv.innerHTML = 2;
            plusImg.style.display = "inline";
        } else if (stateimgdiv.innerHTML == 2) {
            proImgdiv2.style.display = "none";
            stateimgdiv.innerHTML = 1;
            minImg.style.display = "none";
        } else {

        }
    }


}


function deleteProject(xx) {
    var r = confirm("Are you sure you want to delete this Project ?");
    if (r == true) {
        $.ajax({
            type: 'POST',
            url: '../controller/viewProjectController.php?delete_pro_id=' + xx + '',
            dataType: "JSON",
            success: function (feedback) {
                console.log(feedback);
                if (feedback['status'] == 'success') {
                    location = feedback['msg'];
                } else if (feedback['status'] == 'error') {
                    alert(feedback['msg']);
                }
            },
            error: function (error) {
                console.log(error);
                alert('<h4>Internal Server Error !</h4><p>' + (error.responseText + '</p>'));
            }
        })
    } else {

    }
}


function toggle(yy) {
    trkeepimg1 = document.getElementById("trkeepimg1");
    trkeepimg2 = document.getElementById("trkeepimg2");
    trkeepimg3 = document.getElementById("trkeepimg3");
    trnewimg1 = document.getElementById("trnewimg1");
    trnewimg2 = document.getElementById("trnewimg2");
    trnewimg3 = document.getElementById("trnewimg3");

    if (yy == -1) {
        trkeepimg1.style.display = "none";
        trnewimg1.style.display = "";
    } else if (yy == 1) {
        trkeepimg1.style.display = "";
        trnewimg1.style.display = "none";
    } else if (yy == -2) {
        trkeepimg2.style.display = "none";
        trnewimg2.style.display = "";
    } else if (yy == 2) {
        trkeepimg2.style.display = "";
        trnewimg2.style.display = "none";
    } else if (yy == -3) {
        trkeepimg3.style.display = "none";
        trnewimg3.style.display = "";
    } else if (yy == 3) {
        trkeepimg3.style.display = "";
        trnewimg3.style.display = "none";
    }
}

function openEditProjectModel() {
    document.getElementById("editProjectModel").style.display = "block";
}

function closeEditProjectModel() {
    document.getElementById("editProjectModel").style.display = "none";
}