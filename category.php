<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category</title>
    <style>
      img{
        height:120px;
        width:120px;
      }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
<body>
    <?php include_once "nav.php"; ?>
    <div class="row">
    <?php
      include_once "dbconnect.php";
      $cate = $_GET["cate"];
      $sql = "SELECT * FROM  product WHERE category='$cate' order by id desc";
      $result = $db->query($sql);
      $cate = strtoupper($cate);
      echo "<h1> <center>$cate</center> </h1>";
      echo"<hr>";
      foreach($result as $row){
    ?>
    <div class="card mt-5 mx-auto" style="width: 15rem;">
    <img src="images/<?php echo $row['image'] ?>" class="card-img-top" alt="...">
    <div class="card-body">
    <h5 class="card-title"><?php echo $row["productname"] ?></h5>
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" 
            data-bs-target="#p<?php echo $row['id'] ?>">
      Description
    </button>

        <!-- Modal -->
<div class="modal fade" id="p<?php echo $row['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel"><?php echo $row['productname']?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <img src="images/<?php echo $row['image'] ?>" alt="..."><br/><br/>
      <div><h5>Description</h5><?php echo $row["description"] ?></div><br/>
         <div><h5>Category</h5><?php echo $row["category"] ?></div><br/>
         <div><h5>Price</h5><?php echo "#".$row["price"] ?></div><br/>
         <div><h5>Quantity</h5><?php echo $row["quantity"]." (stock)" ?></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

    <p class="card-text"><?php echo "#".$row["price"] ?></p>
    <p class="card-text"><?php echo $row["quantity"]." (stock)" ?></p>
    <a href="#" class="btn btn-primary">Add to Cart</a>
    </div>
    </div>
    <?php }?>
    </div>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script>
</body>
</html>