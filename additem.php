<?php

include "connect.php"; // adding connect code from connect.php

include "items.php"; // adding connect code from items.php, SELECT SQL

// getting the parameters , sanitize and valisate
$item = filter_input(INPUT_GET, "item", FILTER_SANITIZE_SPECIAL_CHARS);
$quantity = filter_input(INPUT_GET, "quantity", FILTER_VALIDATE_INT);

if( $item === null or $quantity === null or $quantity <= 0)
{ 
    header("Location: error.html");  //redirect to error message page
}
else{
    // insert the new item added with its quantity
    $command = "INSERT
                into shopping_item (item, quantity)
                VALUES (?, ?)";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute([$item, $quantity]);
    if(!$success)
    {
        header("Location: error.html"); //redirect to error page
    }
}

Get_Items(); // call the function that is inside items.php


/*
* note: although it is showing error on "Get_Items();" line-32, it is correct. the method is inside other file
*/