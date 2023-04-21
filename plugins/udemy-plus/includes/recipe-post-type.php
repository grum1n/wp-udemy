<?php

function up_recipe_post_type(){
    $labels = array(
		'name'                  => _x( 'Recipes', 'Post type general name', 'udemy-plus' ),
		'singular_name'         => _x( 'Recipe', 'Post type singular name', 'udemy-plus' ),
		'menu_name'             => _x( 'Recipes', 'Admin Menu text', 'udemy-plus' ),
		'name_admin_bar'        => _x( 'Recipe', 'Add New on Toolbar', 'udemy-plus' ),
		'add_new'               => __( 'Add New', 'udemy-plus' ),
		'add_new_item'          => __( 'Add New Recipe', 'udemy-plus' ),
		'new_item'              => __( 'New Recipe', 'udemy-plus' ),
		'edit_item'             => __( 'Edit Recipe', 'udemy-plus' ),
		'view_item'             => __( 'View Recipe', 'udemy-plus' ),
		'all_items'             => __( 'All Recipes', 'udemy-plus' ),
		'search_items'          => __( 'Search Recipes', 'udemy-plus' ),
		'parent_item_colon'     => __( 'Parent Recipes:', 'udemy-plus' ),
		'not_found'             => __( 'No Recipes found.', 'udemy-plus' ),
		'not_found_in_trash'    => __( 'No Recipes found in Trash.', 'udemy-plus' ),
		'featured_image'        => _x( 'Recipe Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'udemy-plus' ),
		'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'udemy-plus' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'udemy-plus' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'udemy-plus' ),
		'archives'              => _x( 'Recipe archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'udemy-plus' ),
		'insert_into_item'      => _x( 'Insert into Recipe', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'udemy-plus' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this Recipe', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'udemy-plus' ),
		'filter_items_list'     => _x( 'Filter Recipes list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'udemy-plus' ),
		'items_list_navigation' => _x( 'Recipes list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'udemy-plus' ),
		'items_list'            => _x( 'Recipes list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'udemy-plus' ),
	);

	$args = array(
        // WP will render our labels in various locations on the WP dashboard
		'labels'             => $labels,
        // This option can toggle the visibility of the post ttype on the front end by default visitors are not able to view posts registered under this post type
        // We can set this option to true to give access to visitors on the front end
		'public'             => true,
        // WP will create a query on the front end by using the URL based on the URL
        // This option allows this post type to be accessible via a URL query
		'publicly_queryable' => true,
        // WP is capable of rendering an interface for managing this post type in the admin dashboard
        // By setting this option to false , we are responsible for providing a UI
		'show_ui'            => true,
        // The show in menu option will display a menu link in the admin dashboard
        // If we're going to allow users to modify a post type with the UI, you might as well provide a link, true for adding a menu link
		'show_in_menu'       => true,
        // this option works hand in hand with the publicly variable option ('publicly_queryable')
        //we can costumize the query parameter name with this option

        // For example , I'll add a comment with the following path 
        // ?recipe=pizza
        // From the homepage, we can filter the posts on the page by setting a query parameter to the URL
        //if this option is set to true, WP will set the name of the query parameter to the name of the post type. in our case, the post type will be called recipe.
        // However, we can override the name by setting this option to a string.
        // For example, let's say the name is called Tutorial
		// 'query_var'          => 'tutorial',
        // The query parameter would be updated to ?tutorial=pizza
        // The value effects, the query parameter name, in my opinion, using the same name as the post type make sense. We' leave this option as true
		'query_var'          => true,
        //This option allows us to modufy the URL for post types with an array.
        // inside this array we can set the slug
		// original 'rewrite' => array( 'slug' => 'books' ),
        // this option in not to be confused with the query var option
        // Both option are very similar, but with one core difference
        // The rewrite option modifies the path of the URL
        //For example, let's say we had a post called Pizza.
        // We can access the post with the following path : /recipe/pizza
        // The query var option focuses on filtering posts with query parameters, whereas the rewrite option uses paths.
		'rewrite'            => array( 'slug' => 'recipe' ), //recipe/pizza
        // The capability type option will configure the permissions of this post type
        // Registered users can have roles
        // Each role has a different set of capabilities, which are permissions for performing different actions
        // To make it simple, rather than using custom permissions, we can borrow permissions for posts.
        //By setting this option to posts, we are using the same permissions as regular posts
		'capability_type'    => 'post', // for now leave this option to its original value
        // this option allows users to view older posts
        // I think enabling this option is preferable for most scenarios
        // We should allow users to view older recipes
		'has_archive'        => true,
        //WP recommends disabling this option,  by enabling this option Recipes may have parent recipes
        //Typically, a recipe can stand on its own , but there isn't reason to enabling tis option
		'hierarchical'       => false,
        // The menu position option will configure the location of the menu in the admin dashboard
        // The lower the number, the higher the menu will appear
        //For example, setting this option to one will position the menu at the top
        // I prefer to position it bellow the pages menu 
        // let's set this option to 20
		// original : 'menu_position'      => null,
		'menu_position'      => 20,

        //WP has various features for post types
        // We're required to use everything a post type can enable and disable specific editor features such as the title
        // In this array we are given examples of features we can enable
        // We are modifying to removing comments
		// original : 'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
        // Item recipes are not going to support comments
		'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
        // with this single option, the post can be saved via the rest API
        // WP will create a custom endpoint for this post type , 
        //should appear by enabling the Rest API
        // WP will switch to Guttenberg editor for editting posts
        // This feature allows us to insert blocks into the editor
        'show_in_rest' => true,
        //we can add a description for our post type by adding the description option
        'description' => __('A custom post type for recipes', 'udemy-plus'),
        //enabling categories and tags for our custom post type
        //By adding these two items, the post type will support categories and tags
        // dashboard sidebar appears Categories and Tags
        // While the categories and tags can be added to our post type, cliants will be able to organize their recipes with these options
        // WP will provide a UI for helping us manage these Taxonomies
        'taxonomies' => ['category', 'post_tag']
	);



    // The last step is to call the register post type function
    // The first argument of this function is the name of our post type
    // The second argument is an array of options which has been outsourced to a variable, we do not modify this option.
	register_post_type( 'recipe', $args );

    // the register taxonomy function
    // dashboard sidebar , appears sub menu = cuisine
    // This option will event appear in the Gutenberg Editor
    // WP will dunamically load taxonomies after the content has been rendered
    // deactivate plugin , and reactivate
    register_taxonomy('cuisine', 'recipe', [
        'label' => __('Cuisine', 'udemy-plus'),
        'rewrite' => ['slug' => 'cuisine'],
        'show_in_rest' => true
    ]);
}