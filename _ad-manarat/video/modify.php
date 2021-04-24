<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_update_GenerlUseXV1'] != 1 && $_SESSION['permission_video_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

$video_id = getIdChecker(filter_input(INPUT_GET, 'video_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
$modifyVideoResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `video` WHERE `video_id` = $video_id"));

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تعديل الفيديو</title>
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
                <a href="index.php"><img title="إضافة فيديو" style="border: none;" align="absmiddle" src="../images/icon_video.png" width="40" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="display.php"><img title="عرض الفيديوهات" style="border: none;" align="absmiddle" src="../images/icon_video_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['update_video'])) {

                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $display_phone = getDisplay(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $code = getVideoYoutube($_POST['code']);
                $videoImagePath = getUpdatedImagePath("video");
                $video_id = getIdChecker(filter_input(INPUT_POST, 'video_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

                // Version Control
                $restoreVersionResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `video` WHERE `video_id` = $video_id"));
                mysqli_query($serverConnection, "INSERT INTO `video_version_control` VALUES (NULL, '$video_id', '$restoreVersionResult[title]', '$restoreVersionResult[code]', '$restoreVersionResult[image]', 0, 0, '$restoreVersionResult[display]', '$restoreVersionResult[display_phone]', '$restoreVersionResult[creation]', '$restoreVersionResult[modify]');");


                // Exceute the insertion
                if (mysqli_query($serverConnection, "UPDATE `video` SET `title` = '$title', `code` = '$code', `image` = '$videoImagePath', `display` = $display, `display_phone` = $display_phone, `modify` = CURRENT_TIMESTAMP WHERE `video_id` = $video_id")) {
                    reDirect("?video_id={$video_id}");
                } else {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">لم يتم تعديل الفيديو! \"" . $title . "\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Video Section -->
                <tr>
                    <td class="section" colspan="4">تعديل الخبر</td>
                </tr>
            </table>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الفيديو:</td>
                        <td><input name="title" id="title" type="text" size="35" value="<?php echo $modifyVideoResult['title']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الفيديو:</td>
                        <td>
                            <?php
                            if ($modifyVideoResult['display'] == 1) {
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
                            if ($modifyVideoResult['display_phone'] == 1) {
                                echo "<input name=\"display_phone\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"display_phone\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>كود الفيديو:</td>
                        <td><textarea class="textArea" name="code" id="code" rows="5"><?php echo $modifyVideoResult['code']; ?></textarea></td>
                    </tr>
                    <tr valign="middle">
                        <td>صورة الفيديو:</td>
                        <td>
                            <img src="../images/icon_image.png" width="60" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="hidden" name="video_id" value="<?php echo $modifyVideoResult['video_id']; ?>" />
                            <input type="hidden" name="image_path" value="<?php echo $modifyVideoResult['image']; ?>" />
                            <input type="submit" name="update_video" value="تعديل الفيديو" /></td>
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