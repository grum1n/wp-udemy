<?php
function up_plugin_options_alt_page(){
    ?>
    <div class="wrap">
       <form method="POST" action="options.php">

        <?php
            settings_fields('up_options_group');
        ?>

       </form>
    </div>
    <?php
}