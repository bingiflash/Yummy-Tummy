<?php
$servername = "localhost";
$username = "root";
$password = "BingiV";
$dbname = "yummy_tummy";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

// JSON init or from POST
$QueryData = array();
$QueryData['receipe_name'] = "Tomato Curry";
$QueryData['type'] = 'veg';
$QueryData['url'] = "https://www.youtube.com/watch?v=6d064RiWVJM";
// $QueryData['notes'] = '';
$QueryData['ing_list'] = array(
    array("ing_id" => "1", "quantity" => "3", "units" => "Pieces"),
    array("ing_id" => "9", "quantity" => "1", "units" => "Pieces"),
    array("ing_id" => "63", "quantity" => "1", "units" => "T-spoons"),
    array("ing_id" => "65", "quantity" => "1", "units" => "T-spoons"),
    array("ing_id" => "20", "quantity" => "10", "units" => "Pieces")
);
//JSON done

$recipe_query = "INSERT INTO recipe VALUES (NULL, \"" . $QueryData['receipe_name'] . "\", \"" . $QueryData['type'] . "\", \"" . $QueryData['url'] . "\")";
$result = mysqli_query($conn, $recipe_query);

if ($result) {
    echo "Added a Recipe <br>";
} else {
    echo "Failed to add a Recipe <br>";
}

$id_query = "SELECT id  FROM recipe WHERE name LIKE \"" . $QueryData['receipe_name'] . "\"";
$result = mysqli_query($conn, $id_query);
$recipe_id =  mysqli_fetch_assoc($result)["id"];

foreach ($QueryData['ing_list'] as &$step) {
    $recipe_ing_query = "INSERT INTO recipe_ingredient VALUES (NULL, \"" . $recipe_id . "\", \"" . $step['ing_id'] . "\", \"" . $step['quantity'] . "\", \"" . $step['units'] . "\")";
    $result = mysqli_query($conn, $recipe_ing_query);
    if ($result) {
        echo "Added a Recipe Step <br>";
    } else {
        echo "Unable to a add a Recipe Step <br>";
    }
}

mysqli_close($conn);
