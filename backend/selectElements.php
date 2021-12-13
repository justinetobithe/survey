<?php

require '../config/config.php';

$survey_id = $_POST['survey_id'];
$data = array();
if (count($survey_id) > 0) {

    $result = $conn->query("SELECT * FROM `element` WHERE survey_id = '$survey_id' ORDER BY position ASC");
    $counter = 0;
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $data[$counter] = array(
                "access" => $row['access'],
                "classname" => $row['classname'],
                "label" => $row['label'],
                "name" => $row['inputName'],
                "type" => $row['inputType'],
                "position" => $row['position'],
                "value" => $row['element_value'],
                "element" => $row['element']
            );
            $counter++;
        }
    }
    echo json_encode($data);
    // echo $data;
}
