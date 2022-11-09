<?php

define("DB_HOST", "localhost");
define("DB_NAME", "untitled blog"); 
define("DB_USER", "root"); 
define("DB_PASS", "");

try {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
}
catch (mysqli_sql_exception $ex) {
    echo "<p>Error: Unable to connect to database.</p>";
    echo "<p>Debugging errno: " . $ex->getCode() . "</p>";
    echo "<p>Debugging error: " . $ex->getMessage() . "</p>";
    exit;
}
