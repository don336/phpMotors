<?php
    // Create/start Session 
       if(!$_SESSION['loggedin']){
           header('Location: /phpmotors/');
       }
    require_once '../Library/connection.php';
// Get the PHP Motors model for use as needed
    require_once '../model/vehicle-model.php';
    require_once '../model/main-model.php';
    require_once '../Library/functions.php';

    $classifications = getClassifications();

    $navList = checkClassifications($classifications);

?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/mobile.css" media="screen">
    <link rel="stylesheet" href="../css/style.css" media="screen">
    <title>
        <?php 
            if(isset($clientData['clientFirstname']) && isset($clientData['clientLastname'])){ 
		        echo "Modify $clientData[clientFirstname] $clientData[clientLastname]";
            } 
	        elseif(isset($clientFirstname) && isset($clientLastname)) { 
		        echo "Modify $clientFirstname $clientLastname";
            }
        ?>
    </title>
</head>
<body>
    <!-- <img src="./images/site/checkerboard.jpg" alt="mi"> -->
    <div class="main-container">
        <div class="container">
            <header id="main-header">
                  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/header.php'?>
                   <h1 class="black">
                        <?php
                        if(isset($_SESSION['loggedin'])){
                            echo "Welcome";
                            echo $_SESSION['clientData']['clientFirstname'];
                        }
                        ?>
                   </h1>
            </header>
            <nav class="main-nav">
                <?php echo $navList?>
            </nav>
            <main id="showcase">
                <?php 
                    if(isset($message)){
                    echo $message;
                    }
                ?>
                <h1 class="black">Update Account Information</h1>
                  <form class="login-form" action="/phpmotors/accounts/" method="post">
                
                        <label for="fname">
                            FirstName:
                            <input 
                            type="text" 
                            name="clientFirstname" placeholder="FirstName" id="fname"
                            <?php if(isset($clientFirstname)){ echo "value='$clientFirstname'"; } elseif(isset($clientData['clientFirstname'])) {echo "value='$clientData[clientFirstname]'"; }?>
                            >
                        </label>
                  
                            <label for="lname">
                                LastName:
                                <input type="text" name="clientLastname" placeholder="Last Name" id="lname"
                                <?php if(isset($clientLastname)){ echo "value='$clientLastname'"; } elseif(isset($clientData['clientLastname'])) {echo "value='$clientData[clientLastname]'"; }?> 
                            required>
                            </label>
                            <label for="email">
                                Email:
                                <input type="email" name="clientEmail" placeholder="Email" id="email"
                                <?php 
                                if(isset($clientEmail)){ echo "value='$clientData[clientEmail]'"; } elseif(isset($clientData['clientEmail'])) {echo "value='$clientData[clientEmail]'"; }?> required>
                            </label>
                    <input type="submit" value="Update Account" class="regbtn">
                    <input type="hidden" name="action" value="updateAccount">
                    <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
                    elseif(isset($clientId)){ echo $clientId; } ?>">
                </form>
                <br>
                <h2 class="black">Change User Password.</h2>
                <?php 
                    if(isset($message)){
                    echo $message;
                    }
                ?>
                <form class="login-form" action="/phpmotors/accounts/" method="post">
                            <span class="pwd">Password should have at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character</span>
                            <label for="pwd">Password:</label>
                            <input type="password" name="clientPassword" placeholder="Password" id="pwd" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"> 
                            <input type="submit" value="Change Password" class="regbtn">
                            <input type="hidden" name="action" value="changePassword">
                            <input type="hidden" name="clientId" value="<?php if(isset($clientData['clientId'])){ echo $clientData['clientId'];} 
                             elseif(isset($clientId)){ echo $clientId; } ?>">
                </form>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>

</body>
</html>