<?php

ob_start();
require('../library/dbconnector.php');
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        $imageCorrection = mysqli_query($serverConnection, "SELECT `image`, `news_id` FROM `news`");
        while ($imageCorrectionResult = mysqli_fetch_array($imageCorrection)){
            $image = str_replace("../../", "", $imageCorrectionResult['image']);
            mysqli_query($serverConnection, "UPDATE `news` SET `image` = '$image' WHERE `news_id` = $imageCorrectionResult[news_id]");
        }        
        ?>
        
        <?php
        $imageCorrection = mysqli_query($serverConnection, "SELECT `image`, `advertis_id` FROM `advertising`");
        while ($imageCorrectionResult = mysqli_fetch_array($imageCorrection)){
            $image = str_replace("../../", "", $imageCorrectionResult['image']);
            mysqli_query($serverConnection, "UPDATE `advertising` SET `image` = '$image' WHERE `advertis_id` = $imageCorrectionResult[advertis_id]");
        }        
        ?>
        
        <?php
        $imageCorrection = mysqli_query($serverConnection, "SELECT `image`, `gallery_image_id` FROM `gallery_images`");
        while ($imageCorrectionResult = mysqli_fetch_array($imageCorrection)){
            $image = str_replace("../../", "", $imageCorrectionResult['image']);
            mysqli_query($serverConnection, "UPDATE `gallery_images` SET `image` = '$image' WHERE `gallery_image_id` = $imageCorrectionResult[gallery_image_id]");
        }        
        ?>
        
        <?php
        $imageCorrection = mysqli_query($serverConnection, "SELECT `image`, `program_id` FROM `programs`");
        while ($imageCorrectionResult = mysqli_fetch_array($imageCorrection)){
            $image = str_replace("../../", "", $imageCorrectionResult['image']);
            mysqli_query($serverConnection, "UPDATE `programs` SET `image` = '$image' WHERE `program_id` = $imageCorrectionResult[program_id]");
        }        
        ?>
        
        <?php
        $imageCorrection = mysqli_query($serverConnection, "SELECT `image`, `program_day_id` FROM `programs_day`");
        while ($imageCorrectionResult = mysqli_fetch_array($imageCorrection)){
            $image = str_replace("../../", "", $imageCorrectionResult['image']);
            mysqli_query($serverConnection, "UPDATE `programs_day` SET `image` = '$image' WHERE `program_day_id` = $imageCorrectionResult[program_day_id]");
        }        
        ?>
        
        <?php
        $imageCorrection = mysqli_query($serverConnection, "SELECT `image`, `video_id` FROM `video`");
        while ($imageCorrectionResult = mysqli_fetch_array($imageCorrection)){
            $image = str_replace("../../", "", $imageCorrectionResult['image']);
            mysqli_query($serverConnection, "UPDATE `video` SET `image` = '$image' WHERE `video_id` = $imageCorrectionResult[video_id]");
        }        
        ?>
    </body>
</html>
