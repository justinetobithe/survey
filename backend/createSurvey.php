<?php

require '../config/config.php';

$errCounter = 0;

$title = $_POST['title'];
$description = $_POST['description'];

if (strlen($title) === 0) {
    $errCounter++;
}

if (strlen($description) === 0) {
    $errCounter++;
}

if ($errCounter > 0) {
    echo 0;
} else if ($errCounter === 0) {

    function generateRandomString($length = 10)
    {
        return substr(str_shuffle(str_repeat($x = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length / strlen($x)))), 1, $length);
    }

    $url_key = generateRandomString();

    $result = $conn->query("insert into survey 
        (url_key, survey_title, survey_description, created_at, updated_at) VALUES ('$url_key', '$title', '$description', CURRENT_DATE(), CURRENT_DATE())");

    if (!$result) {
        echo 1;
    } else {
        echo 2;
    }
}
