<?php
ob_start();
include './_library/dbconn_ector.php';
?>
<!DOCTYPE>
<html>
    <head>
        <title>Photos Album</title>
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
                <div id="subPages">
                    <div class="title">Photo Albums</div>
                    <div style="text-align: center; margin-top: 10px;">
                        <?php
                        $fetchGallery = "SELECT `gallery_id`, `title` FROM `gallery` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `gallery_id` DESC LIMIT 30";
                        $fetchGallery = mysqli_query($serverConnection, $fetchGallery);
                        $counter = 1;
                        if (mysqli_num_rows(mysqli_query($serverConnection, "SELECT `gallery_id`, `title` FROM `gallery` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `gallery_id` DESC LIMIT 30")) != 0) {
                            while ($fetchGalleryResult = mysqli_fetch_array($fetchGallery)) {
                                $gallerySelectImage = mysqli_fetch_array(mysqli_query($serverConnection, "SELECT `image` FROM `gallery_images` WHERE `gallery_id` = $fetchGalleryResult[gallery_id] LIMIT 1"));
                                $titleExplodeArray = explode(" ", $fetchGalleryResult['title']);
                                $title = "";
                                for ($i = 0; $i <= 5; $i++) {
                                    $title .= " " . $titleExplodeArray[$i];
                                }
                                $imagePath = $gallerySelectImage['image'];
                                echo "<div style=\"display: inline-block; margin: 7px;\"><a href=\"gallery_viewer.php?gallery_id=$fetchGalleryResult[gallery_id]\" target=\"_blank\"><img style=\"border: 1px solid #5c7c96; padding: 5px;\" src=\"$imagePath\" width=\"160\" height=\"115\" /></a><div style=\"background-color: #ddd; color: #2e3e4b; padding: 5px; text-align: center;\">$title</div></div>";
                            }
                        } else {
                            echo "<h2 style=\"text-align: center;\">No Albums</h2>";
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
</body>
</html>