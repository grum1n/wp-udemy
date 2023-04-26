<?php

function up_load_php_translations(){
    load_plugin_textdomain(
        "udemy-plus",
        false,
        "udemy-plus/languages"
    );
}