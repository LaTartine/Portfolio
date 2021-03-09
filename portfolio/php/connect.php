<?php

    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");

    $username = "******";
    $password = "*********";

    if($_POST["username"] == $username && $_POST["password"] == $password)
    {
        echo http_response_code(201);
    }
    else{
        print_r($_POST["username"]);
        print_r($_POST["password"]);
        echo http_response_code(404);
    }


?>