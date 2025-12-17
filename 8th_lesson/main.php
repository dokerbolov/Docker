<?php

    function writeLog($command, $message = "") {
        $file_name = "/Users/dokerbolov/Desktop/Docker/8th_lesson/log.txt";
        $text = "Command: $command, message: $message \n";
        if(file_exists($file_name)) {
            file_put_contents($file_name, $text, FILE_APPEND);
        } else {
            file_put_contents($file_name, $text);
        }
    }

    $bool = true;

    while($bool) {
        echo getcwd() . ": ";
        $command = trim(fgets(STDIN));

        switch ($command) {
            case str_contains($command, "cd"):
                $new_command = str_replace("cd ", "", $command);
                chdir($new_command);
                writeLog($command, $new_command);
                break;
            case "pwd":
                echo getcwd() . "\n";
                writeLog($command);
                break;
            case "ls":
                print_r(scandir(getcwd()));
                writeLog($command);
                break;
            case str_contains($command, "crfile"):
                $file_name = str_replace("crfile ", "", $command);
                file_put_contents($file_name, "");
                writeLog($command);
                break;
            case str_contains($command, "addtext"):
                $file_name = str_replace("addtext ", "", $command);
                $text = trim(fgets(STDIN));
                if(file_exists($file_name)) {
                    file_put_contents($file_name, $text, FILE_APPEND);
                } else {
                    file_put_contents($file_name, $text);
                }
                writeLog($command, $text);
                break;
            case str_contains($command, "fileread"):
                $file_name = str_replace("fileread ", "", $command);
                echo file_get_contents($file_name) . "\n";
                writeLog($command);
                break;
            case str_contains($command, "deletefile"):
                $file_name = str_replace("deletefile ", "", $command);
                if(file_exists($file_name)) {
                    unlink($file_name);
                    echo "Successfully deleted";
                    writeLog($command, "Successfully deleted");
                } else {
                    echo "File doesn't exist";
                    writeLog($command, "File doesn't exist");
                }
                break;
            case str_contains($command, "chfiledir"):
                $file_name = str_replace("chfiledir ", "", $command);
                $content = file_get_contents($file_name);
                echo "Choose new directory: ";
                $directory = trim(fgets(STDIN));
                if(file_exists($file_name)) {
                    unlink($file_name);
                    writeLog($command, "Successfully deleted");
                } else {
                    writeLog($command, "File doesn't exist");
                }
                $scandir = scandir(getcwd());
                $found = false;
                foreach ($scandir as $dir) {
                    if ($dir === $directory) {
                        chdir($directory);
                        $found = true;
                    }
                }
                if($found) {
                    file_put_contents($file_name, $content);
                    writeLog("file directory changed", $file_name . " : " . $content);
                }
                break;
            case "exit":
                $bool = false;
                echo "Terminal ended";
                writeLog($command);
                break;
            default:
                echo "Command doesn't exist";
                writeLog($command);
                break;
        }
    }

?>