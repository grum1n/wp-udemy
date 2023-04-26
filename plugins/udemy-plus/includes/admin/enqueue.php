<?php

function up_admin_enqueue($hook_suffix){
   if($hook_suffix === 'toplevel_page_up-plugin-options'){
        wp_enqueue_media();
   }
}