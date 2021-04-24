<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_update_GenerlUseXV1'] != 1 && $_SESSION['permission_news_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Check the news id
$hashtag_id = getIdChecker(filter_input(INPUT_GET, 'hashtag_id', FILTER_SANITIZE_NUMBER_INT), "hashtag_display.php");

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تعديل الهاشتاج</title>
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
                <a href="hashtag.php"><img title="إضافة هاشتاج" style="border: none;" align="absmiddle" src="../images/icon_hashtag.png" width="40" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="hashtag_display.php"><img title="عرض هاشتاج" style="border: none;" align="absmiddle" src="../images/icon_hashtag_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['update_hashtag'])) {
                $keyword = getTitle(filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING));
                $active = getDisplay(filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT));

                if (mysqli_query($serverConnection, "UPDATE `news_hashtag` SET `keywords` = '$keyword', `active` = $active WHERE `hashtag_id` = $hashtag_id")) {
                    echo "<h2>تم تعديل الهاشيتاج \"" . $keyword . "\"</h2>";
                } else {
                    echo "<h2>لم يتم تعديل الهاشتاج! \"" . $keyword . "\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">تعديل الهاشتاج</td>
                </tr>
            </table>
            <?php
// Get data
            $modifyNews = "SELECT * FROM `news_hashtag` WHERE `hashtag_id` = $hashtag_id";
            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `news_hashtag` WHERE `hashtag_id` = $hashtag_id")) != 0) {
                $modifyNewsResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `news_hashtag` WHERE `hashtag_id` = $hashtag_id"));
            } else {
                reDirect("hashtag_display.php?message=object not exists");
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الهاشتاج:</td>
                        <td><input name="keyword" id="keyword" type="text" size="35" value="<?php echo $modifyNewsResult['keywords']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>تفعيل الهاشتاج:</td>
                        <td>
                            <?php
                            if ($modifyNewsResult['active'] == 1) {
                                echo "<input name=\"active\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"active\" type=\"checkbox\" />";
                            }
                            ?>    
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="hidden" name="hashtag_id" value="<?php echo $modifyNewsResult['hashtag_id']; ?>" />
                            <input type="submit" name="update_hashtag" value="تعديل الهاشتاج" /></td>
                    </tr>
                </table>
            </form>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        