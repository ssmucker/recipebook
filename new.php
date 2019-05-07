<?php

/* Add new recipe data to database */

require "dbconnection.php";

/* Set variables for possible post values */
$name = "";
$ingredients = "";
$recipe = "";
$source = "";
$category = "";

/* Handle file variables if image was uploaded */
if(isset($_FILES['image'])) {
    $currentDir = getcwd();
    $mediaDir = "/media/";
    $errors = [];
    $fileExtensions = ['jpeg', 'jpg', 'png'];

    $fileName = $_FILES['image']['name'];
    $fileSize = $_FILES['image']['size'];
    $fileTmpName = $_FILES['image']['tmp_name'];
    $fileType = $_FILES['image']['type'];
    $tmp = explode('.', $fileName);
    $fileExtension = strtolower(end($tmp));

    $uploadPath = $currentDir . $mediaDir . basename($fileName);

    if(!in_array($fileExtension, $fileExtensions)) {
        $errors[] = "This file extension is not allowed. Please upload a jpeg or png file.";
    }
    if($fileSize > 4000000) {
        $errors[] = "This file is too large. It must be less than 4 MB.";
    }

    /* If there aren't any errors, move the uploaded file into the media directory */
    if(empty($errors)) {
        $didUpload = move_uploaded_file($fileTmpName, $uploadPath);

        if(!$didUpload) {
            echo "Something went wrong with the upload.";
        }
    } else {
        foreach($errors as $error) {
            echo $error . "\n";
        }
    }
}

/* Set post values to their variables if they exist
if(isset($_POST['name']) && $_POST['name'] != "") {
    $name = $_POST['name'];
}

if(isset($_POST['ingredients']) && $_POST['ingredients'] != "") {
    $ingredients = $_POST['ingredients'];
}

if(isset($_POST['recipe']) && $_POST['recipe'] != "") {
    $recipe = $_POST['recipe'];
}

if(isset($_POST['source']) && $_POST['source'] != "") {
    $source = $_POST['source'];
}

if(isset($_POST['category']) && $_POST['category'] != "") {
    $category = $_POST['category'];
}*/

$name = $_POST['name'] || "";
$ingredients = $_POST['ingredients'] || "";
$recipe = $_POST['recipe'] || "";
$source = $_POST['source'] || "";

try {
    /* Create database handler object */
    $dbh = new PDO($dsn, $username, $password, $options);

    /* Prepare SQL statement */
    $stmt = $dbh->prepare("INSERT INTO recipes (name, ingredients, recipe, source, image_path) VALUES (:name, :ingredients, :recipe, :source, :image_path)");
    
    /* Bind parameters safely */
    $stmt->bindParam(":name", $name);
    $stmt->bindParam(":ingredients", $ingredients);
    $stmt->bindParam(":recipe", $recipe);
    $stmt->bindParam(":source", $source);
    /* $stmt->bindParam(":category", $category); */
    $stmt->bindParam(":image_path", $fileName);

    /* Execute the query */
    $stmt->execute();

    /* Close the connection */
    $stmt = null;
    $dbh = null;

    echo "Recipe successfully added to database!";
} catch(PDOException $error) {
    echo "<p>Error: " . $error->getMessage() . "</p>";
}