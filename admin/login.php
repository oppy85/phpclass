<?php
session_start();
require "../dbconnect.php";
if(isset($_POST['login'])){
   $email = $_POST['email'];
   $passw = $_POST['password'];
   $sql = "SELECT * FROM members ";
   $result = $db->query($sql);
   foreach($result as $row){
     if($row['email'] == $email){
        if(password_verify($passw, $row['password'])){
          $_SESSION["fname"] = $row['firstname'];
          $_SESSION["lname"] = $row['lastname'];
          echo "<script>window.location.href='product.php'</script>"; 
        }
     }
   }
   echo "<div class='alert alert-warning' role='alert'>
   <center>Invalid Email Address or Incorrect Password</center>
   </div>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Login Page</title>
</head>
<body>
<br/>   
<center><h1>Login</h1></center>

<div class="container">
<form method="POST"  action="">

<input type="text" class="form-control" name="email" placeholder="Email" required><br/>
<input type="password" class="form-control" name="password" placeholder="Password" required><br/>
<button type="submit" name="login" class="btn btn-secondary">Login</button>
</form>
<br/>
<a href="password_reset.php">Forgotten Password?</a>
</div>

</body>
</html>