<?php
include '_library/dbconn_ector.php';
?>
<!DOCTYPE>
<html>
    <head>
        <title>السيرة الذاتية</title>
        <meta charset="utf8" />
        <link type="text/css" rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function (d, s, id) {
                var js, fjs = d.getElementsByTagName(s)[0];
                if (d.getElementById(id))
                    return;
                js = d.createElement(s);
                js.id = id;
                js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10";
                fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
        <div id="searchBar">
            <div id="search">
                <form id="searchForm" action="search.php" enctype="multipart/form-data" method="post">
                    <input type="submit" name="searchbtn" id="searchbtn" />
                    <input type="text" name="keywords" id="keywords" />
                </form>
            </div>
            <ul id="icons">
                <li><a href="#"><img src="images/facebook.jpg" /></a></li>
                <li><a href="#"><img src="images/twitter.jpg" /></a></li>
                <li><a href="#"><img src="images/googleplus.jpg" /></a></li>
                <li><a href="#"><img src="images/instagram.jpg" /></a></li>
                <li><a href="#"><img src="images/youtube.jpg" /></a></li>
                <li><a href="#"><img src="images/rss.jpg" /></a></li>
            </ul>
        </div>
        <div id="header">
            <img src="images/header.jpg" />
        </div>
        <div id="navigation">
            <ul id="icons">
                <li><a href="index.php">الرئيسية</a></li>
                <li><a href="cv.php">السيرة الذاتية</a></li>
                <li><a href="writes.php">كتابات</a></li>
                <li><a href="twites.php">تغريدات</a></li>
                <li><a href="contact.php">اتصل بنا</a></li>
        </div>

        <div id="default"><h2 style="color: #ced5d6; text-align: center; margin-top: 40px; margin-bottom: 100px;">الصفحة قيد الانجاز.</h2></div>

        <div id="fotter">
            <div id="alkhanjarText"><img src="images/alkhanjar_text.jpg" /></div>
            <div id="coptyrights">
                <p>
                    جميع الحقوق محفوظة لموقع
                    <br />
                    الشيخ خميس الخنجر
                    <br />
                    الأمين العام للمشروع العربي في العراق
                </p>
                <ul id="icons">
                    <li><a href="#"><img src="images/facebook.jpg" /></a></li>
                    <li><a href="#"><img src="images/twitter.jpg" /></a></li>
                    <li><a href="#"><img src="images/googleplus.jpg" /></a></li>
                    <li><a href="#"><img src="images/instagram.jpg" /></a></li>
                    <li><a href="#"><img src="images/youtube.jpg" /></a></li>
                    <li><a href="#"><img src="images/rss.jpg" /></a></li>
                </ul>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index.php">الرئيسية</a></li>
                    <li><a href="cv.php">السيرة الذاتية</a></li>
                    <li><a href="../">المشروع العربي</a></li>
                    <li><a href="writes.php">اخر الكتابات</a></li>
                </ul>                
                <ul>
                    <li><a href="twites.php">التغريدات</a></li>
                    <li><a href="gallery.php">معرض الصور</a></li>
                    <li><a href="video.php">مكتبة الفيديو</a></li>
                    <li><a href="contact.php">اتصل بنا</a></li>
                </ul>                
            </div>
        </div>



        <script type="text/javascript">
<?php
if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT `news_id`, `image` FROM `news` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `news_id` DESC LIMIT 0,4")) != 0) {
    $defaultHeadLine = mysqli_query($serverConnection, "SELECT `news_id`, `image` FROM `news` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `news_id` DESC LIMIT 0,4");
    $counter = 1;
    $imageArray = "var imageArray = [";
    $linkArray = "var linkArray = [";
    while ($defaultHeadLineResult = mysqli_fetch_array($defaultHeadLine)) {
        $imagePath = $defaultHeadLineResult['image'];
        $imageArray .= "\"$imagePath\", ";
        $linkArray .= "\"details.php?news_id=$defaultHeadLineResult[news_id]\", ";
    }
    $imageArray .= "];";
    $linkArray .= "];";
    $imageArray = str_replace(", ];", "];", $imageArray);
    $linkArray = str_replace(", ];", "];", $linkArray);
    echo "\t" . $imageArray . "\n";
    echo "\t" . $linkArray . "\n";
}
?>
            var rotatorImages = ["images/rotater_circle_1.png", "images/rotater_circle_2.png", "images/rotater_circle_3.png", "images/rotater_circle_4.png"];
            var indexArray = 0;
            var arrayLength = 3;
            function changeData() {
                document.getElementById("importantNewsImage").src = imageArray[indexArray];
                //        document.getElementById("importantNewsLink").href = linkArray[indexArray];
                document.getElementById("rotatorPosition").src = rotatorImages[indexArray];
                if (indexArray >= arrayLength) {
                    indexArray = 0;
                } else {
                    indexArray++;
                }
            }
            function nextImportant() {
                document.getElementById("importantNewsImage").src = imageArray[indexArray];
                //        document.getElementById("importantNewsLink").href = linkArray[indexArray];
                document.getElementById("rotatorPosition").src = rotatorImages[indexArray];
                if (indexArray >= arrayLength) {
                    indexArray = 0;
                } else {
                    indexArray++;
                }
            }
            function prevImportant() {
                document.getElementById("importantNewsImage").src = imageArray[indexArray];
                //        document.getElementById("importantNewsLink").href = linkArray[indexArray];
                document.getElementById("rotatorPosition").src = rotatorImages[indexArray];
                if (indexArray === 0) {
                    indexArray = arrayLength;
                } else {
                    indexArray--;
                }
            }
            setInterval(changeData, 8000);
        </script>
    </body>
</html>