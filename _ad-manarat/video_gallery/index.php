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

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>إضافة البوم فيديو</title>
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
                <a href="display.php"><img title="عرض وتعديل الالبومات" style="border: none;" align="absmiddle" src="../images/icon_programs_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['inserting_gallery'])) {

                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $description = getDescription(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                $display_phone = getDisplay(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $videoImagePath = getImagePath("video");

                // Exceute the insertion of news query
                if (mysqli_query($serverConnection, "INSERT INTO `video_gallery` (`video_gallery_id`, `title`, `description`, `image`, `display`, `display_phone`, `creation`, `modify`) VALUES (NULL, '$title', '$description', '$videoImagePath', '$display', '$display_phone', CURRENT_TIMESTAMP, '0000-00-00 00:00:00');")) {
                    $video_gallery_id = mysqli_insert_id($serverConnection);
                    reDirect("insert_video.php?video_gallery_id=$video_gallery_id");
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">إضافة البوم فيديو</td>
                </tr>
            </table>

            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الالبوم:</td>
                        <td><input name="title" id="title" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الالبوم:</td>
                        <td><input name="display" type="checkbox" checked /></td>
                    </tr>
                    <tr valign="top">
                        <td>حصري على الهاتف:</td>
                        <td><input name="display_phone" type="checkbox" /></td>
                    </tr>
                    <tr valign="top">
                        <td>الوصف:</td>
                        <td><input name="description" id="description" type="text" size="35" /></td>
                    </tr>
                    <tr valign="middle">
                        <td>صورة البوم الفيديو:</td>
                        <td>
                            <img src="../images/icon_image.png" width="60" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="submit" name="inserting_gallery" value="إضافة الالبوم" /></td>
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
        