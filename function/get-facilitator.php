<?php
function Get_Facilitator($id) {
    $facilitator   = get_post( $id );
    $obj = new member();
    $obj->ID = $facilitator->ID;
    $obj->name = $facilitator->post_title;
    $obj->description = get_post_meta( $facilitator->ID, 'description', true );
    $obj->email = get_post_meta( $facilitator->ID, 'email', true );
    $obj->phone = get_post_meta( $facilitator->ID, 'phone', true );
    $imageid = get_post_meta( $facilitator->ID, 'imageid', true );
    $obj->imageid = get_post_meta( $facilitator->ID, 'imageid', true );
    $imageurl = get_site_url()."/wp-content/uploads/".get_post_meta( $imageid, '_wp_attached_file', true );
    $obj->imageurl = $imageurl;
    return $obj;
}
?>