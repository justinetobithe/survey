<?php

require '../config/config.php';

$element_type = $_POST['type'];
$survey_id = $_POST['survey_id'];

$errCounter = 0;
if ($element_type === "text") {
    //element attr
    //variable for passing into element
    $access = $_POST['access'];
    $className = $_POST['className'];
    $label = $_POST['label'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $value = $_POST['value'];
    $element = "input";
    //
    //variable for passing into element values
    $required = $_POST['required'];
    $subtype = $_POST['subtype'];
    $description = $_POST['description'];
    $maxlength = $_POST['maxlength'];
    $placeholder = $_POST['placeholder'];
    //
    //insert to element table
    $result_text_field = $conn->query("INSERT INTO element
        (survey_id, access, classname,
        label, inputName, inputType,
        position, element_value, element)
        VALUES ('$survey_id', $access, '$className',
        '$label', '$name', '$element_type',
        $position, '$value', '$element')");

    if (!$result_text_field) {
        $errCounter++;
    } else {
        $result_text_field_select = $conn->query("SELECT id FROM element WHERE position = '$position' and survey_id = '$survey_id'");
        if ($result_text_field_select->num_rows > 0) {
            $fetched_id;
            while ($row = $result_text_field_select->fetch_assoc()) {
                $fetched_id = $row['id'];
            }
            $result_add_element_values = $conn->query("INSERT INTO elementvalues 
                (element_id, input_required, sub_type,
                input_description, max_length,
                input_placeholder) VALUES
                ('$fetched_id', $access, '$subtype', '$description', $required, 
                '$placeholder')");

            if (!$result_add_element_values) {
                $errCounter++;
            }
        }
    }
} else if ($element_type === "number") {
    //variable for passing into element
    $access = $_POST['access'];
    $className = $_POST['className'];
    $label = $_POST['label'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $value = $_POST['value'];
    $element = "input";
    //
    //variable for passing into element values
    $required = $_POST['required'];
    $placeholder = $_POST['placeholder'];
    $description = $_POST['description'];
    $max = $_POST['max'];
    $min = $_POST['min'];
    $step = $_POST['step'];
    //
    //insert to element table
    $result_number = $conn->query("INSERT INTO element
   (survey_id, access, classname,
   label, inputName, inputType,
   position, element_value, element)
   VALUES ('$survey_id', $access, '$className',
   '$label', '$name', '$element_type',
   $position, '$value', '$element')");

    if (!$result_number) {
        $errCounter++;
    } else {
        $result_number_select = $conn->query("SELECT id FROM element WHERE position = '$position' and survey_id = '$survey_id'");
        if ($result_number_select->num_rows > 0) {
            $fetched_id;
            while ($row = $result_number_select->fetch_assoc()) {
                $fetched_id = $row['id'];
            }
            $result_add_element_values = $conn->query("INSERT INTO elementvalues 
                (element_id, input_required, input_placeholder,
                input_description, input_max, input_min, input_step) VALUES
                ('$fetched_id', $required, '$placeholder', '$description',
                $max, $min, $step)");

            if (!$result_add_element_values) {
                $errCounter++;
            }
        }
    }
} else if ($element_type === "button") {
    //variable for passing into element
    $access = $_POST['access'];
    $className = $_POST['className'];
    $label = $_POST['label'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $value = $_POST['value'];
    $element = "input";
    //
    //variable for passing into element values
    $style = $_POST['style'];
    $subtype = $_POST['subtype'];
    //
    //insert to db
    //insert to element table
    $result_button = $conn->query("INSERT INTO element
    (survey_id, access, classname,
    label, inputName, inputType,
    position, element_value, element)
    VALUES ('$survey_id', $access, '$className',
    '$label', '$name', '$element_type',
    $position, '$value', '$element')");

    if (!$result_button) {
        $errCounter++;
    } else {
        $result_button_select = $conn->query("SELECT id FROM element WHERE position = '$position' and survey_id = '$survey_id'");
        if ($result_button_select->num_rows > 0) {
            $fetched_id;
            while ($row = $result_button_select->fetch_assoc()) {
                $fetched_id = $row['id'];
            }
            $result_add_element_values = $conn->query("INSERT INTO elementvalues 
                (element_id, style, sub_type) VALUES
                ('$fetched_id', '$style', '$subtype')");

            if (!$result_add_element_values) {
                $errCounter++;
            }
        }
    }
    // echo "hello button" . $position;
} else if ($element_type === "file") {
    //variable for passing into element
    $access = $_POST['access'];
    $className = $_POST['className'];
    $label = $_POST['label'];
    $name = $_POST['name'];
    $position = $_POST['position'];
    $element = "input";
    //
    //variable for passing into element values
    $required = $_POST['required'];
    $subtype = $_POST['subtype'];
    $description = $_POST['description'];
    $placeholder = $_POST['placeholder'];
    $multiple = $_POST['multiple'];
    //
    //insert to db
    //insert to db
    //insert to element table
    $result_file = $conn->query("INSERT INTO element
    (survey_id, access, classname,
    label, inputName, inputType,
    position, element)
    VALUES ('$survey_id', $access, '$className',
    '$label', '$name', '$element_type',
    $position, '$element')");

    if (!$result_file) {
        $errCounter++;
    } else {
        $result_file_select = $conn->query("SELECT id FROM element WHERE position = '$position' and survey_id = '$survey_id'");
        if ($result_file_select->num_rows > 0) {
            $fetched_id;
            while ($row = $result_file_select->fetch_assoc()) {
                $fetched_id = $row['id'];
            }
            $result_add_element_values = $conn->query("INSERT INTO elementvalues 
                (element_id, input_required, sub_type,
                input_description, input_placeholder, multiple) VALUES
                ('$fetched_id', $required, '$subtype',
                '$description', '$placeholder', $multiple)");

            if (!$result_add_element_values) {
                $errCounter++;
            }
        }
    }
}

if ($errCounter === 0) {
    echo "success";
} else {
    echo "error";
}
