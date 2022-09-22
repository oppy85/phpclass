<?php
session_start();
if(!isset($_SESSION["fname"]) && !isset($_SESSION["lname"])){
  echo "<script>window.location.href='login.php';</script>";
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
<?php require "nav1.php"; ?>
<!-- Button trigger modal -->
<button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Add Product
</button>

<table class="table table-hover" id="example">
  <thead>
    <tr>
      <th scope="col">S/N</th>
      <th scope="col">Product Name</th>
      <th scope="col">Description</th>
      <th scope="col">Category</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Image</th>
      <th scope="col">Options</th>
    </tr>
  </thead>
  <tbody>
    <?php
      include_once "../dbconnect.php";
      $sql = "SELECT * FROM  product order by id desc";
      $result = $db->query($sql);
      $n=1;
      foreach($result as $row){
    ?>
      <tr>
      <th scope="row"><?php echo $n ?></th>
      <td><?php echo $row["productname"] ?></td>
      <td><?php echo substr($row["description"], 0, 25) ?></td>
      <td><?php echo $row["category"] ?></td>
      <td><?php echo $row["price"] ?></td>
      <td><?php echo $row["quantity"] ?></td>
      <td><img src="../images/<?php echo $row['image'] ?>"></td>
      <td>
        <a href="editproduct?prod-id=<?php echo $row["id"]?>">
          <button type="button" name="edit" class="btn btn-outline-secondary">Edit</button>
        </a>
        <a href="?prod-id=<?php echo $row["id"] ?>&image=<?php echo $row['image']
        ?>">
          <button type="button" name="delete" class="btn btn-outline-danger" 
                 onclick="return confirm('Are you sure you want to delete?')">Delete</button>
        </a>
      </td>
      </tr>

    <?php $n++; } ?>
  </tbody>
</table>  

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Enter Product Information</h4>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="mb-3">
      <form method="POST" enctype="multipart/form-data" action="">

      <input type="text" class="form-control" name="prod-name" placeholder="Product Name" required><br/>
      <textarea class="form-control" name="desc" placeholder="description"></textarea><br/>
      <input type="text" class="form-control" name="prod-cate" placeholder="Product Category" required><br/>
      <input type="number" class="form-control" name="prod-price" placeholder="Product Price" required><br/>
      <input type="number" class="form-control" name="prod-quantity" placeholder="Product Quantity" required><br/>
      <input type="file" class="form-control" name="prod-image" accept="image/*">

      </div>
     </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="add-product">Add Product</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>
     $(document).ready(function() {
     $('#example').DataTable();
    } );
</script>
</body>
</html>

<?php
include_once "../dbconnect.php";

if(isset($_POST["add-product"]))
  {
    $name = $_REQUEST["prod-name"];
    $desc = $_REQUEST["desc"];
    $cate = $_REQUEST["prod-cate"];
    $price = $_REQUEST["prod-price"];
    $quant = $_REQUEST["prod-quantity"];
  
    $filen = $_FILES['prod-image']['name'];
    if($filen == NULL){
      $filen = "noimage.jpg";
      $sql = "INSERT INTO product(productname,description, category, price, quantity, image) 
                  Values('$name', '$desc', '$cate', '$price', '$quant','$filen')";
      if($db->query($sql)){
     // echo "<meta http-equiv='refresh' content='0'>";
        echo "<script>alert('Product added successufully')</script>";
        echo "<script>window.location.href='product.php';</script>";
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
      $sql = "INSERT INTO product(productname, description, category, price, quantity, image) 
                  Values('$name', '$desc', '$cate', '$price', '$quant','$nimage')";
      if($db->query($sql)){
      //echo "<meta http-equiv='refresh' content='0'>";
       echo "<script>alert('Product added successufully')</script>";
       echo "<script>window.location.href='product.php';</script>";
      }
    }
    
 } 
elseif(isset($_GET["prod-id"]) && isset($_GET["image"])){
   $id = $_GET['prod-id'];
   $dimage = $_GET['image'];

    $path = "images/".$dimage;
    if($dimage != "noimage.jpg" && (file_exists("../images/".$dimage))){
       unlink($path);
    }
    $sql = "DELETE FROM product where id=$id";
    if($db->query($sql)){
      echo "<script>alert('Product deleted successufully')</script>";
      echo "<script>window.location.href='product.php';</script>";
    }
}
?>