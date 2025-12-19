<?php
session_start();
include_once "mysqlConnector.php";
$database = new mysqlConnector();

$id = $_POST['id'];

$sql = "DELETE FROM students WHERE id = $id";
return $database->execute($sql);