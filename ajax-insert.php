<?php
$roll = $_POST["Roll"];
$name = $_POST["Name"];

$conn = mysqli_connect("localhost", "root", "", "phpajax") or die("Connection Failed!!!");
$sql = "INSERT INTO students(Roll, Name) VALUES ('{$roll}','{$name}')";
// $result = mysqli_query($conn, $sql) or die("Query Failed!!!");
if (mysqli_query($conn, $sql)) {
    echo 1;
} else {
    echo 0;
}
?>
