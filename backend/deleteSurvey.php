<?php

require '../config/config.php';

$survey_id = $_POST['id'];
$errCounter = 0;
if (count($survey_id) > 0) {

    $result = $conn->query("SELECT id FROM `element` WHERE survey_id = '$survey_id'");
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $fetched_id = $row['id'];
            $del_e_values_result = $conn->query("DELETE FROM `elementvalues` WHERE element_id = '$fetched_id'");
            if (!$del_e_values_result) {
                $errCounter++;
            }
        }
    }

    $del_element_result = $conn->query("DELETE FROM `element` WHERE survey_id = '$survey_id'");
    if (!$del_element_result) {
        $errCounter++;
    }

    $del_survey_result = $conn->query("DELETE FROM `survey` WHERE id = '$survey_id'");
    if (!$del_survey_result) {
        $errCounter++;
    }

    if ($errCounter === 0) {
        echo true;
    } else {
        echo false;
    }
}
