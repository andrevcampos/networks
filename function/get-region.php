<?php
function Get_Region($id) {
    $region   = get_post( $id );
    $obj = new region();
    $obj->ID = $region->ID;
    $obj->post_title = $region->post_title;
    return $obj;
}
?>