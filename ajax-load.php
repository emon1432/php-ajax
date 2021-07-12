<?php

$conn = mysqli_connect("localhost", "root", "", "phpajax") or die("Connection Failed!!!");
$limit_per_page = 3;
$page = "";
if (isset($_POST["page_no"])) {
    $page = $_POST["page_no"];
} else {
    $page = 1;
}

$offset = ($page - 1) * $limit_per_page;

$sql = "SELECT * FROM students ORDER BY Roll ASC LIMIT {$offset},{$limit_per_page}";
$result = mysqli_query($conn, $sql);
$output = "";
if (mysqli_num_rows($result) > 0) {
    $output = '<table border="1" width="50%" align="center" cellspacing="0" cellpadding="10px">
                <tr style="background:green;">
                    <th width="100px">Roll</th>
                    <th>Name</th>
                    <th width="100px">Update</th>
                    <th width="100px">Delete</th>
                </tr>';
    while ($row = mysqli_fetch_assoc($result)) {
        $output .= "<tr align='center'>
                        <td>{$row["Roll"]}</td>
                        <td>{$row["Name"]}</td>
                        <td><button class='edit-btn' data-eid='{$row["Roll"]}'>Edit</button></td>
                        <td><button id='delete-btn' data-id='{$row["Roll"]}'>Delete</button></td>
                    </tr>";
    }
    $output .= '</table>';
    $sql_total = "SELECT * FROM students";
    $result1 = mysqli_query($conn, $sql_total) or die("Query Failed!!!");
    $total_records = mysqli_num_rows($result1);
    $total_pages = ceil($total_records / $limit_per_page);

    $output .= '<div id="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        if($i==$page){
            $class_name = "active";
        }else{
            $class_name = "";
        }
        $output .= "<a class='{$class_name}' id='{$i}' href=''>{$i}</a>";
    }
    $output .= '</div>';
    echo $output;
} else {
    echo "No Record Found!!!";
}
