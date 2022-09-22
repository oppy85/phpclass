<?php
function check($str){
  $str = htmlspecialchars($str);
  return strip_tags($str);

}

require "../dbconnect.php";
if(isset($_POST["register"])){
 $fname = check($_POST['firstname']);
 $lname = check($_POST['lastname']);
 $email = check($_POST['email']);
 $password = $_POST['password'];
 $conpass = $_POST['confirmpass'];
 if($password == $conpass){
    $password = check($_POST['password']);
    $hpass = password_hash($password, PASSWORD_DEFAULT);

    $sql = "SELECT COUNT(*) as total from members";
    $count = $db->query($sql);
    $cnt = $count->fetch_assoc();
    //echo $cnt['total'];

    $sql ="SELECT COUNT(*) as ecount from members where email = '$email'";
    $res = $db->query($sql);
    $em = $res->fetch_assoc();
    //echo $em['ecount'];
    
    if( $cnt['total']== 0 or $em['ecount']== 0){
      $sql = "INSERT INTO members(firstname, lastname, email, password) 
              Values('$fname', '$lname', '$email', '$hpass')";
      if($db->query($sql)){
       echo "<script>alert('Registration is successful')</script>";
       echo "<script>window.location.href='login.php'</script>"; 
     }
    }
    else{
     echo "<div class='alert alert-warning' role='alert'>
       <center>Email Address Have been Used</center>
       </div>";
      //echo "<script> alert('Email Address Have been Used')</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>Register</title>
</head>
<body>
  <br/>   
  <center><h1>Register</h1></center>
  <div class="container">
  <form method="POST"  action="">

  <input type="text" class="form-control" name="firstname" placeholder="Firstname" required><br/>
  <input type="text" class="form-control" name="lastname" placeholder="lastname" required><br/>
  <input type="email" class="form-control" name="email" placeholder="Email" required><br/>
  <input type="password" class="form-control" name="password" id="password" 
         placeholder="Password" required><br/>
  <input type="password" class="form-control" name="confirmpass" id="confirmpass" 
         placeholder="Confirm Password" onkeyup="validate()" required><br/>
  <small id="err"></small><br/>
  <button type="submit" class="btn btn-secondary" style="display : none" id="submit" name="register">
    Register</button>
  </form>
  </div>
  <script>
    function validate(){
        var pass = document.getElementById("password").value;
        var conpass = document.getElementById("confirmpass").value;
       // console.log(pass + " " + conpass);
        if(pass != conpass){
            document.getElementById("err").innerHTML ="password does not match";
            document.getElementById("err").style.color ="red";
        }
        else{
            document.getElementById("err").innerHTML ="correct";
            document.getElementById("err").style.color ="green";
            document.getElementById("submit").style.display ="block";
        }
    }
    
  </script>
</body>
</html>