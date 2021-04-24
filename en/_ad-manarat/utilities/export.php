<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_export_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">

<title>تصدير البيانات</title>
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
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- News Section -->
                <tr>
                    <td class="section" colspan="4">تصدير البيانات</td>
                </tr>
            </table>

            <?php
            if (isset($_POST['export'])) {


                $type = getString(filter_input(INPUT_POST, 'type', FILTER_SANITIZE_STRING));
                $fileType = getString(filter_input(INPUT_POST, 'file_type', FILTER_SANITIZE_STRING));


                // Export news with XML file
                if ($type == "news" && $fileType == "xml") {
                    $newsXml = mysqli_query($serverConnection, "SELECT `title`, `editor`, `content`, `creation`, `image` FROM `news` WHERE `display` IN (0,1)");

                    $xmlHeaderString = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
                    $xmlWritingToFile = $xmlHeaderString . "<EportedNews>\n";

                    while ($newsXmlResult = mysqli_fetch_array($newsXml)) {
                        $xmlWritingToFile .= "\t<news>\n";
                        $xmlWritingToFile .= "\t\t<title>" . $newsXmlResult['title'] . "</title>\n";
                        $xmlWritingToFile .= "\t\t<editor>" . $newsXmlResult['editor'] . "</editor>\n";
                        $xmlWritingToFile .= "\t\t<content>" . $newsXmlResult['content'] . "</content>\n";
                        $xmlWritingToFile .= "\t\t<pubDate>" . $newsXmlResult['creation'] . "</pubDate>\n";
                        $xmlWritingToFile .= "\t\t<image>" . $newsXmlResult['image'] . "</image>\n";
                        $xmlWritingToFile .= "\t</news>";
                    }
                    $xmlWritingToFile .= "\n</EportedNews>";

                    // Open and write to file
                    $serialFileName = $_SESSION['user_id_GenerlUseXV1'] . date("hisU");
                    $fileHandler = fopen("../resource/export/news_{$serialFileName}.xml", "w");
                    fwrite($fileHandler, $xmlWritingToFile);
                    fclose($fileHandler);
                    echo "<h2><a href=\"../resource/export/news_{$serialFileName}.xml\" download>" . "تحميل" . "</a></h2>";
                }
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td width="100">تصدير:</td>
                        <td width="700">
                            <select name="type">
                                <option value="news">الاخبار</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top" >
                        <td>نوع الملف:</td>
                        <td>
                            <select name="file_type">
                                <option value="xml">XML</option>
                            </select>
                        </td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="submit" name="export" value="تصدير البيانات" /></td>
                    </tr>
                </table>
            </form>
        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        