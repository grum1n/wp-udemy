<?php

function up_enqueue_scripts(){
    $authURLs = json_encode([
        'signup' => esc_url_raw(rest_url('up/v1/signup'))
    ]);

    // The handle name for a script will be added as the ID to the script's tag.
    // video tutorial : id="udemy-plus-auth-modal-script-js"
    // By using this handle, we can add the inline script whenever the front and Js has been added to the document

    // my id: id="udemy-plus-auth-modal-view-script-js"
    //<script src='http://wp-udemy.local/wp-content/plugins/udemy-plus/build/blocks/auth-modal/frontend.js?ver=7cf804a6900d45361afe' id='udemy-plus-auth-modal-view-script-js'></script>
    
    //original:
    // wp_add_inline_script(
    //     'udemy-plus-auth-modal-script',
    //     "const up_auth_rest = {$authURLs}",
    //     'before' // after
    // );

    // inside the first argument of the WP inline script function pass in the following ID Udemy plus auth modal script
    // WP adds Js to the ID identify the element as a script
    // However, it's not officialy part of the handle by adding the handle

    // Official, WP will add this inline script whenever the front end Js file has been added

    //the next argument is the Javascript code passing the following const up_auth_rest = off URLs
    // these script tags can be excluded
    // wordpress will wrap your code with them inside our script, we are defining a gladdedobal variable with our URLs.

    // the last argument for our function is the placement of the scripts
    // we can add the script before or after the handle
    // in this case, we are going to round the script before the handle
    // otherwise, our scripts may not have access to the variables
    // Our variables should be defined first

    wp_add_inline_script(
        'udemy-plus-auth-modal-view-script',
        "const up_auth_rest = {$authURLs}",
        'before' // after
    );
}