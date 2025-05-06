
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'head.php'; ?>
</head>


<body class="index-page">
  <?php include 'header.php'; ?>



  <main class="main">

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Impulsamos Alianzas Estratégicas para tu Beneficio</h1>
              <p class="mb-0">En GrupoPro, creemos en la fuerza de las colaboraciones. Por eso, en esta sección encontrarás a nuestros socios comerciales, cuidadosamente seleccionados por su calidad, confiabilidad y compromiso con la excelencia. Estas alianzas no solo refuerzan nuestra misión, sino que también te brindan acceso a servicios y productos que complementan lo que ofrecemos, aportando valor a cada uno de tus proyectos.</p>
              <br>
              <p class="mb-0">Explora las oportunidades que hemos preparado junto a ellos y encuentra soluciones que harán la diferencia.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li class="current">Socios Comerciales</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Agents Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      <!-- INICIA EL CARROUSEL -->
        
          <div class="carousel-item active">
              <img src="assets/img/RenovandoXY.jpg" alt="">
              <div class="carousel-container"> 
              </div>
          </div><!-- End Carousel Item -->

          <div class="carousel-item">
              <img src="assets/img/RenovandoXY.jpg" alt="">
              <div class="carousel-container"> 
              </div>
          </div><!-- End Carousel Item -->

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

      </div>

    </section><!-- /Hero Section -->


  </main>
  <!-- footer -->
<?php include 'footer.php'; ?>
  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
<script> 
  document.getElementById("agents-form").addEventListener("submit", function (e) {
    e.preventDefault(); // Evita el envío estándar del formulario

    // Mostrar el indicador de carga
    document.getElementById("loading").style.display = "block";

    // Captura los datos del formulario
    const formData = new FormData(this);

    // Envía los datos al servidor con fetch
    fetch("forma_agentes.php", {
        method: "POST",
        body: formData
    })
    .then(response => response.text())
    .then(data => {
      console.log(data)
        // Oculta el indicador de carga
        document.getElementById("loading").style.display = "none";

        if (data.trim() === "success") {
            // Mostrar mensaje de éxito
            document.getElementById("success-message").style.display = "block";
            document.getElementById("error-message").style.display = "none";

            // Opcional: Limpiar los campos del formulario
            document.getElementById("agents-form").reset();
        } else {
            // Mostrar mensaje de error
            document.getElementById("error-message").style.display = "block";
            document.getElementById("success-message").style.display = "none";
        }
    })
});

</script>

</body>

</html>