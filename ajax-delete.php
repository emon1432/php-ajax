<?php


$roll = $_POST["roll"];
$conn = mysqli_connect("localhost", "root", "", "phpajax") or die("Connection Failed!!!");
$sql = "DELETE FROM students WHERE Roll = {$roll}";
if(mysqli_query($conn,$sql)){
    echo 1;
}
else{
    echo 0;
}
?>
