<?php
require_once '../dbconnect.php';

$error = '';
if (isset($_POST['reset'])){

$email = $_POST['email'];

// ensure email exists
$query = "SELECT email FROM members WHERE email='$email'";
$result = $db->query($query);
$count = $result->num_rows;
if($count ==0){
    $error = "Email $email doesn't exist";
}else{
    $token = bin2hex(random_bytes(50));
   // echo $token;
$sql = "INSERT INTO password_reset(email, token) VALUES('$email','$token')";
$results = $db->query($sql);
$to = $email;
$subject = "Reset your password";
$msg = "Hi,   <a href='$appurl/admin/new_password.php?token=$token'> Click Here </a> to reset your password  ";
$appmail = "sony";
$header = "From: $appmail";
mail($to, $subject, $msg, $header);
header('Location: pending.php?email='.$email);
}

}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Career Navigator</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

</head>
<body>
    
<div class = 'container'>
    <form method="post" action = ''>
    <br/>
    <h2><center>Reset Password</center></h2>
    <input type="email" name="email" class='form-control' placeholder ='Email Address' required>
    <br/>
    <button type = 'submit' class = 'btn btn-primary' name="reset">
     Submit
    </button>  
    </form>
</div>

</body>
</html>