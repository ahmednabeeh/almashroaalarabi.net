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

<title>إضافة خبر</title>
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
                <a href="display.php"><img title="عرض وتعديل الاخبار" style="border: none;" align="absmiddle" src="../images/icon_news_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['inserting'])) {

                $user_id_GenerlUseXV1 = $_SESSION['user_id_GenerlUseXV1'];
                $title = getTitle(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));
                $editor = getEditor(filter_input(INPUT_POST, 'editor', FILTER_SANITIZE_STRING));
                $content = getContent(filter_input(INPUT_POST, 'content', FILTER_SANITIZE_STRING));
                $videoYoutube = getVideoYoutube($_POST['video_youtube']);
                $category = getCategory(filter_input(INPUT_POST, 'category', FILTER_SANITIZE_STRING));
                $display = getDisplay(filter_input(INPUT_POST, 'display', FILTER_SANITIZE_NUMBER_INT));
                $display_phone = getDisplayPhone(filter_input(INPUT_POST, 'display_phone', FILTER_SANITIZE_NUMBER_INT));
                $comments = getComments(filter_input(INPUT_POST, 'comments', FILTER_SANITIZE_NUMBER_INT));
                $newsImagePath = getImagePath("news");
                $newsPdfPath = getPdfPath();


                // Exceute the insertion of news query
                if (mysqli_query($serverConnection, "INSERT INTO `news` (`news_id`, `title`, `editor`, `content`, `image`, `pdf`, `video_youtube`, `category`, `display`, `display_phone`, `creation`, `comments`) VALUES (NULL, '$title', '$editor', '$content', '$newsImagePath', '$newsPdfPath', '$videoYoutube', '$category', '$display', '$display_phone', CURRENT_TIMESTAMP, $comments);")) {
                    echo "<h2>تم حفظ الخبر \"" . $title . "\"</h2>";
                } else {
                    echo "<h2>لم يتم حفظ الخبر! \"" . $title . "\"</h2>";
                    echo mysqli_error($serverConnection);
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">إضافة خبر</td>
                </tr>
            </table>

            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>عنوان الخبر:</td>
                        <td><input name="title" id="title" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>محرر الخبر:</td>
                        <td><input name="editor" id="editor" type="text" size="35" /></td>
                    </tr>

                    <tr valign="top">
                        <td>فحوى الخبر:</td>
                        <td><textarea class="textArea" name="content" id="content" rows="5"></textarea></td>
                    </tr>
                    <tr valign="top">
                        <td>كود الفيديو الخاص باليوتيوب :</td>
                        <td><textarea class="textArea" name="video_youtube" id="video_youtube" rows="5"></textarea></td>
                    </tr>

                    <tr valign="top">
                        <td>نوع الخبر:</td>
                        <td>
                            <select name="category" title="category">
                                <option value="الامين العام">الامين العام</option>
                                <option value="بيانات ومواقف">بيانات ومواقف</option>
                                <option value="رؤى سياسية">رؤى سياسية</option>
                                <option value="نشاطات المكتب">نشاطات المكتب</option>
                                <option value="قضايا وطن">قضايا وطن</option>
                                <option value="انفوكرافبك">انفوكرافبك</option>
                                <option value="المشاريع">المشاريع</option>
                                <option value="المكاتب">المكاتب</option>
                                <option value="عاجل">عاجل</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>عرض الخبر:</td>
                        <td><input name="display" type="checkbox" checked title="display" /></td>
                    </tr>
                    <tr valign="top">
                        <td>حصري على الهاتف:</td>
                        <td><input name="display_phone" type="checkbox" title="display on phone" /></td>
                    </tr>
                    <tr valign="top">
                        <td>تفعيل التعليقات:</td>
                        <td><input name="comments" type="checkbox" title="Comments" /></td>
                    </tr>
                    <tr valign="top">
                        <td>مرفقات الخبر:</td>
                        <td>
                            <img class="imageIcon" src="../images/icon_image.png" onClick="clickImageFile();" />
                            <input style="display: none;" type="file" name="image" id="image" class="imageFileStyle" />
                            <img class="imageIcon" src="../images/icon_pdf.png" onClick="clickPdfFile();" />
                            <input style="display: none;" type="file" name="pdf" id="pdf" class="imageFileStyle" />
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="submit" name="inserting" value="إضافة خبر" /></td>
                    </tr>
                </table>
            </form>

        </div><!-- // Main -->
        <script type="text/javascript">
            function clickImageFile() {
                document.getElementById("image").click();
            }
            function clickPdfFile() {
                document.getElementById("pdf").click();
            }
        </script>
        <?php
        require("../library/footer.php");
        