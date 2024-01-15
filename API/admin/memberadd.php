<?php

    include '../../../../wp-load.php';
 
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
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $nid = $row['nid'];

            //Business Name
            $sql1 = "SELECT * FROM node__field_member_business_name WHERE entity_id='$nid'";
            $result1 = mysqli_query($conn, $sql1);
            if ($result1 && mysqli_num_rows($result1) > 0) {
                $row = mysqli_fetch_assoc($result1);
                $businessName = $row['field_member_business_name_value'];
            } 

            //Check if already have Member
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
                        add_post_meta( $post_id, 'socialmedia', $socialmedia, false);
                    }
                }

                //Status
                $sql1 = "SELECT * FROM node_field_data WHERE nid='$nid'";
                $result1 = mysqli_query($conn, $sql1);
                if ($result1 && mysqli_num_rows($result1) > 0) {
                    while($row = $result1->fetch_assoc()) {
                        $status = $row['status'];
                        add_post_meta( $post_id, 'status', $status, true);
                    }
                }

                //User Image
                $sql7 = "SELECT * FROM node__field_member_image WHERE entity_id='$nid'";
                $result7 = mysqli_query($conn, $sql7);
                if ($result7 && mysqli_num_rows($result7) > 0) {
                    $row = mysqli_fetch_assoc($result7);
                    $fid = $row['field_member_image_target_id'];
                    add_post_meta( $post_id, 'imageid', $fid, true);
                }

                //logo
                $sql7 = "SELECT * FROM node__field_member_logo WHERE entity_id='$nid'";
                $result7 = mysqli_query($conn, $sql7);
                if ($result7 && mysqli_num_rows($result7) > 0) {
                    $row = mysqli_fetch_assoc($result7);
                    $fid = $row['field_member_logo_target_id'];
                    add_post_meta( $post_id, 'logoid', $fid, true);
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
            }
        }
    }
?>