<?php
include 'dbconnect.php';
$output ="";
if(isset($_POST['query'])){
    $search = $_POST['query'];
    $stmt = $connection->prepare("SELECT * FROM live_search where first_name LIKE CONCAT('%',?,'%') OR last_name LIKE CONCAT('%',?,'%')");
    $stmt->bind_param("ss",$search,$search);
}
else{
    $stmt = $connection->prepare("SELECT * FROM live_search");
}
$stmt->execute();
$result = $stmt->get_result();
if($result->num_rows>0){
    $output ="<thead>
                <tr>
                    <th>#</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Gender</th>
                </tr>
            </thead>
            <tbody>" ;
  while($row = $result->fetch_assoc()){
      $output .="<tr>
                    <td>".$row['id']."</td>
                    <td>".$row['first_name']."</td>
                    <td>".$row['last_name']."</td>
                    <td>".$row['email']."</td>
                    <td>".$row['gender']."</td>
                </tr>
                ";
            }
            $output .="</tbody>";
            echo $output;
        }
        else{
            echo "<h3>No Records Found</h3>";
        }

?>