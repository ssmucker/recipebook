<?php

require "dbconnection.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Query database to retrieve all recipe categories */
try {
    $dbh = new PDO("mysql:host=$host;dbname=$database", $username, $password, $options);

    $sql = "SELECT * FROM categories";

    /* Get query results */
    $results = $dbh->query($sql);

    /* Only display category box if at least one row was returned */
    //if(count($results) > 0) {
        echo "<div class='category-container'>";
        echo "<div class='category-header'>Categories</div>";

        foreach($results as $row) {
            echo "<div class='category'>" . $row['name'] . "</div>";
        }
        echo "</div>";
    //}
} catch(PDOException $error) {
    echo "<p>Error: " . $error->getMessage() . "</p>";
}