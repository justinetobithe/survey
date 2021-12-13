<?php

require '../config/config.php';

$errCounter = 0;

$iframe = $_POST['iframe'];
$url_key = $_POST['url_key'];

if (strlen($iframe) === 0) {
    $errCounter++;
}

if (strlen($url_key) === 0) {
    $errCounter++;
}

if ($errCounter > 0) {
    echo 0;
} else if ($errCounter === 0) {

    $result = $conn->query("update form set content = '$iframe', updated_at = CURRENT_DATE() where url_key = '$url_key'");

    if (!$result) {
        echo 1;
    } else {
        echo 2;
    }
}
