<?php
ob_start();
session_start();

// Database Conncetion
require('library/functions.php');

// Clear login sessions for the first time.
resetLogin();

// Database Conncetion
require('library/dbconnector.php');

// Header Area
require("library/meta.php");
?>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="images/icon_system.ico" type="image/x-icon">
<script language="javascript" type="text/javascript" src="../_system/scripts/functions.js"></script>
<title>الدخول للنظام</title>
</head>

<body>
    <div id="wrapper">
        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->
        <div id="main">
            <div class="section">الدخول للنظام</div>

            <?php
            if (isset($_POST['login'])) {
                // POST the value from login form
                $username = mysqli_real_escape_string($serverConnection, cleanInjection(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING)));
                $password = md5(mysqli_real_escape_string($serverConnection, cleanInjection(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING))));

                // Adminstration permissions
                if (isset($_POST['adminstration']) && $_POST['adminstration'] == "admin") {

                    $userQueryResult = mysqli_query($serverConnection, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' AND `adminstration` = 1 AND `activite` = 1;");

                    if (mysqli_num_rows($userQueryResult) == 1) {

                        // Fetching data from query for login
                        $userQueryResult = mysqli_fetch_array($userQueryResult);
                        // Building longin sessions
                        $_SESSION['fullName_GenerlUseXV1'] = $userQueryResult['firstname'] . " " . $userQueryResult['lastname'];
                        $_SESSION['user_id_GenerlUseXV1'] = $userQueryResult['user_id'];
                        // Building user permissions
                        $_SESSION['permission_news_GenerlUseXV1'] = $userQueryResult['permission_news'];
                        $_SESSION['permission_subtitle_GenerlUseXV1'] = $userQueryResult['permission_subtitle'];
                        $_SESSION['permission_video_GenerlUseXV1'] = $userQueryResult['permission_video'];
                        $_SESSION['permission_gallery_GenerlUseXV1'] = $userQueryResult['permission_gallery'];
                        $_SESSION['permission_advertising_GenerlUseXV1'] = $userQueryResult['permission_advertising'];
                        $_SESSION['permission_programsDay_GenerlUseXV1'] = $userQueryResult['permission_programs_day'];
                        $_SESSION['permission_questionnaire_GenerlUseXV1'] = $userQueryResult['permission_questionnaire'];
                        $_SESSION['permission_users_GenerlUseXV1'] = $userQueryResult['permission_users'];
                        $_SESSION['permission_export_GenerlUseXV1'] = $userQueryResult['permission_export'];
                        $_SESSION['permission_sitemap_GenerlUseXV1'] = $userQueryResult['permission_sitemap'];
                        $_SESSION['permission_delete_GenerlUseXV1'] = $userQueryResult['permission_delete'];
                        $_SESSION['permission_update_GenerlUseXV1'] = $userQueryResult['permission_update'];
                        $_SESSION['permission_insert_GenerlUseXV1'] = $userQueryResult['permission_insert'];
                        $_SESSION['permission_adminstration_GenerlUseXV1'] = $userQueryResult['adminstration'];

                        // Time and Date with adminstration
                        $adminstration = 0;
                        $date = date("Y-n-j");
                        $time = date("h:i:s");

                        // Client Browser detection
                        $_SESSION['browser_GenerlUseXV1'] = browserDetection();

                        // Client Device detection
                        $_SESSION['operatingSystem_GenerlUseXV1'] = deviceDetection();

                        // Client ip detection
                        $ip = ""; //mysqli_real_escape_string($serverConnection, filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING));
                        // Location of user
                        $location = ""; // unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
                        // Insert login information
                        mysqli_query($serverConnection, "INSERT INTO `users_log` (`user_id`, `fullname`, `login_date`, `login_time`, `adminstration`, `browser`, `os`, `ip`, `countryname`, `countrycode`) VALUES ('$_SESSION[user_id_GenerlUseXV1]', '$_SESSION[fullName_GenerlUseXV1]', '$date', '$time', '$adminstration', '$_SESSION[browser_GenerlUseXV1]', '$_SESSION[operatingSystem_GenerlUseXV1]', '$ip', '$location[geoplugin_countryCode]', '$location[geoplugin_countryName]')");

                        // Used for logout
                        $_SESSION['log_id_GenerlUseXV1'] = mysqli_insert_id($serverConnection);

                        // Distroyed error msg
                        $_SESSION['loginMessage_GenerlUseXV1'] = null;

                        // Free Server Memory
                        mysqli_free_result($userQueryResult);

                        // Redirecting to home page
                        reDirect("home.php");
                    } else {
                        // Building error Msg
                        $_SESSION['loginMessage_GenerlUseXV1'] = "يرجى التأكد من أسم المستخدم أو كلمة المرور";
                        $_SESSION['accountErrorCount_GenerlUseXV1'] ++;
                        // Disable Account
                        if ($_SESSION['accountErrorCount_GenerlUseXV1'] == 5) {
                            mysqli_query($serverConnection, "UPDATE `users` SET `activite` = 0 WHERE `username` = '$username' AND `adminstration` = 1;");
                        }
                        // Redirecting to login page
                        reDirect("index.php");
                    }
                }



                // Non Adminstration Permissions
                else {
                    // MySQL query for getting non admin user

                    $userQueryResult = mysqli_query($serverConnection, "SELECT * FROM `users` WHERE `username` = '$username' AND `password` = '$password' AND `adminstration` = 0 AND `activite` = 1;");

                    if (mysqli_num_rows($userQueryResult) == 1) {

                        // Fetching data from query for login
                        $userQueryResult = mysqli_fetch_array($userQueryResult);
                        // Building longin sessions
                        $_SESSION['fullName_GenerlUseXV1'] = $userQueryResult['firstname'] . " " . $userQueryResult['lastname'];
                        $_SESSION['user_id_GenerlUseXV1'] = $userQueryResult['user_id'];
                        // Building user permissions
                        $_SESSION['permission_news_GenerlUseXV1'] = $userQueryResult['permission_news'];
                        $_SESSION['permission_subtitle_GenerlUseXV1'] = $userQueryResult['permission_subtitle'];
                        $_SESSION['permission_video_GenerlUseXV1'] = $userQueryResult['permission_video'];
                        $_SESSION['permission_gallery_GenerlUseXV1'] = $userQueryResult['permission_gallery'];
                        $_SESSION['permission_advertising_GenerlUseXV1'] = $userQueryResult['permission_advertising'];
                        $_SESSION['permission_programsDay_GenerlUseXV1'] = $userQueryResult['permission_programs_day'];
                        $_SESSION['permission_questionnaire_GenerlUseXV1'] = $userQueryResult['permission_questionnaire'];
                        $_SESSION['permission_users_GenerlUseXV1'] = $userQueryResult['permission_users'];
                        $_SESSION['permission_export_GenerlUseXV1'] = $userQueryResult['permission_export'];
                        $_SESSION['permission_sitemap_GenerlUseXV1'] = $userQueryResult['permission_sitemap'];
                        $_SESSION['permission_delete_GenerlUseXV1'] = $userQueryResult['permission_delete'];
                        $_SESSION['permission_update_GenerlUseXV1'] = $userQueryResult['permission_update'];
                        $_SESSION['permission_insert_GenerlUseXV1'] = $userQueryResult['permission_insert'];
                        $_SESSION['permission_adminstration_GenerlUseXV1'] = $userQueryResult['adminstration'];

                        // Time and Date with adminstration
                        $adminstration = 0;
                        $date = date("Y-n-j");
                        $time = date("h:i:s");

                        // Client Browser detection
                        $_SESSION['browser_GenerlUseXV1'] = browserDetection();

                        // Client Device detection
                        $_SESSION['operatingSystem_GenerlUseXV1'] = deviceDetection();

                        // Client ip detection
                        $ip = ""; //mysqli_real_escape_string($serverConnection, filter_input(INPUT_SERVER, 'REMOTE_ADDR', FILTER_SANITIZE_STRING));
                        // Location of user
                        $location = ""; // unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $ip));
                        // Insert login information
                        mysqli_query($serverConnection, "INSERT INTO `users_log` (`user_id`, `fullname`, `login_date`, `login_time`, `adminstration`, `browser`, `os`, `ip`, `countryname`, `countrycode`) VALUES ('$_SESSION[user_id_GenerlUseXV1]', '$_SESSION[fullName_GenerlUseXV1]', '$date', '$time', '$adminstration', '$_SESSION[browser_GenerlUseXV1]', '$_SESSION[operatingSystem_GenerlUseXV1]', '$ip', '$location[geoplugin_countryCode]', '$location[geoplugin_countryName]')");

                        // Used for logout
                        $_SESSION['log_id_GenerlUseXV1'] = mysqli_insert_id($serverConnection);

                        // Distroyed error msg
                        $_SESSION['loginMessage_GenerlUseXV1'] = null;

                        // Free Server Memory
                        mysqli_free_result($userQueryResult);

                        // Redirecting to home page
                        reDirect("home.php");
                    } else {
                        // Building error Msg
                        $_SESSION['loginMessage_GenerlUseXV1'] = "يرجى التأكد من أسم المستخدم أو كلمة المرور";
                        $_SESSION['accountErrorCount_GenerlUseXV1'] ++;
                        // Disable Account
                        if ($_SESSION['accountErrorCount_GenerlUseXV1'] == 5) {
                            mysqli_query($serverConnection, "UPDATE `users` SET `activite` = 0 WHERE `username` = '$username' AND `adminstration` = 1;");
                        }
                        // Redirecting to login page
                        reDirect("index.php");
                    }
                }
            }
            ?>

            <?php
            // Display login error msg
            if (isset($_SESSION['loginMessage_GenerlUseXV1'])) {
                echo "<h2 class=\"loginMessage\">" . $_SESSION['loginMessage_GenerlUseXV1'] . "</h2>";
            } else {
                $_SESSION['loginMessage_GenerlUseXV1'] = null;
                $_SESSION['accountErrorCount_GenerlUseXV1'] = 1;
            }
            ?>
            <form action="" method="post" enctype="multipart/form-data">
                <table border="0" cellspacing="0" cellpadding="10" align="center">
                    <tr>
                        <td>أسم المستخدم: </td>
                        <td><input class="textFields" name="username" type="text"></td>
                    </tr>
                    <tr>
                        <td>كلمة المـــرور: </td>
                        <td><input class="password" name="password" type="password"></td>
                    </tr>
                    <tr>
                        <td>الدخول كمسؤول للنظام: </td>
                        <td><input name="adminstration" type="checkbox" value="admin"></td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left"><input type="submit" name="login" value="الدخول للنظام"></td>
                    </tr>
                </table>
            </form>
        </div><!-- // Main -->
        <?php
        require("library/footer.php");
        