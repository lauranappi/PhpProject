<?php
session_start();
include("functions.php");
?>
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
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
<style>
    .divisori {
        border: 2px solid #ffc107;
        border-radius: 2%;
        padding: 2%;
        margin: 1% auto;

    }
    </style>
</head>

<body>
  <?php
  if(controllo_admin())
 {
  $username=$_SESSION["username"];
  $_SESSION["username"]=$username;
 //verifica sessione username e presenta sezioni admin
  ?>
<div class="container ">
              <div class="row">
                <div class="col-md-7 col-lg-6 divisori ">
                  <div class="detail-box">
                    <h1>
                     Gestione Prenotazioni
                    </h1>
                    <p>
                        <p> In questa pagina puoi creare una nuova prenotazione, cancellare una prenotaizone o cancellare tutte le prenotazioni con un solo click.</p>
                    <div class="btn-box">
                      <a href="prenotazioni_ute.php" class="btn btn-warning">
                        Visualizza Ora
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 col-lg-6  divisori ">
                  <div class="detail-box">
                    <h1>
                      Gestione Tavoli
                    </h1>
                    <p>
                    <p>In questa pagina puoi eliminare un tavoli, liberarlo, liberare tutti i tavoli o crearne uno nuovo.</p>
                    <div class="btn-box">
                      <a href="./app_client_Bootstrap/" class="btn btn-warning">
                        Visualizza Ora
                      </a>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-7 col-lg-6  divisori ">
                  <div class="detail-box">
                    <h1>
                      Gestione utenti
                    </h1>
                    <p>
                        <p>In questa pagina puoi aggiungere utenti, eliminare degli sconti agli utenti, creare una nuova prenotazione o modificarne una già esistente.</p>
                    
                    <div class="btn-box">
                      <a href="utenti.php" class="btn btn-warning">
                        Visualizza Ora
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <br/>
            <center><div class="btn-box">
                      <a href="logout.php" class="btn btn-warning">
                        Logout
                      </a>
                    </div></center>
                    <br/>
            <?php
 }
 ?>



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