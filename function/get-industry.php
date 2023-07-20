<?php
function Get_Industry($id) {
    $industry = get_post( $id );
    $obj = new industry();
    $obj->ID = $industry->ID;
    $obj->post_title = $industry->post_title;
    return $obj;
}
?>