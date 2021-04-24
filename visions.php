<?php
include './_library/dbconn_ector.php';
// Pagination
define('PERPAGE', 30);
if (isset($_GET['PAGE'])) {
    $page = abs(filter_input(INPUT_GET, 'PAGE', FILTER_SANITIZE_NUMBER_INT));
    $start = $page * PERPAGE;
} else {
    $page = 0;
    $start = $page;
}
?>
<!DOCTYPE>
<html>
    <head>
        <title>رؤى سياسية</title>
        <meta charset="utf8" />
        <link type="text/css" rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <div id="header">
            <div id="container">
                <div id="navigation">
                    <div id="logo"><img src="images/almashroaalarabi.png" /></div>
                    <div id="menu">
                        <ul>
                            <li><a href="index.php">الرئيسية</a></li>
                            <li><a href="projects.php">المشاريع</a></li>
                            <li><a href="office.php">المكاتب</a></li>
                            <li><a href="about.php">من نحن</a></li>
                            <li><a href="contact.php">أتصل بنا</a></li>
                            <!--<li><a href="en/">EN</a></li>-->
                        </ul>
                    </div>
                </div>
                <div id="image"><img src="images/khames-alkhanjar.png" /></div>
            </div>
        </div>
        <div id="wrapper">
            <div id="rightSideBar">
                <div id="rightSideBarMenu">
                    <ul>
                        <li class="home"><a href="index.php">الرئيسية</a></li>
                        <?php // Menu Render ?>
                        <li><a href="secretary.php">الأمين العام</a></li>
                        <li><a href="sides.php">بيانات ومواقف</a></li>
                        <li><a href="visions.php">رؤى سياسية</a></li>
                        <li><a href="activities.php">نشاطات المكتب</a></li>
                        <li><a href="homeland.php">قضايا وطن</a></li>
                        <li><a href="resources/opention.pdf">كتاب الرأي</a></li>
                    </ul>
                </div>
                <!--                <div id="socialIcons">
                                    <a href="https://facebook.com" target="_blank"><img src="images/fb.jpg" /></a>
                                    <a href="https://twitter.com" target="_blank"><img src="images/twitter.jpg" /></a>
                                    <a href="https://plus.google.com" target="_blank"><img src="images/google.jpg" /></a>
                                    <a href="https://youtube.com" target="_blank"><img src="images/youtube.jpg" /></a>
                                    <a href="/resources/feeds/rss.xml" target="_blank"><img src="images/rss.jpg" /></a>
                                </div>-->
            </div>
            <div id="midBar">
                <div id="subPages">
                    <div class="title">رؤى سياسية</div>
                    <div style="text-align: center; margin-top: 10px;">
                        <?php
                        if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'رؤى سياسية' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT  $start, " . PERPAGE)) != 0) {
                            $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'رؤى سياسية' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT  $start, " . PERPAGE);
                            $counter = 1;
                            while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                                echo "<div style=\"display: inline-block; width: 380px; margin-left: 10px; margin-bottom: 10px; background-color: #fff; text-align: right;\">";
                                echo "<a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img style=\"display: inline-block; vertical-align: top; width: 150px;\" src=\"$defaultActivitesNewsResult[image]\" width=\"150\" height=\"100\" /></a>";
                                echo "<a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\" style=\"display: inline-block; vertical-align: top; width: 150px;margin-right: 5px;\"><h1 style=\"color: #3a588d; font-wight: bold; font-size: 0.8em;\">$defaultActivitesNewsResult[title]</h1><img style=\"margin-left: 10px;\" src=\"images/views.png\" /><span style=\"font-size: 0.8em;\" >$defaultActivitesNewsResult[views]</span></a>";
                                echo "</div>";
                            }
                        }
                        ?>
                    </div>
                    <div class="pagination" style="background-color: #F00;">

                        <?php
                        // Display Pagination Compleate
                        $nextPage = $page + 1;
                        $pagesNum = ceil(mysqli_num_rows(mysqli_query($serverConnection, "SELECT `news_id` FROM `news` WHERE `category` = 'رؤى سياسية'")) / PERPAGE);

                        if ($page >= $pagesNum) {
                            $reDirectToPage = $pagesNum - 1;
                            if ($reDirectToPage >= 0) {
                                header("Location: ?PAGE=$reDirectToPage");
                            }
                        }
                        // Prev
                        echo "<div class=\"prev\">";
                        if ($page >= 1) {
                            $prevPage = $page - 1;
                            echo "<a href=\"?PAGE=$prevPage\"><</a>";
                        }
                        echo "</div>";
                        // Next
                        echo "<div class=\"next\">";
                        if ($pagesNum === 1) {
                            echo "<a href=\"?PAGE=$nextPage\">></a>";
                        } elseif ($pagesNum > 1) {
                            if ($nextPage < $pagesNum) {
                                echo "<a href=\"?PAGE=$nextPage\">></a>";
                            }
                        }
                        echo "</div>";
                        ?>
                    </div>
                </div>
            </div>

            <div id="leftSideBar">
                <div><img src="images/secretary-general.png" /></div>
                <div id="khamesAlkhanjar">
                    <!--<a class="personalWebsite" href="#">الموقع الرسمي</a>
                    <a class="cv" href="cv.php">السيرة الذاتية</a>
                    <a class="twits" href="https://twitter.com">التغريدات</a>-->
                </div>
                <div id="khamesAlkhanjarSocial">
                    <a href="https://www.facebook.com/Arab.project"><img src="images/social-fb.png" /></a>
                    <a href="https://twitter.com/arabprojectiq"><img src="images/social-twitter.png" /></a>
                    <a href="https://www.youtube.com/channel/UCMNzLRzcp9MXdEqeCMjSpzw"><img src="images/social-youtube.png" /></a>
                    <a href="https://plus.google.com/u/0/103158091189451334925"><img src="images/gplus.png" /></a>
                </div>
                <div class="fb-like" style="background-color: #e7ecec; display: block; padding-top: 5px; padding-bottom: 5px;" data-href="https://www.facebook.com/Arab.project" data-width="278" data-layout="standard" data-action="like" data-size="large" data-show-faces="true" data-share="true"></div>
                <h1 id="secretaryGeneral">أخبار الأمين العام</h1>
                <?php
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'الامين العام' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 5")) != 0) {
                    $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'الامين العام' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 5");
                    $counter = 1;
                    while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                        echo "<div class=\"secretaryGeneralItems\">";
                        echo "<div><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img class=\"image\" src=\"$defaultActivitesNewsResult[image]\" /></a></div>";
                        echo "<div class=\"views\"><img style=\"margin-left: 10px;\" src=\"images/views.png\" /><span style=\"font-size: 0.8em; color: #fff;\">$defaultActivitesNewsResult[views]</span></div>";
                        echo "<div class=\"title\"><a style=\"font-size: 0.8em; color: #fff;\" href=\"details.php?id=$defaultActivitesNewsResult[news_id]\">$defaultActivitesNewsResult[title]</a></div>";
                        echo "</div>";
                    }
                }
                ?>
                <div><a style="background-color: #48628a; color: #8fa3c1; display: block; text-align: center; margin-bottom: 50px;" href="secretary.php"/>المزيد</a></div>
                <h1 id="positions">بيانات ومواقف</h1>
                <?php
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'بيانات ومواقف' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 4")) != 0) {
                    $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'بيانات ومواقف' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 4");
                    $counter = 1;
                    while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                        echo "<div class=\"positionsGeneralItems\">";
                        echo "<div><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img class=\"image\" src=\"$defaultActivitesNewsResult[image]\" /></a></div>";
                        echo "<div class=\"views\"><img style=\"margin-left: 10px;\" src=\"images/views.png\" /><span style=\"font-size: 0.8em; color: #fff;\">$defaultActivitesNewsResult[views]</span></div>";
                        echo "<div class=\"title\"><a style=\"font-size: 0.8em; color: #fff;\" href=\"details.php?id=$defaultActivitesNewsResult[news_id]\">$defaultActivitesNewsResult[title]</a></div>";
                        echo "</div>";
                    }
                }
                ?>
                <div><a style="background-color: #48628a; color: #8fa3c1; display: block; text-align: center; margin-bottom: 50px;" href="sides.php"/>المزيد</a></div>

                <h1 id="visions">رؤى سياسية</h1>
                <?php
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'رؤى سياسية' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 4")) != 0) {
                    $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'رؤى سياسية' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 4");
                    $counter = 1;
                    while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                        echo "<div class=\"visionsGeneralItems\">";
                        echo "<div><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img class=\"image\" src=\"$defaultActivitesNewsResult[image]\" /></a></div>";
                        echo "<div class=\"views\"><img style=\"margin-left: 10px;\" src=\"images/views.png\" /><span style=\"font-size: 0.8em; color: #fff;\">$defaultActivitesNewsResult[views]</span></div>";
                        echo "<div class=\"title\"><a style=\"font-size: 0.8em; color: #fff;\" href=\"details.php?id=$defaultActivitesNewsResult[news_id]\">$defaultActivitesNewsResult[title]</a></div>";
                        echo "</div>";
                    }
                }
                ?>
                <div><a style="background-color: #48628a; color: #8fa3c1; display: block; text-align: center; margin-bottom: 50px;" href="visions.php"/>المزيد</a></div>
            </div>
        </div>
        <div id="footer">
            <div id="container">
                <div id="almashroaaFooter"><img src="images/almashroaalarabi-footer.png" /></div>
                <div id="copyrights">
                    <h1>جميع الحقوق محفوظة للمشروع العربي في العراق <?php echo date('Y'); ?></h1>
                    <a href="https://facebook.com" target="_blank"><img src="images/fb.jpg" /></a>
                    <a href="https://twitter.com" target="_blank"><img src="images/twitter.jpg" /></a>
                    <a href="https://plus.google.com" target="_blank"><img src="images/google.jpg" /></a>
                    <a href="https://youtube.com" target="_blank"><img src="images/youtube.jpg" /></a>
                    <a href="/resources/feeds/rss.xml" target="_blank"><img src="images/rss.jpg" /></a>
                </div>
                <div id="menu">
                    <ul>
                        <li><a href="index.php">الرئيسية</a></li>
                        <li><a href="secretary.php">الأمين العام</a></li>
                        <li><a href="sides.php">بيانات ومواقف</a></li>
                        <li><a href="visions.php">رؤى سياسية</a></li>
                    </ul>
                    <ul>
                        <li><a href="activities.php">نشاطات المكاتب</a></li>
                        <li><a href="homeland.php">قضايا وطن</a></li>
                        <li><a href="openion.php">كتاب الرأي</a></li>
                        <li><a href="infographics.php">أنفوكرافيك</a></li>
                    </ul>
                    <ul>
                        <li><a href="video.php">مكتبة الفيديو</a></li>
                        <li><a href="gallery.php">معرض الصور</a></li>
                    </ul>
                </div>
            </div>

            <div id="navigation">
                <ul>
                    <li><a href="projects.php">المشاريع</a></li>
                    <li><a href="office.php">المكاتب</a></li>
                    <li><a href="about.php">من نحن</a></li>
                    <li><a href="contact.php">أتصل بنا</a></li>
                </ul>
            </div>
        </div>
    </body>
</html>