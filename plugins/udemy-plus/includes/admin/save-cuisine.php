<?php
//tut 211
//we should not insert data into the database if the form does not contain the necessary data at the top of the function
function up_save_cuisine_meta($termID){ //ok , veliau, PATAISYMAS , NEBUVAU IDEJES  $termID
    // if form data is submitted traditionally PHP will store the form data in a varialble called post
    //However, there is one caveat the form must be submitted with a post request
    //WP will configure the form to be sent with the post method
    //the value from our input will be stored in this variable, which is an array of values from the form
    // we can reference a specific item by the value in the name attributes
    // in our case, the name from the nput is called up_more_info_url
    // let's update the condition with the not operator
    // the contotion should check if the variable i missing
    // if it is, we will return the function
    // we are returning nothing which is considered completely valid by returning a function, we are stopping the funtion from executing futher
    //However, we are not exiting the script
    // if we were to use the exit statements word WP would stop running, which isn't desirable
    // WP should continue running
    //returning a function will give us the best of both worlds
    // it will stop the function from running while leting WP continue running 
    // below this conditionlet's insert metadata into the table
    // normaly we would write a custom query for inserting data
    // WP has a function for inserting metadata for a term called add_term_meta()
    // the first argument in the ID of the term before this function is called WP will insert the term into the database, therefore the term will have an ID
    // our funtion for handling the submission will be provided the ID of a term as an argument
    // let's call it $termID
    if(!isset($_POST['up_more_info_url'])){
        return;
    }

    // add_term_meta(
    //     $termID, 
    //     'more_info_url',
    //     sanitize_url($_POST['up_more_info_url'])
    // );

    update_term_meta(
        $termID, 
        'more_info_url',
        sanitize_url($_POST['up_more_info_url'])
    );
}