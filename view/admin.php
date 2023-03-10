<?php
    // Create/start Session 
    if(!$_SESSION['loggedin']){
        header('Location: /phpmotors/');
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
    <title>PHP Motors</title>
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
                <h1 class="black"><?php echo $_SESSION['clientData']['clientFirstname'];?></h1>
                <p>You are logged in.</p>
                <br>
                <p class="black">
                    <?php 
                    if(isset($message)){
                    echo $message;
                    }
                ?>
                </p>
                <ul>
                    <li>FirstName:<?php echo $_SESSION['clientData']['clientFirstname'];?></li>
                    <li>Email:<?php echo $_SESSION['clientData']['clientEmail'];?></li>
                </ul>
                <br>
                <h2>Account Management</h2>
                <p>Use this link to update account information.</p>
                <a href="/phpmotors/accounts/index.php?action=clientUpdt&clientId=<?php  echo $_SESSION['clientData']['clientId'];?>">Update Account Information</a>
                <br>
                <?php
                    if($_SESSION['clientData']['clientLevel']>1){
                        echo "<h2>Inventory Management</h2>
                        <p>Use this link to manage the inventory</p>";
                        echo '<a href="/phpmotors/vehicles">Vehicle Management</a>';
                    }
                ?>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>

</body>
</html>