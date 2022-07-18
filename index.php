<?php

?>

<?php
   //$n = count($name);
   $person = array('firstname'=> 'tayo', 'lastname'=> 'james');
   echo $person["firstname"];
   echo "<br/>";
?>

<?php
   $person = array('firstname'=> 'tayo', 'lastname'=> 'james');
   foreach($person as $p => $value){
     echo "$p = $value <br>";
   }
   echo json_encode($person);
   var_dump($person);

   $data ="foo:*:1023:1000::/home/foo:/bin/sh";
   list($user, $pass, $uid, $gid, $gecos, $home, $shell) = explode(":", $data);
   echo $gecos;
?>

<!DOCTYPE html>
<html lang="en">
<head>
     <title>Document</title>
</head>

<body>

</body>
</html>

<!-- 1 to 7 Infant, 7 to 17 Teenager, 18 t0 49 Adult, 50 to 99 Old, else you are Methussela    -->