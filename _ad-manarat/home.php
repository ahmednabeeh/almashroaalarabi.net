<?php
session_start();
ob_start();

// System function conncetion
require('library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("index.php");

// Database Conncetion
require('library/dbconnector.php');

// Header Area
require("library/meta.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="images/icon_system.ico" type="image/x-icon">
<script language="javascript" type="text/javascript" src="../_system/scripts/functions.js"></script>
<script type="text/javascript">
    function permission() {
        alert("لاتملك الصلاحية للدخول");
        return false;
    }
</script>
<title>لوحة التحكم في الموقع</title>
</head>

<body>
    <div id="wrapper">
        <div class="user_info_area">
            <div class="welcome" style="border: none; text-align:right;">
                <?php echo "<span class=\"user_text\">مرحباً " . $_SESSION['fullName_GenerlUseXV1'] . "</span>" ?>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="tasks/index.php"><img title="مهام المستخدم" style="border: none;" align="absmiddle" src="images/iconic_task.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="../index.php" target="_blank"><img title="عرض الموقع" style="border: none;" align="absmiddle" src="images/icon_sitehome.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="support.php"><img title="الدعم الفني" style="border: none;" align="absmiddle" src="images/icon_support.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="about.php"><img title="حول النظام" style="border: none;" align="absmiddle" src="images/iconic_about.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="logout.php"><img title="تسجيل الخروج" style="border: none;" align="absmiddle" src="images/iconic_logout.png" width="17" /></a>
            </div>
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">الاخبار</td>
                </tr>
                <tr>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_news_GenerlUseXV1'] == 1) {
                            echo "<a href=\"news/index.php\">
<img style=\"border: none;\" src=\"images/icon_news.png\" vspace=\"5\" width=\"70\"/><br />إضافة خبر</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_news_off.png\" vspace=\"5\" width=\"70\"/><br />إضافة خبر";
                        }
                        ?>
                    </td>

                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_news_GenerlUseXV1'] == 1) {
                            echo "<a href=\"news/display.php\">
<img style=\"border: none;\" src=\"images/icon_news_edit.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الاخبار</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_news_edit_off.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الاخبار";
                        }
                        ?>
                    </td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_subtitle_GenerlUseXV1'] == 1) {
                            echo "<a href=\"subtitle/index.php\">
<img style=\"border: none;\" src=\"images/icon_subtitle.png\" vspace=\"5\" width=\"70\"/><br />إضافة شريط متحرك</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_subtitle_off.png\" vspace=\"5\" width=\"70\"/><br />إضافة شريط متحرك";
                        }
                        ?>
                    </td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_subtitle_GenerlUseXV1'] == 1) {
                            echo "<a href=\"subtitle/display.php\">
<img style=\"border: none;\" src=\"images/icon_subtitle_edit.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الأشرطة الاخبارية</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_subtitle_edit_off.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الاشرطة المتحركة";
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_news_GenerlUseXV1'] == 1) {
                            echo "<a href=\"news/hashtag.php\">
<img style=\"border: none;\" src=\"images/icon_hashtag.png\" vspace=\"5\" width=\"70\"/><br />إضافة هاشتاج</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_hashtag.png\" vspace=\"5\" width=\"70\"/><br />إضافة الهاشتاج";
                        }
                        ?>
                    </td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_news_GenerlUseXV1'] == 1) {
                            echo "<a href=\"news/hashtag_display.php\">
<img style=\"border: none;\" src=\"images/icon_hashtag_edit.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الهاشتاج</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_hashtag_edit_off.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الهاشتاج";
                        }
                        ?>
                    </td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_video_GenerlUseXV1'] == 1) {
                            echo "<a href=\"channel/edit.php\">
<img style=\"border: none;\" src=\"images/icon_programs_edit.png\" vspace=\"5\" width=\"70\"/><br />البث المباشر</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_programs_edit_off.png\" vspace=\"5\" width=\"70\"/><br />البث المباشر";
                        }
                        ?>
                    </td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">-</td>
                </tr>
            </table>

            <!-- ------------------------------------------------------------------------- -->

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Video and Albums Section -->
                <tr>
                    <td class="section" colspan="4">الصور والفيديوهات</td>
                </tr>
                <tr>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_video_GenerlUseXV1'] == 1) {
                            echo "<a href=\"video/index.php\">
<img style=\"border: none;\" src=\"images/icon_video.png\" vspace=\"5\" width=\"70\"/><br />إضافة فيديو</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_video_off.png\" vspace=\"5\" width=\"70\"/><br />إضافة فيديو";
                        }
                        ?>
                    </td>

                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_video_GenerlUseXV1'] == 1) {
                            echo "<a href=\"video/display.php\">
<img style=\"border: none;\" src=\"images/icon_video_edit.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الفيديوهات</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_video_edit_off.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الفيديوهات";
                        }
                        ?>
                    </td>

                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_gallery_GenerlUseXV1'] == 1) {
                            echo "<a href=\"gallery/index.php\">
<img style=\"border: none;\" src=\"images/icon_gallery.png\" vspace=\"5\" width=\"70\"/><br />إضافة البوم الصور</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_gallery_off.png\" vspace=\"5\" width=\"70\"/><br />إضافة البوم الصور";
                        }
                        ?>
                    </td>

                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_gallery_GenerlUseXV1'] == 1) {
                            echo "<a href=\"gallery/display.php\">
<img style=\"border: none;\" src=\"images/icon_gallery_edit.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الالبومات</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_gallery_edit_off.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح الالبومات";
                        }
                        ?>
                    </td>
                </tr>
            </table>


            <!-- ------------------------------------------------------------------------- -->
            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Users Section -->
                <tr>
                    <td class="section" colspan="4">المستخدمين</td>
                </tr>
                <tr>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_users_GenerlUseXV1'] == 1) {
                            echo "<a href=\"users/index.php\">
<img style=\"border: none;\" src=\"images/icon_users.png\" vspace=\"5\" width=\"70\"/><br />إضافة مستخدم</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_users_off.png\" vspace=\"5\" width=\"70\"/><br />إضافة فيديو";
                        }
                        ?>
                    </td>

                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_users_GenerlUseXV1'] == 1) {
                            echo "<a href=\"users/display.php\">
<img style=\"border: none;\" src=\"images/icon_users_edit.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح المستخدمين</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_users_edit_off.png\" vspace=\"5\" width=\"70\"/><br />عرض، تعديل ومسح المستخدمين";
                        }
                        ?>
                    </td>

                    <td class="tableCellHome" width="200" align="center" valign="middle">-</td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">-</td>
                </tr>
            </table>



            <!-- ------------------------------------------------------------------------- -->
            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- Utilities Section -->
                <tr>
                    <td class="section" colspan="4">خدمات المستخدم</td>
                </tr>
                <tr>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_adminstration_GenerlUseXV1'] == 1) {
                            echo "<a href=\"utilities/setting.php\">
<img style=\"border: none;\" src=\"images/icon_setting.png\" vspace=\"5\" width=\"70\"/><br />أعدادات النظام</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_setting_off.png\" vspace=\"5\" width=\"70\"/><br />أعدادات النظام";
                        }
                        ?>
                    </td>

                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_export_GenerlUseXV1'] == 1) {
                            echo "<a href=\"utilities/export.php\">
<img style=\"border: none;\" src=\"images/icon_export.png\" vspace=\"5\" width=\"70\"/><br />تصدير البيانات</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_export_off.png\" vspace=\"5\" width=\"70\"/><br />تصدير البيانات";
                        }
                        ?>
                    </td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">
                        <?php
                        if ($_SESSION['permission_sitemap_GenerlUseXV1'] == 1) {
                            echo "<a href=\"utilities/sitemap.php\"><img style=\"border: none;\" src=\"images/icon_sitemap.png\" vspace=\"5\" width=\"70\"/><br />تكوين خارطة الموقع</a>";
                        } else {
                            echo "<img onclick=\"return permission();\" style=\"border: none;\" src=\"images/icon_sitemap_off.png\" vspace=\"5\" width=\"70\"/><br />" . "تكوين خارطة الموقع";
                        }
                        ?>
                    </td>
                    <td class="tableCellHome" width="200" align="center" valign="middle">-</td>
                </tr>
            </table>
        </div><!-- // Main -->
        <?php
        require("library/footer.php");
        