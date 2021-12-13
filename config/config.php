<?php

    $servername="localhost";
    $dbName="survey_app";
    $username="root";
    $password="";

    $conn = new mysqli($servername, $username, $password, $dbName);
    if($conn->connect_error){
        die("Connection error: ". $conn->connect_error);
    }else{
        session_start();
    }