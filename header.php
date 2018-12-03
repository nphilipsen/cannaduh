<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="css/header.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro" rel="stylesheet">
</head>
<body>
<div class="navbar">
  <ul class="ul-header">
    <li class="li-header"><a href="logout.php" class="li-header-a">Logout</a></li>
    <li class="li-header"><a href="cart.php" class="li-header-a">Cart</a></li>
    <?php 
      echo "<li class=\"li-header\"><a href=\"account.php\" class=\"li-header-a\">".$_SESSION['userName']."</a></li>";
      if ($_SESSION['isAdmin'] == true){
        echo "<li class=\"li-header\"><a href=\"shop.php\" class=\"li-header-a\">Shop</a></li>";
        echo "<li class=\"li-header\"><a href=\"adminAccount.php\" class=\"li-header-a\">Admin</a></li>";
        echo "<li class=\"li-header-left\"><a href=\"shop.php\"><img src=\"img/cannada.jpg\" alt=\"Cannaduh Logo\" class=\"img-header\"></a></li>";
        echo "<li class=\"li-storename\"><a href=\"shop.php\" class=\"name-link\">CANNADUH</a></li>";
      }else{
        echo "<li class=\"li-header\"><a href=\"shop.php\" class=\"li-header-a\">Shop</a></li>";
        echo "<li class=\"li-header-left\"><a href=\"shop.php\"><img src=\"img/cannada.jpg\" alt=\"Cannaduh Logo\" class=\"img-header\"></a></li>";
        echo "<li class=\"li-storename\"><a href=\"shop.php\" class=\"name-link\">CANNADUH</a></li>";
      }
    ?>

  </ul>
</div>
</body>
</html>
