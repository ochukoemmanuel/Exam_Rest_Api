<?php
    class Exam {
        // DB stuff
        private $conn;
        private $table = "exam";

        // Exam Properties
        public $question_id;
        public $title;
        public $course_title;
        public $class;
        public $course_code;
        public $course_units;
        public $time_allowed;
        public $instruction;
        public $question_one;
        public $question_two;
        public $question_three;
        public $question_four;
        public $question_five;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get Posts
        public function read() {
            // Create query
            $query = "SELECT 
                question_id,
                title, 
                course_title, 
                class, 
                course_code,  
                course_units, time_allowed, instruction, question_one, question_two,
                question_three, question_four, question_five
            FROM
                " . $this->table . " 
            ORDER BY
            question_id DESC";

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Execute query
        $stmt->execute();

        return $stmt;

        }

        // Get Single Post
        public function read_single() {
            // Create query
            $query = "SELECT 
                question_id,
                title, 
                course_title, 
                class, 
                course_code,  
                course_units, time_allowed, instruction, question_one, question_two,
                question_three, question_four, question_five
            FROM
                " . $this->table . " 
            ORDER BY
                title DESC
            WHERE
            question_id = ?
            LIMIT 0,1";

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            //Bind ID
            $stmt->bindParam(1, $this->question_id);

            // Execute query
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            // Set properties
            $this->question_id = $row['question_id']; 
            $this->title = $row['title']; 
            $this->course_title = $row['course_title'];
            $this->class = $row['class']; 
            $this->course_code = $row['course_code']; 
            $this->course_units = $row['course_units'];
            $this->time_allowed = $row['time_allowed'];
            $this->instruction = $row['instruction'];
            $this->question_one = $row['question_one'];
            $this->question_two = $row['question_two'];
            $this->question_three = $row['question_three'];
            $this->question_four = $row['question_four'];
            $this->question_five = $row['question_five'];

            }

            // Create Post
            public function create() {
                // Create query
                $query = 'INSERT INTO ' .
                        $this->table . '
                    SET
                    title = :title,
                    course_title = :course_title,
                    class = :class,
                    course_code = :course_code,
                    course_units = :course_units,
                    time_allowed = :time_allowed,
                    instruction = :instruction, 
                    question_one = :question_one, 
                    question_two = :question_two,
                    question_three = :question_three, 
                    question_four = :question_four, 
                    question_five = :question_five';

                    // Prepare Statement
                    $stmt = $this->conn->prepare($query);

                    // Clean data
                    $this->title = htmlspecialchars(strip_tags($this->title));
                    $this->course_title = htmlspecialchars(strip_tags($this->course_title));
                    $this->class = htmlspecialchars(strip_tags($this->class));
                    $this->course_code = htmlspecialchars(strip_tags($this->course_code));
                    $this->course_units = htmlspecialchars(strip_tags($this->course_units));
                    $this->time_allowed = htmlspecialchars(strip_tags($this->time_allowed));
                    $this->instruction = htmlspecialchars(strip_tags($this->instruction));
                    $this->question_one = htmlspecialchars(strip_tags($this->question_one));
                    $this->question_two = htmlspecialchars(strip_tags($this->question_two));
                    $this->question_three = htmlspecialchars(strip_tags($this->question_three));
                    $this->question_four = htmlspecialchars(strip_tags($this->question_four));
                    $this->question_five = htmlspecialchars(strip_tags($this->question_five));

                    // Bind data
                    $stmt->bindParam(':title', $this->title);
                    $stmt->bindParam(':course_title', $this->course_title);
                    $stmt->bindParam(':class', $this->class);
                    $stmt->bindParam(':course_code', $this->course_code);
                    $stmt->bindParam(':course_units', $this->course_units);
                    $stmt->bindParam(':time_allowed', $this->time_allowed);
                    $stmt->bindParam(':instruction', $this->instruction);
                    $stmt->bindParam(':question_one', $this->question_one);
                    $stmt->bindParam(':question_two', $this->question_two);
                    $stmt->bindParam(':question_three', $this->question_three);
                    $stmt->bindParam(':question_four', $this->question_four);
                    $stmt->bindParam(':question_five', $this->question_five);

                    // Execute query
                    if($stmt->execute()) {
                        return true;
                    }

                    // Print error if something goes wrong
                    printf("Error: %s. \n", $stmt->error);

                    return false;

            }

            // Update Post
            public function update() {
                // Create query
                $query = 'UPDATE ' .
                        $this->table . '
                    SET
                    title = :title, 
                    course_title = :course_title, 
                    class = :class, 
                    course_code = :course_code,  
                    course_units = :course_units, 
                    time_allowed = :time_allowed, 
                    instruction = :instruction,
                    question_one = :question_one, 
                    question_two = :question_two,
                    question_three = :question_three, 
                    question_four = :question_four, 
                    question_five = :question_five
                        WHERE question_id = :question_id';

                    // Prepare Statement
                    $stmt = $this->conn->prepare($query);

                    // Clean data
                    $this->question_id = htmlspecialchars(strip_tags($this->question_id));
                    $this->title = htmlspecialchars(strip_tags($this->title));
                    $this->course_title = htmlspecialchars(strip_tags($this->course_title));
                    $this->class = htmlspecialchars(strip_tags($this->class));
                    $this->course_code = htmlspecialchars(strip_tags($this->course_code));
                    $this->course_units = htmlspecialchars(strip_tags($this->course_units));
                    $this->time_allowed = htmlspecialchars(strip_tags($this->time_allowed));
                    $this->instruction = htmlspecialchars(strip_tags($this->instruction));
                    $this->question_one = htmlspecialchars(strip_tags($this->question_one));
                    $this->question_two = htmlspecialchars(strip_tags($this->question_two));
                    $this->question_three = htmlspecialchars(strip_tags($this->question_three));
                    $this->question_four = htmlspecialchars(strip_tags($this->question_four));
                    $this->question_five = htmlspecialchars(strip_tags($this->question_five));

                    // Bind data
                    $stmt->bindParam(':question_id', $this->question_id);
                    $stmt->bindParam(':title', $this->title);
                    $stmt->bindParam(':course_title', $this->course_title);
                    $stmt->bindParam(':class', $this->class);
                    $stmt->bindParam(':course_code', $this->course_code);
                    $stmt->bindParam(':course_units', $this->course_units);
                    $stmt->bindParam(':time_allowed', $this->time_allowed);
                    $stmt->bindParam(':instruction', $this->instruction);
                    $stmt->bindParam(':question_one', $this->question_one);
                    $stmt->bindParam(':question_two', $this->question_two);
                    $stmt->bindParam(':question_three', $this->question_three);
                    $stmt->bindParam(':question_four', $this->question_four);
                    $stmt->bindParam(':question_five', $this->question_five);

                    // Execute query
                    if($stmt->execute()) {
                        return true;
                    }

                    // Print error if something goes wrong
                    printf("Error: %s. \n", $stmt->error);

                    return false;

            }

            // Delete Post
            public function delete() {
                // Create query
                $query = 'DELETE FROM ' . $this->table . ' WHERE question_id = :question_id';

                // Prepare statement
                $stmt = $this->conn->prepare($query);

                // Clean data
                $this->question_id = htmlspecialchars(strip_tags($this->question_id));

                // Bind data
                $stmt->bindParam(':question_id', $this->question_id);

                // Execute query
                if($stmt->execute()) {
                    return true;
                }

                // Print error if something goes worng
                printf("Error: %s. \n", $stmt->error);

                return false;
            }
    }