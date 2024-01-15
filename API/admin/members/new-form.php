<?php

function network_members_new() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $url = $plugin_url . 'new.php';
    $membercheckurl = plugins_url() . '/thenetworks/admin/function/member-check.php';
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    ?>

    <div style="display:block" id="networkersbox" class="networkersbox">
        <form id='myForm' action='<?php echo $url; ?>' method='post' enctype='multipart/form-data'>
           <div class="wrap">
                <h2>New Member</h2>
            </div><br><br>

            <div class="memberlogobox">

                <label>Status:</label><br>
                    <select id="memberstatus" name="memberstatus" style="margin-top:5px">
                        <option value="Potential Member" selected>Potential Member</option>
                        <option value="Scheduled Visitor">Scheduled Visitor</option>
                        <option value="Active Visitor">Active Visitor</option>
                        <option value="Active Member">Active Member</option>
                        <option value="Past Member">Past Member</option>
                </select><br><br><br>

                <label>First Visit:</label><br>
                <input style="width:200px" type="date" id="firstvisit" name="firstvisit">
                <p>Please choose the date of the member's initial visit.</p>

            </div>

            <br><br>

            <div class="memberlogobox">

                <h2 style="font-size:22px"><b>Profile Information</b></h2><br>

                <label>First Name:<spam style="color:red"> *</spam></label><br>
                <input id="firstName" name="firstName" type="text"><br><br>

                <label>Last Name:<spam style="color:red"> *</spam></label><br>
                <input id="lastName" name="lastName" type="text"><br><br>

                <label>Email:</label><br>
                <input id="email" name="email" type="text"><br><br>

                <label>Phone:</label><br>
                <div id="memberphone">
                    <input class="phone" name="phone[]" type="text"><br>
                </div>
                <div class="networkersbuttom bg-info" onclick="addnewphone()" >New Phone</div>
                <br>
            </div>

            <br><br>

            <div class="memberlogobox">
                <?php
                User_Image_Box();
                ?>
            </div>

            <br><br>

            <div class="memberlogobox">
                <?php
                // Multiple selection and nothing selected.
                Group_Box($groups, true);
                ?>
            </div>

            <br><br>

            <div class="memberlogobox">
                <h2 style="font-size:22px"><b>Company Information</b></h2><br>
                <label>Business Name:<spam style="color:red"> *</spam></label><br>
                <input id="businessname" name="businessname" type="text"><br>

                <?php

                Industry_Box($groups, true);

                $logoHtml = member_logo();
                echo $logoHtml;

                ?>

                <br><br>

                <?php 
                $socialmediaHtml = member_social_media();
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
                <input id="streetaddress1" name="streetaddress1" type="text"><br>
                <input id="streetaddress2" name="streetaddress2" type="text"><br><br>

                <label>Suburb:</label><br>
                <input id="suburb" name="suburb" type="text"><br><br>

                <div class="d-flex">
                    <label style="width:70%">City:</label>
                    <label style="width:calc(30% - 10px);margin-left:10px">Postal code:</label>
                </div>
                <div class="d-flex">
                    <input id="city" name="city" style="width:70%" type="text">
                    <input id="postalcode" name="postalcode" style="width:calc(30% - 10px);margin-left:10px" type="text">
                </div>

                <br>
            </div>

            <br><br>

            <div class="memberlogobox">
                <?php
                // Multiple selection and nothing selected.
                Referedby_Box($members, true);
                ?>
            </div>

            <br><br>

            <div class="memberlogobox">

                <h2 style="font-size:22px"><b>Payment Preference</b></h2>
                <input style="width:10px" type="radio" id="N/A" name="payment" value="N/A" checked>
                <label for="n/a">N/A</label><br><br>
                <input style="width:10px" type="radio" id="1month" name="payment" value="1 Month @ $50+GST">
                <label for="1month">1 Month @ $50+GST</label><br><br>
                <input style="width:10px" type="radio" id="3months" name="payment" value="3 Months @ $150+GST">
                <label for="3months">3 Months @ $150+GST</label><br><br>
                <input style="width:10px" type="radio" id="6months" name="payment" value="6 Months @ $300+GST">
                <label for="6months">6 Months @ $300+GST</label><br><br>
                <input style="width:10px" type="radio" id="12months" name="payment" value="12 Months @ $600+GST">
                <label for="12months">12 Months @ $600+GST</label><br>
                <br>
            </div>

            <br><br>   

            <div class="memberlogobox">

                <h2 style="font-size:22px"><b>Permissions</b></h2>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="paymentcheckbox" name="paymentcheckbox"></div>
                    <div style="margin-top:3px"><spam >By joining as a member I give "The Networkers" permission to generate an invoice which is billed in advance for the period I select.</spam></div>
                </div>
                <br>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="newslettercheckbox" name="newslettercheckbox"></div>
                    <div style="margin-top:3px"><spam>I give permission for The Networkers to send me 'Networkers' email updates (approx 1-2 monthly).</spam></div>
                </div>
                <br>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="businessinformationcheckbox" name="businessinformationcheckbox"></div>
                    <div style="margin-top:3px"><spam>By joining as a member I give "The Networkers" permission to use my business information for a website profile & in soclal media etc.</spam></div>
                </div>
                <br>
                <div class="d-flex">
                    <div><input style="width:10px" type="checkbox" id="agreecheckbox" name="agreecheckbox"></div>
                    <div style="margin-top:3px"><spam>I agree that my details are correct and I have been given an introduction brochure.</spam></div>
                </div>

            </div>
            

        </form>
        <br><br>
    </div>

    <div class='networkersbuttom' onclick='membercheck("<?php echo $membercheckurl; ?>")' >Create</div>

<?php
}

?>