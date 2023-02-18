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
                    <h1>Add Classification</h1>
                        <label>
                            Classification:
                            <input type="text" name="classificationName" placeholder="Classification Name" required>
                        </label>
                    <input type="submit" value="Add Classification" class="regbtn cntBtn">
                    <input type="hidden" name="action" value="classification">
                </form>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>

</body>
</html>