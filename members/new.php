<?php

// What is showing on Annoucement menu on wordpress admin menu.
function my_menu_networkers_members_new() {

     $plugin_url = plugin_dir_url( __FILE__ );
     wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
	 wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

    echo '
    <div class="memberbox">
        <div class="wrap">
            <h2>New Member</h2>
        </div><br>

        <label>Business Name:</label><br>
        <input id="businessName" type="text"><br><br>

        <label>First Name:</label><br>
        <input id="firstName" type="text"><br><br>

        <label>Last Name:</label><br>
        <input id="lastName" type="text"><br><br>

        <label>Email:</label><br>
        <input id="email" type="text"><br><br>

        <label>Phone:</label><br>
        <div id="memberphone">
            <input class="phone" type="text"><br>
        </div>
        <div class="memberbuttom" onclick="addnewphone()" >Add another phone</div>

        <div class="membertitles">Networking Group</div>
        <p>Please select the group(s) this member belongs to</p>
        <input class="membergroup" type="text"><br>
        <div class="membergroups"></div>

        <div class="membertitles" style="margin-top:30px">Industries</div>
        <p>Please select the Industries this member belongs to</p>
        <input class="industry" type="text"><br>
        <div class="industries"></div>

        <div class="membertitles" style="margin-top:30px">Referred by</div>
        <p>If an existing member referred this member, please enter their name here.</p>
        <input class="referred" type="text"><br>
        <div class="referredby"></div>

    </div>
    ';

}
	
	// echo '<label class="switch">';
    //     if($status == "true"){
    //         echo '<input id="status" onclick="myFunction()" type="checkbox" checked>';
    //     }else{
    //         echo '<input id="status" onclick="myFunction()" type="checkbox">';
    //     }
    //     echo '<span class="slider round"></span>';
    // echo '</label><br><br>';
    
    // echo "<div id='announcementplugininformation' class='wrap' style='display:$statusdisplay'>";
    
    //     echo '<div class="wrap">';
    //         echo '<h3>Display</h3>';
    // 	echo '</div>';
        
    //     if($descriptiontab == "true"){
    //         echo '<input type="checkbox" id="descriptiontab" name="descriptiontab" checked>';
    //     }else{
    //         echo '<input type="checkbox" id="descriptiontab" name="descriptiontab">';
    //     }
    //     echo '<label for="descriptiontab">Show on Description Tab</label><br><br>';

    //     echo '<div class="wrap">';
    //         echo '<h3>Title</h3>';
    // 	echo '</div>';

    //     echo "<input type='text' id='title' name='title' value='$title'><br><br>";

    //     echo '<div class="wrap">';
    //         echo '<h3>Shortcode</h3>';
    // 	echo '</div>';

    //     echo "<div>Post the shortcode anywhere on the product page. <br> [bm_woo_pdf]</div><br>";

    //     echo "<input type='number' id='margintop' name='margintop' value='$margintop'>";
    //     echo '<label for="margintop"> Margin Top</label><br><br>';

    //     echo "<input type='number' id='marginbottom' name='marginbottom' value='$marginbottom'>";
    //     echo '<label for="marginbottom"> Margin Bottom</label><br><br>';

    //     echo "<input type='number' id='paddingtop' name='paddingtop' value='$paddingtop'>";
    //     echo '<label for="paddingtop"> Paddingn Top</label><br><br>';

    //     echo "<input type='number' id='paddingbottom' name='paddingbottom' value='$paddingbottom'>";
    //     echo '<label for="paddingbottom"> Paddingn Bottom</label><br><br>';


    //     echo '<div class="wrap">';
    //     echo '<h3>Font-Size</h3>';
    //     echo '</div>';

    //     echo "<input type='number' id='fontsizetitle' name='fontsizetitle' value='$fontsizetitle'>";
    //     echo '<label for="fontsizetitle"> Box Title</label><br><br>';

    //     echo "<input type='number' id='fontsizepdftitle' name='fontsizepdftitle' value='$fontsizepdftitle'>";
    //     echo '<label for="fontsizepdftitle"> PDF Title</label><br><br>';

    //     echo '<div class="wrap">';
    //         echo '<h3>Color</h3>';
    // 	echo '</div>';

    //     echo "<input type='color' id='titlepdfcolor' name='titlepdfcolor' value='$titlecolor'>";
    //     echo '<label for="titlepdfcolor"> Box Title Color</label><br><br>';

    //     echo "<input type='color' id='pdftitlecolor' name='pdftitlecolor' value='$pdftitlecolor'>";
    //     echo '<label for="pdftitlecolor"> PDF Title Color</label><br><br>';

    //     echo "<input type='color' id='backgroundpdfcolor' name='backgroundpdfcolor' value='$background'>";
    //     echo '<label for="backgroundpdfcolor"> Background Color</label><br><br>';

    //     echo '<div class="wrap">';
    //         echo '<h3>PDF Icon</h3>';
    // 	echo '</div>';

    //     if($pdficon == "1"){
    //         echo "<input type='radio' id='pdf1' name='icon' value='1' checked>";
    //     }else{
    //         echo "<input type='radio' id='pdf1' name='icon' value='1'>";
    //     }
    //     $backgroundimage01url =  $plugin_url . 'img/icon1.png';
    //     echo "<img src='$backgroundimage01url' alt='pdf icon' style='width:90px;height:90px;'>";
    
    //     if($pdficon == "2"){
    //         echo "<input type='radio' id='pdf2' name='icon' value='2' checked>";
    //     }else{
    //         echo "<input type='radio' id='pdf2' name='icon' value='2'>";
    //     }
    //     $backgroundimage02url =  $plugin_url . 'img/icon2.png';
    //     echo "<img src='$backgroundimage02url' alt='pdf icon' style='width:90px;height:90px;'>";
    
    //     if($pdficon == "3"){
    //         echo "<input type='radio' id='pdf3' name='icon' value='3' checked>";
    //     }else{
    //         echo "<input type='radio' id='pdf3' name='icon' value='3'>";
    //     }
    //     $backgroundimage03url =  $plugin_url . 'img/icon3.png';
    //     echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'><br><br>";

    //     if($pdficon == "4"){
    //         echo "<input type='radio' id='pdf4' name='icon' value='4' checked>";
    //     }else{
    //         echo "<input type='radio' id='pdf4' name='icon' value='4'>";
    //     }
    //     $backgroundimage03url =  $plugin_url . 'img/icon4.png';
    //     echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'>";

    //     if($pdficon == "5"){
    //         echo "<input type='radio' id='pdf5' name='icon' value='5' checked>";
    //     }else{
    //         echo "<input type='radio' id='pdf5' name='icon' value='5'>";
    //     }
    //     $backgroundimage03url =  $plugin_url . 'img/icon5.png';
    //     echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'><br><br>";

    //     if($pdficon == "6"){
    //         echo "<input type='radio' id='pdf6' name='icon' value='6' checked>";
    //     }else{
    //         echo "<input type='radio' id='pdf6' name='icon' value='6'>";
    //     }
    //     $backgroundimage03url =  $plugin_url . 'img/icon6.png';
    //     echo "<img src='$backgroundimage03url' alt='pdf icon' style='width:90px;height:90px;'><br><br>";
    
    // echo '</div><br>';
    
    // echo '<div class="wrap">';
    //     echo "<button id='announcementbutton' onclick='buttonsave(\"$jsonurledit\")' style='width:80px;height:35px;'>Save</button></a>";
    // echo '</div>';

?>

