<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_update_GenerlUseXV1'] != 1 && $_SESSION['permission_gallery_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

$video_id = getIdChecker(filter_input(INPUT_GET, 'video_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
$video_gallery_id = getIdChecker(filter_input(INPUT_GET, 'video_gallery_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

$modifyGalleryImageResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `video_gallery_items` WHERE `video_id` = $video_id"));

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تعديل فيديو الالبوم</title>
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
            if (isset($_POST['update_gallery_video'])) {
                
                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $display_phone = getDisplay(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $video_gallery_id = getIdChecker(filter_input(INPUT_POST, 'video_gallery_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
                $video_id = getIdChecker(filter_input(INPUT_POST, 'video_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
                $code = getVideoYoutube($_POST['code']);
                $updateImagePath = getUpdatedImagePath("programs");

                // Exceute the insertion
                if (mysqli_query($serverConnection, "UPDATE `video_gallery_items` SET `title` = '$title', `code` = '$code', `image` = '$updateImagePath', `display` = $display, `display_phone` = $display_phone, `modify` = CURRENT_TIMESTAMP WHERE `video_gallery_id` = $video_gallery_id AND `video_id` = $video_id")) {
                    reDirect("display_video.php?video_gallery_id=$video_gallery_id");
                } else {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">لم يتم تعديل الفيديو! \"" . $title . "\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">تعديل الفيديو الالبوم</td>
                </tr>
            </table>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الفيديو:</td>
                        <td><input name="title" id="title" type="text" size="35" value="<?php echo $modifyGalleryImageResult['title']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الفيديو:</td>
                        <td>
                            <?php
                            if ($modifyGalleryImageResult['display'] == 1) {
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
                            if ($modifyGalleryImageResult['display_phone'] == 1) {
                                echo "<input name=\"display_phone\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"display_phone\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>كود الفيديو:</td>
                        <td><textarea class="textArea" name="code" id="code" rows="5"><?php echo $modifyGalleryImageResult['code']; ?></textarea></td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="hidden" name="video_gallery_id" value="<?php echo $modifyGalleryImageResult['video_gallery_id']; ?>" />
                            <input type="hidden" name="image_path" value="<?php echo $modifyNewsResult['image']; ?>" />
                            <input type="hidden" name="video_id" value="<?php echo $modifyGalleryImageResult['video_id']; ?>" />
                            <img class="imageIcon" style="width: 50px;" src="../images/icon_image.png" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                            <input type="submit" name="update_gallery_video" value="تعديل الفيديو" /></td>
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
        