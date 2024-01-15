<?php
function Get_Region($id) {
    $region   = get_post( $id );
    $obj = new region();
    $obj->ID = $region->ID;
    $obj->post_title = $region->post_title;
    $obj->status = get_post_meta( $region->ID, 'status', true );
    $obj->order = get_post_meta( $region->ID, 'order', true );
    return $obj;
}
?>