<?php
ob_start();
session_start();

// Database Conncetion
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
<title>الدعم الفني</title>
</head>

<body>
    <div id="wrapper">
        <div class="user_info_area">
            <div class="welcome" style="border: none; text-align:right;">
                <?php echo "<span class=\"user_text\">مرحباً " . $_SESSION['fullName_GenerlUseXV1'] . "</span>" ?>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="home.php"><img title="لوحة التحكم في الموقع" style="border: none;" align="absmiddle" src="images/iconic_home.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="tasks/index.php"><img title="مهام المستخدم" style="border: none;" align="absmiddle" src="images/iconic_task.png" width="20" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="../index.php" target="_blank"><img title="عرض الموقع" style="border: none;" align="absmiddle" src="images/icon_sitehome.png" width="20" /></a>
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
                <!-- Support Section -->
                <tr>
                    <td class="section" colspan="4">الدعم الفني</td>
                </tr>
            </table><!-- // End of Section -->

            <table border="0" cellspacing="0" cellpadding="10" width="940">
                <tr>
                    <td colspan="4">
                        <?php
                        // Sending Support Email
                        if (isset($_POST['send'])) {

                            // To
                            $to = "lamar.host@gmail.com";

                            // Message Heading
                            $title = mysqli_real_escape_string(filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING));

                            // Message Content
                            $messageContent = mysqli_real_escape_string(filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING)) . "\n\r" . mysqli_real_escape_string(filter_input(INPUT_POST, 'messageContent', FILTER_SANITIZE_STRING));

                            // From
                            $from = "From: " . mysqli_real_escape_string(filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING));

                            if (mail($to, $title, $messageContent, $from)) {
                                echo "<h2 style=\"color: #F00; margin-top: 30px;\" align=\"center\">تم ارسال الرسالة</h2>";
                            } else {
                                echo "<h2 style=\"color: #F00; margin-top: 30px;\" align=\"center\">لم يتم ارسال الرسالة</h2>";
                            }
                        }
                        ?>
                    </td>
                </tr>
                <tr>
                <form action="" method="post" enctype="multipart/form-data">
                    <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5">
                        <tr valign="top">
                            <td>العنوان:</td>
                            <td><input name="title" type="text" size="50" /></td>
                        </tr>
                        <tr valign="top">
                            <td>المشكلة او ألاستفسار:</td>
                            <td><textarea name="messageContent" cols="75" rows="5"></textarea></td>
                        </tr>
                        <tr valign="top" align="left">
                            <td colspan="2"><input type="submit" name="send" value="إرسال"/></td>
                        </tr>
                    </table>
                </form>
                </tr>
                <tr>
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5">
                    <tr valign="top">
                        <td>أو ألاتصال على الارقام التالية</td>
                        <td dir="ltr">-</td>
                    </tr>
                </table>
                </tr>
            </table>
        </div><!-- // Main -->
        <?php
        // Footer
        require("library/footer.php");
