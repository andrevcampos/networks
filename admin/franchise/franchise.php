<?php

function networkers_franchise() {

    include ABSPATH . '/wp-content/plugins/thenetworks/admin/function/popup.php';
    wp_enqueue_style( 'admincss', plugins_url() . '/thenetworks/public/css/admin.css');
    wp_enqueue_script( 'mainjs', plugins_url() . '/thenetworks/public/js/js.js' );
    wp_enqueue_script( 'functionjs', plugins_url() . '/thenetworks/public/js/functions.js' );

    $exampleListTable = new Example_List_Table();
    $exampleListTable->prepare_items();
    echo '<div id="networkersbox" class="wrap">';
        echo '<h1>The Networkers</h1><br>';
        echo '<div id="icon-users" class="icon32"></div>';
        echo '<h2>Franchise List</h2>';
        $exampleListTable->display();
    echo '</div>';
    
}

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Create a new table class that will extend the WP_List_Table
 */
class Example_List_Table extends WP_List_Table
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

    /**
     * Override the parent columns method. Defines the columns to use in your listing table
     *
     * @return Array
     */
    public function get_columns()
    {
        $columns = array(
            'id' => 'ID',
            'login' => 'Login',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
        );

        return $columns;
    }

    function column_login($item)
    {
        $plugin_url = plugin_dir_url( __FILE__ );
        $removeurl = $plugin_url . 'delete.php';
        $actions = array(
            'edit' => sprintf('<a href="?page=networkers-franchise-update&id=%s">%s</a>', $item['id'], __('Edit', 'cltd_example')),
            'delete' => sprintf('<div style="display: inline-block;color:red;cursor: pointer;" onclick="PopupRemoveBox(\'Remove Franchise\',%s,\'%s\',\'%s\')">Remove</div>',  $item['id'], $item['login'], $removeurl),
        );

        return sprintf('%s %s',
            $item['login'],
            $this->row_actions($actions)
        );

    }

    

    /**
     * Define which columns are hidden
     *
     * @return Array
     */
    public function get_hidden_columns()
    {
        return array();
    }

    /**
     * Define the sortable columns
     *
     * @return Array
     */
    public function get_sortable_columns()
    {
        return array('id' => array('id', false));
    }

  
    private function table_data()
    {
        $args = array(
            'role' => "franchise",
            'orderby' => "display_name",
            'order' => "ASC"
          );
        $latest_posts = get_users( $args );
        $data = array();
        if(count($latest_posts) > 0 ){
            foreach($latest_posts as $post) {
                $first_name = get_user_meta( $post->ID, 'first_name', true );
                $last_name = get_user_meta( $post->ID, 'last_name', true );
                $phone = get_user_meta( $post->ID, 'phone', true );
                $data2 = array(
                    'id' => $post->ID,
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'login' => $post->user_login,
                    'email' => $post->user_email,
                    'phone' => $phone,
                    );
                array_push($data, $data2);
            }
            
        }

        return $data;
    }

    /**
     * Define what data to show on each column of the table
     *
     * @param  Array $item        Data
     * @param  String $column_name - Current column name
     *
     * @return Mixed
     */
    public function column_default( $item, $column_name )
    {
        switch( $column_name ) {
            case 'id':
            case 'login':
            case 'first_name':
            case 'last_name':
            case 'email':
            case 'phone':
                return $item[ $column_name ];

            default:
                return print_r( $item, true ) ;
        }
    }

    /**
     * Allows you to sort the data by the variables set in the $_GET
     *
     * @return Mixed
     */
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

?>