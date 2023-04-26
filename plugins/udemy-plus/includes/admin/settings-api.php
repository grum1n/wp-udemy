<?php

function up_settings_api(){
    register_setting('up_options_group', 'up_options');
}