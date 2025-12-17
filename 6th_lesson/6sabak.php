<?php
    require_once "Class/Student.php";

    $available_subjects = ['Programming', 'Web Development', 'Algebra'];

    $student = new Student('eldos', '123', 'eldos@docker.academy', '1');
    $teacher = new Teacher('Maksat', '123', 'Maksat@docker.academy', 'Programming', '5');

    $student->getPassword();

//    echo "Login: ";
//    $login = trim(fgets(STDIN));
//    echo "Password: ";
//    $password = trim(fgets(STDIN));
//
//    $student->getPassword();
//
//    $student->login($login, $password);
//
////    $teacher->login();
//
//    $student->checkSchedule();
//
////    $teacher->checkStudentList();
//
//    $student->registerToSubjects($available_subjects, $teacher);
//    $student->checkSchedule();
//    $student->exit();
//
////    $teacher->checkStudentList();
////    $teacher->exit();

?>