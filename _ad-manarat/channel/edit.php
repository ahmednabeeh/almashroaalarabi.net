<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_update_GenerlUseXV1'] != 1 && $_SESSION['permission_subtitle_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

$modifychannelResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM channel"));

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تعديل البث المباشر</title>
</head>

<body>
    <div id="wrapper">
        <div class="user_info_area">
            <div class="welcome" style="border: none; text-align:right;">
                <?php echo "<span class=\"user_text\">مرحباً " . $_SESSION['fullName_GenerlUseXV1'] . "</span>" ?>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="../home.php"><img title="لوحة التحكم في الموقع" style="border: none;" align="absmiddle" src="../images/iconic_home.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="../../index.php" target="_blank"><img title="عرض الموقع" style="border: none;" align="absmiddle" src="../images/icon_sitehome.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="../support.php"><img title="الدعم الفني" style="border: none;" align="absmiddle" src="../images/icon_support.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="../logout.php"><img title="تسجيل الخروج" style="border: none;" align="absmiddle" src="../images/iconic_logout.png" width="17" /></a>
            </div>
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['update'])) {

//                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $title = $_POST['title'];
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                // Exceute the insertion
                if (mysqli_query($serverConnection, "UPDATE channel SET title = '$title', display = '$display'")) {
                    echo "<h2 align=\"center\" style=\"color: #F00;\"> تم تعديل رابط البث! \"" . $title . "\"</h2>";
                    reDirect("edit.php");
                } else {
                    echo mysqli_error($serverConnection);
                    echo "<h2 align=\"center\" style=\"color: #F00;\">لم يتم تعديل رابط البث! \"" . $title . "\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Subtitle Section -->
                <tr>
                    <td class="section" colspan="4">تعديل رابط البث المباشر</td>
                </tr>
            </table>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>رابط البث:</td>
                        <td><textarea class="textArea" name="title" id="content" rows="5"><?php echo $modifychannelResult['title']; ?></textarea>
                    </tr>
                    <tr valign="top">
                        <td>عرض البث:</td>
                        <td>
                            <?php
                            if ($modifychannelResult['display'] == 1) {
                                echo "<input name=\"display\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"display\" type=\"checkbox\" />";
                            }
                            ?>    
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="submit" name="update" value="تعديل رابط البث" /></td>
                    </tr>
                </table>
            </form>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        