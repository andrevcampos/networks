<?php

include ABSPATH . '/wp-content/plugins/thenetworks/admin/regions/new-form.php';
include ABSPATH . '/wp-content/plugins/thenetworks/admin/regions/update-form.php';

function networkers_region() {

    $plugin_url = plugin_dir_url( __FILE__ );
    $removeurl = $plugin_url . 'delete.php';
    $editurl = $plugin_url . 'update.php';
    wp_enqueue_style( 'membercss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'js', plugins_url() . '/thenetworks/public/js/js.js' );

    //POPUP MESSAGE BOX
    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';

    $message = $_GET["message"];
    $messagetitle = $_GET["messagetitle"];
    
    //if(!$message){

    $exampleListTable = new Region_List_Table();
    $exampleListTable->prepare_items();
    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Region List</h2>';
        $exampleListTable->display();
    echo '</div>';

    // echo '<div id="regionremove" style="display:none" class="wrap">';
    //     echo '<h2>Remove Region</h2>';
    //     echo '<h3 id="textregionremove">Region Name: </h3>';
    //     echo '<p>Type DELETE to remove this region</p>';
    //     echo '<input id="inputremoveregion" type="text" name="inputremoveregion" onKeyUp="regionremovecheck()">';
    //     echo "<form id='myFormRemove' action='$removeurl' method='post'>";
    //         echo '<input id="regionremoveid" type="text" name="regionremoveid" style="display:none" value="">';
    //         echo "<button type='submit' id='buttonremoveregion' style='display:none;cursor:pointer;padding:10px;background-color:#d63638;color:white;width:100px;height:40px;text-align:center;margin-top:20px'>Remove</button>";
    //     echo '</form>';
    //     echo "<div id='buttongobackregion' onclick='regiongoback()' style='display:block;cursor: pointer;padding:10px;background-color:#6495ed;color:white;width:100px;height:20px;text-align:center;margin-top:20px'>Go Back</div>";
    // echo '</div>';



    // }else{
    //     echo '<div id="regionmessage" style="display:block" >';
    //         echo "<h2>$messagetitle</h2>";
    //         echo "<h4>$message</h4>";
    //     echo '</div>';
    // }

}


if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Region_List_Table extends WP_List_Table
{

    public function prepare_items()
    {
        $columns = $this->get_columns();
        $hidden = $this->get_hidden_columns();
        $sortable = $this->get_sortable_columns();

        $data = $this->table_data();
        usort( $data, array( &$this, 'sort_data' ) );

        $perPage = 5;
        $currentPage = $this->get_pagenum();
        $totalItems = count($data);

        $this->set_pagination_args( array(
            'total_items' => $totalItems,
            'per_page'    => $perPage
        ) );

        $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

        $this->_column_headers = array($columns, $hidden, $sortable);
        $this->items = $data;
    }


    public function get_columns()
    {
        $columns = array(
            'id' => 'ID',
            'name' => 'name',
        );
        return $columns;
    }

    function column_name($item)
    {
        $actions = array(
            'edit' => sprintf('<a href="?page=networkers-region-update&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
            //'delete' => sprintf('<div style="display: inline-block;color:red;cursor: pointer;" onclick="PopupRemoveBox(\'Remove Group\',%s,\'%s\',\'%s\')">Remove</div>',  $item['id'], $item['name'], $removeurl),
            'delete' => sprintf('<div style="display: inline-block;color:red;cursor: pointer;" onclick="regionremovebox(%s,\'%s\')">Remove</div>',  $item['id'],  $item['name']),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );

    }

    public function get_hidden_columns()
    {
        return array();
    }

    public function get_sortable_columns()
    {
        return array('name' => array('name', false),'id' => array('id', false));
    }

  
    private function table_data()
    {
        $args = array(
            'post_type' => "network-region",
            'posts_per_page' => -1
          );
        $latest_posts = get_posts( $args );
        $data = array();
        if(count($latest_posts) > 0 ){
            foreach($latest_posts as $post) {
                $data2 = array(
                    'id' => $post->ID,
                    'name' => $post->post_title,
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
}

add_action('admin_head', 'my_admin_column_width');
function my_admin_column_width() {
    echo '<style type="text/css">
        .column-id { text-align: left; width:100px !important; overflow:hidden }
    </style>';
}

?>