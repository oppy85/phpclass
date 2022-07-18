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
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
  <?php include_once "nav.php" ; ?>
  <center><h1>Enter Product Information</h1></center>
  <br/><br/>
  <form method = POST action = "">
  <input type = "text" placeholder = "Product Name" name = "prod-name" class="form-control">
  <br/><br/>
  <input type = "text" placeholder = "Product Category" name = "prod-category" class="form-control">
  <br/><br/>
  <input type = "number" placeholder = "Product Price" min="1" name = "prod-price" class="form-control">
  <br/><br/>
  <input type = "number" placeholder = "Product Quantity" min="1" name = "prod-quantity" class="form-control">
  <br/><br/>

  <label for="img">Select Image:</label>
  <input type="file" id="img" name="img" accept="image/*">
  <br/><br/>

  <input type = "submit" name ="submit" value="submit"class="btn btn-secondary btn-lg">
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>
