
<?php

// Variables 

// Includes
include(get_theme_file_path('/includes/front/enqueue.php'));
include(get_theme_file_path('/includes/front/head.php'));
include(get_theme_file_path('/includes/setup.php'));

// Hooks
add_action('wp_enqueue_scripts', 'u_enqueue');
// priority , order by 5 to top
add_action('wp_head', 'u_head', 5 );

//event that runs after our theme has been loaded
//it's one of the earliest hooks available
//loading styles in the editor must be performed in this hook, WP recommends setup Theme
add_action('after_setup_theme', 'u_setup_theme');

