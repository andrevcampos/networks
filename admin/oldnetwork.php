<?php

function GetGroupInformation() {

$servername = "thenetworkers.co.nz";
$username = "thenetw_andre";
$password = "Andre@123!";
$dbname = "thenetw_networkers";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM node WHERE type='group'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $type = $row['type'];
        $nid = $row['nid'];
        $vid = $row['vid'];
        $uuid = $row['uuid'];
        echo $type;
    }
} else {
    echo "No nodes found.";
}

mysqli_close($conn);

}

function GetIndustryInformation() {

    $servername = "thenetworkers.co.nz";
    $username = "thenetw_andre";
    $password = "Andre@123!";
    $dbname = "thenetw_networkers";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM taxonomy_term_field_data WHERE vid='industries'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $tid = $row['tid'];
            echo $name;

            //lowercap
            $post_name = strtolower($name);
            //remove white space
            $post_name2 = trim($post_name);
            //replace space with -
            $slug = str_replace(' ', '-', $post_name2);
            //add region to slug
            $regionslug = $slug;

            $my_post = array(
            'post_title'    => $name,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_content'   => $tid,
            'post_type'   => 'network-industry',
            'post_name'   => $regionslug,
            );

            wp_insert_post( $my_post );


        }
    } else {
        echo "No nodes found.";
    }
    
    mysqli_close($conn);
    
}

function GetRegionformation() {

    $servername = "thenetworkers.co.nz";
    $username = "thenetw_andre";
    $password = "Andre@123!";
    $dbname = "thenetw_networkers";
    
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $sql = "SELECT * FROM taxonomy_term_field_data WHERE vid='groups_groupings'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $name = $row['name'];
            $tid = $row['tid'];
            echo $name;

            //lowercap
            $post_name = strtolower($name);
            //remove white space
            $post_name2 = trim($post_name);
            //replace space with -
            $slug = str_replace(' ', '-', $post_name2);
            //add region to slug
            $regionslug = $slug;

            $my_post = array(
            'post_title'    => $name,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_content'   => $tid,
            'post_type'   => 'network-region',
            'post_name'   => $regionslug,
            );

            wp_insert_post( $my_post );

        }
    } else {
        echo "No nodes found.";
    }
    
    mysqli_close($conn);
    
}


?>