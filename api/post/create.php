<?php
    // required headers
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json");
    header("Access-Control-Allow-Methods: POST");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type,Access-Control-Allow-Methods, Authorization, X-Requested-with");
    
    // database connection will be here
    include_once '../../config/Database.php';
    include_once '../../models/Post.php';

    // Instantiate DB & connect
    $database = new Database();
    $db = $database->getConnection();

    // Instantiate exam object
    $exam = new Exam($db);

    // Get raw categoryed data
    $data = json_decode(file_get_contents("php://input"));

    $exam->title = $data->title;
    $exam->course_title = $data->course_title;
    $exam->class = $data->class;
    $exam->course_code = $data->course_code;
    $exam->course_units = $data->course_units;
    $exam->time_allowed = $data->time_allowed;
    $exam->instruction = $data->instruction;
    $exam->question_one = $data->question_one;
    $exam->question_two = $data->question_two;
    $exam->question_three = $data->question_three;
    $exam->question_four = $data->question_four;
    $exam->question_five = $data->question_five;

    // Create category
    if($exam->create()){
        echo json_encode(
            array('message' => 'Exam Created')
        );
    } else {
        echo json_encode(
            array('message' => 'Exam Not Created')
        );
    }