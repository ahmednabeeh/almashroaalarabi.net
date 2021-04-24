<?php
ob_start();
session_start();


// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_insert_GenerlUseXV1'] != 1 && $_SESSION['permission_video_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

$video_gallery_id = getIdChecker(filter_input(INPUT_GET, 'video_gallery_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>إضافة فيديو للالبوم</title>
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
                <a href="display_video.php?video_gallery_id=<?php echo $video_gallery_id; ?>"><img title="عرض وتعديل الالبومات" style="border: none;" align="absmiddle" src="../images/icon_video_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['inserting_video'])) {

                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $display_phone = getDisplay(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $video_gallery_id = getIdChecker(filter_input(INPUT_POST, 'video_gallery_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
                $code = getVideoYoutube($_POST['code']);
                $videoImagePath = getImagePath("programs");

                // Exceute the insertion
                if (mysqli_query($serverConnection, "INSERT INTO `video_gallery_items` (`video_id`, `video_gallery_id`, `title`, `code`, `image`, `display`, `display_phone`, `creation`, `modify`) VALUES (NULL, $video_gallery_id, '$title', '$code', '$videoImagePath', '$display', '$display_phone', CURRENT_TIMESTAMP, '0000-00-00 00:00:00');")) {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">تم حفظ الفيديو \"" . $title . "\"</h2>";
                } else {
                    echo "<br /><br /><h2 align=\"center\" style=\"color: #F00;\">لم يتم حفظ الفيديو! \"" . $title . "\"</h2><br /><br /><br />";
                }
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">إضافة فيديو للالبوم</td>
                </tr>
            </table>

            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الفيديو:</td>
                        <td><input name="title" id="title" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الفيديو:</td>
                        <td><input name="display" type="checkbox" checked /></td>
                    </tr>
                    <tr valign="top">
                        <td>حصري على الهاتف:</td>
                        <td><input name="display_phone" type="checkbox" /></td>
                    </tr>
                    <tr valign="top">
                        <td>كود اليوتيوب:</td>
                        <td><textarea class="textArea" name="code" id="code" rows="5"></textarea></td>
                    </tr>
                    <tr valign="middle">
                        <td>صورة الفيديو:</td>
                        <td>
                            <img class="imageIcon" style="width: 50px;" src="../images/icon_image.png" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input name="video_gallery_id" id="video_gallery_id" type="hidden" value="<?php echo $video_gallery_id; ?>" />
                            <input type="submit" name="inserting_video" value="إضافة الفيديو" /></td>
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
        