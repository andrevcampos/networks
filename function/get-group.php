<?php

function Get_Group($id) {

    $group   = get_post( $id );
    $obj = new group();
    $obj->ID = $group->ID;
    $obj->post_title = $group->post_title;
    $obj->status = get_post_meta( $group->ID, 'status', true );
    $obj->weekday = get_post_meta( $group->ID, 'weekday', true );
    $obj->start = get_post_meta( $group->ID, 'start', true );
    $obj->finsh = get_post_meta( $group->ID, 'finsh', true );
    $obj->description = get_post_meta( $group->ID, 'description', true );
    $obj->company = get_post_meta( $group->ID, 'lcompany', true );
    $obj->address1 = get_post_meta( $group->ID, 'address1', true );
    $obj->address2 = get_post_meta( $group->ID, 'address2', true );
    $obj->suburb = get_post_meta( $group->ID, 'suburb', true );
    $obj->city = get_post_meta( $group->ID, 'city', true );
    $obj->postcode = get_post_meta( $group->ID, 'postcode', true );
    $obj->regions = get_post_meta( $group->ID, 'regions', true );
    $obj->facilitator = get_post_meta( $group->ID, 'facilitator', true );
    
    $imageid = get_post_meta( $group->ID, 'imageid', true );
    $obj->imageid = $imageid;
    $imageurl = get_site_url()."/wp-content/uploads/".get_post_meta( $imageid, '_wp_attached_file', true );
    $obj->imageurl = $imageurl;
    return $obj;
}
?>