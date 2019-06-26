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
		add_filter('template_include', array($this, 'sweaters_archive_page'));
		add_filter('query_vars', array($this, 'add_query_vars_filter'));
		$this->templates = array();
	}

	function activate() {
		$this->sweaters_post_type();
		flush_rewrite_rules();
	}

	function deactivate() {
		flush_rewrite_rules();
	}

	function register() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue'));
	}

	function enqueue() {
		wp_enqueue_style('nav-homework-style', plugins_url('/assets/nav-homework.css', __FILE__));
		wp_enqueue_script('nav-homework-script', plugins_url('/assets/nav-homework.js', __FILE__));
	}

	function sweaters_post_type() {
		register_post_type('sweaters', [
			'public' => true,
			'labels' => ['name' => __('Sweaters'), 'singular_name' => __('Sweater')],
			'has_archive' => true,
		]);
	}

	function add_query_vars_filter($vars) {
		$vars[] = "sort";
		return $vars;
	}

	function sweaters_archive_page($template) {
		if(is_post_type_archive('sweaters')) {
			return WP_PLUGIN_DIR . '/' . plugin_basename(dirname(__FILE__)) . '/templates/archive-sweaters.php';
		}
		return $template;
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
