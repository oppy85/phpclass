<?php
  session_start();
  if(isset($_GET["action"])){
    if($_GET['action'] == "empty"){
        unset($_SESSION["cart"]);
        //echo "<script>window.location.href='index.php';</script>";
    }
    if($_GET["action"] == "delete"){
       foreach($_SESSION["cart"] as $key => $value){
        if($value['itemid'] == $_GET['id']){
          unset($_SESSION['cart'][$key]);
          echo"<script>alert('Item Removed From Cart')</script>";
        }
       }
    }
  }
  if(isset($_POST['update'])){
    if(isset($_SESSION['cart'])){
      foreach($_SESSION["cart"] as $key => $value){
        if($value['itemid'] == $_POST['id']){
          $_SESSION["cart"][$key]['itemquantity'] =$_POST['quantity'];
          echo"<script>alert('Item quantity updated to " .$_SESSION["cart"][$key]['itemquantity']."')</script>";
        }
      }
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
</head>
<body>
<table class="table table-hover" id="example">
  <thead>
    <tr>
      <th scope="col">S/N</th>
      <th scope="col">Product Name</th>
      <th scope="col">Category</th>
      <th scope="col">Price</th>
      <th scope="col">Quantity</th>
      <th scope="col">Image</th>
      <th scope="col">Total Price</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
     <?php
       if(!empty($_SESSION["cart"])){
         $total = 0;
         $n = 1;
         foreach($_SESSION["cart"] as $key => $value){
            $tp = $value["itemquantity"] * $value["itemprice"];  
         ?>
         <form method="POST">
         <tr>
            <input type="hidden" name="id" value="<?php echo $value["itemid"]?>">
            <td> <?php echo "$n" ?> </td>
            <td> <?php echo $value["itemname"]?> </td>
            <td> <?php echo $value["itemcategory"]?> </td>
            <td> <?php echo $value["itemprice"]?> </td>
            <td> <input type="number" name="quantity" value="<?php echo $value["itemquantity"]?>"> </td>
            <td> <img src="images/<?php echo $value['itemimage']?>" height=50 width=50 /> </td>
            <td> <?php echo number_format($tp,2) ?> </td>
            <td>
            <button type="submit" name="update" class="btn btn-warning">Update</button>
            <a href="cart.php?action=delete&id=<?php echo $value["itemid"] ?>">
              <button type="button" class="btn btn-danger">Delete</button>
            </a>
            </td>
         </tr>
         </form>
       <?php
       $n++;
       $total = $total + $tp;
       }
       echo "<tr>";
       echo "<td colspan='6' align='right'>Total</td>";
       echo "<td>". number_format($total, 2) . "</td>";
       echo "<td colspan='1'><a href='cart.php?action=empty'> Empty Cart </a></td>";
       echo"</tr>";
       echo"<tr>";
       echo "<td colspan='8' align='right'><a href='checkout.php?total=".$total."' 
              class='btn btn-outline-primary'> Proceed to Checkout </a></td>";
       echo"</tr>";
       } 
       else{
        echo "<tr>";
        echo "<td colspan='6' align='center'> Your Cart is Empty </td>";
        echo"</tr>";
       }
       
        echo "<tr>";
        echo "<td colspan='8' align='right'><a href='index.php' class='btn btn-outline-primary'> 
              Continue Shopping </a></td>";
        echo"</tr>";
      ?>
  </tbody>
</table>  
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.min.js" integrity="sha384-ODmDIVzN+pFdexxHEHFBQH3/9/vQ9uori45z4JjnFsRydbmQbmL5t1tQ0culUzyK" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>