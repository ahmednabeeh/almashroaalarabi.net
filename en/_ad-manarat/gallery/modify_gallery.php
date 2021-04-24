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

$gallery_id = getIdChecker(filter_input(INPUT_GET, 'gallery_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
$gallery_image_id = getIdChecker(filter_input(INPUT_GET, 'gallery_image_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

$modifyGalleryImageResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `gallery_images` WHERE `gallery_image_id` = $gallery_image_id"));

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تعديل صورة الالبوم</title>
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
            if (isset($_POST['update_gallery_image'])) {

                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $display_phone = getDisplay(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $gallery_id = getIdChecker(filter_input(INPUT_POST, 'gallery_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
                $gallery_image_id = getIdChecker(filter_input(INPUT_POST, 'gallery_image_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
                $galleryImagePath = getUpdatedImagePath("gallery");

                // Exceute the insertion
                if (mysqli_query($serverConnection, "UPDATE `gallery_images` SET `title` = '$title', `image` = '$galleryImagePath', `display` = $display, `display_phone` = $display_phone, `modify` = CURRENT_TIMESTAMP WHERE `gallery_image_id` = $gallery_image_id")) {
                    reDirect("display_gallery.php?gallery_id=$gallery_id");
                } else {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">لم يتم تعديل الصورة! \"" . $title . "\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">تعديل صورة الالبوم</td>
                </tr>
            </table>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الصورة:</td>
                        <td><input name="title" id="title" type="text" size="35" value="<?php echo $modifyGalleryImageResult['title']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الصورة:</td>
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
                    <tr valign="middle">
                        <td>الصورة:</td>
                        <td>
                            <img src="../images/icon_image.png" width="60" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="hidden" name="gallery_image_id" value="<?php echo $modifyGalleryImageResult['gallery_image_id']; ?>" />
                            <input type="hidden" name="gallery_id" value="<?php echo $modifyGalleryImageResult['gallery_id']; ?>" />
                            <input type="hidden" name="image_path" value="<?php echo $modifyGalleryImageResult['image']; ?>" />
                            <input type="submit" name="update_gallery_image" value="تعديل الصورة" /></td>
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
        