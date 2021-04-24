<?php
include './_library/dbconn_ector.php';
?>
<!DOCTYPE>
<html>
    <head>
        <title>Almashroaa Alarabie</title>
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
                            <li><a href="index.php">Home</a></li>
                            <li><a href="projects.php">Projects</a></li>
                            <li><a href="office.php">Offices</a></li>
                            <li><a href="about.php">About</a></li>
                            <li><a href="contact.php">Contact</a></li>
                            <li><a href="../">AR</a></li>
                        </ul>
                    </div>
                </div>
                <div id="image"><img src="images/khames-alkhanjar.png" /></div>
            </div>
        </div>
        <!-- OK -->
        <div id="wrapper">
            <div id="rightSideBar">
                <div id="rightSideBarMenu">
                    <ul>
                        <li class="home"><a href="index.php">Home</a></li>
                        <?php // Menu Render ?>
                        <li><a href="secretary.php">General Secretary</a></li>
                        <li><a href="sides.php">Situations</a></li>
                        <li><a href="visions.php">Political Visions</a></li>
                        <li><a href="activities.php">Activities</a></li>
                        <li><a href="homeland.php">Issues of a homeland</a></li>
                        <li><a href="resources/opention.pdf">Raiee Book</a></li>
                    </ul>
                </div>
                <div id="socialIcons">
                    <a href="https://facebook.com" target="_blank"><img src="images/fb.jpg" /></a>
                    <a href="https://twitter.com" target="_blank"><img src="images/twitter.jpg" /></a>
                    <a href="https://plus.google.com" target="_blank"><img src="images/google.jpg" /></a>
                    <a href="https://youtube.com" target="_blank"><img src="images/youtube.jpg" /></a>
                    <a href="/resources/feeds/rss.xml" target="_blank"><img src="images/rss.jpg" /></a>
                </div>
            </div>
            <div id="midBar">
                <div id="urgent">
                    <div id="scroll">
                        <p>
                            <?php
                            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT title FROM subtitle WHERE display = 1 ORDER BY subtitle_id DESC LIMIT 1")) != 0) {
                                $defaultSubtitle = mysqli_query($serverConnection, "SELECT title FROM subtitle WHERE display = 1 ORDER BY subtitle_id DESC LIMIT 1");
                                $counter = 1;
                                while ($defaultSubtitleResult = mysqli_fetch_array($defaultSubtitle)) {
                                    echo $defaultSubtitleResult['title'];
                                }
                            }
                            ?>
                        </p>
                    </div>
                </div>
                <div id="latestNewsTitle">&nbsp;</div>
                <div style="display: inline; margin-left: 10px;"></div>
                <div id="importantNews">

                    <?php
                        if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT `news_id`, `image` FROM `news` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `news_id` DESC LIMIT 1")) != 0) {
                            $defaultHeadLine = mysqli_query($serverConnection, "SELECT `news_id`, `image` FROM `news` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `news_id` DESC LIMIT 1");
                            $counter = 1;
                            while ($defaultImportantNewsResult = mysqli_fetch_array($defaultHeadLine)) {
                                $imagePath = $defaultImportantNewsResult['image'];
                                echo "<div style=\"display: inline-block; vertical-align: top; padding: 15px;\">";
// Images
// Next
                                echo "<div style=\"display: inline-block; vertical-align: middle; margin-right: -30px; z-index: 99; position: relative; cursor: pointer; \"><img src=\"images/arrow_next.png\" width=\"30\" onClick=\"nextImportant()\"></div>";
// Master Image
                                echo "<div style=\"display: inline-block; vertical-align: middle; \"><img style=\"border: 4px solid #0fa087\" id=\"importantNewsImage\" src=\"$imagePath\" width=\"770\" height=\"460\"/></div>";
// Prev
                                echo "<div style=\"display: inline-block; vertical-align: middle; margin-left: -30px; z-index: 99; position: relative; cursor: pointer; \"><img src=\"images/arrow_prev.png\" width=\"30\" onClick=\"prevImportant()\"></div>";                                
// Rotator Position
                                echo "<div style=\"text-align: center;\"><img id=\"rotatorPosition\" src=\"images/rotater_circle_1.png\" width=\"80\" height=\"15\"></div>";
                                echo "</div>";
                            }
                        } else {
                            echo mysqli_error($serverConnection);
                        }
                    ?>
                </div>
                <div id="activities">
                    <div class="title"><a style="color: #fff;" href="activities.php">Activities</a></div>
                    <div>
                        <?php
                        if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'نشاطات المكتب' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 1")) != 0) {
                            $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'نشاطات المكتب' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 1");
                            $counter = 1;
                            while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                                echo "<div style=\"display: inline-block; vertical-align: top; width: 380px; margin-top: 10px;\">";
                                echo "<div style=\"display: inline; margin-right: 10px;\"><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img src=\"$defaultActivitesNewsResult[image]\" width=\"380\" height=\"230\" /></a></div>";
                                echo "<div style=\"background-color: #c5c7cc; padding-left: 10px; font-size: 0.8em;\"><img style=\"margin-left: 10px;\" src=\"images/views.png\" />$defaultActivitesNewsResult[views]</div>";
                                echo "<h1 style=\"margin: 0px padding: 0px; font-size: 1.2em; color: #0fa087\"><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\">$defaultActivitesNewsResult[title]</a></h1>";
                            $contentExplodeArray = explode(" ", $defaultActivitesNewsResult['content']);
                            $content = "";
                            for ($i = 0; $i <= 35; $i++) {
                                $content .= " " . $contentExplodeArray[$i];
                            }
                            $content = str_replace("\\\"", "", $content);
                                echo "<div style=\"width: 380px; margin-top: 0px; padding: 0px; font-size: 0.8em;\"><p><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\">$content</a></p></div>";
                                echo "</div>";
                            }
                        }
                        ?>


                        <div style="display: inline-block; vertical-align: top; width: 380px; margin-left: 30px; margin-top: 10px;">
                            <?php
                            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'نشاطات المكتب' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 1,3")) != 0) {
                                $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'نشاطات المكتب' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 1,3");
                                $counter = 1;
                                while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                                    echo "<div style=\"display: inline-block; width: 380px; margin-right: 10px; margin-bottom: 10px; background-color: #fff;\">";
                                    echo "<a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img style=\"display: inline-block; vertical-align: top; width: 150px;\" src=\"$defaultActivitesNewsResult[image]\" width=\"150\" height=\"100\" /></a>";
                                    echo "<a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\" style=\"display: inline-block; vertical-align: top; width: 150px;margin-left: 5px;\"><h1 style=\"color: #3a588d; font-wight: bold; font-size: 0.8em;\">$defaultActivitesNewsResult[title]</h1><img style=\"margin-right: 10px;\" src=\"images/views.png\" /><span style=\"font-size: 0.8em;\" >$defaultActivitesNewsResult[views]</span></a>";
                                    echo "</div>";
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div id="gallery">
                    <div class="title"><a style="color: #fff;" href="gallery.php">Photo Gallery</a></div>
                    <div style="text-align: center;">
                        <div>
                            <?php
                            $fetchGallery = "SELECT gallery_id FROM gallery WHERE display = 1 AND display_phone = 0 ORDER BY gallery_id DESC LIMIT 1";
                            $fetchGallery = mysqli_query($serverConnection, $fetchGallery);
                            $counter = 1;
                            if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT gallery_id FROM gallery WHERE display = 1 AND display_phone = 0 ORDER BY gallery_id DESC LIMIT 1")) != 0) {
                                while ($fetchGalleryResult = mysqli_fetch_array($fetchGallery)) {
                                    $gallerySelectImage = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT image FROM gallery_images WHERE gallery_id = $fetchGalleryResult[gallery_id] LIMIT 1"));
                                    $imagePath = $gallerySelectImage['image'];
                                    echo "<div style=\"display: inline-block; margin-right: 10px; margin-bottom: 10px; margin-top: 10px;\"><a href=\"gallery_viewer.php?gallery_id=$fetchGalleryResult[gallery_id]\" target=\"_blank\"><img style=\"border: 1px solid #5c7c96; padding: 3px;\" src=\"$imagePath\" width=\"630\" height=\"420\" /></a></div>";
                                }
                            } else {
                            }
                            ?>
                        </div>
                        <?php
                        $fetchGallery = "SELECT gallery_id FROM gallery WHERE display = 1 AND display_phone = 0 ORDER BY gallery_id DESC LIMIT 1,3";
                        $fetchGallery = mysqli_query($serverConnection, $fetchGallery);
                        $counter = 1;
                        if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT gallery_id FROM gallery WHERE display = 1 AND display_phone = 0 ORDER BY gallery_id DESC LIMIT 1,3")) != 0) {
                            while ($fetchGalleryResult = mysqli_fetch_array($fetchGallery)) {
                                $gallerySelectImage = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT image FROM gallery_images WHERE gallery_id = $fetchGalleryResult[gallery_id] LIMIT 1"));
                                $imagePath = $gallerySelectImage['image'];
                                echo "<div style=\"display: inline; margin-right: 10px;\"><a href=\"gallery_viewer.php?gallery_id=$fetchGalleryResult[gallery_id]\" target=\"_blank\"><img style=\"border: 1px solid #5c7c96; padding: 3px;\" src=\"$imagePath\" width=\"180\" height=\"100\" /></a></div>";
                            }
                        } else {
                        }
                        ?>
                    </div>
                </div>
                <div id="videoGallery">
                    <div class="title"><a style="color: #fff;" href="video.php">Video</a></div>
                    <div style="text-align: center;">
                        <?php
                        if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT code FROM video WHERE display = 1 AND display_phone = 0 ORDER BY video_id DESC LIMIT 4")) != 0) {
                            $video = mysqli_query($serverConnection, "SELECT code FROM video WHERE display = 1 AND display_phone = 0 ORDER BY video_id DESC LIMIT 4");
                            $counter = 1;
                            while ($videoResult = mysqli_fetch_array($video)) {
                                echo "<div style=\"display: inline-block; margin-right: 10px; margin-bottom: 30px; margin-top: 30px;\">$videoResult[code]</div>";
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <div id="leftSideBar">
                <div><img src="images/secretary-general.png" /></div>
                <div id="khamesAlkhanjar">
                    <a class="personalWebsite" href="#">Personal Site</a>
                    <a class="cv" href="cv.php">CV</a>
                    <a class="twits" href="https://twitter.com">Tweets</a>
                </div>
                <div id="khamesAlkhanjarSocial">
                    <a href="https://facebook.com"><img src="images/social-fb.png" /></a>
                    <a href="https://twitter.com"><img src="images/social-twitter.png" /></a>
                    <a href="https://youtube.com"><img src="images/social-youtube.png" /></a>
                    <a href="https://instagram.com"><img src="images/social-instagram.png" /></a>
                </div>
                <h1 id="secretaryGeneral">General Secretary News</h1>
                <?php
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'الامين العام' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 5")) != 0) {
                    $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'الامين العام' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 5");
                    $counter = 1;
                    while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                        echo "<div class=\"secretaryGeneralItems\">";
                        echo "<div><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img class=\"image\" src=\"$defaultActivitesNewsResult[image]\" /></a></div>";
                        echo "<div class=\"views\"><img style=\"margin-right: 10px;\" src=\"images/views.png\" /><span style=\"font-size: 0.8em; color: #fff;\">$defaultActivitesNewsResult[views]</span></div>";
                        echo "<div class=\"title\"><a style=\"font-size: 0.8em; color: #fff;\" href=\"details.php?id=$defaultActivitesNewsResult[news_id]\">$defaultActivitesNewsResult[title]</a></div>";
                    }
                }
                ?>
                <div><a style="background-color: #48628a; color: #8fa3c1; display: block; text-align: center; margin-bottom: 50px;" href="secretary.php"/>More</a></div>
                <h1 id="positions">Situations</h1>
                <?php
                if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'بيانات ومواقف' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 5")) != 0) {
                    $defaultActivities = mysqli_query($serverConnection, "SELECT news_id, title, content, image, views FROM news WHERE category = 'بيانات ومواقف' AND display = 1 AND display_phone = 0 ORDER BY news_id DESC LIMIT 5");
                    $counter = 1;
                    while ($defaultActivitesNewsResult = mysqli_fetch_array($defaultActivities)) {
                        echo "<div class=\"positionsGeneralItems\">";
                        echo "<div><a href=\"details.php?id=$defaultActivitesNewsResult[news_id]\"><img class=\"image\" src=\"$defaultActivitesNewsResult[image]\" /></a></div>";
                        echo "<div class=\"views\"><img style=\"margin-right: 10px;\" src=\"images/views.png\" /><span style=\"font-size: 0.8em; color: #fff;\">$defaultActivitesNewsResult[views]</span></div>";
                        echo "<div class=\"title\"><a style=\"font-size: 0.8em; color: #fff;\" href=\"details.php?id=$defaultActivitesNewsResult[news_id]\">$defaultActivitesNewsResult[title]</a></div>";
                    }
                }
                ?>
                <div><a style="background-color: #48628a; color: #8fa3c1; display: block; text-align: center; margin-bottom: 50px;" href="sides.php"/>More</a></div>
            </div>
        </div>
    </div>

    <div id="footer">
        <div id="container">
            <div id="almashroaaFooter"><img src="images/almashroaalarabi-footer.png" /></div>
            <div id="copyrights">
                <h1>All Rights Reserved <?php echo date('Y'); ?></h1>
                <a href="https://facebook.com" target="_blank"><img src="images/fb.jpg" /></a>
                <a href="https://twitter.com" target="_blank"><img src="images/twitter.jpg" /></a>
                <a href="https://plus.google.com" target="_blank"><img src="images/google.jpg" /></a>
                <a href="https://youtube.com" target="_blank"><img src="images/youtube.jpg" /></a>
                <a href="/resources/feeds/rss.xml" target="_blank"><img src="images/rss.jpg" /></a>
            </div>
            <div id="menu">
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <li><a href="secretary.php">General Secretary</a></li>
                    <li><a href="sides.php">Situations</a></li>
                    <li><a href="visions.php">Political Visions</a></li>
                </ul>
                <ul>
                    <li><a href="activities.php">Activities</a></li>
                    <li><a href="homeland.php">Issues of a homeland</a></li>
                    <li><a href="openion.php">Raiee Book</a></li>
                    <li><a href="infographics.php">Infographics</a></li>
                </ul>
                <ul>
                    <li><a href="video.php">Video</a></li>
                    <li><a href="gallery.php">Photos</a></li>                        
                </ul>
            </div>
        </div>

        <div id="navigation">
            <ul>
                <li><a href="projects.php">Projects</a></li>
                <li><a href="office.php">Offices</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </div>
    </div>
    <!-- OK -->
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