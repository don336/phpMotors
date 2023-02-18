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
                <form class="login-form" action="/phpmotors/accounts/index.php" method="post">
                    <label>
                        <label for="fname">FirstName:</label>
                        <input type="text" name="clientFirstname" placeholder="FirstName"
                        required>
                    </label>
                    <label>
                        <label for="lname">LastName:</label>
                        <input type="text" name="clientLastname" placeholder="Last Name" required>
                    </label>
                    <label>
                        <label for="email">Email:</label>
                        <input type="email" name="clientEmail" placeholder="Email" required>
                    </label>
                    <label>
                        <span class="pwd">Password should have at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character</span>
                        <label for="password">Password:</label>
                        <input type="password" name="clientPassword" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"> 
                    </label>
                    <input type="submit" value="Register" class="regbtn">
                    <input type="hidden" name="action" value="register">
                </form>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>

</body>
</html>