<?php
session_start();
include_once "mysqlConnector.php";
$database = new mysqlConnector();

$name = $_POST['name'];
$age = $_POST['age'];
$group_uni = $_POST['group_uni'];

$sql = "INSERT INTO students(name, group_id, age) VALUES ('$name', $group_uni, $age);";
return $database->execute($sql);