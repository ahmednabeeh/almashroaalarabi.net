<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_insert_GenerlUseXV1'] != 1 && $_SESSION['permission_news_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>إضافة هاشتاج</title>
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
                <a href="hashtag_display.php"><img title="عرض وتعديل الهاشتاج" style="border: none;" align="absmiddle" src="../images/icon_hashtag_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['inserting'])) {
                $keyword = getTitle(filter_input(INPUT_POST, 'keyword', FILTER_SANITIZE_STRING));
                $active = getDisplay(filter_input(INPUT_POST, 'active', FILTER_SANITIZE_NUMBER_INT));

                // Exceute the insertion of news query
                if (mysqli_query($serverConnection, "INSERT INTO `news_hashtag` (`hashtag_id`, `keywords`, `active`) VALUES (NULL, '$keyword', '$active');")) {
                    echo "<h2>تم حفظ الهاشتاج \"" . $keyword . "\"</h2>";
                } else {
                    echo "<h2>لم يتم حفظ الهاشتاج! \"" . $keyword . "\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">إضافة هاشتاج</td>
                </tr>
            </table>

            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>الهاشتاج:</td>
                        <td><input name="keyword" id="keyword" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>تفعيل الهاشتاج:</td>
                        <td><input name="active" type="checkbox" checked /></td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="submit" name="inserting" value="إضافة الهاشتاج" /></td>
                    </tr>
                </table>
            </form>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        