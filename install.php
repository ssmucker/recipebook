<?php

require "dbconnection.php";

// Install the database and tables
try {
    $dbh = new PDO($dsn, $username, $password, $options);
    $sql = file_get_contents("data/install.sql");
    $dbh->exec($sql);
    $dbh = null;

    // echo "Database and table(s) created successfully!";
} catch (PDOException $error) {
    echo $sql . "<br>" . $error->getMessage();
}

// Create file structure
if(!is_dir("./media")) {
    mkdir("./media", 0777, true);
}
