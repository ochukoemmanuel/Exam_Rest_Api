<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
include_once '../../config/Database.php';
include_once '../../models/Post.php';

// Instantiate DB & connect
$database = new Database();
$db = $database->getConnection();

// Instantiate question object
$exam = new Exam($db);

// Get question 
$result = $exam->read();
// Get row count
$num = $result->rowCount();

// Check if more than 0 record found
if($num > 0) {
    // products array
    $exam_arr = array();
    $exam_arr['exam'] = array();

    while($row = $result->fetch(PDO::FETCH_ASSOC)){
        extract($row);

        $exam_item = array(
            'question_id' => $question_id,
            'title' => $title,
            'course_title' => $course_title,
            'class' => $class,
            'course_code' => $course_code,
            'course_units' => $course_units,
            'time_allowed' => $time_allowed,
            'instruction' => $instruction,
            'question_one' => html_entity_decode($question_one),
            'question_two' => html_entity_decode($question_two),
            'question_three' => html_entity_decode($question_three),
            'question_four' => html_entity_decode($question_four),
            'question_five' => html_entity_decode($question_five),
        );

        // Push to "data"
        array_push($exam_arr['exam'], $exam_item);
}

// show products data in json format
echo json_encode($exam_arr);

} else {
    // No question
    echo json_encode(
        array('message' => 'No question Found')
    );
}