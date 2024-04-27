<?php
  session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
      if(isset($_SESSION["mail"])&& $_SESSION["mail"]!=="root@gmail.com"){
        include "menu2.php";
      }
      if(isset($_SESSION["mail"]) && $_SESSION["mail"]==="root@gmail.com"){
          include "menu3.php";
      }
      elseif(!isset($_SESSION["mail"])){
        include "menu1.php";
      }
    ?>

</body>
</html>