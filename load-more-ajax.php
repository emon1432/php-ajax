<?php

$conn = mysqli_connect("localhost", "root", "", "phpajax") or die("Connection Failed!!!");
$limit = 3;
if(isset($_POST['page_no'])){
    $page = $_POST['page_no'];
}else{
    $page = 0;
}
// $sql = "SELECT * FROM students ORDER BY Roll ASC";
$sql = "SELECT * FROM students ORDER BY Roll ASC LIMIT {$page},{$limit}";
$result = mysqli_query($conn, $sql) or die("query Failed!!!");
$output = "";
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $last_id = $row["Roll"];
        $output .= "<tr align='center'>
                        <td>{$row["Roll"]}</td>
                        <td>{$row["Name"]}</td>
                        <td><button class='edit-btn' data-eid='{$row["Roll"]}'>Edit</button></td>
                        <td><button id='delete-btn' data-id='{$row["Roll"]}'>Delete</button></td>
                    </tr>";
    }
   $output .= "<tr id='load-more-pagination'>
                    <td colspan='4'>
                        <button id='ajaxbtn' data-id='{$last_id}'>Load More</button>
                    </td>
                </tr>";
    $output .= '</table>';
    echo $output;
} else {
    echo "";
}
