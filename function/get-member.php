<?php
function Get_Member($id) {
    $member   = get_post( $id );
    $obj = new member();
    $obj->ID = $member->ID;
    $obj->businessname = $member->post_title;
    $obj->businessdescription = get_post_meta( $member->ID, 'businessdescription', true );
    $obj->status = get_post_meta( $member->ID, 'status', true );
    $obj->facilitator = get_post_meta( $member->ID, 'facilitator', true );
    $obj->firstname = get_post_meta( $member->ID, 'firstName', true );
    $obj->lastname = get_post_meta( $member->ID, 'lastName', true );
    $obj->firstvisit = get_post_meta( $member->ID, 'firstvisit', true );
    $obj->email = get_post_meta( $member->ID, 'email', true );
    $obj->phone = get_post_meta( $member->ID, 'phone', false );
    $obj->country = get_post_meta( $member->ID, 'country', true );
    $obj->address1 = get_post_meta( $member->ID, 'streetaddress1', true );
    $obj->address2 = get_post_meta( $member->ID, 'streetaddress2', true );
    $obj->suburb = get_post_meta( $member->ID, 'suburb', true );
    $obj->city = get_post_meta( $member->ID, 'city', true );
    $obj->postcode = get_post_meta( $member->ID, 'postalcode', true );
    $obj->payment = get_post_meta( $member->ID, 'payment', true );
    $obj->industry = get_post_meta( $member->ID, 'industry', false );
    $obj->group = get_post_meta( $member->ID, 'group', false );
    $imageid = get_post_meta( $member->ID, 'imageid', true );
    $imageurl = get_site_url()."wp-content/uploads/".get_post_meta( $imageid, '_wp_attached_file', true );
    $obj->imageurl = $imageurl;
    return $obj;
}
?>