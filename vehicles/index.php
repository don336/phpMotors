<?php
// This is the Account controller
// Get the datbase connection file
// Create or access a session
session_start();
require_once '../Library/connection.php';
// Get the PHP Motors model for use as needed
require_once '../model/vehicle-model.php';
require_once '../model/main-model.php';
require_once '../Library/functions.php';

$classifications = getClassifications();

$navList = checkClassifications($classifications);

$action = filter_input(INPUT_POST, 'action');
 if ($action == NULL){
  $action = filter_input(INPUT_GET, 'action');
 }

//  $_SESSION['loggedin'] = TRUE;

switch ($action){
    case 'AddClassification':
        include '../view/addClassification.php';
        exit;
    case 'Classification':
        //Filter and store the data
        $classificationName = trim(filter_input(INPUT_POST, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

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
            header('Location: /phpmotors/vehicles/index.php?action=AddClassification'); 
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
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        if(empty($invMake) ||empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invColor)||empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/addVehicle.php';
            exit;
        }
            $regOutcome = regVehicle($classificationId,$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $invStock);
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
    case 'getInventoryItems':
        // Get the ClassificationId
        $classificationId = filter_input(INPUT_GET, 'classificationId', FILTER_SANITIZE_NUMBER_INT);
        // Fetch the vehicles by classificationId from the DB
        $inventoryArray = getInventoryByClassification($classificationId);
        // Convert the array to a JSON object and send it back 
         echo json_encode($inventoryArray); 
         break;
    case 'mod':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicles information could be found';
        }
        include '../view/vehicle-update.php';
        break;
    case 'updateVehicle':
        $classificationId = filter_input(INPUT_POST, 'classificationId');
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invDescription = trim(filter_input(INPUT_POST, 'invDescription', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invImage = trim(filter_input(INPUT_POST, 'invImage', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invThumbnail = trim(filter_input(INPUT_POST, 'invThumbnail', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invPrice = trim(filter_input(INPUT_POST, 'invPrice', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invStock = trim(filter_input(INPUT_POST, 'invStock', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invColor = trim(filter_input(INPUT_POST, 'invColor', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);
        if(empty($invMake) ||empty($invModel) || empty($invDescription) || empty($invImage) || empty($invThumbnail)||empty($invPrice)||empty($invStock)||empty($invColor)||empty($classificationId)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/vehicle-update.php';
            exit;
        }
        $updateResult = updateVehicle($classificationId,$invMake, $invModel, $invDescription, $invImage, $invThumbnail, $invPrice, $invColor, $invStock,$invId);
            // Check and report the result
        if($updateResult === 1){
            $message = "<p>Vehicle $invMake Updated</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Sorry $invMake, but the update failed. Please try again.</p>";
            include '../view/AddVehicle.php';
            exit;
        }
        break;
    case 'del':
        $invId = filter_input(INPUT_GET, 'invId', FILTER_VALIDATE_INT);
        $invInfo = getInvItemInfo($invId);
        if(count($invInfo)<1){
            $message = 'Sorry, no vehicles information could be found';
        }
        include '../view/vehicle-delete.php';
        exit;
        break;
    case 'deleteVehicle':
        $invMake = trim(filter_input(INPUT_POST, 'invMake', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invModel = trim(filter_input(INPUT_POST, 'invModel', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $invId = filter_input(INPUT_POST, 'invId', FILTER_SANITIZE_NUMBER_INT);

        $deleteResult = DeleteVehicle($invId);
            // Check and report the result
        if($deleteResult === 1){
            $message = "<p>Vehicle $invMake deleted</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        } else {
            $message = "<p>Error: $invMake $invModel was not
            deleted.</p>";
            $_SESSION['message'] = $message;
            header('location: /phpmotors/vehicles/');
            exit;
        }
        break;
      
    case 'classification':
        $classificationName = filter_input(INPUT_GET, 'classificationName', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $vehicles = getVehiclesByClassification($classificationName);

        if(!count($vehicles)){
            $message = "<p class='notice'>Sorry, no $classificationName vehicles could be found.</p>";
        } else {
            $vehicleDisplay = buildVehiclesDisplay($vehicles);
        }
        include '../view/classification.php';
        break;
    case 'vehicleDetail':
        $invId = filter_input(INPUT_GET, 'vehicleId', FILTER_SANITIZE_NUMBER_INT);
     
        $vehicle = getVehicleById($invId);

        if(!$vehicle){
            $message = "<p class='notice'>Sorry, details not found.</p>";
        } else {
            $vehicleDetail = buildVehiclesDetails($vehicle);
        }
        include '../view/vehicle-detail.php';
           break;

    default: 
         $classificationList = buildClassificationList($classifications);
            
        include "../view/vehicleManagement.php";
      
}
 