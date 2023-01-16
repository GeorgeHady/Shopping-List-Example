<?php
/**
 * connect to the database
 * will be included in other php files
 */
try {
    $dbh = new PDO(
        "mysql:host=localhost;dbname=DATABASE_NAME",
        "", ""  // fill it with data base info
    );
} catch (Exception $e) {
    die("ERROR: Couldn't connect. {$e->getMessage()}");
}
