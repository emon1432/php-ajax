<?php
$student_id = $_POST["id"];
$conn = mysqli_connect("localhost", "root", "", "phpajax") or die("Connection Failed!!!");
$sql = "SELECT * FROM students WHERE Roll = {$student_id}";
$result = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($result) > 0) {

    while ($row = mysqli_fetch_assoc($result)) {


        $output .= "<tr>
                        <td>Roll</td>
                        <input type='hidden' id='edit-id' value='{$row["Roll"]}'>
                        <td><b >{$row["Roll"]}</b></td>
                    </tr>
                    <tr>
                        <td>Name</td>
                        <td><input type='text' id='edit-name' value='{$row["Name"]}'></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type='submit' id='edit-submit'></td>
                    </tr>";
    }
    mysqli_close($conn);
    echo $output;
} else {
    echo "No Record Found!!!";
}
