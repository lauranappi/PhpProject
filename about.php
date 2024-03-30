<?php
// avvio sessione
session_start();
include("functions.php");
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
  <link href="css/font-awesome.min.css" rel="stylesheet" />
  <script src="jquery-3.6.0.js" type="text/javascript"></script>

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
<script>
$(document).ready(function() {
$('#moreinfo').hide();
$('#read').text('Mostra di più');


$('#read').click(function() {
  $('#moreinfo').toggle('slow');
  $('#read').text(function(_,txt) {
      var ret=''; //sta per return

      if ( txt == 'Mostra di più' ) {
         ret = 'Mostra di meno';
      }else{
         ret = 'Mostra di meno';
      }
      return ret; //ritorna il contenuto della variabile nel metodo text che sostituisce il valore del testo del bottone
  });
  return false;  //disativa il bottone (non ha funzione di rimandare da qualche altra parte)
});

});
</script>
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
          <a class="navbar-brand" href="index.html"> <!-- spazio bootstrap logo--> 
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
<!--button di espasione/compressione menu con aria x disabilità-->
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
              <li class="nav-item active">
                <a class="nav-link" href="about.php">About <span class="sr-only">(current)</span> </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="book.php">Book Table</a>
              </li>
            </ul>
            <div class="user_option">
              <a href='login.php' class='user_link'>
                    <i class='fa fa-user' aria-hidden='true'></i> 
                           <?php
                if(controllo()){
                    $username=$_SESSION["username"];
                    echo "Ciao, $username<a href='logout.php' class='order_online'>
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

  <!-- about section -->

  <section class="about_section layout_padding">
    <div class="container  ">

      <div class="row">
        <div class="col-md-6 ">
          <div class="img-box">
            <img src="images/about-img.png" alt="">
          </div>
        </div>
        <div class="col-md-6">
          <div class="detail-box">
            <div class="heading_container">
              <h2>
                Siamo Pietra di Luna
              </h2>
            </div>
            <p>
            <h2>- Una tradizione di famiglia -</h2>
Il ristorante pizzeria Pietra di Luna è gestito dal 1977 dalla famiglia Saba.
Oggi, a portare avanti la tradizione di famiglia sono Andrea e Paolo, che hanno ereditato la 
passione per la ristorazione dai genitori Salvatore e Giuseppina. Insieme a loro c’è uno staff
 affiatato e cortese pronto ad accogliere e a soddisfare le esigenze degli ospiti della Pietra di Luna.


           <div id="moreinfo"> <h2>- La nostra cucina -</h2>
Il ristorante, situato lungo la costiera amalfitana, 
vanta una lunghissima storia. Nato nel 1890 come rosticceria,
 dove i maiorani si mettevano in fila per acquistare i cartocci
  di fritto misto famosi in tutta la città, negli anni ’60 è diventato un ristorante.
Dal 1977, Pietra di Luna è gestito dalla famiglia Saba, che porta avanti la grande 
tradizione gastronomia di questo locale proponendo una cucina mediterranea, molto 
apprezzata dai campani e dai tanti turisti che visitano la città. Il ristorante pizzeria 
si trova, infatti, in una delle zone più turistiche della costiera.
Gli ospiti de Pietra di Luna possono godere della bellezza di questo luogo pranzando 
nel dehor che viene allestito all’esterno durante la bella stagione.
Il locale propone un ricco menu con piatti tipici italiani, realizzati con prodotti 
stagionali scelti accuratamente dallo chef. Antipasti, primi, secondi, pizze e dessert 
sono in grado di soddisfare tutti coloro che vogliono provare piatti gustosi e genuini,
 come nella migliore tradizione gastronomica italiana.


<h2>- Ottime pizze -</h2>
Se vuoi mangiare una gustosa pizza a Maiori, Pietra di Luna ti sorprenderà!
L’impasto della pizza viene fatto lievitare dalle 24 alle 36 ore e la cottura viene 
fatta nel forno a legna, come vuole la tradizione. Le pizze vengono preparate con 
ingredienti di qualità, come la mozzarella di bufala campana o la burrata pugliese, e
 servite in tanti gusti diversi.
            </div>
            </p>
            <a id="read">
            </a>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- end about section -->

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