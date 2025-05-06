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
              <h1>Contáctanos</h1>
              <p class="mb-0">Si estás interesado en vender, rentar o comprar una propiedad, ¡estamos aquí para ayudarte! Nuestro equipo de expertos en bienes raíces está listo para ofrecerte asesoría personalizada y responder a todas tus preguntas. No dudes en comunicarte con nosotros para explorar las mejores opciones que se ajusten a tus necesidades. ¡Esperamos saber de ti pronto!</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li class="current">Contacto</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="mb-4" data-aos="fade-up" data-aos-delay="200">
          <iframe style="border:0; width: 100%; height: 270px;" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d972.2879314608576!2d-100.35429082455396!3d20.645739095730406!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85d35b86df49d987%3A0x7645101ac1dd0a0!2sPe%C3%B1a%20de%20Bernal%2C%20El%20Refugio%2C%2076146%20El%20Refugio%2C%20Qro.!5e1!3m2!1ses-419!2smx!4v1730495884039!5m2!1ses-419!2smx" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div><!-- End Google Maps -->
        <div class="row gy-4">

          <div class="col-lg-4">
            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
              <i class="bi bi-geo-alt flex-shrink-0"></i>
              <div>
                <h3>Dirección</h3>
                <p>Peña de Bernal 5167 Local 7</p>
                <p>Plaza Los Cantos, Residencial El Refugio</p>
                <p>Querétaro, Querétaro</p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
              <i class="bi bi-telephone flex-shrink-0"></i>
              <div>
              <h3>Llámanos!</h3>
              <p>
              +52 442 822 2174
               </p>
              </div>
            </div><!-- End Info Item -->

            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="500">
              <i class="bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Escríbenos!</h3>
                <p>contacto@grupopro.com.mx</p>
              </div>
            </div><!-- End Info Item -->

          </div>

          <div class="col-lg-8">
            <form id ="contact-form" action="forma_contacto.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
              <div class="row gy-4">

                <div class="col-md-6">
                  <input type="text" name="name" id = "name" class="form-control" placeholder="Nombre (s)" required="">
                </div>

                <div class="col-md-6 ">
                  <input type="email" class="form-control" name="email" id="email" placeholder="E-mail" required="">
                </div>

                <div class="col-md-12">
                  <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" required="">
                </div>

                <div class="col-md-12">
                  <textarea class="form-control" name="message" id = "message" rows="6" placeholder="Cuéntanos en qué te podemos ayudar." required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <div id="loading" style="display: none;">Loading...</div>
                  <div id="error-message" style="color: green; display: none;">Tu mensaje no ha podido ser enviado, intentalo de nuevo más tarde o contáctanos al +52 442 822 2174!</div>
                  <div id="success-message" style="color: green; display: none;">Tu mensaje ha sido enviado, pronto nos pondremos en contacto contigo!</div>
                  <div id="prueba-message" style="color: green; display: none;">Tu  ha sido enviado, pronto nos pondremos en contacto contigo!</div>
                
                  <button type="submit">Enviar</button>
                </div>

              </div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>

    </section><!-- /Contact Section -->

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
  document.getElementById("contact-form").addEventListener("submit", function (e) {
    e.preventDefault(); // Evita el envío estándar del formulario

    // Mostrar el indicador de carga
    document.getElementById("loading").style.display = "block";

    // Captura los datos del formulario
    const formData = new FormData(this);

    // Envía los datos al servidor con fetch
    fetch("forma_contacto.php", {
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
            document.getElementById("contact-form").reset();
        } else {
            // Mostrar mensaje de error
            document.getElementById("prueba-message").style.display = "block";
            document.getElementById("success-message").style.display = "none";
        }
    })
    .catch(() => {
        // Oculta el indicador de carga y muestra un mensaje de error
        document.getElementById("loading").style.display = "none";
        document.getElementById("prueba-message").style.display = "block";
        document.getElementById("success-message").style.display = "none";
    });
});

</script>

</body>

</html>