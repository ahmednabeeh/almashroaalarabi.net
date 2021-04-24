<?php
ob_start();
session_start();

// System function conncetion
require('library/functions.php');

// Database Conncetion
require('library/dbconnector.php');

// Header Area
require("library/meta.php");
?>
<script language="javascript" type="text/javascript" src="../_system/scripts/functions.js"></script>
<link href="css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="images/icon_system.ico" type="image/x-icon">
<title>الخروج من النظام</title>
</head>

<body>
    <?php
    $date = date("Y-n-j");
    $time = date("h:i:s");
    $logout = "UPDATE `users_log` SET `logout_date` = '$date', `logout_time` = '$time' WHERE `log_id` = $_SESSION[log_id_GenerlUseXV1] AND `user_id` = $_SESSION[user_id_GenerlUseXV1] AND `fullname` = '$_SESSION[fullName_GenerlUseXV1]' AND `os` = '$_SESSION[operatingSystem_GenerlUseXV1]'";
    mysqli_query($serverConnection, $logout);

    mysqli_close($serverConnection);

    $_SESSION['fullName_GenerlUseXV1'] = null;
    $_SESSION['user_id_GenerlUseXV1'] = null;
    $_SESSION['permission_delete_GenerlUseXV1'] = null;
    $_SESSION['permission_update_GenerlUseXV1'] = null;
    $_SESSION['permission_insert_GenerlUseXV1'] = null;
    $_SESSION['browser_GenerlUseXV1'] = null;
    $_SESSION['operatingSystem_GenerlUseXV1'] = null;
    $_SESSION['log_id_GenerlUseXV1'] = null;

    reDirect("index.php");
    ?>
</body>
</html>