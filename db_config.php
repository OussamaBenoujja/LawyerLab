

<?php

    $username = 'osama';
    $password = 'osama1310';
    $host = 'localhost';
    $db = 'laywerLab';

    $con = new mysqli($host, $username, $password, $db);

    if($con->connect_error){
        echo "connection to the database failed";
    }


    


?>