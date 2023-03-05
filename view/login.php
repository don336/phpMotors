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
    <title>PHP Motors</title>
</head>
<body>
    <!-- <img src="./images/site/checkerboard.jpg" alt="mi"> -->
    <div class="main-container">
        <div class="container">
            <header id="main-header">
                  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/header.php'?>
                   <h1 class="black">
                        Welcome
                        <?php
                        if(isset($_SESSION['loggedin'])){
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
                    if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                    }
                ?>
                <form class="login-form" method="post" action="/phpmotors/accounts/">
                    <label>
                        <label for="email">Email</label>
                        <input type="email" name="clientEmail" placeholder="Email" <?php 
                        $clientEmail = '';
                        if(isset($clientEmail)){echo "value='$clientEmail'";}?> required>
                    </label>
                    <label>
                        <label for="password">Password</label>
                         <span class="pwd">Password should have at least 8 characters and has at least 1 uppercase character, 1 number and 1 special character</span>
                        <label for="password">Password:</label>
                        <input type="password" name="clientPassword" placeholder="Password" required pattern="(?=^.{8,}$)(?=.*\d)(?=.*\W+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" requirerd> 
                    </label>

                    
                    <input type="submit" value="Sign In" class="signbtn">


                    <input type="hidden" name="action" value="Login">


                    <p>Don't have an Account <a href="/phpmotors/accounts/index.php?action=Registration">Sign Up</a></p>
                </form>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpMotors/common/footer.php'?>
            </footer>
        </div>
    </div>

</body>
</html>