<?php

// Change 'title' column to 'name' for people for clarity
add_filter( 'manage_edit-person_columns', 'rename_person_title' );
function rename_person_title( $columns ) 
{
    $columns['title'] = 'Name';
    return $columns;
}