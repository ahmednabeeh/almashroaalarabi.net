<?php

//define('DB_NAME', 'almashro_Uxvs_DBNew');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_HOST', 'localhost');

define('DB_NAME', 'almashro_Uxvs_DBNen');
define('DB_USERNAME', 'almashro_useHGD');
define('DB_PASSWORD', 'Jv)Qb[p]&E3!');
define('DB_HOST', 'localhost');

// Check if the users login or not
function checkLoginStatus($location) {
    if (!isset($_SESSION['fullName_GenerlUseXV1']) || !isset($_SESSION['user_id_GenerlUseXV1']) || !isset($_SESSION['log_id_GenerlUseXV1']) || !isset($_SESSION['operatingSystem_GenerlUseXV1']) || !isset($_SESSION['browser_GenerlUseXV1'])) {
        reDirect($location);
    }
}

// Redirect to page
function reDirect($pageDirection) {
    header("Location: " . $pageDirection);
}

// Clear login sessions
function resetLogin() {
    $_SESSION['fullName_GenerlUseXV1'] = null;
    $_SESSION['user_id_GenerlUseXV1'] = null;
    $_SESSION['log_id_GenerlUseXV1'] = null;
    $_SESSION['operatingSystem_GenerlUseXV1'] = null;
    $_SESSION['browser_GenerlUseXV1'] = null;
}

// Clean Text
function cleanInjection($cleaning) {
    $cleanedStringStript = strip_tags($cleaning, "<script><p><a><div><h1><h2><body><styles>");
    $cleanedStringRreplaceSlash = str_replace("\"", " &#34; ", $cleanedStringStript);
    $cleaned = str_replace("  ", " ", $cleanedStringRreplaceSlash);
    return $cleaned;
}

// Title
function getTitle($title) {
    if (!empty($title)) {
        $returnedTitle = str_replace("\"", "&#34;", cleanInjection($title));
    } else {
        $returnedTitle = "لم يتم تحديد العنوان";
    }
    return $returnedTitle;
}

// String
function getString($string) {
    if (!empty($string)) {
        $returnedString = str_replace("\"", "&#34;", cleanInjection($string));
    } else {
        $returnedString = "لم يتم تحديد المحتوى";
    }
    return $returnedString;
}

// String
function getStringSymbol($string, $symbol) {
    if (!empty($string)) {
        $returnedStringSymbol = str_replace("\"", "&#34;", cleanInjection($string));
    } else {
        $returnedStringSymbol = $symbol;
    }
    return $returnedStringSymbol;
}

// Description
function getDescription($description) {
    if (!empty($description)) {
        $returnedDescription = str_replace("\"", "&#34;", cleanInjection($description));
    } else {
        $returnedDescription = "لم يتم تحديد الوصف";
    }
    return $returnedDescription;
}

// Editor
function getEditor($editor) {
    if (!empty($editor)) {
        $returnedEditor = cleanInjection($editor);
    } else {
        $returnedEditor = "لم يتم تحديد المحرر";
    }
    return $returnedEditor;
}

// Content
function getContent($content) {
    if (!empty($content)) {
        $returnedContent = cleanInjection($content);
    } else {
        $returnedContent = "لم يتم تحديد المحتوى";
    }
    return $returnedContent;
}

// Video Youtube
function getVideoYoutube($videoYoutube) {
    if (!empty($videoYoutube)) {
        $returnedVideo = $videoYoutube;
    } else {
        $returnedVideo = "no video";
    }
    return $returnedVideo;
}

// Category
function getCategory($category) {
    if (!empty($category)) {
        $returnedCategory = cleanInjection($category);
    } else {
        $returnedCategory = "";
    }
    return $returnedCategory;
}

// display
function getDisplay($display) {
    if (isset($display)) {
        $returnedDisplay = 1;
    } else {
        $returnedDisplay = 0;
    }
    return $returnedDisplay;
}

// display Phone
function getDisplayPhone($display_phone) {
    if (isset($display_phone)) {
        $returnedDisplayPhone = 1;
    } else {
        $returnedDisplayPhone = 0;
    }
    return $returnedDisplayPhone;
}

// Comments
function getComments($comments) {
    if (isset($comments)) {
        $returnedComments = 1;
    } else {
        $returnedComments = 0;
    }
    return $returnedComments;
}

function getIdChecker($id, $location) {
// News Display on Phone
    $returnedId = 0;
    if (isset($id) && is_numeric($id)) {
        $returnedId = abs($id);
    } else {
        reDirect($location);
    }
    return $returnedId;
}

// Image Uploads
function getImagePath($direction) {

    $fileName = $_SESSION['user_id_GenerlUseXV1'] . "19185" . date('Y') . "4346" . date('n') . date('j') . date('U');;

    $imagePath = "";
    if (isset($_FILES['image'])) {
        $image_name = explode('.', $_FILES['image']['name']);
        $image_count_array = count($image_name);
        $image_count_array -= 1;

        if ($image_name[$image_count_array] == "jpg" && $_FILES['image']['type'] == "image/jpeg" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.jpg";
        } elseif ($image_name[$image_count_array] == "png" && $_FILES['image']['type'] == "image/png" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.png";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.png";
        } elseif ($image_name[$image_count_array] == "gif" && $_FILES['image']['type'] == "image/gif" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.gif";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.gif";
        } elseif ($image_name[$image_count_array] == "bmp" && $_FILES['image']['type'] == "image/bmp" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.bmp";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.bmp";
        } else {
            $imagePath = "images/{$direction}/default.png";
        }
    }
    return $imagePath;
}

// Update Image Uploads
function getUpdatedImagePath($direction) {

    $fileName = $_SESSION['user_id_GenerlUseXV1'] . "19185" . date('Y') . "4346" . date('n') . date('j') . date('U');;

    $imagePath = "";
    if (isset($_FILES['image'])) {
        $image_name = explode('.', $_FILES['image']['name']);
        $image_count_array = count($image_name);
        $image_count_array -= 1;

        if ($image_name[$image_count_array] == "jpg" && $_FILES['image']['type'] == "image/jpeg" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.jpg";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.jpg";
        } elseif ($image_name[$image_count_array] == "png" && $_FILES['image']['type'] == "image/png" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.png";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.png";
        } elseif ($image_name[$image_count_array] == "gif" && $_FILES['image']['type'] == "image/gif" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.gif";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.gif";
        } elseif ($image_name[$image_count_array] == "bmp" && $_FILES['image']['type'] == "image/bmp" && $_FILES['image']['size'] <= 5242880) {
            $imagePathUpload = "../../images/{$direction}/{$fileName}.bmp";
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePathUpload);
            $imagePath = "images/{$direction}/{$fileName}.bmp";
        } else {
            $imagePath = filter_input(INPUT_POST, 'image_path', FILTER_SANITIZE_STRING);
        }
    }
    return $imagePath;
}

// Sitemap
function generateSitemap() {


// Server connection
    $serverConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);

// Selecting database
    mysqli_select_db($serverConnection, DB_NAME);

// Database encoding
    mysqli_query($serverConnection, "set character_set_server='utf8'");
    mysqli_query($serverConnection, "set names 'utf8'");

    $sitemapStructure = "";
    $sitemapStructure .= "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
    $sitemapStructure .= "\n";
    $sitemapStructure .= "<urlset xmlns=\"http://www.sitemaps.org/schemas/sitemap/0.9\">";
    $sitemapStructure .= "\n\t";

    $sitemapXmlQuery = mysqli_query($serverConnection, "SELECT `news_id`, `creation` FROM `news` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `news_id` DESC");
    while ($sitemapXmlQueryResult = mysqli_fetch_array($sitemapXmlQuery)) {
        $sitemapStructure .= "<url>";
        $sitemapStructure .= "\n\t\t";
        $sitemapStructure .= "<loc>http://www." . filter_input(INPUT_SERVER, 'HTTP_HOST') . "/details.php?news_id={$sitemapXmlQueryResult[news_id]}" . "</loc>";
        $sitemapStructure .= "\n\t";
        $sitemapStructure .= "</url>";
    }
    
    $sitemapStructure .= "\n</urlset>";
    $fileOpenerXml = fopen('../../sitemap.xml', 'w');
    fwrite($fileOpenerXml, $sitemapStructure);
}

// XML with hashtag Function
function xmlFeedsHashTag() {

    // Server connection
    $serverConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD);

// Selecting database
    mysqli_select_db($serverConnection, DB_NAME);

// Database encoding
    mysqli_query($serverConnection, "set character_set_server='utf8'");
    mysqli_query($serverConnection, "set names 'utf8'");


    $rss_header_xml = "<?xml version=\"1.0\" encoding=\"utf-8\"?>\t\n";
    $rss_start_version = "<rss version=\"2.0\">\t\n";
    $rss_start_channel = "<channel>\t\n";

// Rss Discription

    $rss_title = "<title>-----------</title>\t\n";
    $rss_link = "<link>http://www." . filter_input(INPUT_SERVER, 'HTTP_HOST') . "</link>\t\n";
    $rss_description = "<description>-----------</description>\t\n";
    $master_content = "";
    $sql_query = mysqli_query($serverConnection, "SELECT * FROM `news` WHERE `display` = 1 AND `display_phone` = 0 ORDER BY `news_id` DESC LIMIT 30");
    while ($result = mysqli_fetch_array($sql_query)) {
        $image = $result['image'];
        $item = "<item>\t\n";
        $titleResult = $result['title'];
        $content = $result['content'];
        $hashedQuery = mysqli_query($serverConnection, "SELECT `keywords` FROM `news_hashtag`");
        while ($hashedQueryResult = mysqli_fetch_array($hashedQuery)) {
            // $hashedString = "#". $hashedQueryResult['keywords'];
            $keyword = "#" . str_replace(" ", "_", $hashedQueryResult['keywords']);

            $title = str_replace("##", "#", str_replace($hashedQueryResult['keywords'], $keyword, $titleResult));
            $content = str_replace("##", "#", str_replace($hashedQueryResult['keywords'], $keyword, $content));
        }


        $title = "<title>{$title}</title>\t\n";

        $link = "<link>http://www." . filter_input(INPUT_SERVER, 'HTTP_HOST') . "/details.php?news_id={$result[news_id]}</link>\t\n";
        $description = "<description><![CDATA[<p><img src=\"http://www." . filter_input(INPUT_SERVER, 'HTTP_HOST') . "/images/news/{$image}\" align=\"left\" width=\"150\" border=\"0\"/>{$content}</p>]]></description>\t\n";
        $publish_date = "<pubDate>{$result[creation]} {$result[time]} </pubDate>\t\n";
        $author = "<author>-----------</author>\t\n";
        $item_end = "</item>\t\n";
        $master_content .= $item . $title . $link . $description . $publish_date . $author . $item_end;
    }
    $rss_end_channel = "</channel>\t\n</rss>\t\n";
    $handel = fopen('../../resources/feeds/rss.xml', 'w');
    $rss_header_xml_file = $rss_header_xml . $rss_start_version . $rss_start_channel . $rss_title . $rss_link . $rss_description . $master_content . $rss_end_channel;
    fwrite($handel, $rss_header_xml_file);
    mysqli_close($serverConnection);
    mysqli_free_result($hashedQuery);
}

// Device detection
function deviceDetection() {
    $userAgent = strtolower(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'));
    if (preg_match("/windows/", $userAgent)) {
        $operatingSystem = "Windows OS";
    } elseif (preg_match("/imac/", $userAgent)) {
        $operatingSystem = "Apple OS";
    } elseif (preg_match("/linux/", $userAgent)) {
        $operatingSystem = "Linux OS";
    } elseif (preg_match("/unix/", $userAgent)) {
        $operatingSystem = "Unix OS";
    } elseif (preg_match("/android/", $userAgent)) {
        $operatingSystem = "Android OS";
    } elseif (preg_match("/iphone/", $userAgent)) {
        $operatingSystem = "iPhone OS";
    } elseif (preg_match("/ipad/", $userAgent)) {
        $operatingSystem = "iPad OS";
    } else {
        $operatingSystem = "Unknown OS";
    }
    return $operatingSystem;
}

// Browser Detection
function browserDetection() {
// Browser detection
    $userAgent = strtolower(filter_input(INPUT_SERVER, 'HTTP_USER_AGENT'));

    if (preg_match("/navigator/", $userAgent)) {
        $browser = "Netscape Navigator";
    } elseif (preg_match("/flock/", $userAgent)) {
        $browser = "Flock";
    } elseif (preg_match("/firefox/", $userAgent)) {
        $browser = "Mozila Firefox";
    } elseif (preg_match("/trident/", $userAgent)) {
        $browser = "Internet Explorer";
    } elseif (preg_match("/opera/", $userAgent)) {
        $browser = "Opera";
    } elseif (preg_match("/chrome/", $userAgent)) {
        $browser = "Google Chrome";
    } elseif (preg_match("/safari/", $userAgent)) {
        $browser = "Apple Safari";
    } else {
        $browser = "Unknown";
    }
    return $browser;
}
