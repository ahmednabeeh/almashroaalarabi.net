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

// Selecting Data for print from database

if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `display` IN (0,1) AND `news_id` = $news_id")) != 0) {
    $printQueryResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `display` IN (0,1) AND `news_id` = $news_id"));
} else {
    reDirect("display.php?message=object not exists for printing");
}

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title><?php echo $printQueryResult['title']; ?></title>
<script type="text/javascript">
    function printDocument() {
        window.print();
    }
</script>
</head>

<body onLoad="printDocument();">
    <div id="wrapper">
        <div id="top_round"></div><!-- // Top round -->

        <div id="main">

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">طباعة الخبر</td>
                </tr>
            </table>

            <table border="0" cellspacing="0" cellpadding="10" width="940">
                <!-- News Section -->
                <tr valign="top">
                    <td width="150">عنوان الخبر</td>
                    <td width="800"><?php echo $printQueryResult['title']; ?></td>
                </tr>
                <tr valign="top">
                    <td>محرر الخبر</td>
                    <td><?php echo $printQueryResult['editor']; ?></td>
                </tr>
                <tr valign="top">
                    <td>محرر الخبر</td>
                    <td><?php echo $printQueryResult['content']; ?></td>
                </tr>
                <tr valign="top">
                    <td>فئة الخبر</td>
                    <td>
                        <?php
                        if ($printQueryResult['category'] == 1) {
                            echo "خبر سياسي";
                        } elseif ($printQueryResult['category'] == 2) {
                            echo "العراق";
                        } elseif ($printQueryResult['category'] == 3) {
                            echo "الشرق الاوسط";
                        } elseif ($printQueryResult['category'] == 4) {
                            echo "دولي";
                        } elseif ($printQueryResult['category'] == 5) {
                            echo "رياضية";
                        } elseif ($printQueryResult['category'] == 6) {
                            echo "ثقافية";
                        } elseif ($printQueryResult['category'] == 7) {
                            echo "علوم";
                        } elseif ($printQueryResult['category'] == 8) {
                            echo "مقالات";
                        } elseif ($printQueryResult['category'] == 9) {
                            echo "مالية";
                        } elseif ($printQueryResult['category'] == 10) {
                            echo "صحة";
                        } elseif ($printQueryResult['category'] == 11) {
                            echo "تكنولوجيا";
                        } elseif ($printQueryResult['category'] == 12) {
                            echo "ادبية";
                        } elseif ($printQueryResult['category'] == 13) {
                            echo "دينية";
                        }
                        ?>
                    </td>
                </tr>
                <tr valign="top">
                    <td>العرض</td>
                    <td>
                        <?php
                        if ($printQueryResult['display'] == 1) {
                            echo "<img src=\"../images/icon_display_on.png\" width=\"20\" />";
                        } else {
                            echo "<img src=\"../images/icon_display_off.png\" width=\"20\" />";
                        }
                        ?>    
                    </td>
                </tr>
                <tr valign="top">
                    <td>يعرض على الهاتف</td>
                    <td>
                        <?php
                        if ($printQueryResult['display_phone'] == 1) {
                            echo "<img src=\"../images/icon_phone_on.png\" width=\"20\" />";
                        } else {
                            echo "<img src=\"../images/icon_phone_off.png\" width=\"20\" />";
                        }
                        ?>    
                    </td>
                </tr>
                <tr valign="top">
                    <td>تاريخ الانشاء</td>
                    <td><?php echo $printQueryResult['creation']; ?></td>
                </tr>
                <tr valign="top">
                    <td>تاريخ التحديث</td>
                    <td><?php echo $printQueryResult['update']; ?></td>
                </tr>
                <tr valign="top">
                    <td>عدد المشاهدات</td>
                    <td><?php echo $printQueryResult['views']; ?></td>
                </tr>
                <tr valign="top">
                    <td>عدد التعليقات</td>
                    <td><?php echo $printQueryResult['comments_number']; ?></td>
                </tr>
                <tr valign="top">
                    <td>صورة الخبر</td>
                    <td align="center"><img src="<?php echo $printQueryResult['image']; ?>" width="500" /></td>
                </tr>
            </table>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        