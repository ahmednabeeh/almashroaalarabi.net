<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_news_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>عرض الهاشتاج</title>
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
                <a href="index.php"><img title="إضافة هاشتاج" style="border: none;" align="absmiddle" src="../images/icon_hashtag.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Display News Section -->
                <tr>
                    <td class="section" colspan="4">عرض الهاشتاج</td>
                </tr>
            </table>
            <?php
// Display on Site, Mobile, Delete
            if (isset($_GET['hashtag_id']) && isset($_GET['operation'])) {
                $hashtag_id = filter_input(INPUT_GET, 'hashtag_id', FILTER_SANITIZE_NUMBER_INT);
                $operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);

// Diplay on Site
                if ($operation == "hide") {
                    mysqli_query($serverConnection, "UPDATE `news_hashtag` SET `active` = 0 WHERE `hashtag_id` = $hashtag_id;");
                    echo "<h2 align=\"center\">تم تعطيل العنصر بنجاح</h2>";
                } elseif ($operation == "show") {
                    mysqli_query($serverConnection, "UPDATE `news_hashtag` SET `active` = 1 WHERE `hashtag_id` = $hashtag_id;");
                    echo "<h2 align=\"center\">تم تفعيل العنصر بنجاح</h2>";
                } elseif ($operation == "delete") {
                    mysqli_query($serverConnection, "DELETE FROM `news_hashtag` WHERE `hashtag_id` = $hashtag_id;");
                    echo "<h2 align=\"center\">تم مسح العنصر</h2>";
                }
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="5" width="940">
                <tr class="table_header">
                    <td width="30" align="center">تـ.</td>
                    <td width="20" align="center">A</td>
                    <td width="540">الهاشتاج</td>
                    <td width="40" align="center">تعديل</td>
                    <td width="40" align="center">حذف</td>
                </tr>

                <?php
                $counter = 1;
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `news_hashtag`")) == 0) {
                    echo "<tr><td colspan=\"10\"><h2 align=\"center\">لايوجد كلمات هاشتاج</h2></td></tr>";
                } else {
                    $displayNewsArray = mysqli_query($serverConnection, "SELECT * FROM `news_hashtag` ORDER BY `keywords`");
                    while ($displayNewsArrayResult = mysqli_fetch_array($displayNewsArray)) {
                        if ($counter % 2 != 0) {
                            echo "<tr class=\"table_row_a\" valign=\"middle\">";
                        } else {
                            echo "<tr class=\"table_row_b\" valign=\"middle\">";
                        }

                        echo "<td>" . $counter . "</td>";

// Display Eye
                        echo "<td>";
                        if ($displayNewsArrayResult['active'] == 1) {
                            echo "<a href=\"hashtag_display.php?hashtag_id=" . $displayNewsArrayResult['hashtag_id'] . "&operation=hide\"><img src=\"../images/icon_display_on.png\" width=\"20\" /></a>";
                        } else {
                            echo "<a href=\"hashtag_display.php?hashtag_id=" . $displayNewsArrayResult['hashtag_id'] . "&operation=show\"><img src=\"../images/icon_display_off.png\" width=\"20\" /></a>";
                        }
                        echo "</td>";



// Display Title
                        echo "<td>" . $displayNewsArrayResult['keywords'] . "</td>";


// Modify
                        echo "<td align=\"center\">";
                        if ($_SESSION['permission_update_GenerlUseXV1'] == 1) {
                            echo "<a href=\"hashtag_modify.php?hashtag_id=" . $displayNewsArrayResult['hashtag_id'] . "\"><img src=\"../images/icon_modify.png\" width=\"25\" /></a>";
                        } else {
                            echo "<img src=\"../images/icon_modify_off.png\" width=\"25\" />";
                        }
                        echo "</td>";


// Delete
                        echo "<td align=\"center\">";
                        if ($_SESSION['permission_delete_GenerlUseXV1'] == 1) {
                            echo "<a href=\"hashtag_display.php?hashtag_id=" . $displayNewsArrayResult['hashtag_id'] . "&operation=delete\"><img src=\"../images/icon_delete.png\" width=\"25\" /></a>";
                        } else {
                            echo "<img src=\"../images/icon_delete_off.png\" width=\"25\" />";
                        }
                        echo "</td>";
                        echo "</tr>";
                        $counter++;
                    }
                }
                ?>
            </table>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        