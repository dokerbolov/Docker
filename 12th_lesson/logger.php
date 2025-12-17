<?php

class logger
{
    function writeLog($command, $message = "") {
        $file_name = "/Users/dokerbolov/Desktop/Docker/12th_lesson/log.txt";
        $text = "Command: $command, message: $message \n";
        if(file_exists($file_name)) {
            file_put_contents($file_name, $text, FILE_APPEND);
        } else {
            file_put_contents($file_name, $text);
        }
    }
}