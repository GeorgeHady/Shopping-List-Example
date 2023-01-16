<?php

/**
 * Assignment 4 - Shopping List
 */

include "connect.php"; // adding connect code from connect.php

include "items.php"; // adding connect code from items.php, SELECT SQL

// getting the parameter vite validate
$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);

if ($id === null) {
    header("Location: error.html");  //redirect to error message page
} else {
    // insert the new item added with its quantity
    $command = "UPDATE shopping_item
                SET checked = (checked * -1)
                WHERE id = ?";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$id]);
    if (!$success) {
        header("Location: error.html"); //redirect to error page
    }
}

Get_Items(); // call the function that is inside items.php



/*
* note: although it is showing error on "Get_Items();" line-31, it is correct. the method is inside other file
*/
