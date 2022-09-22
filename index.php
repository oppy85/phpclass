<?php
  include_once "dbconnect.php";
  session_start();
 // unset($_SESSION["cart"]);

  if(isset($_POST['addtocart'])){
    if(isset($_SESSION["cart"])){
     $item_array = array_column($_SESSION["cart"], "itemid");
     if(!in_array($_POST['id'], $item_array)){
      $count = count($_SESSION["cart"]);

      $items = array(
        'itemid' => $_POST["id"],
        'itemname' => $_POST["productname"],
        'itemcategory' => $_POST["category"],
        'itemprice' => $_POST["price"],
        'itemquantity' => $_POST["quantity"],
        'itemimage' => $_POST["image"]
      );
      $_SESSION["cart"][$count] = $items;
     }
     else{ echo"<script> alert('Product already added to cart') </script>"; }
    }
   
  else{
     $items = array(
      'itemid' => $_POST["id"],
      'itemname' => $_POST["productname"],
      'itemcategory' => $_POST["category"],
      'itemprice' => $_POST["price"],
      'itemquantity' => $_POST["quantity"],
      'itemimage' => $_POST["image"]
    );
    $_SESSION["cart"][0] = $items;
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
        height:120px;
        width:120px;
      }
    </style>
    <?php include_once 'header.php'?>
  </head>
<body>
    <?php include_once "nav.php"; ?>
    <div class="row">
    <?php
      include_once "dbconnect.php";
      $sql = "SELECT * FROM  product order by id desc";
      $result = $db->query($sql);
      foreach($result as $row){
    ?>
    <div class="card mt-5 mx-auto" style="width: 15rem;">
  <form action="" method="post">
  <input type="hidden" name="id" value="<?php echo $row["id"]?>">
  <input type="hidden" name="productname" value="<?php echo $row["productname"]?>">
  <input type="hidden" name="category" value="<?php echo $row["category"]?>">
  <input type="hidden" name="price" value="<?php echo $row["price"]?>">
  <input type="hidden" name="image" value="<?php echo $row["image"]?>">
  <input type="hidden" name="quantity" value="1">

    <img src="images/<?php echo $row['image'] ?>" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title"><?php echo $row["productname"] ?></h5>
    <button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal" 
       data-bs-target="#product<?php echo $row["id"]?>">
      Description
    </button>
        <!-- Modal -->
    <div class="modal fade" id="product<?php echo $row["id"] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLabel"><?php echo $row["productname"] ?></h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
         <center><img src="images/<?php echo $row['image'] ?>" alt="..."/></center>
         <div><h5>Description</h5><?php echo $row["description"] ?></div><br/>
         <div><h5>Category</h5><?php echo $row["category"] ?></div><br/>
         <div><h5>Price</h5><?php echo "#".$row["price"] ?></div><br/>
         <div><h5>Quantity</h5><?php echo $row["quantity"]." (stock)" ?></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <p class="card-text"><a href="category?cate=<?php echo $row["category"] ?>"><?php echo $row["category"] ?>
                         </a></p>
    <p class="card-text"><?php echo "#".$row["price"] ?></p>
    <p class="card-text"><?php echo $row["quantity"]." (stock)" ?></p>
    <button type="submit" name="addtocart" class="btn btn-primary">Add to Cart</button>
    </div>
  </form>
    </div>
    <?php }?>
    </div>
<?php include_once 'footer.php'?>
</body>
</html>