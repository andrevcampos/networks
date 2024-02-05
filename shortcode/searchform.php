<?php
function search_form() {
    ob_start();
    //$type = $_GET['type'];
    ?>
    
    <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/members/')); ?>">
        <!-- Select box for "type" parameter -->
        <!-- <label>
            <span class="screen-reader-text" ><?php echo esc_html__('Type:', 'your-theme-text-domain'); ?></span>
            <select name="type" style="height: 41px; background-color: #f1f2f3; border: none;">
                <?php
                if ($type == "business") {
                    echo '<option value="business" selected>Business Name</option>';
                } else {
                    echo '<option value="business">Business Name</option>';
                }
                if ($type == "member") {
                    echo '<option value="member" selected>Member Name</option>';
                } else {
                    echo '<option value="member">Member Name</option>';
                }
                if ($type == "industry") {
                    echo '<option value="industry" selected>Industry</option>';
                } else {
                    echo '<option value="industry">Industry</option>';
                }
                ?>
            </select>
        </label> -->

        <label>
            <span class="screen-reader-text"><?php echo _x('Search for:', 'label', 'your-theme-text-domain'); ?></span>
            <input type="search" class="search-field" placeholder="<?php echo esc_attr_x('Search …', 'placeholder', 'your-theme-text-domain'); ?>" value="<?php echo get_search_query(); ?>" name="search" style="height: 40px; background-color: #f1f2f3; border: none;" />
        </label>

        <button type="submit" class="search-submit">
            <i class="fas fa-search "></i>
        </button>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode('searchform', 'search_form');
?>