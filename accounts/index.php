<?php
// This is the Account controller
// Get the datbase connection file
// Create or access a session
session_start();
require_once '../Library/connection.php';
// Get the PHP Motors model for use as needed
require_once '../model/main-model.php';
// Get the phpmotors model for registration
require_once '../model/accounts_model.php';
// Get the functions Library
require_once '../Library/functions.php';

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

 switch ($action){
    case 'Registration':
        include '../view/register.php';
        exit;

    case 'register':
        //Filter and store the data
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        $checkPassword = checkPassword($clientPassword);

        // Checking for existing email Address
        $existingEmail = checkExisitingEmail($clientEmail);
        if($existingEmail){
            $message = '<p>Email Already Exists.You may want to login instead.</p>';
            include '../view/login.php';
            exit; 
        }
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail) || empty($checkPassword)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/register.php';
            exit; 
        }

        // Hash the checked password
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);
        // Send the data to the model
        $regOutcome = regClient($clientFirstname, $clientLastname, $clientEmail, $hashedPassword);

        // Check and report the result
        if($regOutcome === 1){
            // Check and report the result
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Thanks for registering $clientFirstname. Please use your email and password to login.";
            header('Location: /phpmotors/accounts/?action=Login');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, but the registration failed. Please try again.</p>";
            include '../view/register.php';
            exit;
        }

        break;

    case 'Login' :
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = checkEmail($clientEmail);
        if(empty($clientEmail)||empty($clientPassword)){
            $message = '<p>Please provide a valid email address and password.</p>';
            include '../view/login.php';
            exit; 
        }

    
        $clientData = getClient($clientEmail);
       
        $hashCheck = password_verify($clientPassword, $clientData['clientPassword']);
        // If the hashes don't match create an error
        // and return to the login view
        if(!$hashCheck) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/login.php';
            exit;
        }
        // A valid user exists, log them in
        $_SESSION['loggedin'] = TRUE;

        // Remove the password from the array
        // the array_pop function removes the last
        // element from an array
        array_pop($clientData);
        // Store the array into the session
        $_SESSION['clientData'] = $clientData;
        if($_SESSION['loggedin']){
            $firstName = $_SESSION['clientData']['clientFirstname'];
            $welmsg = "<a href='/phpmotors/accounts/'>Welcome $firstName</a>";
        } else {
            $firstName = $_SESSION['clientData']['clientFirstname'];
            $welmsg = "<h1 class='black'>Welcome $firstName</h1>";
        }
        // Send them to the admin view
        include '../view/admin.php';
        exit;
        break;

    case 'Logout':
     
            session_unset();
            session_destroy();
            include '../view/login.php';
            exit;
        break;
    
    case "clientUpdt":
        $clientId = filter_input(INPUT_GET, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $clientData = getClientInfo($clientId);
        $_SESSION['clientData'] = $clientData;
        include '../view/client-update.php';
        break;
    case "updateAccount":
        $clientFirstname = trim(filter_input(INPUT_POST, 'clientFirstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientLastname = trim(filter_input(INPUT_POST, 'clientLastname', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientEmail = trim(filter_input(INPUT_POST, 'clientEmail', FILTER_SANITIZE_EMAIL));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        // Check for missing data
        if(empty($clientFirstname) || empty($clientLastname) || empty($clientEmail)){
            $message = '<p>Please provide information for all empty form fields.</p>';
            include '../view/client-update.php';
            exit; 
        }

        // Checking for existing email Address
        // $clientEmail = checkEmail($clientEmail);
        // if($clientEmail){
        //     $message = '<p>Please Check Email and Try again</p>';
        //     include '../view/client-update.php';
        //     exit; 
        // }
        $updateResult = updateClient($clientFirstname, $clientLastname, $clientEmail, $clientId);
        
        if($updateResult == 1){
            // Check and report the result
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = " $clientFirstname user profile Updated.";
             $clientData = getClientInfo($clientId);
             $_SESSION['clientData'] = $clientData;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Sorry $clientFirstname, Update Failed.</p>";
            include '../view/client-update.php';
        }
    
        include '../view/admin.php';
        exit;
        break;
    case 'changePassword':
        $clientPassword = trim(filter_input(INPUT_POST, 'clientPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
        $clientId = filter_input(INPUT_POST, 'clientId', FILTER_SANITIZE_NUMBER_INT);
        $checkPassword = checkPassword($clientPassword);
        if(!$checkPassword) {
            $message = '<p class="notice">Please check your password and try again.</p>';
            include '../view/client-update.php';
            exit;
        }
        $hashedPassword = password_hash($clientPassword, PASSWORD_DEFAULT);

        $updatedPwd = pwdUpdate($hashedPassword, $clientId);
        if($updatedPwd == 1){
            // Check and report the result
            setcookie('firstname', $clientFirstname, strtotime('+1 year'), '/');
            $_SESSION['message'] = "Password Updated.";
            $clientData = getClientInfo($clientId);
             $_SESSION['clientData'] = $clientData;
            header('Location: /phpmotors/accounts/');
            exit;
        } else {
            $message = "<p>Password Update Failed.</p>";
            include '../view/client-update.php';
        }
        exit;
    default:
        include '../view/admin.php';
      
 }
 

//  $2y$10$9wtLRySCgL4vYUYWp2nW.ODfF442S7v0VdpqjWgP6./..