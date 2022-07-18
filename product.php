<?php
  include_once "dbconnect.php";
  if(isset($_POST["addproduct"]))
    {
      $productname = $_POST["prod-name"];
      $price = $_POST["prod-price"];
      $quantity = $_POST["prod-quantity"];

      $image = $_FILES["image"]["name"];
      $tmp_dir = $_FILES["image"]["tmp_name"];
      $imageSize = $_FILES["image"]["size"];
      $upload_dir = 'images/';
      $imgExt = strtolower(pathinfo($image, PATHINFO_EXTENSION));
      $image = $image.".".$imgExt;
      if($imageSize < 5000000){
        move_uploaded_file($tmp_dir, $upload_dir.$image);
      }
      $sql = "INSERT INTO product(productname, price, quantity, image) 
            values('$productname', '$price', '$quantity', '$image')";
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <!--button triggers Modal   -->
  <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modallink">
    Add product
  </button>
    <!--  Modal   -->
  <div class="modal fade" tabindex="-1" id="modallink">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Enter Product Information</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <br/>
      <form method = POST action = "">
      <input type = "text" placeholder = "Product Name" name = "prod-name" class="form-control">
      <br/>
      <input type = "text" placeholder = "Product Category" name = "prod-category" class="form-control">
      <br/>
      <input type = "number" placeholder = "Product Price" min="1" name = "prod-price" class="form-control">
      <br/>
      <input type = "number" placeholder = "Product Quantity" min="1" name = "prod-quantity" class="form-control">
      <br/>

      <label for="img">Select Image:</label>
      <input type="file" id="img" name="img" accept="image/*">
      <br/>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type = "submit" name ="submit" value="submit"class="btn btn-primary btn-lg">
      </div>
    </div>
  </div>
</div>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
 </body>
</html>
