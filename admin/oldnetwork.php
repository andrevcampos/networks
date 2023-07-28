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
        $nid = $row['nid'];

        $sql1 = "SELECT * FROM node__field_group_name WHERE entity_id='$nid'";
        $result1 = mysqli_query($conn, $sql1);
        if ($result1 && mysqli_num_rows($result1) > 0) {
            $row = mysqli_fetch_assoc($result1);
            $name = $row['field_group_name_value'];
        } 

        //Check if already have Group Name
        global $user_ID, $wpdb;
        $query = $wpdb->prepare(
            'SELECT ID FROM ' . $wpdb->posts . '
            WHERE post_title = %s
            AND post_type = \'network-group\'',
            $name
        );
        $wpdb->query( $query );
        if ( !$wpdb->num_rows ) {

            //lowercap
            $post_name = strtolower($name);
            //remove white space
            $post_name2 = trim($post_name);
            //replace space with -
            $slug = str_replace(' ', '-', $post_name2);
            //add region to slug
            $regionslug = "group-".$slug;

            //Create Post
            $my_post = array(
            'post_content'  => $nid,
            'post_title'    => $name,
            'post_status'   => 'publish',
            'post_author'   => 1,
            'post_type'     => 'network-group',
            'post_name'     => $regionslug,
            );

            $post_id = wp_insert_post( $my_post );

            //Region
            $sql2 = "SELECT * FROM node__field_group_grouping WHERE entity_id='$nid'";
            $result2 = mysqli_query($conn, $sql2);
            if ($result2 && mysqli_num_rows($result2) > 0) {
                $row = mysqli_fetch_assoc($result2);
                $region = $row['field_group_grouping_target_id'];
            }
            if($region){
                add_post_meta( $post_id, 'regions', $region, true );
            }

            //Facilitator id
            $sql3 = "SELECT * FROM node__field_facilitator WHERE entity_id='$nid'";
            $result3 = mysqli_query($conn, $sql3);
            if ($result3 && mysqli_num_rows($result3) > 0) {
                $row = mysqli_fetch_assoc($result3);
                $facilitator = $row['field_facilitator_target_id'];
            }

            
            //Meeting day
            $sql4 = "SELECT * FROM node__field_meeting_day WHERE entity_id='$nid'";
            $result4 = mysqli_query($conn, $sql4);
            if ($result4 && mysqli_num_rows($result4) > 0) {
                $row = mysqli_fetch_assoc($result4);
                $datetime = $row['field_meeting_day_value'];
                echo $datetime;
                echo "<br>";

                $datetime = str_replace(" - "," ",$datetime);
                $datetime = str_replace(" to "," ",$datetime);
                $datetime = str_replace(".",":",$datetime);
                $datetime = str_replace(" am","am",$datetime);
                $datetime = str_replace(" pm","pm",$datetime);
                $datetime = str_replace(" Am","am",$datetime);
                $datetime = str_replace(" Pm","pm",$datetime);
                $datetime = str_replace("Am","am",$datetime);
                $datetime = str_replace("Pm","pm",$datetime);
                $datetime = str_replace("12noon","12pm",$datetime);
                $datetime = str_replace("  "," ",$datetime);
                $datetime2 = $datetime;

                $weekday = "";
                $array = ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"];
                foreach ($array as $weekday2) {
                    if (strpos($datetime2, $weekday2) !== FALSE) {
                        $weekday = strtolower($weekday2); 
                        echo $weekday;
                        echo "<br>";
                    }
                }
                
                $start = "";
                $finish = "";
                $stringarray = explode(" ",$datetime2);
                if($weekday != ""){
                    $start = $stringarray[1];
                    $finish = $stringarray[2];
                }else{
                    $start = $stringarray[0];
                    $finish = $stringarray[1];
                }
                if (str_contains($start, ':')) { 
                    $start = str_replace("am",":am",$start);
                    $start = str_replace("pm",":pm",$start);
                }else{
                    $start = str_replace("am",":00:am",$start);
                    $start = str_replace("pm",":00:pm",$start);
                }
                if (str_contains($finish, ':')) { 
                    $finish = str_replace("am",":am",$finish);
                    $finish = str_replace("pm",":pm",$finish);
                }else{
                    $finish = str_replace("am",":00:am",$finish);
                    $finish = str_replace("pm",":00:pm",$finish);
                }
                if (!str_contains($start, 'am') && !str_contains($start, 'pm')) { 
                    $timearray4 = explode(":",$finish);
                    $start = $start . ":" . $timearray4[2];
                }
                if(!$finish || $finish == ""){
                    $timearray5 = explode(":",$start);
                    $hour = $timearray5[0] + 1;
                    if($hour > 12){
                        $hour -= 12;
                        $timearray5[2] = "pm";
                    }
                    $finish = $hour . ":" . $timearray5[1] . ":" . $timearray5[2];
                }

                echo $start;
                echo "<br>";
                echo $finish;

                echo "<br>";
                echo "<br>";

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
            }

            //description
            $sql6 = "SELECT * FROM node__body WHERE entity_id='$nid'";
            $result6 = mysqli_query($conn, $sql6);
            if ($result6 && mysqli_num_rows($result6) > 0) {
                $row = mysqli_fetch_assoc($result6);
                $description = $row['body_value'];
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
            }
        
        }
    }
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