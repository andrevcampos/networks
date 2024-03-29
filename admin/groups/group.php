<?php

function networkers_group() {
    
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $exampleListTable = new Group_List_Table();
    $exampleListTable->prepare_items();
    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Group List</h2>';
        $exampleListTable->search_box('Search', 'search_id');
        $exampleListTable->display();
    echo '</div>';
    
}

//Table List
if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Group_List_Table extends WP_List_Table
{

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort($data, array(&$this, 'sort_data'));

        $perPage = 50;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        // Process search query if set
        $search = isset($_REQUEST['s']) ? sanitize_text_field($_REQUEST['s']) : '';

        if (!empty($search)) {
            $data = array_filter($data, function ($item) use ($search) {
                foreach ($item as $column_value) {
                    if (stripos($column_value, $search) !== false) {
                        return true;
                    }
                }
                return false;
            });
        }

        $totalItems = count($data);

        $this->set_pagination_args(array(
            'total_items' => $totalItems,
            'per_page' => $perPage
        ));

        $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }


    public function get_columns()
    {
        $columns = array(
            'id' => 'ID',
            'name' => 'Name',
            'region' => 'Region',
            'time' => 'Time',
            'city' => 'City',
            'facilitator' => 'Facilitator',
            'status' => 'Status',
        );
        return $columns;
    }

    function column_name($item)
    {
        $plugin_url = plugin_dir_url( __FILE__ );
        $removeurl = $plugin_url . 'delete.php';
        $actions = array(
            'edit' => sprintf('<a href="?page=networkers-group-update&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
            'delete' => sprintf('<div style="display: inline-block;color:red;cursor: pointer;" onclick="PopupRemoveBox(\'Remove Group\',%s,\'%s\',\'%s\')">Remove</div>',  $item['id'], $item['name'], $removeurl),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );

    }

    public function get_hidden_columns()
    {
        return array('id');
    }

    public function get_sortable_columns()
    {
        return array('name' => array('name', false),'region' => array('region', false));
    }

  
    private function table_data()
    {
        //check user role
        $user_role = Get_User_Role();

        $args = array(
            'post_type' => "network-group",
            'posts_per_page' => -1
          );
        $latest_posts = get_posts( $args );
        $data = array();
        if(count($latest_posts) > 0 ){
            foreach($latest_posts as $post) {
                
                $weekday = get_post_meta( $post->ID, 'weekday', true );
                $start = get_post_meta( $post->ID, 'start', true );
                $finish = get_post_meta( $post->ID, 'finish', true );
                $time = $weekday . " " . $start . " - " . $finish;
                $city = get_post_meta( $post->ID, 'city', true );
                $status = get_post_meta( $post->ID, 'status', true );

                $regions = get_post_meta( $post->ID, 'regions', true );
                $regions = get_post_meta( $post->ID, 'regions', true );
                $regionname = get_post( $regions )->post_title;

                $facilitatorid = get_post_meta( $post->ID, 'facilitator', true );
                $facilitator = get_the_title($facilitatorid);

                //Dont have permition
                if ($user_role == 'franchise'){
                    $userregionids = get_user_meta( $user->ID, 'region', false );
                    if (!in_array($regions, $userregionids)) continue;
                }

                $data2 = array(
                    'id' => $post->ID,
                    'name' => $post->post_title,
                    'region' => $regionname,
                    'time' => $time,
                    'city' => $city,
                    'facilitator' => $facilitator,
                    'status' => $status,
                    );
                array_push($data, $data2);
            }
        }
        return $data;
    }

    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'name':
            case 'region':
            case 'time':
            case 'city':
            case 'facilitator':
            case 'status':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    private function sort_data( $a, $b )
    {
        // Set defaults
        $orderby = 'id';
        $order = 'desc';

        // If orderby is set, use this as the sort column
        if(!empty($_GET['orderby']))
        {
            $orderby = $_GET['orderby'];
        }

        // If order is set use this as the order
        if(!empty($_GET['order']))
        {
            $order = $_GET['order'];
        }


        $result = strcmp( $a[$orderby], $b[$orderby] );

        if($order === 'asc')
        {
            return $result;
        }

        return -$result;
    }

    function search_box($text, $input_id) {
        if (empty($_REQUEST['s']) && !$this->has_items()) {
            return;
        }
    
        $input_id = $input_id . '-search-input';
    
        if (!empty($_REQUEST['orderby'])) {
            echo '<input type="hidden" name="orderby" value="' . esc_attr($_REQUEST['orderby']) . '" />';
        }
        if (!empty($_REQUEST['order'])) {
            echo '<input type="hidden" name="order" value="' . esc_attr($_REQUEST['order']) . '" />';
        }
        if (!empty($_REQUEST['post_mime_type'])) {
            echo '<input type="hidden" name="post_mime_type" value="' . esc_attr($_REQUEST['post_mime_type']) . '" />';
        }
        if (!empty($_REQUEST['detached'])) {
            echo '<input type="hidden" name="detached" value="' . esc_attr($_REQUEST['detached']) . '" />';
        }
        ?>
        <form method="get" action="<?php echo esc_url(admin_url('admin.php')); ?>">
            <input type="hidden" name="page" value="networkers-group" />
            <p class="search-box">
                <label class="screen-reader-text" for="<?php echo esc_attr($input_id); ?>"><?php echo $text; ?>:</label>
                <input type="search" id="<?php echo esc_attr($input_id); ?>" name="s" value="<?php echo esc_attr(isset($_REQUEST['s']) ? $_REQUEST['s'] : ''); ?>" />
                <?php submit_button($text, '', '', false, array('id' => 'search-submit')); ?>
            </p>
        </form>
        <?php
    }
}

?>