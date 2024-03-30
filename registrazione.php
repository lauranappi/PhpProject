<?php
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
  <script src="jquery-3.6.0.js" type="text/javascript"></script>

  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
  <script>
//script che chambia l'ultima lettera di Benvenuto e salva in sessione 
//dei colori che costituiscono il colore del nome del ristoran,e in ogni pagina(con sessioni)
   	$(document).ready(function() {
	  $(".gen").on("change", () => {
    const genere = $('input[name="genere"]:checked').val();
    let col="";
    if(genere=="o"){
      col="#E3F385";
    }
    if(genere=="a"){
      col="#12CB90";
    }
    if(genere=="*"){
      col="#FF9061";
    }
		// il valore di un campo input, type=color è una stringa di 7 caratteri che indica il colore (RGB) in formato esadecimale che inizia sempre con #
		// --> uso la funzione encodeURIComponent per sostituire # con la sua codifica %23 (altrimenti la HTTP request si confonde...)
    const ciao = encodeURIComponent(col);
    const fetchPromise = fetch("colore_titolo.php?c="+ciao);

		fetchPromise.then( (response) => {
			$(".benvenuto").html(genere);
      if(genere=="o"){
      $("#titolo").css({'color': '#E3F385'});}
      if(genere=="a"){
      $("#titolo").css({'color': '#12CB90'});}
      if(genere=="*"){
      $("#titolo").css({'color': '#FF9061'});}
		})
		.catch( (error) => {
			// stampo l'errore sulla console e sulla pagina (N.B. sulla pagina, solo in fase di sviluppo!)
			console.log(error.message);
			$("#messaggio").html(error.message);
		});
	  }); //onchange
	}); //ready
   </script>
</head>
<body class="sub_page">
<?php
?>
  <div class="hero_area">
    <div class="bg-box">
      <img src="images/hero-bg.jpg" alt="">
    </div>
    <!-- header section strats -->
    <header class="header_section">
      <div class="container">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.html">
            <span id="titolo">
              Pietra di Luna
            </span>
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
                <a class="nav-link" href="book.php">Book Table </a>
              </li>
            </ul>
            <div class="user_option">
              <a href='login.php' class='user_link'>
                    <i class='fa fa-user' aria-hidden='true'></i> 
                           <?php
                if(controllo() ){
                    $username=$_SESSION["username"];
                    echo "Ciao, $username";
                }else{
                    echo "Login";
                }
                ?>
              </a>
                </svg>
              </a>
        
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->
  </div>

  <!-- book section -->
  <section class="book_section layout_padding">
    <div class="container">
      <div class="heading_container">
        <h2>
          Benvenut<span class="benvenuto">*</span>! Registrati compilando i dati richiesti
        </h2>
      </div>
      <div class="row">
        <div class="col-md-11">
          <div class="form_container">
          <?php
if(isset($_SESSION['mex'])){
            $mex = $_SESSION['mex']; 
            echo "<span style='color: red;'>$mex</span>";
            unset($_SESSION['mex']);}
            //form di registrazione con ajax per utenti
?>
            <form action="controlla_registrazione.php" method="post" id="registrazione">
            <p class="errore">
<span id="messaggio"></span>
</p>
<div>
                Genere: <br/>
          <input type="radio" name="genere"  class="gen" value="o" required=""> M<br/>
          <input type="radio" name="genere"  class="gen" value="a" required=""> F<br/>
          <input type="radio" name="genere"  class="gen" value="*" required=""> Non mi ritrovo in questi generi
              </div><br/>
<div>Username:<input type="text" name="username"  class="form-control" required></div>
<div>Password:<input type="password" name="password"  class="form-control" required></div>
<div>Ripeti password: <input type="password" name="password2"  class="form-control" required></div>
<div>Nome:<input type="text" name="nome"  class="form-control" required></div>
<div>Cognome:<input type="text" name="cognome"  class="form-control" required></div>

              <div class="btn_box">
                <button type="submit" form="registrazione" value="Registrati">
                  Registrati
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>

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