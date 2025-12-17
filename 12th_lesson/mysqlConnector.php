<?php

include_once 'logger.php';

class mysqlConnector
{
    public mysqli $conn;

    public function __construct()
    {
        $logger = new logger();
        $servername = "localhost:8889"; // сервер (егер жергілікті болса: localhost)
        $username = "root";        // MySQL қолданушы аты
        $password = "root";            // пароль (xampp/wamp-та бос болады)
        $dbname = "university";        // база атауы

        $this->conn = new mysqli($servername, $username, $password, $dbname);

        if ($this->conn->connect_error) {
            $logger->writeLog("Қосыла алмады: ", $this->conn->connect_error);
        }

        $logger->writeLog("Сәтті қосылды");
    }

    public function __destruct()
    {
        $this->conn->close();
    }

    public function execute($sql) {
        return $this->conn->query($sql);
    }
}