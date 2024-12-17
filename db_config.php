

<?php

    $username = 'root';
    $password = 'osama';
    $host = 'localhost';
    $db = 'lwbase';

    $con = new mysqli($host, $username, $password, $db);

    if($con->connect_error){
        echo "connection to the database failed";
    }





?>