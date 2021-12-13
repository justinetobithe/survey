<?php

require '../config/config.php';

if ($_POST['type'] === 'all') {
    $data = array();
    $counter = 0;
    $result = $conn->query("SELECT * FROM survey");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $data[$counter] = array(
                "survey_id" => $row['id'],
                "survey_title" => $row['survey_title'],
                "survey_description" => $row['survey_description']
            );

            $counter++;
        }
    }
    // if($result)
    echo json_encode($data);
}

if ($_POST['type'] === 'getByID') {

    $data;
    $counter = 0;

    $survey_id = $_POST['id'];

    $result = $conn->query("SELECT * FROM survey WHERE id = '$survey_id'");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {

            $data = array(
                "survey_id" => $row['id'],
                "url_key" => $row['url_key'],
                "survey_title" => $row['survey_title'],
                "survey_description" => $row['survey_description'],
                "created_at" => $row['created_at'],
                "updated_at" => $row['updated_at']
            );

            $counter++;
        }
    }
    // if($result)
    echo json_encode($data);
}
