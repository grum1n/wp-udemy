<?php

function up_settings_api(){
    register_setting('up_options_group', 'up_options');

    add_settings_section(
        'up_options_section',
        __('Udemy Plus Settings', 'udemy-plus'),
        'up_options_section_cb',
        'up-options-page'
    );
}

function up_options_section_cb(){
    ?>
        <p>An alternative form for updating options with the settings API.</p>

    <?php

}
