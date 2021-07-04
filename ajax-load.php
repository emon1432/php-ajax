<?php

$conn = mysqli_connect("localhost","root","","phpajax") or die("Connection Failed!!!");
$sql = "SELECT * FROM students ORDER BY Roll ASC";
$result = mysqli_query($conn,$sql);
$output = "";
if(mysqli_num_rows($result)>0){
    $output = '<table border="1" width="50%" align="center" cellspacing="0" cellpadding="10px">
                <tr style="background:green;">
                    <th>Roll</th>
                    <th>Name</th>
                </tr>';
    while($row = mysqli_fetch_assoc($result)){
        $output .= "<tr align='center'>
                        <td>{$row["Roll"]}</td>
                        <td>{$row["Name"]}</td>
                    </tr>";
    }
    $output .= '</table>'; 
    mysqli_close($conn);
    echo $output;
}else{
    echo "No Record Found!!!";
}
?>