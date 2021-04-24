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

// Header Area
require("../library/meta.php");
?>
<link href="../css/style.css" rel="stylesheet" type="text/css" media="all">
<link rel="shortcut icon" href="../images/icon_system.ico" type="image/x-icon">
<title>إضافة مستخدم</title>
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
                <a href="display.php"><img title="عرض وتعديل المستخدمين" style="border: none;" align="absmiddle" src="../images/icon_users_edit.png" width="40" /></a>
            </div><!-- // Navigation Bar -->
        </div><!-- // Log information area -->

        <div id="top_round"></div><!-- // Top round -->
        <div id="header"></div><!-- // Header -->

        <div id="main">
            <?php
            if (isset($_POST['inserting_user'])) {

                $firstname = getString(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
                $lastname = getString(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
                $username = getString(filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING));
                $password = md5(getString(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING)));
                $jobtitle = getString(filter_input(INPUT_POST, 'jobtitle', FILTER_SANITIZE_STRING));
                $phone = getStringSymbol(filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_STRING), "-");
                $email = getStringSymbol(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING), "-");
                $description = getDescription(filter_input(INPUT_POST, 'description', FILTER_SANITIZE_STRING));

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


                if (mysqli_query($serverConnection, "INSERT INTO `users` (`user_id`, `firstname`, `lastname`, `username`, `password`, `jobtitle`, `phone`, `email`, `creation`, `modify`, `permission_news`, `permission_subtitle`, `permission_video`, `permission_programs`, `permission_programs_day`, `permission_users`, `permission_export`, `permission_insert`, `permission_update`, `permission_delete`, `activite`, `adminstration`, `decription`) VALUES (NULL, '$firstname', '$lastname', '$username', '$password', '$jobtitle', '$phone', '$email', CURRENT_TIMESTAMP, '0000-00-00 00:00:00', '$permission_news', '$permission_subtitle', '$permission_video', '$permission_programs', '$permission_programs_day', '$permission_users', '$permission_export','$permission_insert', '$permission_update', '$permission_delete', '$activite', '$adminstration', '$description');")) {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">تم حفظ المستخدم \"{$firstname} {$lastname}\"</h2>";
                } else {
                    echo "<h2 align=\"center\" style=\"color: #F00;\">لم يتم حفظ المستخدم! \"{$firstname} {$lastname}\"</h2>";
                }
            }
            ?>

            <table border="0" cellspacing="0" cellpadding="0" width="940">
                <!-- User Section -->
                <tr>
                    <td class="section" colspan="4">إضافة مستخدم</td>
                </tr>
            </table>

            <form action="" method="post" enctype="multipart/form-data" name="userInfo">
                <table style="margin-left:30px; margin-bottom:30px; margin-top:30px" border="0" cellspacing="10" cellpadding="5" width="850">
                    <tr valign="top">
                        <td>الاسم:</td>
                        <td><input name="firstname" id="firstname" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>أسم الاب:</td>
                        <td><input name="lastname" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>أسم المستخدم:</td>
                        <td><input name="username" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>كلمةالمرور:</td>
                        <td><input name="password" type="password" size="20" /></td>
                    </tr>
                    <tr valign="top">
                        <td>المهنة:</td>
                        <td><input name="jobtitle" type="text" size="35" /></td>
                    </tr>
                    <tr valign="top">
                        <td>الهاتف:</td>
                        <td><input name="phone" type="text" size="20" dir="ltr" /></td>
                    </tr>
                    <tr valign="top">
                        <td>البريد الالكتروني:</td>
                        <td><input name="email" type="text" size="20" dir="ltr" /></td>
                    </tr>
                    <tr valign="top">
                        <td>صلاحيات لوحة التحكم</td>
                        <td>
                            <label>إضافة الاخبار:</label><input name="permission_news" type="checkbox" checked value="1" />
                            <label>إضافة الاشرطة الاخبارية:</label><input name="permission_subtitle" type="checkbox" checked value="1" />
                            <label>إضافة الفيديوهات:</label><input name="permission_video" type="checkbox" checked value="1" />
                            <label>إضافة البرامج:</label><input name="permission_programs" type="checkbox" checked value="1" />
                            <label>إضافة البرامج لهاذا اليوم:</label><input name="permission_programs_day" type="checkbox" checked value="1" /><br /><br />
                            <label>إضافة مستخدم:</label><input name="permission_users" type="checkbox" value="1" />
                            <label>تصدير البيانات:</label><input name="permission_export" type="checkbox" value="1" />

                        </td>
                    </tr>
                    <tr valign="top">
                        <td>الصلاحيات الفرعية للمستخدم</td>
                        <td>
                            <label>صلاحيةألاضافة:</label><input name="permission_insert" type="checkbox" checked value="1" />
                            <label>صلاحية التعديل:</label><input name="permission_update" type="checkbox" checked value="1" />
                            <label>صلاحية المسح:</label><input name="permission_delete" type="checkbox" checked value="1" />
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>تفعيل الحساب:</td>
                        <td><input name="activite" type="checkbox" checked value="1" /></td>
                    </tr>
                    <tr valign="top">
                        <td>جعل المستخدم كمدير ايضاً:</td>
                        <td><input name="adminstration" type="checkbox" value="1" /></td>
                    </tr>
                    <tr valign="top">
                        <td>وصف المستخدم:</td>
                        <td><textarea class="textArea" name="description" rows="5"></textarea></td>
                    </tr>
                    <tr valign="top" align="left">
                        <td colspan="2">
                            <input type="submit" name="inserting_user" value="إضافة المستخدم" /></td>
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
        