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
$news_id = getIdChecker(filter_input(INPUT_GET, 'news_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تعديل الخبر</title>
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
                <a href="index.php"><img title="إضافة خبر" style="border: none;" align="absmiddle" src="../images/icon_news.png" width="40" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="display.php"><img title="عرض الاخبار" style="border: none;" align="absmiddle" src="../images/icon_news_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['update_news'])) {
                // Get user id

                $user_id_GenerlUseXV1 = $_SESSION['user_id_GenerlUseXV1'];
                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $editor = getEditor(filter_input(INPUT_POST, 'editor', FILTER_SANITIZE_STRING));
                $content = getContent(filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING));
                $videoYoutube = getVideoYoutube($_POST['video_youtube']);
                $category = getCategory(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $display_phone = getDisplayPhone(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $comments = getComments(filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_NUMBER_INT));
                $news_id = getIdChecker(filter_input(INPUT_POST, 'news_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
                $updateImagePath = getUpdatedImagePath("news");


                // Version Control
                $restoreVersionResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `news_id` = $news_id"));
                mysqli_query($serverConnection, "INSERT INTO `news_version_control` VALUES (NULL, '$news_id', '$restoreVersionResult[title]', '$restoreVersionResult[editor]', '$restoreVersionResult[content]', '$restoreVersionResult[image]', '$restoreVersionResult[video_youtube]', '$restoreVersionResult[category]', '$restoreVersionResult[display]', '$restoreVersionResult[display_phone]', '$restoreVersionResult[creation]', '$restoreVersionResult[modify]', '$restoreVersionResult[views]', '$restoreVersionResult[comments]');");


                // Exceute the news update query
                if (mysqli_query($serverConnection, "UPDATE `news` SET `title` = '$title', `editor` = '$editor', `content` = '$content', `image` = '$updateImagePath', `video_youtube` = '$videoYoutube', `category` = '$category', `display` = $display, `display_phone` = $display_phone, `comments` = $comments WHERE `news_id` = $news_id")) {
                    echo "<h2>تم تعديل الخبر \"" . $title . "\"</h2>";
                } else {
                    echo "<h2>لم يتم تعديل الخبر! \"" . $title . "\"</h2>";
                    echo mysqli_error($serverConnection);
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">تعديل الخبر</td>
                </tr>
            </table>
            <?php
// Get data
            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `news_id` = $news_id")) != 0) {
                $modifyNewsResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `news_id` = $news_id"));
            } else {
                reDirect("display.php?message=object not exists");
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الخبر:</td>
                        <td><input name="title" id="title" type="text" size="35" value="<?php echo $modifyNewsResult['title']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>محرر الخبر:</td>
                        <td><input name="editor" id="editor" type="text" size="35" value="<?php echo $modifyNewsResult['editor']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>فحوى الخبر:</td>
                        <td><textarea class="textArea" name="content" id="content" rows="5"><?php echo trim($modifyNewsResult['content']); ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <td>كود الفيديو الخاص باليوتيوب :</td>
                        <td><textarea class="textArea" name="video_youtube" id="video_youtube" rows="5"><?php
                                if ($modifyNewsResult['video_youtube'] != "no video") {
                                    echo $modifyNewsResult['video_youtube'];
                                } else {
                                    echo "";
                                }
                                ?></textarea></td>
                    </tr>
                    <tr valign="top">
                        <td>نوع الخبر:</td>
                        <td>
                            <select name="category">
                                <?php
                                echo "<option value=\"$modifyNewsResult[category]\">$modifyNewsResult[category]</option>";
                                ?>
                                <option value="الامين العام">الامين العام</option>
                                <option value="بيانات ومواقف">بيانات ومواقف</option>
                                <option value="رؤى سياسية">رؤى سياسية</option>
                                <option value="نشاطات المكتب">نشاطات المكتب</option>
                                <option value="قضايا وطن">قضايا وطن</option>
                                <option value="انفوكرافيك">انفوكرافيك</option>
                                <option value="المشاريع">المشاريع</option>
                            </select></td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الخبر:</td>
                        <td>
                            <?php
                            if ($modifyNewsResult['display'] == 1) {
                                echo "<input name=\"display\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"display\" type=\"checkbox\" />";
                            }
                            ?>    
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>حصري على الهاتف:</td>
                        <td>
                            <?php
                            if ($modifyNewsResult['display_phone'] == 1) {
                                echo "<input name=\"display_phone\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"display_phone\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>التعليقات:</td>
                        <td>
                            <?php
                            if ($modifyNewsResult['comments'] == 1) {
                                echo "<input name=\"comments\" type=\"checkbox\" checked />";
                            } else {
                                echo "<input name=\"comments\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>مرفقات الخبر:</td>
                        <td>
                            <img src="../images/icon_image.png" width="60" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="hidden" name="news_id" value="<?php echo $modifyNewsResult['news_id']; ?>" />
                            <input type="hidden" name="image_path" value="<?php echo $modifyNewsResult['image']; ?>" />
                            <input type="submit" name="update_news" value="تعديل خبر" /></td>
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
        