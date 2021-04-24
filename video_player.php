<?php
ob_start();
include './_library/dbconn_ector.php';
if (isset($_GET['video_id'])) {
    $video_id = $_GET['video_id'];
    if (is_numeric($video_id)) {
        $video_id = abs(mysqli_real_escape_string($serverConnection, strip_tags($video_id)));
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
        <title>الفيديوهات</title>
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
                        <?php // Menu Render  ?>
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
                    <div class="title">الفديوهات</div>
                    <div style="text-align: center; margin-top: 10px;">
                        <?php
                        // Important News
                        if (!is_numeric($_GET['video_id'])) {
                            header("Location: index.php");
                        }
                        $video_id = abs(mysqli_real_escape_string($serverConnection, strip_tags(($_GET['video_id']))));
                        $fetchVideo = "SELECT `title`, `code` FROM `video` WHERE `video_id` =  $video_id AND `display` = 1 AND `display_phone` = 0 LIMIT 1";
                        $fetchVideo = mysqli_query($serverConnection, $fetchVideo);
                        $counter = 1;
                        if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT `title`, `code` FROM `video` WHERE `video_id` =  $video_id AND `display` = 1 AND `display_phone` = 0 LIMIT 1")) != 0) {
                            while ($fetchVideoResult = mysqli_fetch_array($fetchVideo)) {
                                $title = $fetchVideoResult['title'];
                                $code = $fetchVideoResult['code'];
                                echo "<h1 id=\"pageheader\">$title</h1><!-- # WEB GENERATOR section page -->";
                                if (!empty($code)) {
                                    echo $code;
                                } else {
                                    
                                }
                            }
                        } else {
                            
                        }
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
        <script type="text/javascript">
            var imageIndex = 0;
<?php
echo "var imagesArray = [";
$imageArray = "";
$javascriptImageArray = mysqli_query($serverConnection, "SELECT * FROM `gallery_images` WHERE `gallery_id` = $gallery_id AND `display` = 1 AND `display_phone` = 0 ORDER BY `gallery_image_id` DESC LIMIT 20");
while ($javascriptResult = mysqli_fetch_array($javascriptImageArray)) {
    $imagePath = $javascriptResult['image'];
    $imageArray .= "\"$imagePath\", ";
}
$imageArray .= "];";
$imageArray = str_replace(", ];", "];", $imageArray);
echo $imageArray;
?>
            var imageArrayLength = imagesArray.length;
            document.getElementById("imageCounter").innerHTML = imagesArray.length + " - " + 1;
            function next() {
                var imageObject = document.getElementById("galleryImage");
                var maxValue = imageArrayLength - 1;
                if (imageIndex >= maxValue) {
                    imageIndex = 0;
                } else {
                    imageIndex++;
                }
                imageObject.src = imagesArray[imageIndex];
                var newImageIndex = imageIndex + 1;
                document.getElementById("imageCounter").innerHTML = imagesArray.length + " - " + newImageIndex;
            }
            function previous() {
                var imageObject = document.getElementById("galleryImage");
                if (imageIndex == 0) {
                    imageIndex = imageArrayLength - 1;
                } else {
                    imageIndex--;
                }
                imageObject.src = imagesArray[imageIndex];
                var newImageIndex = imageIndex + 1;
                document.getElementById("imageCounter").innerHTML = imagesArray.length + " - " + newImageIndex;
            }
        </script>
    </body>
</html>