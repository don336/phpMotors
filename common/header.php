<ul class="head">
    <li>
        <a href="/phpmotors/">
        <img src="/phpmotors/images/site/logo.png" alt="myImage">
        </a>
    </li>
    <li><?php
        if(!isset($_SESSION['loggedin'])){
            echo '<a class="black" href="/phpmotors/accounts/index.php?action=Login">My Account</a>';
        } else {
            echo '<a href="/phpmotors/accounts/index.php?action=Logout" class="black">LogOut</a>';
        }
    ?></li>
</ul>
