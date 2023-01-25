<?php

$host = 'localhost'; //Host Name
$dbname = 'signup'; //Database Name
$username = 'root'; //Host User Name
$userpass = ''; //Host User Password

// try - catch block : We will check in the try block and if we get an error in the catch block, we will write the code that will be displayed
try {
    //Create Connection
    $db = new PDO("mysql:host=$host;dbname=$dbname; charset-utf8;", $username, $userpass, [
        //PDO::ATTR_ERRMODE : It allows us to see the errors. Error handler.
        //PDO::ERRMODE_EXCEPTION : It allows us to catch errors. Error catcher.
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $parameter) {
    echo $parameter->getMessage();
    exit;
}

?>
