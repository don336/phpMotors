<?php
// This is the main controller
// Get the datbase connection file
// Create or access a session
require_once 'Library/connection.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

require_once './Library/functions.php';

$classifications = getClassifications();


// var_dump($classifications);
// exit;
$navList = checkClassifications($classifications);

// echo $navList;
// exit;
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }
 if(isset($_COOKIE['firstname'])){
    $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
 }
 switch ($action){
    case 'template':
        include 'view/template.php';
        break;
    default:
        include 'view/home.php';
 }
 