<?php

/**
 * Assignment 4 - Shopping List
 * 
 */


/**
 * this function do conect to database and get all data from shopping_item table
 * this code will be included in other php files
 *
 */
function Get_Items()
{
    include "connect.php"; // adding connect code from connect.php

    // preper the select command
    // gett all records from shopping_item table
    $command = "SELECT id, item, quantity, checked
                FROM shopping_item
                ORDER BY checked, item";
    $stmt = $dbh->prepare($command);
    $success = $stmt->execute(); // execute select commsnd
    if (!$success) {
        header("Location: error.html"); //redirect to error page
    }

    // item present shopping_item table data
    $items = [];
    while ($row = $stmt->fetch()) {
        array_push($items, [
            "id" => $row["id"],
            "item" => $row["item"],
            "quantity" => (int)$row["quantity"],
            "checked" => $row["checked"],
        ]);
    }

    // write json encoded array to HTTP response
    echo json_encode($items);
}
