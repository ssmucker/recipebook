<?php

/* Configuration variables for database */

$host        = "localhost";
$username    = "root";
$password    = "";
$database    = "recipebook";
$dsn         = "mysql:host=$host;dbname=$database";
$options     = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
               );