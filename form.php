<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
  <center><h1>Enter Your Data</h1></center>
  <br/><br/>
  <form method = POST action = "">
  <input type = "text" placeholder = "Firstname" name = "firstname" class="form-control">
  <br/><br/>
  <input type = "text" placeholder = "Lastname" name = "lastname" class="form-control">
  <br/><br/>
  <input type = "text" placeholder = "Username" name = "username" class="form-control">
  <br/><br/>
  <input type = "Email" placeholder = "Email" name = "email" class="form-control">
  <br/><br/>

  <input type = "radio" name = "gender" value = "male" id = "male" class="form-check-input">
  <label for ="male" class="form-check-label">Male</label>
  <input type = "radio" name = "gender" value = "female" id = "female" class="form-check-input">
  <label for ="female" class="form-check-label">Female</label>
  <br/><br/>

  <input type = "checkbox" name="qualification[]" value="MSC" class="form-check-input"/> 
  <label class="form-check-label">Master</label>
  <input type = "checkbox" name="qualification[]" value="Bsc" class="form-check-input"/>
  <label class="form-check-label">Degree</label>
  <input type = "checkbox" name="qualification[]" value="WAEC" class="form-check-input"/>
  <label class="form-check-label">WAEC</label>
  <input type = "checkbox" name="qualification[]" value="NECO" class="form-check-input"/>
  <label class="form-check-label">NECO</label>
  <br/><br/>

  <input type = "submit" name ="submit" value="submit"class="btn btn-secondary btn-lg">
</form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
  </body>
</html>


<?php
if(isset($_POST["submit"]))
  {
    $fname = $_REQUEST["firstname"];
    $lname = $_REQUEST["lastname"];
    $uname = $_REQUEST["username"];
    $email = $_REQUEST["email"];
    $gender =  $_REQUEST["gender"];
    $qual =  $_REQUEST["qualification"];
    //var_dump($qual);
    $qual = implode(",", $qual);

     $db = new mysqli('localhost:3308', 'root', '','techone');
     if(!$db){
       die("Connection failed: " . mysqli_connect_error());
     }

     $sql = "INSERT INTO USERS(firstname, lastname, username, email, gender, qualification) 
                        values('$fname', '$lname', '$uname', '$email','$gender', '$qual')";
     $db->query($sql);
     echo "RECORD ENTERED SUCCESSFULLY";
   }
?>