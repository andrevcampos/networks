<?php

$servername = "thenetworkers.co.nz";
$username = "thenetw_andre";
$password = "Andre@123!";
$dbname = "thenetw_networkers";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM node WHERE type='member'";
$result = mysqli_query($conn, $sql);
$array = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $nid = $row['nid'];
        array_push($array, $nid);
    }
}
echo json_encode($array);

?>