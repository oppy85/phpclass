<?php
require_once "../dbconnect.php";
if(isset($_GET["prod-id"])){
   $id = $_GET["prod-id"];
   $stmt = "SELECT * FROM product where id=$id";
   $result = $db->query($stmt);
   $row = $result->fetch_assoc();
}
// save edit product
if(isset($_POST["edit-product"]))
  {
    $name = $_REQUEST["prod-name"];
    $desc = $_REQUEST["desc"];
    $cate = $_REQUEST["prod-cate"];
    $price = $_REQUEST["prod-price"];
    $quant = $_REQUEST["prod-quantity"];
  
    $filen = $_FILES['prod-image']['name'];
    if($filen == NULL){
      $filen = $row["image"];
      $sql = "UPDATE product SET productname ='$name', description='$desc', category='$cate', price='$price', 
               quantity='$quant', image='$filen' WHERE id = '$id'" ;
      if($db->query($sql)){
     // echo "<meta http-equiv='refresh' content='0'>";
        echo "<script>alert('Product updated successufully')</script>";
        header("Refresh:0; product.php");
      }
    }
    else{
      $tmpn = $_FILES['prod-image']['tmp_name'];
      $imgsize = $_FILES['prod-image']['size'];
      $ext = strtolower(pathinfo($filen, PATHINFO_EXTENSION));

      // generate random number
      $tmp = range(1,99);
      $num = array_rand($tmp,10);
      $nimage = implode($num).".".$ext;

      if($imgsize < 6000000){
        move_uploaded_file($tmpn, "../images/".$nimage);
      }
      $oldimage = $row["image"];
      $path = "images/".$oldimage;
      if($oldimage != "noimage.jpg" && (file_exists("../images/".$oldimage))){
       unlink($path);
      }
      $sql = "UPDATE product SET productname ='$name', description='$desc', category='$cate', price='$price',
               quantity='$quant', image='$nimage' WHERE id = '$id'" ;
      if($db->query($sql)){
     // echo "<meta http-equiv='refresh' content='0'>";
        echo "<script>alert('Product updated successufully')</script>";
        header("Refresh:0; product.php");
      }
      
    }
    
 }
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products</title>
    <style>
       img{
         height: 50px;
         width: 50px;
       }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
<body>
    <?php include_once "nav1.php"; ?>
<!-- Modal -->
        <br/>
        <h2><center>Edit Product Information</center></h2><br/>
      <form method="POST" enctype="multipart/form-data" action="">

      <input type="text" class="form-control" name="prod-name" value="<?php echo $row['productname'] ?>"
         placeholder="Product Name" required><br/>
      <textarea class="form-control" name="desc"> <?php echo $row['description'] ?> </textarea><br/>
      <input type="text" class="form-control" name="prod-cate" value="<?php echo $row['category']?>"
         placeholder="Product Category" required><br/>
      <input type="number" class="form-control" name="prod-price" value="<?php echo $row['price']?>"
         placeholder="Product Price" required><br/>
      <input type="number" class="form-control" name="prod-quantity" value="<?php echo $row['quantity']?>"
         placeholder="Product Quantity" required><br/>
      
      <label>Image</label>
      <img src="../images/<?php echo $row['image']?>" width="50" height="50" alt="">
      <input type="file" class="form-control" name="prod-image" accept="image/*"><br/>
      <center><button type="submit" class="btn btn-primary" name="edit-product">Edit Product</button></center>
      </form>
    </div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>