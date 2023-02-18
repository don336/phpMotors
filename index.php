<?php
// This is the main controller
// Get the datbase connection file
require_once 'Library/connection.php';
// Get the PHP Motors model for use as needed
require_once 'model/main-model.php';

$classifications = getClassifications();
// var_dump($classifications);
// exit;
 $navList = '<ul class="navbar">';
 $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
 foreach ($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
 }
 $navList .= '</ul>';

// echo $navList;
// exit;
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

 switch ($action){
    case 'template':
        include 'view/template.php';
        break;
    default:
        include 'view/home.php';
 }
 