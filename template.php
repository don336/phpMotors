<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/style.css" media="screen">
    <title>PHP Motors</title>
</head>
<body>
    <!-- <img src="./images/site/checkerboard.jpg" alt="mi"> -->
    <div class="main-container">
        <div class="container">
            <header id="main-header">
                  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/dashboard\phpMotors\common\header.php'?>
            </header>
            <nav class="main-nav">
                 <?php require_once $_SERVER['DOCUMENT_ROOT'].'/dashboard\phpMotors\common\navigate.php'?>
            </nav>
            <main id="showcase">
                Content Title Here
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/dashboard\phpMotors\common\footer.php'?>
            </footer>
        </div>
    </div>

</body>
</html>