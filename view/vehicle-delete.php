<?php
    if($_SESSION['clientData']['clientLevel'] < 1){
        header('location: /phpmotors/');
        exit;
    }
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/style.css" media="screen">
    <link rel="stylesheet" href="../css/mobile.css" media="screen">
    <title><?php if(isset($invInfo['invMake'])){ 
	echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?> | PHP Motors</title>
</head>
<body>
    <!-- <img src="./images/site/checkerboard.jpg" alt="mi"> -->
    <div class="main-container">
        <div class="container">
            <header id="main-header">
                  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/header.php'?>
                    <h1>
                        <?php 
                            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                            echo "Delete  $invInfo[invMake] $invInfo[invModel]";
                            } 
                            elseif(isset($invMake) && isset($invModel)) { 
                                echo "Delete $invMake $invModel"; 
                            }?>
                    </h1>
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
                <h1><?php if(isset($invInfo['invMake'])){ 
	                echo "Delete $invInfo[invMake] $invInfo[invModel]";} ?></h1>
                <form class="login-form" action="/phpmotors/vehicles/index.php" method="post">
                    <h1>Delete Vehicle</h1>
                    <p>Confirm Vehicle Deletion. The delete is permanent.</p>                    
                    <div class="grid-container">
                        <div class="grid-1">
                        
                            <label>
                                Make:
                                <input type="text" name="invMake" id="invMake" readonly <?php
                                if(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                            </label>
                            <label>
                                Model:
                                <input type="text" name="invModel" id="invModel" readonly <?php
                                if(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                            </label>
                            <label>
                                Description:
                                <textarea name="invDescription" id="invDescription" readonly>
                                    <?php
                                        if(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }
                                    ?>
                                </textarea>
                            </label>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Delete Vehicle">
                    <input type="hidden" name="action" value="deleteVehicle">
                    <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])){
                        echo $invInfo['invId'];} ?>"/>
                </form>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>
</body>
</html>