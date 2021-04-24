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

// Check the news id
$news_id = getIdChecker(filter_input(INPUT_GET, 'news_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

// Database Conncetion
require('../library/dbconnector.php');

if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `display` IN (0,1) AND `news_id` = $news_id")) != 0) {
    $previewQueryResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `display` IN (0,1) AND `news_id` = $news_id"));
} else {
    reDirect("display.php?message=object not exists for Preview");
}

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>معاينة الخبر</title>
</head>

<body>
    <div id="wrapper">
        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">معاينة الخبر</td>
                </tr>
            </table>

            <table border="0" cellspacing="0" cellpadding="10" width="940">
                <!-- News Section -->
                <tr valign="top">
                    <td width="150">عنوان الخبر</td>
                    <td width="800"><?php echo $previewQueryResult['title']; ?></td>
                </tr>
                <tr valign="top">
                    <td>محرر الخبر</td>
                    <td><?php echo $previewQueryResult['editor']; ?></td>
                </tr>
                <tr valign="top">
                    <td>محرر الخبر</td>
                    <td><?php echo $previewQueryResult['content']; ?></td>
                </tr>
                <tr valign="top">
                    <td>صورة الخبر</td>
                    <td><img src="<?php echo $previewQueryResult['image']; ?>" width="700" /></td>
                </tr>
                <tr valign="top">
                    <td>نوع الخبر</td>
                    <td>
                        <?php
                        if ($previewQueryResult['type'] == 1) {
                            echo "خبر سياسي";
                        } elseif ($previewQueryResult['type'] == 2) {
                            echo "العراق";
                        } elseif ($previewQueryResult['type'] == 3) {
                            echo "الشرق الاوسط";
                        } elseif ($previewQueryResult['type'] == 4) {
                            echo "دولي";
                        } elseif ($previewQueryResult['type'] == 5) {
                            echo "رياضية";
                        } elseif ($previewQueryResult['type'] == 6) {
                            echo "ثقافية";
                        } elseif ($previewQueryResult['type'] == 7) {
                            echo "علوم";
                        } elseif ($previewQueryResult['type'] == 8) {
                            echo "مقالات";
                        } elseif ($previewQueryResult['type'] == 9) {
                            echo "مالية";
                        } elseif ($previewQueryResult['type'] == 10) {
                            echo "صحة";
                        } elseif ($previewQueryResult['type'] == 11) {
                            echo "تكنولوجيا";
                        } elseif ($previewQueryResult['type'] == 12) {
                            echo "ادبية";
                        } elseif ($previewQueryResult['type'] == 13) {
                            echo "دينية";
                        }
                        ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>العرض</td>
                    <td>
                        <?php
                        if ($previewQueryResult['display'] == 1) {
                            echo "<img src=\"../images/icon_display_on.png\" width=\"30\" />";
                        } else {
                            echo "<img src=\"../images/icon_display_off.png\" width=\"30\" />";
                        }
                        ?>    
                    </td>
                </tr>
                <tr valign="top">
                    <td>يعرض على الهاتف</td>
                    <td>
                        <?php
                        if ($previewQueryResult['display_phone'] == 1) {
                            echo "<img src=\"../images/icon_phone_on.png\" width=\"30\" />";
                        } else {
                            echo "<img src=\"../images/icon_phone_off.png\" width=\"30\" />";
                        }
                        ?>    
                    </td>
                </tr>
                <tr valign="top">
                    <td>تاريخ الانشاء</td>
                    <td><?php echo $previewQueryResult['creation']; ?></td>
                </tr>
                <tr valign="top">
                    <td>تاريخ التحديث</td>
                    <td><?php echo $previewQueryResult['update']; ?></td>
                </tr>
                <tr valign="top">
                    <td>عدد المشاهدات</td>
                    <td><?php echo $previewQueryResult['views']; ?></td>
                </tr>
                <tr valign="top">
                    <td>عدد التعليقات</td>
                    <td><?php echo $previewQueryResult['comments_number']; ?></td>
                </tr>
            </table>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        