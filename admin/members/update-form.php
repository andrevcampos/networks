<?php

function networkers_members_update() {


    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'update.php';
    $membercheckurl = plugins_url() . '/thenetworks/admin/function/member-check.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $user_role = Get_User_Role();

    $id = $_GET['id'];
    $member = get_post($id);
    $businessname = $member->post_title;
    $memberstatus = get_post_meta( $id, 'status', true );
    $facilitator = get_post_meta( $id, 'facilitator', true );
    $firstvisit = get_post_meta( $id, 'firstvisit', true );
    $firstName = get_post_meta( $id, 'firstName', true );
    $lastName = get_post_meta( $id, 'lastName', true );
    $email = get_post_meta( $id, 'email', true );
    $phones = get_post_meta( $id, 'phone', false );
    $groups = get_post_meta( $id, 'group', false );
    $businessDescription = base64_decode(get_post_meta( $id, 'description', true ));
    $country = get_post_meta( $id, 'country', true );
    $streetaddress1 = get_post_meta( $id, 'streetaddress1', true );
    $streetaddress2 = get_post_meta( $id, 'streetaddress2', true );
    $suburb = get_post_meta( $id, 'suburb', true );
    $city = get_post_meta( $id, 'city', true );
    $postalcode = get_post_meta( $id, 'postalcode', true );
    $payment = get_post_meta( $id, 'payment', true );
    $industry = get_post_meta( $id, 'industry', false );
    $referedby = get_post_meta( $id, 'referedby', false );
    $group = get_post_meta( $id, 'group', false );
    $socialmedia = get_post_meta( $id, 'socialmedia', false );

    $logoimageid = get_post_meta( $id, 'logoimageid', true );
    $userimageid = get_post_meta( $id, 'userimageid', true );

    $paymentcheckbox = get_post_meta( $id, 'paymentcheckbox', true );
    if (empty($paymentcheckbox)) {$paymentcheckbox = 'true';}
    $newslettercheckbox = get_post_meta( $id, 'newslettercheckbox', true );
    if (empty($newslettercheckbox)) {$newslettercheckbox = 'true';}
    $businessinformationcheckbox = get_post_meta( $id, 'businessinformationcheckbox', true );
    if (empty($businessinformationcheckbox)) {$businessinformationcheckbox = 'true';}
    $agreecheckbox = get_post_meta( $id, 'agreecheckbox', true );
    if (empty($agreecheckbox)) {$agreecheckbox = 'true';}

    ?>

    <div style="display:block" id="networkersbox" class="networkersbox">
        <form id='myForm' action='<?php echo $url; ?>' method='post' enctype='multipart/form-data'>
           <div class="wrap">
                <h2>Update Member</h2>
            </div><br><br>

            <input style='display:none' id='orginalname' type='text' name='orginalname' value='<?php echo $businessname;?>'>
            <input style='display:none' id='post_id' type='text' name='post_id' value='<?php echo $id;?>'>

            <div class="memberlogobox">

                <label>Status:</label><br>
                <?php 
                    echo '<select name="memberstatus" id="memberstatus" style="margin-top:5px">';
                    $possibleStatus = array("Potential Member", "Scheduled Visitor", "Active Visitor", "Active Member", "Past Member");
                    foreach ($possibleStatus as $status) {
                        $selected = ($status == $memberstatus) ? "selected" : "";
                        echo "<option value='" . $status . "' $selected>$status</option>";
                    }
                    echo '</select><br><br><br>';
                    
                ?>

                <label>First Visit:</label><br>
                <input style="width:200px" type="date" value="<?php echo $firstvisit; ?>" id="firstvisit" name="firstvisit">
                <p>Please choose the date of the member's initial visit.</p>

            </div>

            <br><br>

            <div class="memberlogobox">

                <h2 style="font-size:22px"><b>Profile Information</b></h2><br>

                <label>First Name:<spam style="color:red"> *</spam></label><br>
                <input id="firstName" name="firstName" type="text" value="<?php echo $firstName;?>"><br><br>

                <label>Last Name:<spam style="color:red"> *</spam></label><br>
                <input id="lastName" name="lastName" type="text" value="<?php echo $lastName;?>"><br><br>

                <label>Email:</label><br>
                <input id="email" name="email" type="text" value="<?php echo $email;?>"><br><br>

                <label>Phone:</label><br>
                <div id="memberphone">
                    <?php 
                    if($phones){
                        foreach($phones as $phone) {
                            echo '<div class="phonediv">';
                                echo "<input class='phone' name='phone[]' value='$phone' type='text' style='width:calc(100% - 80px)'>";
                                echo '<div class="memberphoneremove" onclick="removephone(this)">X</div><br>';
                            echo '</div>';
                        }
                    }else{
                        echo "<input class='phone' name='phone[]' type='text'><br>";
                    }
                    ?>
                </div>
                <div class="networkersbuttom bg-info" onclick="addnewphone()" >New Phone</div>
                <br>
            </div>

            <br><br>

            <div class="memberlogobox">
                <?php
                User_Image_Box($userimageid);
                ?>
            </div>

            <br><br>

            <div class="memberlogobox">
                <?php
                // Multiple selection and nothing selected.
                if($user_role == "administrator" || $user_role == "network-admin" || $user_role == "franchise"){
                    Group_Box($groups, true);
                }else{
                    Group_Box($groups, false);
                }
                
                ?>
            </div>

            <br><br>

            <div class="memberlogobox">
                <h2 style="font-size:22px"><b>Company Information</b></h2><br>
                <label>Business Name:<spam style="color:red"> *</spam></label><br>
                <input id="businessname" name="businessname" type="text" value="<?php echo $businessname;?>"><br>

                <?php

                Industry_Box($industry, true);
                echo "<br>";
                $logoHtml = member_logo($logoimageid);
                echo $logoHtml;

                ?>

                <br><br>

                <?php 
                $socialmediaHtml = member_social_media($socialmedia);
                echo $socialmediaHtml;
                ?>
                
                <br><br>
                <label><b>Business Description</b></label>
                <div style="max-width:100%;margin-top:-20px">
                <?php wp_editor( $businessDescription , 'businessDescription', array(
                        'wpautop'       => true,
                        'media_buttons' => false,
                        'textarea_name' => 'businessDescription',
                        'editor_class'  => 'my_custom_class',
                        'textarea_rows' => 10
                    ) ); ?>
                </div>

                <br><br>
                
                <label><b>Location</b></label><br><br>
            
                <select id="country" name="country">
                    <option value="New Zealand" selected>New Zealand</option>
                </select>
                
                <br><br>
                
                <label>Street address:</label><br>
                <input id="streetaddress1" name="streetaddress1" type="text" value="<?php echo $streetaddress1;?>"><br>
                <input id="streetaddress2" name="streetaddress2" type="text" value="<?php echo $streetaddress2;?>"><br><br>

                <label>Suburb:</label><br>
                <input id="suburb" name="suburb" type="text" value="<?php echo $suburb;?>"><br><br>

                <div class="d-flex">
                    <label style="width:70%">City:</label>
                    <label style="width:calc(30% - 10px);margin-left:10px">Postal code:</label>
                </div>
                <div class="d-flex">
                    <input id="city" name="city" style="width:70%" type="text" value="<?php echo $city;?>">
                    <input id="postalcode" name="postalcode" style="width:calc(30% - 10px);margin-left:10px" type="text" value="<?php echo $postalcode;?>">
                </div>

                <br>
            </div>
            
            <br><br>

            <div class="memberlogobox">
                <?php
                // Multiple selection and nothing selected.
                Referedby_Box($referedby, true);
                ?>
            </div>

            <br><br>

            <div class="memberlogobox">
                <h2 style="font-size:22px"><b>Payment Preference</b></h2>

                <?php 
                    $paymentStatus = array("N/A", "1 Month @ $50+GST", "3 Months @ $150+GST", "6 Months @ $300+GST", "12 Months @ $600+GST");
                    foreach ($paymentStatus as $spayment) {
                        $checked = ($spayment == $payment) ? "checked" : "";
                        echo "<input style='width:10px' type='radio' name='payment' value='$spayment' $checked>";
                        echo "<label for='n/a'>$spayment</label><br><br>";
                    }
                ?>
            </div>

            <br><br>   

            <div class="memberlogobox">

                <h2 style="font-size:22px"><b>Permissions</b></h2>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="paymentcheckbox" name="paymentcheckbox" <?php echo ($paymentcheckbox == 'true') ? 'checked' : ''; ?>></div>
                    <div style="margin-top:3px"><spam >By joining as a member I give "The Networkers" permission to generate an invoice which is billed in advance for the period I select.</spam></div>
                </div>
                <br>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="newslettercheckbox" name="newslettercheckbox" <?php echo ($newslettercheckbox == 'true') ? 'checked' : ''; ?>></div>
                    <div style="margin-top:3px"><spam>I give permission for The Networkers to send me 'Networkers' email updates (approx 1-2 monthly).</spam></div>
                </div>
                <br>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="businessinformationcheckbox" name="businessinformationcheckbox" <?php echo ($businessinformationcheckbox == 'true') ? 'checked' : ''; ?>></div>
                    <div style="margin-top:3px"><spam>By joining as a member I give "The Networkers" permission to use my business information for a website profile & in soclal media etc.</spam></div>
                </div>
                <br>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="agreecheckbox" name="agreecheckbox" <?php echo ($agreecheckbox == 'true') ? 'checked' : ''; ?>></div>
                    <div style="margin-top:3px"><spam>I agree that my details are correct and I have been given an introduction brochure.</spam></div>
                </div>

            </div>
            

        </form>
        <br><br>
    </div>

    <div class='networkersbuttom' onclick='updatemember("<?php echo $membercheckurl; ?>")' >Update</div>

<?php
}

?>