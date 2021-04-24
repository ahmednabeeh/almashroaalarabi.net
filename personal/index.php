<?php
include '_library/dbconn_ector.php';
?>
<!DOCTYPE>
<html>
    <head>
        <title>الشيخ خميس الخنجر</title>
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
                <li><a href="contact.php">اتصل بنا</a></li>
        </div>

        <div id="posts">
            <div id="social">
                <div id="facebook" class="fb-page" data-href="https://www.facebook.com/khamesalkhanjar/" data-tabs="timeline" data-width="300" data-height="250" data-small-header="true" data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false"><blockquote cite="https://www.facebook.com/khamesalkhanjar/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/khamesalkhanjar/">‎</a></blockquote></div>
            </div>
            <div id="news">
                <div id="news_header">&nbsp;</div>
                <div id="news_content">
                    <?php
                    $news = "SELECT news_id, title, image FROM news WHERE display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 6";
                    $news = mysqli_query($serverConnection, $news);
                    $counter = 1;
                    if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, image FROM news WHERE display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 6")) != 0) {
                        while ($newsResult = mysqli_fetch_array($news)) {
                            $imagePath = $newsResult['image'];
                            $titleExplodeArray = explode(" ", $newsResult['title']);
                            $title = "";
                            for ($i = 0; $i <= 5; $i++) {
                                $title .= " " . $titleExplodeArray[$i];
                            }
                            $title .= "...";
                            echo "<div style=\"display: inline-block; margin: 10px;\"><div><a style=\"color: #1b2664\" href=\"details.php?news_id=$newsResult[news_id]\" target=\"_blank\"><img style=\"\" src=\"$imagePath\" width=\"270\" height=\"186\" /></div><div style=\"background-color: #ddd; color: #2e3e4b; padding: 5px; text-align: center; width: 260px;\">$title</div></a></div>";
                        }
                    }
                    ?>
                </div>
            </div>
        </div>


        <div id="gallery">
            <div id="galleryHeader"><a href="gallery.php">معرض الصور</a></div>
            <?php
            $gallery = "SELECT gallery_id, title FROM gallery WHERE display = 1 AND display_phone = 0 ORDER BY gallery_id DESC LIMIT 8";
            $fetchGallery = mysqli_query($serverConnection, $gallery);
            $counter = 1;
            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT gallery_id, title FROM gallery WHERE display = 1 AND display_phone = 0 ORDER BY gallery_id DESC LIMIT 8")) != 0) {
                while ($fetchGalleryResult = mysqli_fetch_array($fetchGallery)) {
                    $gallerySelectImage = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT image FROM gallery_images WHERE gallery_id = $fetchGalleryResult[gallery_id] LIMIT 1"));
                    $titleExplodeArray = explode(" ", $fetchGalleryResult['title']);
                    $title = "";
                    for ($i = 0; $i <= 5; $i++) {
                        $title .= " " . $titleExplodeArray[$i];
                    }
                    $imagePath = $gallerySelectImage['image'];
                    echo "<div style=\"display: inline-block; margin: 7px;\"><a href=\"gallery_viewer.php?gallery_id=$fetchGalleryResult[gallery_id]\" target=\"_blank\"><img style=\"border: 1px solid #5c7c96; padding: 5px;\" src=\"$imagePath\" width=\"270\" height=\"190\" /></a></div>";
                }
            }
            ?>
        </div>
        <div id="video">
            <div id="videoHeader"><a href="video.php">مكتبة الفيديو</a></div>
            <?php
            $videoAlbum = "SELECT video_id, image FROM video WHERE display = 1 AND display_phone = 0 ORDER BY video_id DESC LIMIT 2";
            $video = mysqli_query($serverConnection, $videoAlbum);
            $counter = 1;
            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT `video_id`, `title`, `image` FROM `video` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `video_id` DESC LIMIT 2")) != 0) {
                while ($videoResult = mysqli_fetch_array($video)) {
                    $imagePath = $videoResult['image'];
                    echo "<div style=\"display: inline-block; margin: 15px;\"><div><a href=\"video_player.php?video_id=$videoResult[video_id]\" target=\"_blank\"><img style=\"border: 1px solid #5c7c96; padding: 5px;\" src=\"$imagePath\" width=\"525\" height=\"330\" /></a></div></div>";
                }
            }
            echo "<br />";
            $videoAlbum = "SELECT video_id, image FROM video WHERE display = 1 AND display_phone = 0 ORDER BY video_id DESC LIMIT 2,4";
            $video = mysqli_query($serverConnection, $videoAlbum);
            $counter = 1;
            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT `video_id`, `title`, `image` FROM `video` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `video_id` DESC LIMIT 2,4")) != 0) {
                while ($videoResult = mysqli_fetch_array($video)) {
                    $imagePath = $videoResult['image'];
                    echo "<div style=\"display: inline-block; margin: 10px;\"><div><a href=\"video_player.php?video_id=$videoResult[video_id]\" target=\"_blank\"><img style=\"border: 1px solid #5c7c96; padding: 5px;\" src=\"$imagePath\" width=\"250\" height=\"155\" /></a></div></div>";
                }
            }
            ?>
        </div>

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
                <ul
                    <li><a href="cv.php">السيرة الذاتية</a></li>
                    <li><a href="../">المشروع العربي</a></li>
                    <li><a href="writes.php">اخر الكتابات</a></li>
                </ul>                
                <ul>
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