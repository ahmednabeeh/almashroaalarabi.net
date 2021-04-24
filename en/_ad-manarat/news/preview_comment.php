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
$comment_id = getIdChecker(filter_input(INPUT_GET, 'comment_id', FILTER_SANITIZE_NUMBER_INT), "display.php");


// Database Conncetion
require('../library/dbconnector.php');

if (mysqli_num_rows(mysqli_query("SELECT * FROM `news_comments` WHERE `display` = 1 AND `comment_id` = $comment_id LIMIT 1")) != 0) {
    $previewQueryResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `news_comments` WHERE `display` = 1 AND `comment_id` = $comment_id LIMIT 1"));
} else {
    reDirect("display.php?message=object not exists for Preview");
}

// Selecting data for print
/* $previewQuery = "SELECT * FROM `news_comments` WHERE `display` = 1 AND `comment_id` = $comment_id LIMIT 1";
  $previewQueryResult = mysql_fetch_array(mysql_query($previewQuery)); */

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>معاينة التعليق</title>
</head>

<body>
    <div id="wrapper">
        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
// delete comment
            if (isset($_POST['delete_comment'])) {
                $news_id = filter_input(INPUT_POST, 'news_id', FILTER_SANITIZE_NUMBER_INT);
                $comment_id = filter_input(INPUT_POST, 'comment_id', FILTER_SANITIZE_NUMBER_INT);
                if (mysqli_query($serverConnection, "UPDATE `news_comments` SET `display` = 2 WHERE `comment_id` = $comment_id")) {
                    reDirect("display_comments.php?news_id=$news_id");
                }
            }
            ?>
            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">معاينة التعليق</td>
                </tr>
            </table>

            <table border="0" cellspacing="0" cellpadding="10" width="880">
                <!-- News Section -->
                <tr valign="top">
                    <td width="180">عنوان التعليق</td>
                    <td width="700"><?php echo $previewQueryResult['name']; ?></td>
                </tr>
                <tr valign="top">
                    <td>التعليق</td>
                    <td><?php echo $previewQueryResult['comment']; ?></td>
                </tr>
                <tr valign="top">
                    <td>العرض</td>
                    <td>
                        <?php
                        if ($previewQueryResult['display'] == 1) {
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
                        if ($previewQueryResult['display_phone'] == 1) {
                            echo "<img src=\"../images/icon_phone_on.png\" width=\"20\" />";
                        } else {
                            echo "<img src=\"../images/icon_phone_off.png\" width=\"20\" />";
                        }
                        ?>    
                    </td>
                </tr>
                <tr valign="top">
                    <td>تاريخ الانشاء</td>
                    <td><?php echo $previewQueryResult['creation']; ?></td>
                </tr>
                <tr valign="top">
                    <td colspan="2" align="left">
                        <form action="" method="post" enctype="multipart/form-data">
                            <input type="hidden" name="comment_id" value="<?php echo $previewQueryResult['comment_id']; ?>" />
                            <input type="hidden" name="news_id" value="<?php echo $previewQueryResult['news_id']; ?>" />
                            <input type="submit" name="delete_comment" value="مسح التعليق" />
                        </form>
                    </td>
                </tr>
            </table>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        