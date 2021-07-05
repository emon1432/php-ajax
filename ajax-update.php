<?php
$roll = $_POST["id"];
$name = $_POST["name"];
$conn = mysqli_connect("localhost", "root", "", "phpajax") or die("Connection Failed!!!");
$sql = "UPDATE students SET Name = '{$name}' WHERE Roll ={$roll}";
if(mysqli_query($conn,$sql)){
    echo 1;
}
else{
    echo 0;
}
?>
