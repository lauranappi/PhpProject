<?php
include("functions.php");
session_start();
?>
<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <link rel="shortcut icon" href="images/favicon.png" type="">

  <title> Pietra di Luna </title>

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!--owl slider stylesheet -->
  <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <!-- nice select  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/css/nice-select.min.css" integrity="sha512-CruCP+TD3yXzlvvijET8wV5WxxEh5H8P4cmz0RFbKK6FlZ2sYl3AEsKlLPHbniXKSrDdFewhbmBK5skbdsASbQ==" crossorigin="anonymous" />
  <!-- font awesome style -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />


  <style>
    tr,td,th{
      padding: 5%;
    }
  </style>

</head>

<body class="sub_page">

  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
          <?php
if(isset($_SESSION["colore"])){
  $colore=$_SESSION["colore"];

          echo "<span style='color: $colore'>
              Pietra di Luna
            </span>";
}else{
  echo "<span>
  Pietra di Luna
</span>";
}
            ?>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  mx-auto ">
              <li class="nav-item">
                <a class="nav-link" href="index.php">Home </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="menu.php">Menu</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php">About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="book.php">Book Table</a>
              </li>
            </ul>
            <div class="user_option">
              <a href='login.php' class='user_link' style="color: #ffbe33">
                    <i class='fa fa-user' aria-hidden='true'></i> 
                           <?php
                if(isset($_SESSION["username"])
                and !empty($_SESSION["username"]) ){
                    $username=$_SESSION["username"];
                    echo "Ciao, $username
                    <a href='logout.php' class='order_online'>
                    Fai il Logout
                  </a>";
                }else{
                    echo "Login";
                }
                ?>
              </a>
                </svg>
              </a>
              <?php
                if(!isset($_SESSION["username"])
                and empty($_SESSION["username"]) ){
            
             echo " <a href='registrazione.php' class='order_online'>
                Registrati
              </a>";
                }
            ?>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

 <?php 
 //se utente deve fare login, form login, se no profilo
 if(!isset($_SESSION["username"])
 and empty($_SESSION["username"]) )
{
?>
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2 class="center">
          Esegui il login
        </h2>
      </div>
      <div class="row">
        <div class="col-md-4 center">
          <div class="form_container">
          <p class="center" style="display: inline; margin: 0 auto;">
            <?php 
            if(isset($_SESSION['messaggio'])){
            $messaggio = $_SESSION['messaggio']; 
            echo "<span style='color: red'>$messaggio</span>";
            unset($_SESSION['messaggio']);}
            ?>
            </p>
            <form action="controllo.php" method="post">
              <div>
                <input type="text" placeholder="Username" name="username" class="form-control"/>
              </div>
              <div>
                <input type="password"  placeholder="Password" name="password" class="form-control"/>
              </div>
              
              <div class="btn_box center" style="display: inline; margin: 0 auto;">
                <button type="submit">
                  Login
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
  <?php }else{
    if($_SESSION["username"]=="admin"){
      header("Location: home_admin.php");
    }
    $username=$_SESSION["username"];
    $_SESSION["username"]=$username;
?>
    <h1 style="margin: 5%; text-align: center;">Ecco il tuo profilo</h1>
<div style="margin: 5%;">
<?php

    sessioni();
    $erroreDB = "";
    try {
      $db = new PDO("mysql:dbname=pietra_luna;host=localhost;charset=utf8;", "root", "" );
    }
    catch (PDOException $ex) {
      $erroreDB = $ex->getMessage();
    }
  
    if($erroreDB!==""){
      echo $erroreDB;
    }
    $stmt=$db->prepare("SELECT * FROM utenti WHERE username=?");
    if(!$stmt->bindParam(1, $username)){
      echo "errore bind";
  }
  $stmt->execute();
    $record=$stmt->fetch(PDO::FETCH_ASSOC);
if(!$record)
{
    echo $record;
}else{

        $username=$record["username"];
        $password=$record["password"];
        $nome=$record["nome"];
        $cognome=$record["cognome"];
        $gen=$record["genere"];
        $genere="";
        if($gen=="o"){
          $genere="M";
        }elseif($gen=="a"){
          $genere="F";
        }elseif($gen=="*"){
          $genere="Non ti ritrovi in nessun genere convenzionale";
        }
        $punti=$record["punti"];
        $prenotazioni=$record["prenotazioni"];
        if(!$prenotazioni)
        {
            $prenotazioni="Nessuna";
        }
        echo "<table class='table table-responsive-sm table-striped'> 
        <tr>
        <th><strong>Username:</strong></th> <td>$username</td>
        </tr>
        <tr>
        <th><strong>Nome:</strong></th> <td>$nome</td>
        </tr>
        <tr>
        <th><strong>Cognome:</strong></th> <td>$cognome</td>
        </tr>
        <tr>
        <th><strong>Genere:</strong></th><td>$genere</td>
        </tr>
        <tr>
        <th><strong>Punti:</strong></th> <td>$punti</td>
        </tr>
        <tr>
        <th><strong>Prenotazione:</strong></th> <td>$prenotazioni</td></tr>
        </table>";
}
?>
</div>
<?php
$db=NULL;
}
?>
  <!-- end book section -->

     <!-- end slider section -->
     </div>

  
  <!-- footer section -->
  <footer class="footer_section">
    <div class="container">
      <div class="row">
        <div class="col-md-4 footer-col">
          <div class="footer_contact">
            <h4>
              Contattaci
            </h4>
            <div class="contact_link_box">
              <a href="">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
                <span>
                  Paizza Vittorio Emanuele,TO
                </span>
              </a>
              <a href="">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Chiama 011 123456
                </span>
              </a>
              <a href="">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  pietradiluna@gmail.com
                </span>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <div class="footer_detail">
            <a href="" class="footer-logo">
              Pietra di Luna
            </a>
            <p>Per te dal 1956</p>
            <div class="footer_social">
              <a href="">
                <i class="fa fa-facebook" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-twitter" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-linkedin" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-instagram" aria-hidden="true"></i>
              </a>
              <a href="">
                <i class="fa fa-pinterest" aria-hidden="true"></i>
              </a>
            </div>
          </div>
        </div>
        <div class="col-md-4 footer-col">
          <h4>
            Siamo aperti
          </h4>
          <p>
            Tutti i giorni
          </p>
          <p>
            10.00 -22.00 
          </p>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer section -->

  <!-- jQery -->
  <script src="js/jquery-3.4.1.min.js"></script>
  <!-- popper js -->
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
  </script>
  <!-- bootstrap js -->
  <script src="js/bootstrap.js"></script>
  <!-- owl slider -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js">
  </script>
  <!-- isotope js -->
  <script src="https://unpkg.com/isotope-layout@3.0.4/dist/isotope.pkgd.min.js"></script>
  <!-- nice select -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-nice-select/1.1.0/js/jquery.nice-select.min.js"></script>
  <!-- custom js -->
  <script src="js/custom.js"></script>
  <!-- Google Map -->
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCh39n5U-4IoWpsVGUHWdqB6puEkhRLdmI&callback=myMap">
  </script>
  <!-- End Google Map -->

</body>

</html>