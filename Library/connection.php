<?php

function phpmotorsConnect(){
    $server = 'localhost';
    $dbname = 'phpmotors';
    $username = 'IClient';
    $password = '[_hlJY!unQ8eBMHE';
    $dsn = "mysql:host=$server;dbname=$dbname";
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

    try{
        $link = new PDO($dsn, $username, $password, $options);
        return $link;
    } catch(PDOException $e){
        // echo "It didn't work, error:" .     $e->getMessage();
        header('location: /phpMotors/view/500.php');
        exit;
    }
}
// phpmotorsConnect();