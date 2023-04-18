<?php

function u_setup_theme(){
    //allw themes to add styles to the Gutenberg editor
    // feature is called editor-styles
    //by enabling this feature, we can begin loading Css files in the Gutenberg editor
    add_theme_support('editor-styles');

    //The ADD Editor style function is a shortcut for loading CSS files into the editor
    //we have three files that need to be loaded
    add_editor_style([
        'https://fonts.googleapis.com/css2?family=Pacifico&family=Rubik:wght@300;400;500;700&display=swap',
        'assets/bootstrap-icons/bootstrap-icons.css',
        'assets/public/index.css',
        //just for editor added style
        'assets/editor.css'
    ]);
}