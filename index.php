<?php

// include database and object files
include_once 'database/database.php';

 
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
 
$page_title = "Sign In.";
include_once "layout_header.php";
 

include_once "login.php";
 
// layout_footer.php holds our javascript and closing html tags
include_once "layout_footer.php";
