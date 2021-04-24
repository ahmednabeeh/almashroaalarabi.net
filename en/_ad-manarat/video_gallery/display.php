<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_video_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>عرض البومات الفيديو</title>
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
                <a href="index.php"><img title="إضافة البوم" style="border: none;" align="absmiddle" src="../images/icon_programs.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Display News Section -->
                <tr>
                    <td class="section" colspan="4">عرض البومات الفيديو</td>
                </tr>
            </table>
            <?php
            // Display on Site, Mobile, Delete
            if (isset($_GET['video_gallery_id']) && isset($_GET['operation'])) {
                $video_gallery_id = filter_input(INPUT_GET, 'video_gallery_id', FILTER_SANITIZE_NUMBER_INT);
                $operation = filter_input(INPUT_GET, 'operation', FILTER_SANITIZE_STRING);


                if ($operation == "hide") {
                    mysqli_query($serverConnection, "UPDATE `video_gallery` SET `display` = 0 WHERE `video_gallery_id` = $video_gallery_id;");
                    echo "<h2 align=\"center\">تم أخفاء العنصر بنجاح</h2>";
                } elseif ($operation == "show") {
                    mysqli_query($serverConnection, "UPDATE `video_gallery` SET `display` = 1 WHERE `video_gallery_id` = $video_gallery_id;");
                    echo "<h2 align=\"center\">تم عرض العنصر بنجاح</h2>";
                } elseif ($operation == "hide_phone") {
                    mysqli_query($serverConnection, "UPDATE `video_gallery` SET `display_phone` = 0 WHERE `video_gallery_id` = $video_gallery_id;");
                    echo "<h2 align=\"center\">تم أخفاء العنصر عن برامج الهاتف</h2>";
                } elseif ($operation == "show_phone") {
                    mysqli_query($serverConnection, "UPDATE `video_gallery` SET `display_phone` = 1 WHERE `video_gallery_id` = $video_gallery_id;");
                    echo "<h2 align=\"center\">تم إضهار العنصر عن برنامج الهاتف</h2>";
                } elseif ($operation == "delete") {
                    mysqli_query($serverConnection, "UPDATE `video_gallery` SET `display` = 2 WHERE `video_gallery_id` = $video_gallery_id;");
                    echo "<h2 align=\"center\">تم مسح العنصر</h2>";
                }
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="5" width="940">
                <tr class="table_header">
                    <td width="30" align="center">تـ.</td>
                    <td width="20" align="center"> </td>
                    <td width="20" align="center"> </td>
                    <td width="400">عنوان الالبوم</td>
                    <td width="100" align="center">التاريخ</td>
                    <td width="50" align="center">أضافة فيديو</td>
                    <td width="50" align="center">فيديو الاليوم</td>
                    <td width="50" align="center">تعديل</td>
                    <td width="50" align="center">حذف</td>
                </tr>

                <?php
// Display News
                $counter = 1;
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `video_gallery` WHERE `display` IN(0,1)")) == 0) {
                    echo "<tr><td colspan=\"10\"><h2 align=\"center\">لايوجد البومات</h2></td></tr>";
                }

// Check to default display
                else {
                    $displayGalleryArray = mysqli_query($serverConnection, "SELECT * FROM `video_gallery` WHERE `display` IN(0,1) ORDER BY `video_gallery_id` DESC LIMIT 50");
                    while ($displayGalleryArrayResult = mysqli_fetch_array($displayGalleryArray)) {
                        if ($counter % 2 != 0) {
                            echo "<tr class=\"table_row_a\" valign=\"middle\">";
                        } else {
                            echo "<tr class=\"table_row_b\" valign=\"middle\">";
                        }

                        echo "<td>" . $counter . "</td>";

                        // Display Eye
                        echo "<td>";
                        if ($displayGalleryArrayResult['display'] == 1) {
                            echo "<a href=\"display.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "&operation=hide\"><img src=\"../images/icon_display_on.png\" width=\"20\" /></a>";
                        } else {
                            echo "<a href=\"display.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "&operation=show\"><img src=\"../images/icon_display_off.png\" width=\"20\" /></a>";
                        }
                        echo "</td>";

                        // Display Phone
                        echo "<td>";
                        if ($displayGalleryArrayResult['display_phone'] == 1) {
                            echo "<a href=\"display.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "&operation=hide_phone\"><img src=\"../images/icon_phone_on.png\" width=\"20\" /></a>";
                        } else {
                            echo "<a href=\"display.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "&operation=show_phone\"><img src=\"../images/icon_phone_off.png\" width=\"20\" /></a>";
                        }
                        echo "</td>";

                        // Display Title
                        echo "<td>" . $displayGalleryArrayResult['title'] . "</td>";

                        // Display Time
                        echo "<td align=\"center\">";
                        $timeExplode = explode(" ", $displayGalleryArrayResult['creation']);
                        echo $timeExplode[0];
                        echo "</td>";

                        //Insert
                        echo "<td align=\"center\">" . "<a href=\"insert_video.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "\" >" . "<img src=\"../images/icon_video.png\" width=\"25\" />" . "</a>" . "</td>";

                        // Display Preview
                        echo "<td align=\"center\">" . "<a href=\"display_video.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "\" >" . "<img src=\"../images/icon_video_edit.png\" width=\"25\" />" . "</a>" . "</td>";

                        // Modify
                        echo "<td align=\"center\">";
                        if ($_SESSION['permission_update_GenerlUseXV1'] == 1) {
                            echo "<a href=\"modify.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "\"><img src=\"../images/icon_modify.png\" width=\"25\" /></a>";
                        } else {
                            echo "<img src=\"../images/icon_modify_off.png\" width=\"25\" />";
                        }
                        echo "</td>";

                        // Delete
                        echo "<td align=\"center\">";
                        if ($_SESSION['permission_delete_GenerlUseXV1'] == 1) {
                            echo "<a href=\"display.php?video_gallery_id=" . $displayGalleryArrayResult['video_gallery_id'] . "&operation=delete\"><img src=\"../images/icon_delete.png\" width=\"25\" /></a>";
                        } else {
                            echo "<img src=\"../images/icon_delete_off.png\" width=\"25\" />";
                        }
                        echo "</td>";
                        echo "</tr>";
                        $counter++;
                    } // While ends
                } // End else	
                ?>
            </table>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        