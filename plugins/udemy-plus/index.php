<?php
/*
* Plugin Name:       Udemy plus
* Plugin URI:        https://udemy.com
* Description:       A plugin for adding blocks to a theme.
* Version:           1.0.0
* Requires at least: 5.9
* Requires PHP:      7.2
* Author:            Grumin
* Author URI:        https://udemy.com
* Text Domain:       udemy-plus
* Domain Path:       /languages
*/

if(!function_exists('add_action')){
    echo 'Seems like you stumbled here by accident.';
    exit;
}

// Setup 
define('UP_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Includes

//glob returns an array
$rootFiles = glob(UP_PLUGIN_DIR . 'includes/*.php');
$subdirectoryFiles = glob(UP_PLUGIN_DIR . 'includes/**/*.php');
$allFiles = array_merge($rootFiles, $subdirectoryFiles);

foreach($allFiles as $filename){
    include_once($filename);
}


// Hooks
//plug ins have a dedicated function for running a function during activation caaled register Activation hook
//first argument is the path to the main plugin file
//next, we must provide the name of the function to call during activation
register_activation_hook(__FILE__, 'up_activate_plugin');

add_action('init', 'up_register_blocks');
add_action('rest_api_init', 'up_rest_api_init');
// WP recommends this hook for dynamic scripts
add_action('wp_enqueue_scripts', 'up_enqueue_scripts');
add_action('init', 'up_recipe_post_type');
add_action('cuisine_add_form_fields', 'up_cuisine_add_form_fields');

//211 tut
add_action('create_cuisine', 'up_save_cuisine_meta');//ok
add_action('cuisine_edit_form_fields', 'up_cuisine_edit_form_fields');//ok
add_action('edited_cuisine', 'up_save_cuisine_meta'); //OK
add_action('save_post_recipe', 'up_save_post_recipe');
