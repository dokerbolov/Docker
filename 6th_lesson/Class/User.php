<?php
    class User {
        public $login;
        public $password;
        public $email;
        public $is_auth = false; // boolean

        public function __construct($login, $password, $email) {
            $this->login = $login;
            $this->password = md5($password); // Хэширование/Шифрование
            $this->email = $email;
        }

        public function login($login, $password) {
            if($login === $this->login && md5($password) === $this->password) {
                echo "You are successfully logged in by $login \n";
                $this->is_auth = true;
            } else {
                echo "Your credentials seems wrong. Try again \n";
            }
        }

        public function getPassword() {
            echo $this->password;
        }

        public function exit() {
            echo "You are successfully exited \n";
            $this->is_auth = false;
        }
    }
?>
