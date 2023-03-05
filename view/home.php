<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/style.css" media="screen">
    <link rel="stylesheet" href="./css/mobile.css" media="screen">
    <title>PHP Motors</title>
</head>
<body>
    <!-- <img src="./images/site/checkerboard.jpg" alt="mi"> -->
    <div class="main-container">
        <div class="container">
            <header id="main-header" class="black" >
                  <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/header.php'?>
                    <?php
                        if(isset($_SESSION['loggedin'])){
                            $welmsg;
                        }
                    ?>
            </header>
            <nav class="main-nav">
                  <?php echo $navList?>
            </nav>
            <main id="showcase">
                <section class="advert">
                    <h1 class="black">Welcome to PHP Motors!</h1>
                    <div class="car-details">
                            <h2>DMC Delorean</h2>
                            <p>3 Cyp holders</p>
                            <p>Superman doors</p>
                            <p class="mg-btm">Fuzzy dice!</p>
                            <a href="#" class="btn">Own Today</a>
                    </div>
                </section>
                <section class="upgrades">
                    <div class="Deloreanupgrade">
                        <h1>Delorean Upgrade</h1>
                        <div class="box1">
                            <div class="image-wrapper">
                                <img src="./images/upgrades/flux-cap.png" alt="car_upgrade">
                            </div>
                            <p><a href="#">Flux_Capacitor</a></p>
                        </div>
          
                        <div class="box2">
                            <div class="image-wrapper">
                                <img src="./images/upgrades/flame.jpg" alt="car_upgrade">
                            </div>
                            <p><a href="#">Flame_Decals</a></p>
                        </div>
                
                        <div class="box3">
                            <div class="image-wrapper">

                                <img src="./images/upgrades/bumper_sticker.jpg" alt="car_upgrade">
                            </div>
                            <p><a href="#">bumper_sticker</a></p>
                        </div>
                 
                        <div class="box4">
                            <div class="image-wrapper">
                                <img src="./images/upgrades/hub-cap.jpg" alt="car_upgrade">
                            </div>
                            <p><a href="#">Hub_Caps</a></p>
                        </div>
                    </div>
                    <div class="review">
                        <h1>DMC Delorean Reviews</h1>
                        <ul>
                            <li>"So fast its almost like traveling in time."(4/5)</li>
                            <li>"Coolest ride on the road"(4/5)</li>
                            <li>"I'm feeling Marty McFly."(5/5)</li>
                            <li>"The most futuristic ride of our day."(4.5/5)</li>
                            <li>"80's livin and I love it."(4/5)</li>
                        </ul>
                    </div>
                </section>
            </main>
            <footer id="main-footer">
                <?php require_once $_SERVER['DOCUMENT_ROOT'].'/phpmotors/common/footer.php'?>
            </footer>
        </div>
    </div>

</body>
</html>
