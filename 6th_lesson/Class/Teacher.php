<?php
    class Teacher extends User {
        public $subject;
        public $experience;
        public $students = []; // class Student

        public function __construct($login, $password, $email, $subject, $experience)
        {
            parent::__construct($login, $password, $email);
            $this->subject = $subject;
            $this->experience = $experience;
        }

//        public function setGrade($grade) {
//            foreach ($this->students as $student) {
//                $student->grade = $grade;
//            }
//        }

        public function checkStudentList() {
            echo "You students list: \n";
            for($i = 0; $i < count($this->students); $i++) {
                echo $i + 1 . ". " . $this->students[$i] . "\n";
            }
        }

    }
?>
