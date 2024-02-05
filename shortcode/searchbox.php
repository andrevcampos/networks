<?php
function search_box() {
    ob_start();

    wp_enqueue_script( 'shortcodejs', plugins_url() . '/thenetworks/public/js/shortcode.js' );

    // Gets all industry in order ASC
    $industrys = Get_Industrys();

    // Gets all Regions and order by order
    $regions = Get_All_Regions();
    $regionarray = Order_Region($regions, "order");
    
    $search = $_GET['search'];
    // $category = $_GET['category'];
    // if(!$category){$category = "business";}
    $sinduntry = $_GET['industry'];
    $sregion = $_GET['region'];

    ?>
    <form method="get" action="<?php echo esc_url(home_url('/members/')); ?>">
    <div class='search-box'>

        <!-- <div class='search-category'>
            <?php
            if($category == "business"){
                echo "<div id='cbusiness' onclick='searchcategorybutton(\"business\")' class='search-category-button' style='background-color:#5F259F;color:white;'>Business Name</div>";
            }else{
                echo "<div id='cbusiness' onclick='searchcategorybutton(\"business\")' class='search-category-button'>Business Name</div>";
            }
            if($category == "member"){
                echo " <div id='cmember' onclick='searchcategorybutton(\"member\")' class='search-category-button' style='background-color:#5F259F;color:white;'>Member Name</div>";
            }else{
                echo " <div id='cmember' onclick='searchcategorybutton(\"member\")' class='search-category-button'>Member Name</div>";
            }
            if($category == "industry"){
                echo "<div id='cindustry' onclick='searchcategorybutton(\"industry\")' class='search-category-button' style='background-color:#5F259F;color:white;'>Industry</div>";
            }else{
                echo "<div id='cindustry' onclick='searchcategorybutton(\"industry\")' class='search-category-button'>Industry</div>";
            }
            echo "<div style='margin-left:auto;padding:15px;'><strong>Search Form</strong></div>";
            ?>
        </div> -->
        <!-- <input id='categoryimput' name='category' style='display:none' value='<?php echo $category ?>' /> -->

        <!-- <div style="display:flex;margin-top:20px;">
            <?php
            if($category == "business"){
                echo '<spam id="spamtext" style="margin-left:15px;">Search by Business name</spam>';
            }
            if($category == "member"){
                echo '<spam id="spamtext" style="margin-left:15px;">Search by Member name</spam>';
            }
            if($category == "industry"){
                echo '<spam id="spamtext" style="margin-left:15px;">Search by Industry</spam>';
            }
            ?>
            
        </div> -->
        <div style="display:flex;margin-top:45px;">
            <input id="searchbox" type="search" placeholder="Search …" name="search" value="<?php echo $search ?>" style="width:calc(100% - 30px);height:40px;background-color:#f1f2f3;border:none;margin-left:15px;margin-right:15px" />
        </div>

        <div style="display:flex;justify-content:center;margin-top:15px;">
            <select id="industrybox" name="industry" style="height:41px;background-color:#f1f2f3;max-width:calc(100% - 30px)">
                <?php

                if ($sinduntry == "all") {
                    echo '<option value="all" selected>All Industries</option>';
                } else {
                    echo '<option value="all">All Industries</option>';
                }

                foreach ($industrys as $industry) {
                    if ($industry->ID == $sinduntry) {
                        echo "<option value='$industry->ID' selected>$industry->post_title</option>";
                    } else {
                        echo "<option value='$industry->ID'>$industry->post_title</option>";
                    }
                }
                
                ?>
            </select>
        </div>


        <div style="display:flex;justify-content:center;margin-top:15px;">
            <select id="regionbox" name="region" style="height:41px;background-color:#f1f2f3;max-width:calc(100% - 30px)">
                <?php
                if ($sregion == "all") {
                    echo '<option value="all" selected>All Regions</option>';
                } else {
                    echo '<option value="all">All Regions</option>';
                }

                foreach ($regionarray as $region) {
                    if ($region->ID == $sregion) {
                        echo "<option value='$region->ID' selected>$region->post_title</option>";
                    } else {
                        echo "<option value='$region->ID'>$region->post_title</option>";
                    }
                }
                ?>
            </select>
        </div>

        <div  style="display:flex;justify-content:center;margin-top:10px">
            <button type="submit" class="search-box-submit" style="width:calc(100% - 30px);">
                <i class="fas fa-search"></i>
                <spam>Search</spams>
            </button>
        </div>

    </div>
    </form>
    
    <?php
    return ob_get_clean();
}
add_shortcode('searchbox', 'search_box');
?>