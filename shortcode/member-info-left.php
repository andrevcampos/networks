<?php
function member_info_left_shortcode() {

    ob_start();
    wp_enqueue_style( 'shortcodecss', plugins_url() . '/thenetworks/public/css/shortcode.css');

    $facebookurl =  plugins_url() . '/thenetworks/public/img/facebook_icon.jpg';
    $instagramurl =  plugins_url() . '/thenetworks/public/img/instagram_icon.jpg';
    $youtubeurl =  plugins_url() . '/thenetworks/public/img/youtube_icon.jpg';
    $linkedinurl =  plugins_url() . '/thenetworks/public/img/linkedin_icon.jpg';
    $whatsappurl =  plugins_url() . '/thenetworks/public/img/whatsapp_icon.jpg';
    $websiteurl =  plugins_url() . '/thenetworks/public/img/website_icon.jpg';

    $user_role = Get_User_Role();

    $memberid = $_GET['id'];
    $obj = Get_Member($memberid);
    $email = $obj->email;
    // Phones
    $phoneslist = $obj->phone;
    $phones = "";
    foreach($phoneslist as $phone) {
        $cleaned_number = str_replace(' ', '', $phone);
        $number = 'tel:+64'.ltrim($cleaned_number, '0');
        if ($phones == ""){
            $phones = "<a href='$number'><div class='group-info-left-text' style='color:#5F259F;'>$phone</div></a>";
        }else{
            $phones = $phones . "<a href='$number'><div class='group-info-left-text' style='color:#5F259F;'>$phone</div></a>";
        }
    }
    // Groups
    $groupslist = $obj->group;
    $groups = "";
    foreach($groupslist as $groupid) {
        $objgroup = Get_Group($groupid);
        $groupname = get_post_field('post_name', $groupid);
        $grouptitle = $objgroup->post_title;
        if ($groups == ""){
            $groups = "<a href='/groups/$groupname'><div class='group-info-left-text' style='color:#5F259F;'>$grouptitle</div></a>";
        }else{
            $groups = $groups . "<a href='/groups/$groupname'><div class='group-info-left-text' style='color:#5F259F;'>$grouptitle</div></a>";
        }
    }
    //Industry
    $industrylist = $obj->industry;
    $industrys = "";
    foreach($industrylist as $industry) {
        $objindustry = Get_Industry($industry);
        if ($industrys == ""){
            $industrys = $objindustry->post_title;
        }else{
            $industrys = $industrys . "<br>" . $objindustry->post_title;
        }
    }
    $imageid = $obj->imageid;
    $pimage_info = wp_get_attachment_image_src($imageid, 'full');

    $sociallist = $obj->socialmedia;

    if ($user_role == 'administrator' || $user_role == 'network-admin'){
        

        echo '<div class="group-info-left">';
            // echo '<div class="group-info-left-icon">
            //     <span class="material-symbols-outlined">home_work</span>
            // </div>';
            echo "<div class='group-info-left-text-title'><strong>Networkers Admin</strong></div>";
        echo '</div>';
        echo "<div class='group-info-left-text'><a href='/wp-admin/admin.php?page=networkers-members-update&id=$obj->ID'>Edit Profile</a></div>";
        echo "<br>";
    }

    
    
    echo '<div class="profile-picture" style="background-image: url(' . esc_url($pimage_info[0]) . ')"></div>';
    echo "<div class='group-info-left-text' style='text-align: center;width:250px;margin-left:0px'><strong>$obj->firstname $obj->lastname</strong></div>";
    echo "<br>";

    $cleaned_number = str_replace(' ', '', $phones);
    $number = 'tel:+64'.ltrim($cleaned_number, '0');

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">phone_iphone</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Business Name</strong></div>";
    echo '</div>';
    echo $obj->businessname;
    
    echo "<br><br>";

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">phone_iphone</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Phone</strong></div>";
    echo '</div>';
    echo $phones;
    
    echo "<br>";

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">mail</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Email</strong></div>";
    echo '</div>';
    echo "<a href='mailto:$email'><div class='group-info-left-text' style='color:#5F259F;'>$email</div></a>";

    echo "<br>";

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">home_work</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Industry</strong></div>";
    echo '</div>';
    echo "<div class='group-info-left-text'>$industrys</div>";

    echo "<br>";

    if(Count($sociallist)>0){
        echo '<div class="group-info-left">';
            // echo '<div class="group-info-left-icon">
            //     <span class="material-symbols-outlined">captive_portal</span>
            // </div>';
            echo "<div class='group-info-left-text-title'><strong>Social Media</strong></div>";
        echo '</div>';

        echo '<div class="social-icons-container">';
        foreach ($sociallist as $social) {
            $socialdecode = json_decode($social);
            $social = strtolower(str_replace(' ', '', $socialdecode[0]));
            if ($social == "website") {
                echo "<a href='$socialdecode[1]'><img src='$websiteurl' alt='website' style='width:35px;border-radius:10px'></a>";
            } else if ($social == "facebook") {
                echo "<a href='$socialdecode[1]'><img src='$facebookurl' alt='facebook' style='width:35px;border-radius:10px'></a>";
            } else if ($social == "instagram") {
                echo "<a href='$socialdecode[1]'><img src='$instagramurl' alt='instagram' style='width:35px;border-radius:10px'></a>";
            } else if ($social == "linkedin") {
                echo "<a href='$socialdecode[1]'><img src='$linkedinurl' alt='linkedin' style='width:35px;border-radius:10px'></a>";
            } else if ($social == "youtube") {
                echo "<a href='$socialdecode[1]'><img src='$youtubeurl' alt='youtube' style='width:35px;border-radius:10px'></a>";
            } else if ($social == "whatsapp") {
                echo "<a href='$socialdecode[1]'><img src='$whatsappurl' alt='whatsapp' style='width:35px;border-radius:10px'></a>";
            } 
        }
        echo '</div>';

        foreach ($sociallist as $social) {
            $socialdecode = json_decode($social);
            $social = strtolower(str_replace(' ', '', $socialdecode[0]));
            if ($social != "website" && $social != "facebook" && $social != "instagram" && $social != "linkedin" && $social != "youtube" && $social != "whatsapp") {
                echo "<a href='$socialdecode[1]'><div class='group-info-left-text' style='color:#5F259F;'>$socialdecode[0]</div></a>";
            }
        }
 
    }

    echo "<br>";

    echo '<div class="group-info-left">';
        // echo '<div class="group-info-left-icon">
        //     <span class="material-symbols-outlined">home_work</span>
        // </div>';
        echo "<div class='group-info-left-text-title'><strong>Groups</strong></div>";
    echo '</div>';
    echo "<div class='group-info-left-text'>$groups</div>";

    

    

    return ob_get_clean();
}
add_shortcode('memberinfoleft', 'member_info_left_shortcode');
?>