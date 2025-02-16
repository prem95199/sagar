<?php

    $conn = mysqli_connect("localhost:3307", "root", "", "user") or die("connectionfailed");

    if($conn)
    {
        echo "connected ok";
    }
    else
    {
        echo "connection failed";
    }

?>
