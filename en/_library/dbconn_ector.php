<?php

//define('DB_NAME', 'almashro_Uxvs_DBNew');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_HOST', 'localhost');

define('DB_NAME', 'almashro_Uxvs_DBNen');
define('DB_USERNAME', 'almashro_useHGD');
define('DB_PASSWORD', 'Jv)Qb[p]&E3!');
define('DB_HOST', 'localhost');


// Server connection
if(mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME)){
    $serverConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
} else{
    die();
}


// Selecting database
//$dbSelect = mysqli_select_db($serverConnection, DB_NAME);

// Database encoding
mysqli_query($serverConnection, "set character_set_server='utf8'");
mysqli_query($serverConnection, "set names 'utf8'");
