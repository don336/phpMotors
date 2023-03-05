<?php
    $dropDown = '<select name="classificationId" class="drop-down" id="classification">';
    foreach($classifications as $classification) {
        $dropDown .= "<option value='$classification[classificationId]'";
            if(isset($classificationId)){
                if($classification['classificationId'] === $classificationId){
                    $dropDown .= ' selected ';
                    
                }
            }elseif(isset($invInfo['classificationId'])){
                if($classification['classificationId'] === $invInfo['classificationId']){
                $dropDown .= ' selected ';
                }
            }
        $dropDown .= ">$classification[classificationName]</option>";
    }
    $dropDown .= '</select>';
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
    <title>
        <?php 
            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
		        echo "Modify $invInfo[invMake] $invInfo[invModel]";
            } 
	        elseif(isset($invMake) && isset($invModel)) { 
		        echo "Modify $invMake $invModel";
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
                    <h1>
                        <?php 
                            if(isset($invInfo['invMake']) && isset($invInfo['invModel'])){ 
                            echo "Modify $invInfo[invMake] $invInfo[invModel]";
                            } 
                            elseif(isset($invMake) && isset($invModel)) { 
                                echo "Modify$invMake $invModel"; 
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
                <?php 
                    if(isset($message)){
                    echo $message;
                    }
                ?>
                
                <form class="login-form" action="/phpmotors/vehicles/index.php" method="post">
                    <h1>Add Vehicle</h1>
                    <p>*Note all Fields are Required</p>
                    <div class="grid-container">
                        <div class="grid-1">
                        <label for="classification">Choose a classification: <?php echo $dropDown?></label>  
                        <label>
                            Make:
                            <input type="text" name="invMake" id="invMake" required <?php if(isset($invMake)){ echo "value='$invMake'"; } elseif(isset($invInfo['invMake'])) {echo "value='$invInfo[invMake]'"; }?>>
                        </label>
                        <label>
                            Model:
                            <input type="text" name="invModel" id="invModel" required <?php if(isset($invModel)){ echo "value='$invModel'"; } elseif(isset($invInfo['invModel'])) {echo "value='$invInfo[invModel]'"; }?>>
                        </label>
                        <label>
                            Description:
                            <textarea name="invDescription" id="invDescription" required>
                            <?php if(isset($invDescription)){ echo $invDescription; } elseif(isset($invInfo['invDescription'])) {echo $invInfo['invDescription']; }?></textarea>
                        </label>
                        <label>
                           Image Path:
                           <input type="text" name="invImage" id="invImage" required <?php if(isset($invImage)){ echo "value='$invImage'"; } elseif(isset($invInfo['invImage'])) {echo "value='$invInfo[invImage]'"; }?>>
                       </label>
                        </div>
                        <div class="grid-2">
                            <label>
                               ThumbNail:
                               <input type="text" name="invThumbnail" id="invThumbnail" required <?php if(isset($invThumbnail)){ echo "value='$invThumbnail'"; } elseif(isset($invInfo['invThumbnail'])) {echo "value='$invInfo[invThumbnail]'"; }?>>
                           </label>
                            <label>
                               Price:
                               <input type="text" name="invPrice" id="invPrice" required <?php if(isset($invPrice)){ echo "value='$invPrice'"; } elseif(isset($invInfo['invPrice'])) {echo "value='$invInfo[invPrice]'"; }?>>
                           </label>
                            <label>
                               Stock:
                               <input type="text" name="invStock" id="invStock" required <?php if(isset($invStock)){ echo "value='$invStock'"; } elseif(isset($invInfo['invStock'])) {echo "value='$invInfo[invStock]'"; }?>>
                           </label>
                            <label>
                               Color:
                               <input type="text" name="invColor" id="invColor" required <?php if(isset($invColor)){ echo "value='$invColor'"; } elseif(isset($invInfo['invColor'])) {echo "value='$invInfo[invColor]'"; }?>>
                           </label>
                        </div>
                    </div>
                    <input type="submit" name="submit" value="Update Vehicle">
                    <input type="hidden" name="action" value="updateVehicle">
                    <input type="hidden" name="invId" value="
                    <?php if(isset($invInfo['invId'])){ echo $invInfo['invId'];} 
                    elseif(isset($invId)){ echo $invId; } ?>"/>
                </form>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>
</body>
</html>