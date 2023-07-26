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

        

        $sql1 = "SELECT * FROM node__field_group_name WHERE entity_id='$nid'";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1 && mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $name = $row['field_group_name_value'];
            echo "ID: " . $nid;
            echo"<br>";
            echo "Group Name: " . $name;
            echo"<br>";
        } else {
            echo "ID: " . $nid;
            echo"<br>";
            echo "Group Name: Vazio";
            echo"<br>";
        }

        //Region
        $sql2 = "SELECT * FROM node__field_group_grouping WHERE entity_id='$nid'";
        $result2 = mysqli_query($conn, $sql2);
        if ($result2 && mysqli_num_rows($result2) > 0) {
            $row = mysqli_fetch_assoc($result2);
            $region = $row['field_group_grouping_target_id'];
            echo "Region: " . $region;
            echo"<br>";
        } else {
            echo "Region: Vazio";
            echo"<br>";
        }

        //Facilitator id
        $sql3 = "SELECT * FROM node__field_facilitator WHERE entity_id='$nid'";
        $result3 = mysqli_query($conn, $sql3);
        if ($result3 && mysqli_num_rows($result3) > 0) {
            $row = mysqli_fetch_assoc($result3);
            $facilitator = $row['field_facilitator_target_id'];
            echo "facilitator ID: " . $facilitator;
            echo"<br>";
        } else {
            echo "facilitator ID: Vazio";
            echo"<br>";
        }

        //Meeting day
        $sql4 = "SELECT * FROM node__field_meeting_day WHERE entity_id='$nid'";
        $result4 = mysqli_query($conn, $sql4);
        if ($result4 && mysqli_num_rows($result4) > 0) {
            $row = mysqli_fetch_assoc($result4);
            $datetime = $row['field_meeting_day_value'];
            echo "Time: " . $datetime;
            echo"<br>";
        } else {
            echo "Time: Vazio";
            echo"<br>";
        }

        //Location
        $sql5 = "SELECT * FROM node__field_location WHERE entity_id='$nid'";
        $result5 = mysqli_query($conn, $sql5);
        if ($result5 && mysqli_num_rows($result5) > 0) {
            $row = mysqli_fetch_assoc($result5);
            $city = $row['field_location_locality'];
            $suburb = $row['field_location_dependent_locality'];
            $postcode = $row['field_location_postal_code'];
            $address1 = $row['field_location_address_line1'];
            $address2 = $row['field_location_address_line2'];
            $company = $row['field_location_organization'];
            echo "city: " . $city;
            echo"<br>";
            echo "suburb: " . $suburb;
            echo"<br>";
            echo "postcode: " . $postcode;
            echo"<br>";
            echo "address1: " . $address1;
            echo"<br>";
            echo "address2: " . $address2;
            echo"<br>";
            echo "company: " . $company;
            echo"<br>";
        } else {
            echo "address: Vazio";
            echo"<br>";
        }

        //description
        $sql6 = "SELECT * FROM node__body WHERE entity_id='$nid'";
        $result6 = mysqli_query($conn, $sql6);
        if ($result6 && mysqli_num_rows($result6) > 0) {
            $row = mysqli_fetch_assoc($result6);
            $description = $row['body_value'];
            echo "Description: " . $description;
            echo"<br>";
        } else {
            echo "Description: Vazio";
            echo"<br>";
        }

        //image
        $sql7 = "SELECT * FROM node__field_group_photo WHERE entity_id='$nid'";
        $result7 = mysqli_query($conn, $sql7);
        if ($result7 && mysqli_num_rows($result7) > 0) {
            $row = mysqli_fetch_assoc($result7);
            $fid = $row['field_group_photo_target_id'];
            $sql8 = "SELECT * FROM file_managed WHERE fid='$fid'";
            $result8 = mysqli_query($conn, $sql8);
            $row8 = mysqli_fetch_assoc($result8);
            $photourl2 = $row8['uri'];
            $photourl = str_replace('public://', "https://networkers.breeze.marketing/web/sites/default/files/", $photourl2);
            echo "imageurl: " . $photourl;
            echo"<br>";
            echo"<br>";
        } else {
            echo "imageurl: Vazio";
            echo"<br>";
            echo"<br>";
        }
        // file_managed
        // fid
        // uri
        // replace public://
        

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