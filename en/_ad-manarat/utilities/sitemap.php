<?php

ob_start();
session_start();

// Database Conncetion
require('../library/functions.php');

// Clear login sessions for the first time.
checkLoginStatus("../index.php");

// Insert permission
if ($_SESSION['permission_sitemap_GenerlUseXV1'] != 1) {
    reDirect("../home.php");
}

generateSitemap();
reDirect("../home.php");
