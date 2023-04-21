<?php

function up__header_tools_render_cb($atts){
    // The WP get current user function will check if the user is logged in.
    // the object returnde by this function has a method for verifying the user's authentication.
    // We can take advantage of this function before reading their data
    $user = wp_get_current_user();
    $name = $user->exists() ? $user->user_login : 'Sign in';
    $openClass = $user->exists() ? '' : 'open-modal';

    ob_start();
    ?>
        <div class="wp-block-udemy-plus-header-tools">
          <?php
            if($atts['showAuth']){
                ?>
                    <a class="signin-link <?php  echo  $openClass; ?>" href="#">
                        <div class="signin-icon">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="signin-text">
                            <small>Hello, <?php  echo  $name; ?></small>
                            My Account
                        </div>
                    </a>
                <?php
            }

          ?>
               
           
        </div>
    <?php

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}