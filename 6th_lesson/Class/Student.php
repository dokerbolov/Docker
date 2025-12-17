<?php
    require_once "User.php";
    require_once "Teacher.php";

    class Student extends User {
        public $education_year;
        public $avg_mark;
        public $subjects = [];
        public $grade;

        public function __construct($login, $password, $email, $education_year, $avg_mark = 0)
        {
            parent::__construct($login, $password, $email);
            $this->education_year = $education_year;
            $this->avg_mark = $avg_mark;
        }

        public function checkSchedule() {
            if($this->is_auth) {
                echo "You schedule is: \n";
                for($i = 0; $i < count($this->subjects); $i++) {
                    echo $i + 1 . ". " . $this->subjects[$i] . "\n";
                }
            } else {
                echo "Please login to view this action \n";
            }
        }

        public function registerToSubjects($available_subjects, $teacher) {
            if($this->is_auth) {
                echo "Register to subject \n";
                for($i = 0; $i < count($available_subjects); $i++) {
                    echo $i + 1 . ". " . $available_subjects[$i] . "\n";
                }
                echo "\nChoose your subject: ";
                $subject_order = trim(fgets(STDIN));
                $this->subjects[] = $available_subjects[$subject_order - 1];

                if($teacher->subject === $available_subjects[$subject_order -1]) {
                    $teacher->students[] = $this->login;
                }
            } else {
                echo "Please login to view this action \n";
            }
        }
    }
?>