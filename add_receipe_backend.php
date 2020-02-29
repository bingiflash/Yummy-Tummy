<?php
$servername = "localhost";
$username = "root";
$password = "BingiV";
$dbname = "yummy_tummy";
$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

// if (!empty($_GET["var"])) {
//     echo $_GET["var"];
// } else {
//     echo "HI";
// }

// JSON init or from POST
$QueryData = array();
$QueryData['Receipe_name'] = "Tomato Curry";
$QueryData['type'] = 'veg';
$QueryData['url'] = "https://www.youtube.com/watch?v=6d064RiWVJM";
// $QueryData['notes'] = '';
$QueryData['ing_list'] = array(
    array("ingridient" => "1", "Quantity" => "3", "Units" => "Pieces"),
    array("ingridient" => "9", "Quantity" => "1", "Units" => "Pieces"),
    array("ingridient" => "63", "Quantity" => "1", "Units" => "T-spoons"),
    array("ingridient" => "65", "Quantity" => "1", "Units" => "T-spoons"),
    array("ingridient" => "20", "Quantity" => "10", "Units" => "Pieces")
);
//JSON done

$sql = "INSERT INTO recipe VALUES (NULL, \"" . $QueryData['Receipe_name'] . "\", \"" . $QueryData['type'] . "\", \"" . $QueryData['url'] . "\")";
// echo $sql;
$result = mysqli_query($conn, $sql);

if ($result) {
    echo "success";
} else {
    echo "failure";
}
// echo $result;
// echo mysqli_fetch_assoc($result)["item"];

mysqli_close($conn);


// echo $QueryData;
// $myJSON = json_encode($QueryData);

// echo $myJSON;
// echo JSON . stringify($myJSON);
