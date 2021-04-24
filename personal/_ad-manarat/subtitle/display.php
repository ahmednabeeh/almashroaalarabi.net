<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_subtitle_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>عرض الاشرطة الاخبارية</title>
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
                <a href="index.php"><img title="إضافة شريط أخباري" style="border: none;" align="absmiddle" src="../images/icon_subtitle.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Display News Section -->
                <tr>
                    <td class="section" colspan="4">عرض الاشرطةالمتحركة</td>
                </tr>
            </table>
            <?php
            // Display on Site, Mobile, Delete
            if (isset($_GET['subtitle_id']) && isset($_GET['operation'])) {

                $subtitle_id = filter_input(INPUT_GET, 'subtitle_id', FILTER_SANITIZE_NUMBER_INT);
                $operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);

                // Diplay on Site
                if ($operation == "hide") {
                    mysqli_query($serverConnection, "UPDATE `subtitle` SET `display` = 0 WHERE `subtitle_id` = $subtitle_id;");
                    echo "<h2 align=\"center\">تم أخفاء العنصر بنجاح</h2>";
                } elseif ($operation == "show") {
                    mysqli_query($serverConnection, "UPDATE `subtitle` SET `display` = 1 WHERE `subtitle_id` = $subtitle_id;");
                    echo "<h2 align=\"center\">تم عرض العنصر بنجاح</h2>";
                } elseif ($operation == "delete") {
                    mysqli_query($serverConnection, "UPDATE `subtitle` SET `display` = 2 WHERE `subtitle_id` = $subtitle_id;");
                    echo "<h2 align=\"center\">تم مسح العنصر</h2>";
                }
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="5" width="940">
                <tr class="table_header">
                    <td width="30" align="center">تـ.</td>
                    <td width="20" align="center"> </td>
                    <td width="580">عنوان الشريط الاخباري</td>
                    <td width="100" align="center">التاريخ</td>
                    <td width="40" align="center">تعديل</td>
                    <td width="40" align="center">حذف</td>
                </tr>

                <?php
// Display News
                $counter = 1;
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `subtitle` WHERE `display` IN(0,1)")) == 0) {
                    echo "<tr><td colspan=\"5\"><h2 align=\"center\">لايوجد شريط أخباري</h2></td></tr>";
                } else {
                    $displaySubtitleArray = mysqli_query($serverConnection, "SELECT * FROM `subtitle` WHERE `display` IN(0,1) ORDER BY `subtitle_id` DESC");
                    while ($displaySubtitleArrayResult = mysqli_fetch_array($displaySubtitleArray)) {
                        if ($counter % 2 != 0) {
                            echo "<tr class=\"table_row_a\" valign=\"middle\">";
                        } else {
                            echo "<tr class=\"table_row_b\" valign=\"middle\">";
                        }
                        echo "<td>" . $counter . "</td>";

                        // Display Eye
                        echo "<td>";
                        if ($displaySubtitleArrayResult['display'] == 1) {
                            echo "<a href=\"display.php?subtitle_id=" . $displaySubtitleArrayResult['subtitle_id'] . "&operation=hide\"><img src=\"../images/icon_display_on.png\" width=\"20\" /></a>";
                        } else {
                            echo "<a href=\"display.php?subtitle_id=" . $displaySubtitleArrayResult['subtitle_id'] . "&operation=show\"><img src=\"../images/icon_display_off.png\" width=\"20\" /></a>";
                        }
                        echo "</td>";

                        // Display Title
                        echo "<td>";
                        $titleExplodeArray = explode(" ", $displaySubtitleArrayResult['title']);
                        $title = "";
                        for ($i = 0; $i <= 7; $i++) {
                            $title .= $titleExplodeArray[$i] . " ";
                        }
                        echo $title;
                        echo "</td>";

                        // Display Time
                        echo "<td>";
                        $timeExplode = explode(" ", $displaySubtitleArrayResult['creation']);
                        echo $timeExplode[0];
                        echo "</td>";

                        // Modify
                        echo "<td>";
                        if ($_SESSION['permission_update_GenerlUseXV1'] == 1) {
                            echo "<a href=\"modify.php?subtitle_id=" . $displaySubtitleArrayResult['subtitle_id'] . "\"><img src=\"../images/icon_modify.png\" width=\"25\" /></a>";
                        } else {
                            echo "<img src=\"../images/icon_modify_off.png\" width=\"25\" />";
                        }
                        echo "</td>";


                        // Delete
                        echo "<td>";
                        if ($_SESSION['permission_delete_GenerlUseXV1'] == 1) {
                            echo "<a href=\"display.php?subtitle_id=" . $displaySubtitleArrayResult['subtitle_id'] . "&operation=delete\"><img src=\"../images/icon_delete.png\" width=\"25\" /></a>";
                        } else {
                            echo "<img src=\"../images/icon_delete_off.png\" width=\"25\" />";
                        }
                        echo "</td>";
                        echo "</tr>";
                    } // End if row a				
                    $counter++;
                } // While ends
                ?>
            </table>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        