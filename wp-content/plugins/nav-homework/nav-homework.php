<?php
/**
* Plugin Name: Nav Homework "Sweater" Post Type
* Plugin URI: https://github.com/arxpoetica/wp-homework
* Description: Dynamic page with customizable content. Content displayed is determined by data in a user cookie or url parameter.
* Version: 1.0
* Author: Robert Hall
* Author URI: https://arxpoetica.com/
**/

// NO LICENCE. 🤪

defined('ABSPATH') or die('Negative. It didn\'t go in. It deflected off the surface.');

class NavHomework {

	function __construct() {
		add_action('init', array($this, 'sweaters_post_type'));
		$this->templates = array();
	}

	function activate() {
		$this->sweaters_post_type();
		flush_rewrite_rules();
	}

	function deactivate() {
		flush_rewrite_rules();
	}

	function sweaters_post_type() {
		register_post_type('sweaters', ['public' => true, 'label' => 'Sweaters']);
	}

	function register() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue'));
	}

	function enqueue() {
		wp_enqueue_style('nav-homework-style', plugins_url('/assets/nav-homework.css', __FILE__));
		wp_enqueue_script('nav-homework-script', plugins_url('/assets/nav-homework.js', __FILE__));
	}

}

if (class_exists('NavHomework')) {
	$navHomework = new NavHomework();
	$navHomework->register();
}

// activation
register_activation_hook(__FILE__, array($navHomework, 'activate'));
// deactivation
register_deactivation_hook(__FILE__, array($navHomework, 'deactivate'));
