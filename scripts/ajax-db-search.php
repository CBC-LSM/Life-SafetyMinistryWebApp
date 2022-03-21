<?php
// echo "hello";
require 'database/load.php';
// echo "<br> Hi!";

// $name = "b";
// $sql = "SELECT * FROM teamMembers WHERE membername LIKE '{$name}%' LIMIT 25";
// // echo $sql."<br>";
// $db->query($sql);
// $numRows = $db->affected_rows();
// // die(var_dump($db));
// $results = find_by_sql($sql);
// // die(var_dump($results));

// // $x = mysqli_num_rows($results);
// // echo "x= ".$x."<br>";

// if ($numRows>0){
//     // echo "hello";
//     for ($i = 0; $i < $numRows; $i++)  {
//         $res[$i] = $results[$i]['membername'];
//     }
// }else{
//     $res = array();
//     // echo "<br> Hi!";
// }

// // die(var_dump($res));

// if (isset($_GET['term'])) {
//     global $db;
//     $sql = "SELECT * FROM teamMembers WHERE membername LIKE '{$_GET['term']}%' LIMIT 25";
//     echo $sql."<br>";
//     $results = find_by_sql($sql);
//     $db->query($sql);
//     $numRows = $db->affected_rows();

//     if ($numRows>0){
//         // echo "hello";
//         for ($i = 0; $i < $numRows; $i++)  {
//             $res[$i] = $results[$i]['membername'];
//         }
//     }else{
//         $res = array();
//         // echo "<br> Hi!";
//     }
//     echo json_encode($res);
// }

// Get search term 
$searchTerm = $_GET['term']; 
 
// Fetch matched data from the database 
$query = $db->query("SELECT * FROM teamMembers WHERE membername LIKE '{$searchTerm}%' ORDER BY membername ASC"); 
 
// Generate array with skills data 
$skillData = array(); 
if($query->num_rows > 0){ 
    while($row = $query->fetch_assoc()){ 
        $data['id'] = $row['id']; 
        $data['value'] = $row['membername']; 
        array_push($skillData, $data); 
    } 
} 
 
// Return results as json encoded array 
echo json_encode($skillData); 