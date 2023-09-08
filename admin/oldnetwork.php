<?php

function GetMemberInformation() {

    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );
    $membercheckurl = plugins_url() . '/thenetworks/admin/memberlist.php';
    $memberaddurl = plugins_url() . '/thenetworks/admin/memberadd.php';
    

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

    echo "<div id='contar'></div>";
    echo '<script>';
    echo "getmemberlist('$membercheckurl', '$memberaddurl');";
    echo '</script>';
    return;
    
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nid = $row['nid'];
            echo $nid . "<br>";
    
             //Business Name
             $sql1 = "SELECT * FROM node__field_member_business_name WHERE entity_id='$nid'";
             $result1 = mysqli_query($conn, $sql1);
             if ($result1 && mysqli_num_rows($result1) > 0) {
                 $row = mysqli_fetch_assoc($result1);
                 $businessName = $row['field_member_business_name_value'];
             } 
    
            //Check if already have Group Name
            global $user_ID, $wpdb;
            $query = $wpdb->prepare(
                'SELECT ID FROM ' . $wpdb->posts . '
                WHERE post_title = %s
                AND post_type = \'network-member\'',
                $businessName
            );
            $wpdb->query( $query );
            if ( !$wpdb->num_rows ) {
    
                //lowercap
                $post_name = strtolower($businessName);
                //remove white space
                $post_name2 = trim($post_name);
                //replace space with -
                $slug = str_replace(' ', '-', $post_name2);
                //add region to slug
                $regionslug = "member-".$slug;
    
                //Create Post
                $my_post = array(
                'post_title'    => $businessName,
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => 'network-member',
                'post_name'     => $regionslug,
                );
                $post_id = wp_insert_post( $my_post );

                //Old ID
                add_post_meta( $post_id, 'nid', $nid, true );

                //Description
                $sql1 = "SELECT * FROM node__body WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $description = $row['body_value'];
                    $encodedContent = base64_encode($description);
                    add_post_meta( $post_id, 'description', $encodedContent, true );
                } 

                //First Name
                $sql1 = "SELECT * FROM node__field_member_first_name WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $firstName = $row['field_member_first_name_value'];
                    add_post_meta( $post_id, 'firstName', $firstName, true );
                } 

                //Last Name
                $sql1 = "SELECT * FROM node__field_member_last_name WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $lastName = $row['field_member_last_name_value'];
                    add_post_meta( $post_id, 'lastName', $lastName, true );
                } 

                //Email
                $sql1 = "SELECT * FROM node__field_member_email WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $email = $row['field_member_email_value'];
                    add_post_meta( $post_id, 'email', $email, true );
                } 

                //First Visit
                $sql1 = "SELECT * FROM node__field_member_date_of_first_visit WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $firstvisit = $row['field_member_date_of_first_visit_value'];
                    add_post_meta( $post_id, 'firstvisit', $firstvisit, true );
                } 

                //Group ID
                $sql1 = "SELECT * FROM node__field_member_group WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    while($row = $result1->fetch_assoc()) {
                        $groupid = $row['field_member_group_target_id'];
                        add_post_meta( $post_id, 'group', $groupid, true );
                    }
                }

                //Industry
                $sql1 = "SELECT * FROM node__field_member_industries WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $industry = $row['field_member_industries_target_id'];
                    if($industry){
                        $args = array("post_type" => "network-industry",'posts_per_page' => -1);
                        $query = get_posts( $args );
                        if(count($query) > 0 ){
                            foreach($query as $post) {
                                if($post->post_content == $industry){
                                    add_post_meta( $post_id, 'industry', $post->ID, true );
                                }
                            }
                        }
                    }
                } 

                //Reference by
                $sql1 = "SELECT * FROM node__field_member_referred_by WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $referenceby = $row['field_member_referred_by_target_id'];
                } 

                //Phone
                $sql1 = "SELECT * FROM node__field_member_telephone WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    while($row = $result1->fetch_assoc()) {
                        $phone = $row['field_member_telephone_value'];
                        add_post_meta( $post_id, 'phone', $phone, true );
                    }
                }

                //Social Media
                $sql1 = "SELECT * FROM node__field_member_website WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    while($row = $result1->fetch_assoc()) {
                        $title = $row['field_member_website_title'];
                        $url = $row['field_member_website_uri'];
                        $array = array("$title","$url");
                        $socialmedia = json_encode($array); 
                        add_post_meta( $id, 'socialmedia', $socialmedia, false);
                    }
                }

                //User Image
                $sql7 = "SELECT * FROM node__field_member_image WHERE entity_id='$nid'";
                $result7 = mysqli_query($conn, $sql7);
                if ($result7 && mysqli_num_rows($result7) > 0) {
                    $row = mysqli_fetch_assoc($result7);
                    $fid = $row['field_member_image_target_id'];
                    $sql8 = "SELECT * FROM file_managed WHERE fid='$fid'";
                    $result8 = mysqli_query($conn, $sql8);
                    $row8 = mysqli_fetch_assoc($result8);
                    $photourl2 = $row8['uri'];
                    $photourl = str_replace('public://', "https://networkers.breeze.marketing/web/sites/default/files/", $photourl2);
                    $encoded_url = str_replace(' ', '%20', $photourl);
    
                    //Upload image to WP Media
                    $upload_dir = wp_upload_dir();
                    $image_data = file_get_contents( $encoded_url );
                    if(!$image_data){
                        $image_data = file_get_contents( $photourl );
                    }
                    $filename = basename( $photourl );
                    if ( wp_mkdir_p( $upload_dir['path'] ) ) {
                    $file = $upload_dir['path'] . '/' . $filename;
                    }
                    else {
                    $file = $upload_dir['basedir'] . '/' . $filename;
                    }
                    file_put_contents( $file, $image_data );
                    $wp_filetype = wp_check_filetype( $filename, null );
                    $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name( $filename ),
                    'post_content' => '',
                    'post_status' => 'inherit'
                    );
                    $attach_id = wp_insert_attachment( $attachment, $file );
                    add_post_meta( $post_id, 'userimageid', $attach_id, true );
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                }

                //logo
                $sql7 = "SELECT * FROM node__field_member_logo WHERE entity_id='$nid'";
                $result7 = mysqli_query($conn, $sql7);
                if ($result7 && mysqli_num_rows($result7) > 0) {
                    $row = mysqli_fetch_assoc($result7);
                    $fid = $row['field_member_logo_target_id'];
                    $sql8 = "SELECT * FROM file_managed WHERE fid='$fid'";
                    $result8 = mysqli_query($conn, $sql8);
                    $row8 = mysqli_fetch_assoc($result8);
                    $photourl2 = $row8['uri'];
                    $photourl = str_replace('public://', "https://networkers.breeze.marketing/web/sites/default/files/", $photourl2);
                    $encoded_url = str_replace(' ', '%20', $photourl);
    
                    //Upload image to WP Media
                    $upload_dir = wp_upload_dir();
                    $image_data = file_get_contents( $encoded_url );
                    if(!$image_data){
                        $image_data = file_get_contents( $photourl );
                    }
                    $filename = basename( $photourl );
                    if ( wp_mkdir_p( $upload_dir['path'] ) ) {
                    $file = $upload_dir['path'] . '/' . $filename;
                    }
                    else {
                    $file = $upload_dir['basedir'] . '/' . $filename;
                    }
                    file_put_contents( $file, $image_data );
                    $wp_filetype = wp_check_filetype( $filename, null );
                    $attachment = array(
                    'post_mime_type' => $wp_filetype['type'],
                    'post_title' => sanitize_file_name( $filename ),
                    'post_content' => '',
                    'post_status' => 'inherit'
                    );
                    $attach_id = wp_insert_attachment( $attachment, $file );
                    add_post_meta( $post_id, 'logoimageid', $attach_id, true );
                    require_once( ABSPATH . 'wp-admin/includes/image.php' );
                    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                    wp_update_attachment_metadata( $attach_id, $attach_data );
                    
                }

                //Location
                $sql1 = "SELECT * FROM node__field_location WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $city = $row['field_location_locality'];
                    $suburb = $row['field_location_dependent_locality'];
                    $address1 = $row['field_location_address_line1'];
                    $address2 = $row['field_location_address_line2'];
                    $postcode = $row['field_location_postal_code'];
                    if($country)
                        add_post_meta( $post_id, 'country', 'New Zealand', true );
                    if($address1)
                        add_post_meta( $post_id, 'streetaddress1', $address1, true );
                    if($address2)
                        add_post_meta( $post_id, 'streetaddress2', $address2, true );
                    if($suburb)
                        add_post_meta( $post_id, 'suburb', $suburb, true );
                    if($city)
                        add_post_meta( $post_id, 'city', $city, true );
                    if($postcode)
                        add_post_meta( $post_id, 'postalcode', $postcode, true );
                } 

                //Payment
                $sql1 = "SELECT * FROM node__field_member_payment_preference WHERE entity_id='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    $row = mysqli_fetch_assoc($result1);
                    $payment = $row['field_member_payment_preference_target_id'];
                    if($payment == "60"){
                        $payment = "1 Month @ $50+GST";
                    }
                    if($payment == "61"){
                        $payment = "3 Months @ $150+GST";
                    }
                    if($payment == "62"){
                        $payment = "6 Months @ $300+GST";
                    }
                    if($payment == "63"){
                        $payment = "12 Months @ $600+GST";
                    }
                    add_post_meta( $post_id, 'payment', $payment, true );
                } 

                // //Notes
                // $sql1 = "SELECT * FROM node__field_member_group WHERE entity_id='$nid'";
                // $result1 = mysqli_query($conn, $sql1);
                // if ($result1 && mysqli_num_rows($result1) > 0) {
                //     while($row = $result1->fetch_assoc()) {
                //         $groupid = $row['field_member_group_target_id'];
                //     }
                // }

            }
        }
    }
    
    mysqli_close($conn);
    
}

function GetMemberDeleteImage() {
    $query = new WP_Query(array(
        'post_type' => 'attachment',
        'post_status' => 'inherit',
        'posts_per_page' => -1,
    ));
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        if($post_id > 2002){
            wp_delete_attachment( $post_id );
            wp_delete_post( $post_id, false );
        }
    }
    wp_reset_query();
}

function GetMemberDelete() {

    $query = new WP_Query(array(
        'post_type' => 'network-member',
        'posts_per_page' => -1,
    ));

    while ($query->have_posts()) {

        $query->the_post();
        $post_id = get_the_ID();

        $imageid = get_post_meta( $post_id, 'userimageid', true );
        wp_delete_attachment( $imageid );
        $imageid2 = get_post_meta( $post_id, 'logoimageid', true );
        wp_delete_attachment( $imageid2 );

        wp_delete_post( $post_id, false );

    }
    wp_reset_query();

}

function GetMemberIdChange() {
    $query = new WP_Query(array(
        'post_type' => 'network-group',
        'posts_per_page' => -1,
    ));
    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        $oldfacilitatorid = get_post_meta($post_id, 'facilitator', true);
        $new_facilitator = get_post_id_by_meta_key_and_value('nid', $oldfacilitatorid);
        update_post_meta($post_id, 'facilitator', $new_facilitator);
    }
    wp_reset_postdata(); // Restore the original post data for the first query
}

function get_post_id_by_meta_key_and_value($key, $value) {
    global $wpdb;

    $post_id = $wpdb->get_var(
        $wpdb->prepare(
            "SELECT post_id FROM $wpdb->postmeta WHERE meta_key = %s AND meta_value = %s",
            $key,
            $value
        )
    );

    return $post_id;
}


// function GetMemberIdChange() {

//     $query = new WP_Query(array(
//         'post_type' => 'network-group',
//         'posts_per_page' => -1,
//     ));

//     while ($query->have_posts()) {
//         $query->the_post();
//         $post_id = get_the_ID();
//         $oldfacilitatorid = get_post_meta( $post_id, 'facilitator', true );
//         echo "old FacilitatorId " . $oldfacilitatorid . "<br>";

//         $args = array(
//             'post_type' => 'network-member',
//             'post_content' => $oldfacilitatorid,
//             'posts_per_page' => -1,
//           );
//         $latest_posts = new WP_Query($args);
//         if(count($latest_posts) > 0 ){
//             foreach($latest_posts as $post) {
//                 echo "FacilitatorId " . $post->ID . "<br>";
//             }
//         }

//         // while ($query2->have_posts()) {
//         //     $post_id2 = get_the_ID();
//         //     echo "FacilitatorId " . $post_id2 . "<br>";
//         //     //update_post_meta($post_id, 'facilitator', $post_id2);
//         // }
        
//     }
//     wp_reset_query();

// }
    

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
                echo $region . "<br>";
            }
            if($region){
                $args = array("post_type" => "network-region",'posts_per_page' => -1);
                $query = get_posts( $args );
                if(count($query) > 0 ){
                    foreach($query as $post) {
                        if($post->post_content == $region){
                            add_post_meta( $post_id, 'regions', $post->ID, true );
                            echo $post->ID . "<br>";
                        }
                    }
                }
            }

            //Facilitator id
            $sql3 = "SELECT * FROM node__field_facilitator WHERE entity_id='$nid'";
            $result3 = mysqli_query($conn, $sql3);
            if ($result3 && mysqli_num_rows($result3) > 0) {
                $row = mysqli_fetch_assoc($result3);
                $facilitator = $row['field_facilitator_target_id'];
                add_post_meta( $post_id, 'facilitator', $facilitator, true );
            }

            
            //Meeting day
            $sql4 = "SELECT * FROM node__field_meeting_day WHERE entity_id='$nid'";
            $result4 = mysqli_query($conn, $sql4);
            if ($result4 && mysqli_num_rows($result4) > 0) {
                $row = mysqli_fetch_assoc($result4);
                $datetime = $row['field_meeting_day_value'];

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
                        add_post_meta( $post_id, 'weekday', $weekday, true );
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

                 add_post_meta( $post_id, 'start', $start, true );
                 add_post_meta( $post_id, 'finish', $finish, true );

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
                 add_post_meta( $post_id, 'company', $company, true );
                 add_post_meta( $post_id, 'address1', $address1, true );
                 add_post_meta( $post_id, 'address2', $address2, true );
                 add_post_meta( $post_id, 'suburb', $suburb, true );
                 add_post_meta( $post_id, 'postcode', $postcode, true );
                 add_post_meta( $post_id, 'city', $city, true );
            }

            //description
            $sql6 = "SELECT * FROM node__body WHERE entity_id='$nid'";
            $result6 = mysqli_query($conn, $sql6);
            
            if ($result6 && mysqli_num_rows($result6) > 0) {

                $row = mysqli_fetch_assoc($result6);
                $description = $row['body_value'];
                $encodedContent = base64_encode($description);
                add_post_meta( $post_id, 'description', $encodedContent, true );
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
                echo $photourl;
                echo "<br>";
                $encoded_url = str_replace(' ', '%20', $photourl);
 
                //Upload image to WP Media
                $upload_dir = wp_upload_dir();
                $image_data = file_get_contents( $encoded_url );
                if(!$image_data){
                    $image_data = file_get_contents( $photourl );
                }
                $filename = basename( $photourl );
                if ( wp_mkdir_p( $upload_dir['path'] ) ) {
                $file = $upload_dir['path'] . '/' . $filename;
                }
                else {
                $file = $upload_dir['basedir'] . '/' . $filename;
                }
                file_put_contents( $file, $image_data );
                $wp_filetype = wp_check_filetype( $filename, null );
                $attachment = array(
                'post_mime_type' => $wp_filetype['type'],
                'post_title' => sanitize_file_name( $filename ),
                'post_content' => '',
                'post_status' => 'inherit'
                );
                $attach_id = wp_insert_attachment( $attachment, $file );
                add_post_meta( $post_id, 'imageid', $attach_id, true );
                require_once( ABSPATH . 'wp-admin/includes/image.php' );
                $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
                wp_update_attachment_metadata( $attach_id, $attach_data );

                

                // $upload_dir = wp_upload_dir();
                // $image_data = file_get_contents($encoded_url);

                // // Check if image data was fetched successfully
                // if ($image_data === false) {
                //     echo "Error fetching image data from URL.";
                //     exit;
                // }

                // $filename = basename($photourl);

                // // Validate if the file name is not empty
                // if (empty($filename)) {
                //     echo "Invalid file name.";
                //     exit;
                // }

                // if (wp_mkdir_p($upload_dir['path'])) {
                //     $file = $upload_dir['path'] . '/' . $filename;
                // } else {
                //     $file = $upload_dir['basedir'] . '/' . $filename;
                // }

                // // Check if the file was saved successfully
                // if (file_put_contents($file, $image_data) === false) {
                //     echo "Error saving image data to file.";
                //     exit;
                // }

                // $wp_filetype = wp_check_filetype($filename, null);

                // $attachment = array(
                //     'post_mime_type' => $wp_filetype['type'],
                //     'post_title' => sanitize_file_name($filename),
                //     'post_content' => '',
                //     'post_status' => 'inherit'
                // );

                // $attach_id = wp_insert_attachment($attachment, $file);

                // // Check if attachment was inserted successfully
                // if (is_wp_error($attach_id)) {
                //     echo "Error inserting attachment.";
                //     exit;
                // }

                // add_post_meta($post_id, 'imageid', $attach_id, true);
                // require_once(ABSPATH . 'wp-admin/includes/image.php');

                // $attach_data = wp_generate_attachment_metadata($attach_id, $file);

                // // Check if attachment data was generated successfully
                // if (is_wp_error($attach_data)) {
                //     echo "Error generating attachment metadata.";
                //     exit;
                // }

                // wp_update_attachment_metadata($attach_id, $attach_data);

                // // Success message
                // echo "Image uploaded successfully!";

            }
        }
    }
}

mysqli_close($conn);

}
function GetGroupDelete() {

    $query = new WP_Query(array(
        'post_type' => 'network-group',
        'posts_per_page' => -1,
    ));

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        echo $post_id;
        $imageid = get_post_meta( $post_id, 'imageid', true );
        wp_delete_attachment( $imageid );
        wp_delete_post( $post_id, false );
    }
    wp_reset_query();

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