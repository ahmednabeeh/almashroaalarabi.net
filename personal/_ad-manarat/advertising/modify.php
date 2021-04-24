<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_update_GenerlUseXV1'] != 1 && $_SESSION['permission_advertising_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

$advertis_id = getIdChecker(filter_input(INPUT_GET, 'advertis_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تعديل الاعلانات</title>
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
            <div class="navigation_bar">
                <a href="index.php"><img title="إضافة إعلان" style="border: none;" align="absmiddle" src="../images/icon_advertising.png" width="40" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="display.php"><img title="عرض الاعلانات" style="border: none;" align="absmiddle" src="../images/icon_advertising_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['update_advertis'])) {
                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $description = getDescription(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $display_phone = getDisplay(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $advertis_id = getIdChecker(filter_input(INPUT_POST, 'advertis_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
                $advertisImagePath = getUpdatedImagePath("advertising");


                // Version Control
                $restoreVersionResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `advertising` WHERE `advertis_id` = $advertis_id"));

                // Insert into version control table
                mysqli_query($serverConnection, "INSERT INTO `advertising_version_control` VALUES (NULL, '$advertis_id', '$restoreVersionResult[title]', '$restoreVersionResult[description]', '$restoreVersionResult[image]', '$restoreVersionResult[display]', '$restoreVersionResult[display_phone]', '$restoreVersionResult[creation]', '$restoreVersionResult[modify]');");


                // Exceute the insertion of news update  query
                if (mysqli_query($serverConnection, "UPDATE `advertising` SET `title` = '$title', `description` = '$description', `image` = '$advertisImagePath', `display` = $display, `display_phone` = $display_phone, `modify` = CURRENT_TIMESTAMP WHERE `advertis_id` = $advertis_id")) {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">تم تعديل الاعلان \"" . $title . "\"</h2>";
                } else {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">لم يتم تعديل الاعلان! \"" . $title . "\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Video Section -->
                <tr>
                    <td class="section" colspan="4">تعديل الاعلان</td>
                </tr>
            </table>
            <?php
// Get data
            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `advertising` WHERE `advertis_id` = $advertis_id")) != 0) {
                $modifyAdvertisResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `advertising` WHERE `advertis_id` = $advertis_id"));
            } else {
                reDirect("display.php?message=object not exists");
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الاعلان:</td>
                        <td><input name="title" id="title" type="text" size="35" value="<?php echo $modifyAdvertisResult['title']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الاعلان:</td>
                        <td>
                            <?php
                            if ($modifyAdvertisResult['display'] == 1) {
                                echo "<input name=\"display\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"display\" type=\"checkbox\" />";
                            }
                            ?>    
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>حصري على الهاتف:</td>
                        <td>
                            <?php
                            if ($modifyAdvertisResult['display_phone'] == 1) {
                                echo "<input name=\"display_phone\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"display_phone\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>وصف الاعلان:</td>
                        <td><input name="description" id="description" type="text" size="35" value="<?php echo $modifyAdvertisResult['description']; ?>" /></td>
                    </tr>
                    <tr valign="middle">
                        <td>صورة الاعلان:</td>
                        <td>
                            <img src="../images/icon_image.png" width="60" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="hidden" name="advertis_id" value="<?php echo $modifyAdvertisResult['advertis_id']; ?>" />
                            <input type="hidden" name="image_path" value="<?php echo $modifyAdvertisResult['image']; ?>" />
                            <input type="submit" name="update_advertis" value="تعديل الاعلان" /></td>
                    </tr>
                </table>
            </form>

        </div><!-- // Main -->
        <script type="text/javascript">
            function clickImageFile() {
                document.getElementById("image").click();
            }
        </script>
        <?php
        require("../library/footer.php");
        