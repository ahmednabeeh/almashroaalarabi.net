<?php

require_once 'variables.php';

// Server connection
if(mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME)){
    $serverConnection = mysqli_connect(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);
} else{
    echo mysqli_error($serverConnection);
}


// Selecting database
//$dbSelect = mysqli_select_db($serverConnection, DB_NAME);

// Database encoding
mysqli_query($serverConnection, "set character_set_server='utf8'");
mysqli_query($serverConnection, "set names 'utf8'");
