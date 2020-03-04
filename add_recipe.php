<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <script  src="https://code.jquery.com/jquery-3.4.1.min.js"  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <title>Add Recipie</title>
</head>

<body >
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
        <span class="input-group-text">Recipe</span>
      </div>
      <input  type="text" class="form-control" id="recipe_name" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg">
      <div class="input-group-append btn-group btn-group-toggle" >
        <label class="btn btn-outline-success ">
          <input type="radio" name="options" id="veg"> Veg
        </label>
        <label class="btn btn-outline-warning">
          <input type="radio" name="options" id="nonveg"> Non-Veg
        </label>
      </div>
    </div>
    <hr>
    <div class="input-group mt-2">
      <div class="input-group-prepend">
        <span class="input-group-text" >url</span>
      </div>
      <input type="text" class="form-control" id="url" placeholder="Enter URL for reference" aria-label="Username" aria-describedby="basic-addon1">
    </div>
    <div class="input-group mt-1 mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Notes</span>
      </div>
      <textarea class="form-control" id="note" aria-label="With textarea"></textarea>
    </div>
    <div class="container">
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
      <div class="container ing" >
        <!-- Hidden ingredient thread  -->
        <div class="row input-group mb-1" id="ing_0" style="display:none;">
          <input class=" col-lg-7 col-md-7 col-sm-12 custom-select mr-1"  aria-label="" type="text" list="ingredients_list" placeholder="Ingredient">
          
          <input class=" col-lg-2 col-md-2 col-sm-3 form-control mr-1" type="number" min="1"  aria-label="" placeholder="Quantity">

          <select class=" col-lg-2 col-md-2 col-sm-3 custom-select" aria-label="">
            <option selected>Units</option>
            <option value="pieces">Pieces</option>
            <option value="glasses">Glasses</option>
            <option value="Tspoons">T-spoons</option>
            <option value="grams">Grams</option>
          </select>

          <div class="input-group-append col col-md-2 col-sm-3">
            <button class="btn btn-outline-primary mr-1" type="button" onclick="add_ingredient()">+</button>
            <button class="btn btn-outline-danger remove_ing " type="button">-</button>
          </div>
        </div>
        <!-- end Hidden ingredient thread-->
        <div class="row input-group mb-1" id="ing_1">
          <input class=" col-lg-7 col-md-7 col-sm-12 custom-select mr-1"  aria-label="" type="text" list="ingredients_list" placeholder="Ingredient">
          
          <input class=" col-lg-2 col-md-2 col-sm-3 form-control mr-1" type="number" min="1"  aria-label="" placeholder="Quantity">

          <select class=" col-lg-2 col-md-2 col-sm-3 custom-select" aria-label="">
            <option selected>Units</option>
            <option value="pieces">Pieces</option>
            <option value="glasses">Glasses</option>
            <option value="Tspoons">T-spoons</option>
            <option value="grams">Grams</option>
          </select>

          <div class="input-group-append col col-md-2 col-sm-3">
            <button class="btn btn-outline-primary mr-1" type="button" onclick="add_ingredient()">+</button>
            <button class="btn btn-outline-danger remove_ing" type="button">-</button>
          </div>
        </div>
        
      </div>

      <div class="row mt-1">
        <div class="col-12 ">
          <button type="button" class="btn btn-success btn-lg float-right " id="add">Add</button>
        </div>
      </div>
    </div>

  </div>
<script>
  var ing_id  = 1;
$('.remove_ing').click(remove_ingredient);
$('#add').click(send_data);
function remove_ingredient(){
  var ing_remove_id = '#'+$(this).parent().parent().attr("id");
  //console.log(ing_remove_id);
  $(ing_remove_id).remove();
  var list_ing = $('.ing').children();
  //console.log(list_ing.length);
  if(list_ing.length <= 1){
    add_ingredient(); 
  }
}
function add_ingredient(){
  var ing_0 =  $('#ing_0').html();
  ing_id+=1;
  var html =  `<div class="row input-group ing_details mb-1" id="ing_${ing_id}">${ing_0}</div>`;
  $(".ing").append(html);
  $('.remove_ing').click(remove_ingredient);
}
function send_data(){
  var ing_obj = {};
  var ing_ar = [];
  var list_ing = $('.ing').children();
  for (i = 1; i < list_ing.length; i++){
    ing_obj["ing_id"]=list_ing[i].children[0].value;
    ing_obj["quantity"]=list_ing[i].children[1].value;
    ing_obj["units"]=list_ing[i].children[2].value;
    ing_ar.push(ing_obj);
    ing_obj = {};
  }
  var recipe_data = {
    recipe_name:$("#recipe_name").val(),
    type:$("#recepi_name").val(),
    url:$("#url").val(),
    note:$("#note").val(),
    ing_list:ing_ar
  }
  console.log(recipe_data);
  $.ajax({
    type: "POST",
    url: "add_recipe_backend.php",
    data: {
      data: JSON.stringify(recipe_data)
    },
    success: function (ee) {
      alert(ee.msg);
    },
    error:()=>{
      alert('AJAX Error!');
    }
  });
}
</script>
</body>

</html>