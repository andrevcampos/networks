<?php
function Order_Region($regions, $ordertype) {

    $regionarray = [];
    foreach($regions as $region) {
        $id = $region->ID;
        $title = $region->post_title;
        $order = get_post_meta( $region->ID, 'order', true );
        $newObject = (object) [
            'ID' => $id,
            'post_title' => $title,
            'order' => $order,
        ];
        array_push($regionarray, $newObject);
    }
    
    if($ordertype == "order"){usort($regionarray, 'sortByRegionOrder');}
    if($ordertype == "title"){usort($regionarray, 'sortByRegionTitle');}
    if($ordertype == "id"){usort($regionarray, 'sortByRegionID');}

    return $regionarray;
}

function sortByRegionOrder($a, $b) {
    return strcmp($a->order, $b->order);
}
function sortByRegionTitle($a, $b) {
    return strcmp($a->post_title, $b->post_title);
}
function sortByRegionID($a, $b) {
    return strcmp($a->ID, $b->ID);
}

function sortByOrder($a, $b) {
    return strcmp($a->order, $b->order);
}
function sortByPostTitle($a, $b) {
    return strcmp($a->post_title, $b->post_title);
}
function sortByID($a, $b) {
    return strcmp($a->ID, $b->ID);
}

?>