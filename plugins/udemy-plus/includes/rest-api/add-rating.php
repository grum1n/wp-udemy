<?php

function up_rest_api_add_rating_handler($request){
    $response = ['status' => 1];
    $params = $request->get_json_params();

    if(
        !isset($params['rating'], $params['postID']) ||
        empty($params['rating']) ||
        empty($params['postID'])
    ){
        return $response;
    }

    $rating = round(floatval($params['rating']), 1);
    $postID = absint($params['postID']);
    $userID = get_current_user_id();

    global $wpdb;
   
    // get_results() - for counting records
    $wpdb->get_results(
        // prepare() alloww us to write prepared statements
        // they are a feature in SQL for separating a query from data
        // aprepared statement will sanitize our data by stripping away harmful characters, thus reducing the likelihood of an attack on database
        // This function will return a secure query
        // I always recommend preparing a query before executing it
        $wpdb->prepare(
            // we are filtering the results by using the where keyword
            // both conditions must by true
            // we're using the AND keyword to write multiple conditions
            // after adding the query, we must provide the values for replacing these placeholders as additional arguments to the prepare function
            "SELECT * FROM {$wpdb->prefix}recipe_rating
            WHERE post_id=%d AND user_id=%d",  $postID, $userID
        )
    );

    // this statement will couse the request to fall
    // if the rating is fresh, we can begin inserting the rating into the database
    if($wpdb->num_rows > 0){
        return $response;
    }

    $wpdb->insert(
        "{$wpdb->prefix}recipe_rating",
        [
            'post_id' => $postID,
            'rating' => $rating,
            'user_id' => $userID
        ],
        [ '%d', '%f', '%d' ]
    );

    $avgRating = round($wpdb->get_var($wpdb->prepare(
        "SELECT AVG(`rating`) FROM {$wpdb->prefix}recipe_rating
        WHERE post_id=%d", $postID
    )), 1);

    update_post_meta($postID, 'recipe_rating', $avgRating);

    do_action('recipe_rated', [
        'postID' => $postID,
        'rating' => $rating,
        'userID' => $userID
    ]);

    $response['status'] = 2;
    $response['rating'] = $avgRating;


    return $response;
}