<?php
ob_start();
include './_library/dbconn_ector.php';
if (isset($_GET['id'])) {
    $news_id = $_GET['id'];
    if (is_numeric($news_id)) {
        $news_id = abs(mysqli_real_escape_string($serverConnection, strip_tags($news_id)));
        $fetchNews = "SELECT `news_id`, `title`, `editor`, `image`, `video_youtube`, `content`, `creation`, `comments`, `comments_number`, `views` FROM `news` WHERE `news_id` = $news_id AND `display` = 1 AND `display_phone` = 0 LIMIT 1";
        $fetchNewsResult = mysqli_fetch_array(mysqli_query($serverConnection, $fetchNews));
// Counter
        $comment_count = $fetchNewsResult['views'];
        $comment_count = $comment_count + 1;
        mysqli_query($serverConnection, "UPDATE `news` SET `views` = $comment_count WHERE `news_id` = $news_id");
        $httpProtocol = (isset($_SERVER['HTTPS']) ? "https" : "http");
        $siteURL = $httpProtocol . "://" . $_SERVER['SERVER_NAME'];
    } else {
        header("Location: index.php");
    }
} else {
    header("Location: index.php");
}
?>
<!DOCTYPE>
<html>
    <head>
        <meta charset="utf8" />
        <title><?php echo $fetchNewsResult['content']; ?></title>
        <meta name="keywords" content="<?php echo $fetchNewsResult['content']; ?>" />
        <meta name="description" content="<?php echo $fetchNewsResult['content']; ?>" />
        <meta name="robots" content="all" />
        <link type="text/css" rel="stylesheet" href="styles/main.css" />
        <meta property="og:image" content="<?php echo $siteURL . "/" . "$fetchNewsResult[image]";?>" />
	<meta property="og:title" content="<?php echo $fetchNewsResult['title']; ?>"/>
	<meta property="og:description" content="<?php echo $fetchNewsResult['content']; ?>"/>
	<link rel="canonical" href="<?php echo $siteURL . "/details.php?id=" . "$fetchNewsResult[news_id]";?>" />
        <meta name="twitter:image" content="<?php echo $siteURL . "/" . "$fetchNewsResult[image]";?>">
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:site" content="<?php echo $siteURL;?>">
	<meta name="twitter:creator" content="<?php echo $siteURL;?>">
	<meta name="twitter:title" content="<?php echo $fetchNewsResult['title']; ?>">
	<meta name="twitter:description" content="<?php echo $fetchNewsResult['content']; ?>">

        
        
    </head>
    <body>
        <script>
            (function (i, s, o, g, r, a, m) {
                i['GoogleAnalyticsObject'] = r;
                i[r] = i[r] || function () {
                    (i[r].q = i[r].q || []).push(arguments)
                }, i[r].l = 1 * new Date();
                a = s.createElement(o),
                        m = s.getElementsByTagName(o)[0];
                a.async = 1;
                a.src = g;
                m.parentNode.insertBefore(a, m)
            })(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');

            ga('create', 'UA-74960823-1', 'auto');
            ga('send', 'pageview');

        </script>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.4";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));
        </script>
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
                <?php
                $title = str_replace("\\\"", "&quot;", $fetchNewsResult['title']);
                $content = str_replace("\\\"", "&quot;", $fetchNewsResult['content']);
                $content = str_replace("/", "", $content);
                ?>
                <h1 id="pageheader"><?php echo $title; ?></h1>
                <?php
// Details
// Rating system
                if ($fetchNewsResult['views'] <= 50 && $fetchNewsResult['views'] >= 0) {
                    $ratingImage = "images/rating_0.png";
                } elseif ($fetchNewsResult['views'] <= 100 && $fetchNewsResult['views'] >= 51) {
                    $ratingImage = "images/rating_1.png";
                } elseif ($fetchNewsResult['views'] <= 200 && $fetchNewsResult['views'] >= 101) {
                    $ratingImage = "images/rating_2.png";
                } elseif ($fetchNewsResult['views'] <= 300 && $fetchNewsResult['views'] >= 201) {
                    $ratingImage = "images/rating_3.png";
                } elseif ($fetchNewsResult['views'] <= 400 && $fetchNewsResult['views'] >= 301) {
                    $ratingImage = "images/rating_4.png";
                } else {
                    $ratingImage = "images/rating_5.png";
                }

                $imagePath = $fetchNewsResult['image'];

                echo "<p style=\"line-height: 2em; text-align: justify; width: 750px; margin-bottom: 30px;\"><img align=\"right\" style=\"margin: 10px;\" src=\"$imagePath\" width=\"800\" />$fetchNewsResult[editor] <br />$content</p>"
                . "<div id=\"fb-share-button\" style=\"display: inline-block; margin-left: 10px;\" class=\"fb-share-button\" data-href=\"http://almashroaalarabi.net/details.php?id=$fetchNewsResult[news_id]\" data-layout=\"button\"></div><div style=\"display: inline-block; margin-left: 10px;\" class=\"print\"><img onclick=\"printData();\" src=\"images/print.png\" width=\"25\" /></div>"
                . "<div dir=\"ltr\" style=\"text-align: left; font-family: 'arial'; padding-left: 20px;\">$fetchNewsResult[creation]</div>";

                if ($fetchNewsResult['video_youtube'] != "no video") {

                    echo "<div style=\"text-align: center;\">" . $fetchNewsResult['video_youtube'] . "</div>";
                }
                if($fetchNewsResult['pdf'] != ""){
                    echo "<div style=\"color: #f00;\"><a href=\"$fetchNewsResult[pdf]\">لتحميل الملف المرفق بصيغة PDF</a></div>";
                }
                
                ?>
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
        <script type="text/javascript">
            function printData() {
                window.print();
            }
        </script>
    </body>
</html>