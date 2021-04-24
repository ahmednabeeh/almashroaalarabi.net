<?php
ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_insert_GenerlUseXV1'] != 1 && $_SESSION['permission_users_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

// Database Conncetion
require('../library/dbconnector.php');

$user_id = getIdChecker(filter_input(INPUT_GET, 'user_id', FILTER_SANITIZE_NUMBER_INT), "display.php");
$modifyUserResult = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT * FROM `users` WHERE `user_id` = $user_id"));

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">
<title>تعديل المستخدم</title>
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
                <a href="../../_system/users/indedx.php"><img title="إضافة مستخدم" style="border: none;" align="absmiddle" src="../images/icon_users.png" width="40" /></a>
                &nbsp;&nbsp;&nbsp;| &nbsp;&nbsp;&nbsp;
                <a href="display.php"><img title="عرض وتعديل المستخدمين" style="border: none;" align="absmiddle" src="../images/icon_users_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['update_user'])) {

                $firstname = getString(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
                $lastname = getString(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
                $username = getString(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
                $password = md5(getString(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
                $jobtitle = getString(filter_input(INPUT_POST, 'jobtitle', FILTER_SANITIZE_STRING));
                $phone = getStringSymbol(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING), "-");
                $email = getStringSymbol(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING), "-");
                $description = getDescription(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));
                $user_id = getIdChecker(filter_input(INPUT_POST, 'user_id', FILTER_SANITIZE_NUMBER_INT), "display.php");

                if (isset($_POST['permission_news'])) {
                    $permission_news = 1;
                } else {
                    $permission_news = 0;
                }
                if (isset($_POST['permission_subtitle'])) {
                    $permission_subtitle = 1;
                } else {
                    $permission_subtitle = 0;
                }
                if (isset($_POST['permission_video'])) {
                    $permission_video = 1;
                } else {
                    $permission_video = 0;
                }
                if (isset($_POST['permission_programs'])) {
                    $permission_programs = 1;
                } else {
                    $permission_programs = 0;
                }
                if (isset($_POST['permission_programs_day'])) {
                    $permission_programs_day = 1;
                } else {
                    $permission_programs_day = 0;
                }
                if (isset($_POST['permission_users'])) {
                    $permission_users = 1;
                } else {
                    $permission_users = 0;
                }
                if (isset($_POST['permission_export'])) {
                    $permission_export = 1;
                } else {
                    $permission_export = 0;
                }
                if (isset($_POST['permission_insert'])) {
                    $permission_insert = 1;
                } else {
                    $permission_insert = 0;
                }
                if (isset($_POST['permission_update'])) {
                    $permission_update = 1;
                } else {
                    $permission_update = 0;
                }
                if (isset($_POST['permission_delete'])) {
                    $permission_delete = 1;
                } else {
                    $permission_delete = 0;
                }
                if (isset($_POST['activite'])) {
                    $activite = 1;
                } else {
                    $activite = 0;
                }
                if (isset($_POST['adminstration'])) {
                    $adminstration = 1;
                } else {
                    $adminstration = 0;
                }


                if (mysqli_query($serverConnection, "UPDATE `users` SET `firstname` = '$firstname', `lastname` = '$lastname', `username` = '$username', `password` = '$password', `jobtitle` = '$jobtitle', `phone` = '$phone', `email` = '$email', `modify` = CURRENT_TIMESTAMP, `permission_news` = $permission_news, `permission_subtitle` = $permission_subtitle, `permission_video` = $permission_video, `permission_programs` = $permission_programs, `permission_programs_day` = $permission_programs_day, `permission_users` = $permission_users, `permission_export` = $permission_export, `permission_insert` = $permission_insert, `permission_update` = $permission_update, `permission_delete` = $permission_delete, `activite` = $activite, `adminstration` = $adminstration, `decription` = '$description' WHERE `user_id` = $user_id")) {
                    reDirect("?user_id={$user_id}");
                } else {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">لم يتم تعديل المستخدم! \"{$firstname} {$lastname}\"</h2><br />" . mysql_error();
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- User Section -->
                <tr>
                    <td class="section" colspan="4">تعديل المستخدم</td>
                </tr>
            </table>
            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>الاسم:</td>
                        <td><input name="firstname" id="firstname" type="text" size="35" value="<?php echo $modifyUserResult['firstname']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>أسم الاب:</td>
                        <td><input name="lastname" type="text" size="35" value="<?php echo $modifyUserResult['lastname']; ?>" /></td>
                    </tr>
                    <tr valign="top">
                        <td>أسم المستخدم:</td>
                        <td><input name="username" type="text" size="35" value="<?php echo $modifyUserResult['username']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <td>كلمةالمرور:</td>
                        <td><input name="password" type="password" size="20" value="<?php echo $modifyUserResult['password']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <td>المهنة:</td>
                        <td><input name="jobtitle" type="text" size="35" value="<?php echo $modifyUserResult['jobtitle']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <td>الهاتف:</td>
                        <td><input name="phone" type="text" size="20" dir="ltr" value="<?php echo $modifyUserResult['phone']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <td>البريد الالكتروني:</td>
                        <td><input name="email" type="text" size="20" dir="ltr" value="<?php echo $modifyUserResult['email']; ?>"/></td>
                    </tr>
                    <tr valign="top">
                        <td>صلاحيات لوحة التحكم</td>
                        <td>
                            <label>إضافة الاخبار:</label>
                            <?php
                            if ($modifyUserResult['permission_news'] == 1) {
                                echo "<input name=\"permission_news\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_news\" type=\"checkbox\" />";
                            }
                            ?>
                            <label>إضافة الاشرطة الاخبارية:</label>
                            <?php
                            if ($modifyUserResult['permission_subtitle'] == 1) {
                                echo "<input name=\"permission_subtitle\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_subtitle\" type=\"checkbox\" />";
                            }
                            ?>
                            <label>إضافة الفيديوهات:</label>
                            <?php
                            if ($modifyUserResult['permission_video'] == 1) {
                                echo "<input name=\"permission_video\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_video\" type=\"checkbox\" />";
                            }
                            ?>
                            <label>إضافة البرامج:</label>
                            <?php
                            if ($modifyUserResult['permission_programs'] == 1) {
                                echo "<input name=\"permission_programs\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_programs\" type=\"checkbox\" />";
                            }
                            ?>
                            <label>إضافة البرامج لهاذا اليوم:</label>
                            <?php
                            if ($modifyUserResult['permission_programs_day'] == 1) {
                                echo "<input name=\"permission_programs_day\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_programs_day\" type=\"checkbox\" />";
                            }
                            ?>
                            <br /><br />
                            <label>إضافة مستخدم:</label>
                            <?php
                            if ($modifyUserResult['permission_users'] == 1) {
                                echo "<input name=\"permission_users\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_users\" type=\"checkbox\" />";
                            }
                            ?>
                            <label>تصدير البيانات:</label>
                            <?php
                            if ($modifyUserResult['permission_export'] == 1) {
                                echo "<input name=\"permission_export\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_export\" type=\"checkbox\" />";
                            }
                            ?>    
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>الصلاحيات الفرعية للمستخدم</td>
                        <td>
                            <label>صلاحيةألاضافة:</label>
                            <?php
                            if ($modifyUserResult['permission_insert'] == 1) {
                                echo "<input name=\"permission_insert\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_insert\" type=\"checkbox\" />";
                            }
                            ?>    
                            <label>صلاحية التعديل:</label>
                            <?php
                            if ($modifyUserResult['permission_update'] == 1) {
                                echo "<input name=\"permission_update\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_update\" type=\"checkbox\" />";
                            }
                            ?>
                            <label>صلاحية المسح:</label>
                            <?php
                            if ($modifyUserResult['permission_delete'] == 1) {
                                echo "<input name=\"permission_delete\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"permission_delete\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>تفعيل الحساب:</td>
                        <td>
                            <?php
                            if ($modifyUserResult['activite'] == 1) {
                                echo "<input name=\"activite\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"activite\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>جعل المستخدم كمدير ايضاً:</td>
                        <td>
                            <?php
                            if ($modifyUserResult['adminstration'] == 1) {
                                echo "<input name=\"adminstration\" type=\"checkbox\" checked value=\"1\" />";
                            } else {
                                echo "<input name=\"adminstration\" type=\"checkbox\" />";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>وصف المستخدم:</td>
                        <td><textarea class="textArea" name="description" rows="5"><?php echo $modifyUserResult['decription']; ?></textarea></td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="hidden" name="user_id" value="<?php echo $modifyUserResult['user_id']; ?>" />
                            <input type="submit" name="update_user" value="تعديل المستخدم" /></td>
                    </tr>
                </table>
            </form>

        </div><!-- // Main -->
        <?php
        require("../library/footer.php");
        