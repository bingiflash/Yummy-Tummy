<?php
include("backup\dbconfig.php"); //db configuration
if (!$conn)
    die("Connection failed: " . mysqli_connect_error());

// JSON init or from POST
// $QueryData = array();
// $QueryData['recipe_name'] = "Tomato Curry";
// $QueryData['type'] = 'veg';
// $QueryData['url'] = "https://www.youtube.com/watch?v=6d064RiWVJM";
// // $QueryData['notes'] = '';
// $QueryData['ing_list'] = array(
//     array("ing_id" => "1", "quantity" => "3", "units" => "Pieces"),
//     array("ing_id" => "9", "quantity" => "1", "units" => "Pieces"),
//     array("ing_id" => "63", "quantity" => "1", "units" => "T-spoons"),
//     array("ing_id" => "65", "quantity" => "1", "units" => "T-spoons"),
//     array("ing_id" => "20", "quantity" => "10", "units" => "Pieces")
// );
//JSON done

$QueryData = json_decode($_POST["data"], true);
$res_suc = false;

$recipe_query = "INSERT INTO recipe VALUES (NULL, \"" . $QueryData['recipe_name'] . "\", \"" . $QueryData['type'] . "\", \"" . $QueryData['url'] . "\", \"" . $QueryData['url'] . "\")";
$result = mysqli_query($conn, $recipe_query);

if ($result) {
    $res_suc = true;
} else {
    $res_suc = false;
}

$id_query = "SELECT id  FROM recipe WHERE name LIKE \"" . $QueryData['recipe_name'] . "\"";
$result = mysqli_query($conn, $id_query);
$recipe_id =  mysqli_fetch_assoc($result)["id"];
foreach ($QueryData['ing_list'] as &$step) {
    $recipe_ing_query = "INSERT INTO recipe_ingredient VALUES (NULL, \"" . $recipe_id . "\", \"" . $step['ing_id'] . "\", \"" . $step['quantity'] . "\", \"" . $step['units'] . "\")";
    $result = mysqli_query($conn, $recipe_ing_query);
    if ($result) {
        $res_suc = true;
    } else {
        $res_suc = false;
        break;
    }
}
$rep_msg = array();
if ($res_suc) {
    $rep_msg['msg'] = "Recipe Added Successfully";
} else {
    $rep_msg['msg'] = "Failed to add recipe";
}
header('Content-type: application/json');
echo json_encode($rep_msg);
mysqli_close($conn);
