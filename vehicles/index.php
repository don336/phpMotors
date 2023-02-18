<?php
// This is the Account controller
// Get the datbase connection file
require_once '../Library/connection.php';
// Get the PHP Motors model for use as needed
require_once '../model/vehicle-model.php';
require_once '../model/main-model.php';

$classifications = getClassifications();
// var_dump($classifications);
// exit;
 $navList = '<ul class="navbar">';
 $navList .= "<li><a href='/phpmotors/index.php' title='View the PHP Motors home page'>Home</a></li>";
 foreach ($classifications as $classification) {
  $navList .= "<li><a href='/phpmotors/index.php?action=".urlencode($classification['classificationName'])."' title='View our $classification[classificationName] product line'>$classification[classificationName]</a></li>";
 }
 $navList .= '</ul>';

$dropDown = '<select class="drop-down" id="classification">';
foreach($classifications as $classification) {
    $dropDown .= "<option value='$classification[classificationId]'>$classification[classificationName]</option>";
}
$dropDown .= '</select>';

// echo $navList;
// exit;
$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

switch ($action){
    case 'AddClassification':
        include '../view/addClassification.php';
        exit;
    case 'classification':
        //Filter and store the data
        $classificationName = filter_input(INPUT_POST, 'classificationName');

        // Check for missing data
        if(empty($classificationName)) {
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/addClassification.php';
            exit; 
        }
        // Send the data to the model
        $regOutcome = add_Classification($classificationName);
        // Check and report the result
        if($regOutcome === 1){
            $message = "<p>Classification Added</p>";
            include '../view/addClassification.php';
            exit;
        } else {
            $message = "<p>Sorry $classificationName, but the registration failed. Please try again.</p>";
            include '../view/addClassification.php';
            exit;
        }
    case 'AddVehicle':
        include '../view/addVehicle.php';
        exit;
    case 'vehicle':
        //Filter and store the data
        $classificationId = filter_input(INPUT_POST, 'option');
        $invMake = filter_input(INPUT_POST, 'invMake');
        $invModel = filter_input(INPUT_POST, 'invModel');
        $invDescription = filter_input(INPUT_POST, 'invDescription');
        $invImage = filter_input(INPUT_POST, 'invImage');
        $invThumbnail = filter_input(INPUT_POST, 'invThumbnail');
        $invPrice = filter_input(INPUT_POST, 'invPrice');
        $invStock = filter_input(INPUT_POST, 'invStock');
        $invColor = filter_input(INPUT_POST, 'invColor');
        if(empty($invMake) ||empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invColor)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/addVehicle.php';
            exit;
        }
            $regOutcome = regVehicle($classification,$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $invStock);
    
            // Check and report the result
            if($regOutcome === 1){
                $message = "<p>Vehicle Added</p>";
                include '../view/addVehicle.php';
                exit;
            } else {
                $message = "<p>Sorry $invMake, but the registration failed. Please try again.</p>";
                include '../view/AddVehicle.php';
                exit;
            }


    default: 
        include "../view/vehicleManagement.php";
      
}
 