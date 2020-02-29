<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <title>Add Recipie</title>
</head>

<body>
  <div class="container-fluid">
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <h1 class="display-4">Add Recipe</h1>
        <p class="lead">Enter ingredients required and their quantity</p>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="input-group input-group-lg " style="margin-bottom: 1%;">
      <div class="input-group-prepend">
        <span class="input-group-text " id="inputGroup-sizing-lg">Recipe</span>
      </div>
      <input id="recipe_name" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
      <div class="input-group-append btn-group btn-group-toggle" data-toggle="buttons">
        <label class="btn btn-success active">
          <input type="radio" name="options" id="veg" checked> Veg
        </label>
        <label class="btn btn-warning">
          <input type="radio" name="options" id="nonveg"> Non-Veg
        </label>
      </div>
    </div>
    <hr>
    <div class="input-group mt-2">
      <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">url</span>
      </div>
      <input type="text" class="form-control" placeholder="Enter URL for reference" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mt-1 mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Notes</span>
      </div>
      <textarea class="form-control" aria-label="With textarea"></textarea>
    </div>
    <div class="container">
      <div class="container">
        <div class="row input-group ">
          <input class=" col-lg-7 col-md-7 col-sm-12 custom-select mr-1" id="" aria-label="" type="text" list="ingredients_list" placeholder="Ingredient">
          <?php
          $servername = "10.0.0.200";
          $username = "root";
          $password = "BingiV";
          $dbname = "yummy_tummy";
          $port = 9765;
          // Create connection
          $conn = new mysqli($servername, $username, $password, $dbname);
          // Check connection
          if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
          }

          $sql = "SELECT * FROM ingredient ORDER BY ingredient.item ASC";
          $result = $conn->query($sql);

          if ($result->num_rows > 0) {
            echo "<datalist id='ingredients_list'>";
            // output data of each row
            while ($row = $result->fetch_assoc()) {
              echo '<option label="' . $row['item'] . '" value="' . $row["id"] . '">';
            }
            echo "</datalist>";
          } else {
            echo "0 results";
          }
          $conn->close();
          ?>
          <datalist id='ingredients_list'>
          </datalist>
          <input class=" col-lg-2 col-md-2 col-sm-3 form-control mr-1" type="number" min="1" id="" aria-label="" placeholder="Quantity">

          <select class=" col-lg-2 col-md-2 col-sm-3 custom-select" id="" aria-label="">
            <option selected>Units</option>
            <option value="pieces">Pieces</option>
            <option value="glasses">Glasses</option>
            <option value="Tspoons">T-spoons</option>
            <option value="grams">Grams</option>
          </select>

          <div class="input-group-append col col-md-2 col-sm-3">
            <button class="btn btn-outline-primary mr-1" type="button">+</button>
            <button class="btn btn-outline-danger " type="button">-</button>
          </div>
        </div>
      </div>

      <div class="row mt-1">
        <div class="col-12 ">
          <button type="button" class="btn btn-success btn-lg float-right ">Add</button>
        </div>
      </div>
    </div>

  </div>

</body>

</html>