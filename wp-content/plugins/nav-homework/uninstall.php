<?php

defined('WP_UNINSTALL_PLUGIN') or die('Negative. It didn\'t go in. It deflected off the surface.');

$sweaters = get_posts(array('post_type' => 'sweaters', 'numberposts' => -1));

foreach($sweaters as $sweater) {
	wp_delete_post($sweater->ID, true);
}

// // NUCLEAR OPTION if taxonomies, etc.
// global $wbdb;
// $wpdb->query( "DELETE FROM wp_posts WHERE post_type = 'sweaters'");
// $wpdb->query( "DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
// $wpdb->query( "DELETE FROM wp_terms_relationships WHERE object_id NOT IN (SELECT id FROM wp_posts)");
