<!DOCTYPE html>
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
    <title>PHP Motors</title>
</head>
<body>
    <!-- <img src="./images/site/checkerboard.jpg" alt="mi"> -->
    <div class="main-container">
        <div class="container">
            <header id="main-header">
                  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/header.php'?>
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
                            <input type="text" name="invMake" placeholder="Inv Make" required>
                        </label>
                        <label>
                            Model:
                            <input type="text" name="invModel" placeholder="Inv Model" required>
                        </label>
                        <label>
                            Description:
                            <textarea name="invDescription" cols="30" rows="5" required></textarea>
                        </label>
                        <label>
                           Image Path:
                           <input type="text" name="invImage" placeholder="Inv Image" required>
                       </label>
                        </div>
                        <div class="grid-2">
                            <label>
                               ThumbNail:
                               <input type="text" name="invThumbnail" placeholder="Inv ThumbNail" required>
                           </label>
                            <label>
                               Price:
                               <input type="number" name="invPrice" placeholder="InvPrice" required>
                           </label>
                            <label>
                               Stock:
                               <input type="number" name="invStock" placeholder="Inv Stock" required>
                           </label>
                            <label>
                               Color:
                               <input type="text" name="invColor" placeholder="Inv Color" required>
                           </label>
                        </div>
                    </div>
                    <input type="submit" value="AddVehicle" class="regbtn cntBtn">
                    <input type="hidden" name="action" value="vehicle">
                </form>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>
</body>
</html>