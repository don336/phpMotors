<?php
if ($_SESSION['clientData']['clientLevel'] < 2) {
 header('location: /phpmotors/');
 exit;
}

if (isset($_SESSION['message'])) {
 $message = $_SESSION['message'];
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
    <title>PHP Motors</title>
</head>
<body>
    <div class="main-container">
        <div class="container">
            <header id="main-header">
                  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/header.php'?>
                   <h1 class="black">
                        <?php
                            if($_SESSION['loggedin']){
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
                    if($_SESSION['loggedin']){
                        echo "<a href='/phpmotors/vehicles/index.php?action=AddClassification'>Add Classification</a>";
                        echo '<a href="/phpmotors/vehicles/index.php?action=AddVehicle">Add Vehicle</a>';
                    }
                    else{
                        header('Location: /phpmotors');
                    }
                         
                ?>
                <?php
                    if (isset($message)) { 
                        echo $message; 
                    } 
                    if (isset($classificationList)) { 
                        echo '<h2>Vehicles By Classification</h2>'; 
                        echo '<p>Choose a classification to see those vehicles</p>'; 
                        echo $classificationList; 
                    }
                ?>
                <noscript>
                    <p><strong>JavaScript Must Be Enabled to Use this Page.</strong></p>
                </noscript>
                <table id="inventoryDisplay"></table>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>
<script src="../js/inventory.js"></script>
</body>
</html>
<?php unset($_SESSION['message']); ?>