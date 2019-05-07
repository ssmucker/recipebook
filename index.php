<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/* Install database and tables if they don't already exist */
require_once "install.php";

include "header.html";

echo "<div class='page-body'>";

include "categories.php";

/* echo "<div class='category-container'>";
echo "<div class='category-header'>Categories</div>";
echo "</div>"; */

if(isset($_GET['query']) && $_GET['query'] != "") {
    include "search_results.php";
} else {
    include "welcome.php";
}

echo "</div>";

include "footer.html";