<?php
include('conexion_bd.php');
// Realizar una consulta
$sql = "SELECT 
          h.idpropiedad,
          f.partida,
          IF(h.operacion = 'V', 'Venta', 
              IF(h.operacion = 'R', 'Renta', 
                  'Traspaso')) AS operacion, 
          h.precio, 
          h.estado, 
          h.municipio, 
          h.colonia, 
          h.cp, 
          f.ruta_foto 
        FROM 
            Prop_H h
        LEFT JOIN 
            Prop_F f ON h.idpropiedad = f.idpropiedad
        WHERE f.destacado = 'S' AND h.estatus = 'A'"; // Cambia "PROP_F" por el nombre correcto si es diferente
$resultado = mysqli_query($conexion, $sql);

//array vacio
$propiedades =[];
/// Verificar si la consulta devolvió resultados
if (mysqli_num_rows($resultado) > 0) {
  // Recorrer y mostrar cada fila de la tabla
  while ($fila = mysqli_fetch_assoc($resultado)) {
    $propiedades[]=$fila; //se agrega la fila al array

  }
} else {
  echo "No se encontraron resultados.";
}

// Cerrar la conexión
mysqli_close($conexion);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'head.php'; ?>
</head>


<body class="index-page">
  <?php include 'header.php'; ?>
  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section dark-background">

      <div id="hero-carousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
      <!-- INICIA EL CARROUSEL -->
        <?php
        for ($i = 0; $i < count($propiedades); $i++){
          $activeClass = ($i === 0) ? 'active' : ''; // Solo el primer elemento debe ser activo
          $ruta_foto = $propiedades[$i]['ruta_foto']; // Ruta de la foto
          $id_propiedad = $propiedades[$i]['idpropiedad']; // ID de la propiedad
          $operacion = $propiedades[$i]['operacion'];
          $precio = $propiedades[$i]['precio'];
          $precio_format = number_format($precio, 2, '.', ',');
          $estado = $propiedades[$i]['estado'];
          $municipio = $propiedades[$i]['municipio'];
          $colonia = $propiedades[$i]['colonia'];
          $cp = $propiedades[$i]['cp'];
          $id_propiedad = $propiedades[$i]['idpropiedad'];
          ?>
          <div class="carousel-item <?php echo $activeClass; ?>">
              <img src="<?php echo $ruta_foto; ?>" alt="">
              <div class="carousel-container">
                  <div>
                      <p><?php echo $municipio . ', ' . $estado; ?></p> <!-- Puedes cambiar esto según los datos -->
                      <h2><span><?php echo $cp; ?></span> <?php echo $colonia; ?></h2> <!-- Cambia el título según tus datos -->
                      <a href="property-single.php?ID=<?php echo $id_propiedad; ?>" class="btn-get-started"> <?php echo $operacion . ' | $' . $precio_format; ?></a> <!-- Cambia el precio y tipo según tus datos -->
                  </div>
              </div>
          </div><!-- End Carousel Item -->
          <?php
      }
      ?>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

      </div>

    </section><!-- /Hero Section -->

    <!-- Services Section -->
    <section id="services" class="services section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Nuestros Servicios</h2>
        <p>En Grupo Pro, brindamos asesoría experta en compra, venta y alquiler de propiedades para ayudarte a encontrar la opción ideal.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="service-item  position-relative">
              <div class="icon">
                <i class="fa-solid fa-house"></i>
              </div>
              <a href="contact.php" class="stretched-link">
                <h3>Asesoria Integral en Compra y Venta de Propiedades</h3>
              </a>
              <p>Ofrecemos asistencia completa en la compra y venta de casas, apartamentos, 
                terrenos y locales comerciales, incluyendo promoción de propiedades.</p>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
            <div class="service-item position-relative">
              <div class="icon">
              <i class="fas fa-chart-line"></i>
              </div>
              <a href="contact.php" class="stretched-link">
                <h3>Opiniones de Valor y Avaluos</h3>
              </a>
              <p>Nuestros servicios incluyen opinion de valor (analisis comparativo del mercado) esto es gratuito al contratar en exclusiva nuestro servicio. Si lo deseas tenemos socios comerciales en peritaje de inmuebles, con un costo extra.</p>
              <a href="contact.php" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
            <div class="service-item position-relative">
              <div class="icon">
              <i class="fas fa-hand-holding-usd"></i>
              </div>
              <a href="contact.php" class="stretched-link">
                <h3>Asesoramiento Hipotecario</h3>
              </a>
              <p>Al contratar con nosotros te podemos contactar con nuestros socios comerciales especialistas en asesoramiento financiero en créditos hipotecarios bancarios, este sin costo extra. Tambien INFONAVIT, FOVISSTE Y OTROS con costo extra.</p>
              <a href="contact.php" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
              <i class="fas fa-bullhorn"></i>
              </div>
              <a href="contact.php" class="stretched-link">
                <h3>Marketing Inmobiliario Efectivo</h3>
              </a>
              <p>Promocionamos propiedades en diversas plataformas y organizamos visitas guiadas,
                maximizando su atractivo para compradores o inquilinos.</p>
              <a href="contact.php" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
              <i class="fas fa-balance-scale"></i>
              </div>
              <a href="contact.php" class="stretched-link">
                <h3>Normativas y Contratos</h3>
              </a>
              <p>Estamos alineados a la NOM 247. Todas las propiedades que ofrecemos son legalmente vendibles revisadas por nuestra área legal.</p>
              <a href="contact.php" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

          <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
            <div class="service-item position-relative">
              <div class="icon">
              <i class="fas fa-dollar-sign"></i>
              </div>
              <a href="contact.php" class="stretched-link">
                <h3>Oportunidades de Inversión en el Mercado Inmobiliario</h3>
              </a>
              <p>Consulta promociones que ofrecemos al comprar con nosotros en desarrollos afiliados a GrupoPro y oportunidades de inversión de costo mas bajo de su valor catastral</p>
              <a href="contact.php" class="stretched-link"></a>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>

    </section><!-- /Services Section -->

    <!-- Agents Section -->
    <section id="agents" class="agents section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Broker Owner</h2>
        <p>Profesionales dedicados a brindarte asesoría y confianza en cada decisión.</p>
      </div><!-- End Section Title -->

      <div class="container">

        <div class="row gy-5">

        <!-- mensaje predefinido whatsapp -->
         
        <?php
           $teamMembers = [
            [
              'name' => 'Elba Segovia Cruz',
              'title' => 'Broker Owner',
              'phone' => '5214424311792', // Elba's phone number
              'image' => 'assets/img/team/ESC.jpg',
            ],
            [
              'name' => 'Cecilia Perez R.',
              'title' => 'Broker Owner',
              'phone' => '5213318317002', // Cecilia's phone number
              'image' => 'assets/img/team/Cecy.jpg',
            ],

          ];
          $mensaje = "¡Hola!, estoy interesado en obtener más información sobre sus propiedades."; // Mensaje predefinido
          // $url = "https://wa.me/$telefono?text=" . urlencode($mensaje);
        ?>
        <?php foreach ($teamMembers as $member):?>
          <?php
            $url = "https://wa.me/{$member['phone']}?text=" . urlencode($mensaje);
          ?>
          <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-delay="100">
            <div class="member">
              <div class="pic"><img src="<?php echo $member['image']; ?>" class="img-fluid" alt=""></div>
                <div class="member-info">
                  <h4><?php echo $member['name']; ?></h4>
                  <span><?php echo $member['title']; ?></span>
                <div class="social">
                  <a href="<?php echo $url; ?>"> <i class="fa-brands fa-whatsapp"></i></a>
                  <a href="https://www.facebook.com/profile.php?id=61567439252054"><i class="bi bi-facebook"></i></a>
                  <a href="https://www.instagram.com/grupoproinmobiliario/"><i class="bi bi-instagram"></i></a>
                  <a href="https://www.youtube.com/@GrupoproInmobiliario/videos"><i class="fa-brands fa-youtube"></i></a>
                </div>
              </div>
            </div>
          </div><!-- End Team Member -->
        <?php endforeach; ?>

        </div>
      </div>

    </section><!-- /Agents Section -->

    <!-- Testimonials Section -->
    <section id="testimonials" class="testimonials section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Historias de Satisfacción</h2>
        <p>Conoce las experiencias de quienes ya han confiado en nosotros para cumplir sus sueños inmobiliarios</p>
      </div><!-- End Section Title -->

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 1000,
              "autoplay": {
                "delay": 9000
              },
              "slidesPerView": "auto",
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              },
              "breakpoints": {
                "320": {
                  "slidesPerView": 1,
                  "spaceBetween": 40
                },
                "1200": {
                  "slidesPerView": 3,
                  "spaceBetween": 1
                }
              }
            }
          </script>
          <div class="swiper-wrapper">

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                Con la ayuda de Mónica, el proceso de compra de la casa fue bastante fluido. Nos brindó información clara sobre cada paso y siempre estuvo disponible para resolver cualquier consulta. Su conocimiento y seguimiento hicieron que el proceso avanzara sin complicaciones. Agradecemos su ayuda para encontrar la propiedad adecuada y llevar a cabo la compra de manera eficiente."
                </p>
                <div class="profile mt-auto">
                  <!-- <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt=""> -->
                  <h3>Lucía Ramírez</h3>
                  <!-- <h4>Ceo &amp; Founder</h4> -->
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Trabajar con Elba fue muy práctico. Ella se encargó de coordinar visitas y nos ayudó a aclarar todas las dudas sobre el contrato de renta. Fue profesional y rápida en las respuestas, lo cual nos facilitó mucho el proceso. Encontramos el departamento que queríamos sin contratiempos, y la gestión de Elba hizo que el trámite fuera directo y sencillo.
                </p>
                <div class="profile mt-auto">
                  <!-- <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt=""> -->
                  <h3>Javier Ramírez</h3>
                  <!-- <h4>Designer</h4> -->
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                Gracias a los asesores de Grupo Pro, vender mi casa fue muy fácil. Desde el primer momento, se encargaron de todo: gestionaron las visitas, promovieron la propiedad y mantuvieron una comunicación constante. No tuve que preocuparme por nada, y la venta se concretó rápidamente. Estoy muy satisfecho con la atención que recibí.
                </p>
                <div class="profile mt-auto">
                  <!-- <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt=""> -->
                  <h3>Gabriel Peña</h3>
                  <!-- <h4>Ceo &amp; Founder</h4> -->
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                Con la ayuda de Mónica, el proceso de compra de la casa fue bastante fluido. Nos brindó información clara sobre cada paso y siempre estuvo disponible para resolver cualquier consulta. Su conocimiento y seguimiento hicieron que el proceso avanzara sin complicaciones. Agradecemos su ayuda para encontrar la propiedad adecuada y llevar a cabo la compra de manera eficiente."
                </p>
                <div class="profile mt-auto">
                  <!-- <img src="assets/img/testimonials/testimonials-1.jpg" class="testimonial-img" alt=""> -->
                  <h3>Lucía Ramírez</h3>
                  <!-- <h4>Ceo &amp; Founder</h4> -->
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                  Trabajar con Elba fue muy práctico. Ella se encargó de coordinar visitas y nos ayudó a aclarar todas las dudas sobre el contrato de renta. Fue profesional y rápida en las respuestas, lo cual nos facilitó mucho el proceso. Encontramos el departamento que queríamos sin contratiempos, y la gestión de Elba hizo que el trámite fuera directo y sencillo.
                </p>
                <div class="profile mt-auto">
                  <!-- <img src="assets/img/testimonials/testimonials-2.jpg" class="testimonial-img" alt=""> -->
                  <h3>Javier Ramírez</h3>
                  <!-- <h4>Designer</h4> -->
                </div>
              </div>
            </div><!-- End testimonial item -->

            <div class="swiper-slide">
              <div class="testimonial-item">
                <div class="stars">
                  <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                </div>
                <p>
                Gracias a los asesores de Grupo Pro, vender mi casa fue muy fácil. Desde el primer momento, se encargaron de todo: gestionaron las visitas, promovieron la propiedad y mantuvieron una comunicación constante. No tuve que preocuparme por nada, y la venta se concretó rápidamente. Estoy muy satisfecho con la atención que recibí.
                </p>
                <div class="profile mt-auto">
                  <!-- <img src="assets/img/testimonials/testimonials-3.jpg" class="testimonial-img" alt=""> -->
                  <h3>Gabriel Peña</h3>
                  <!-- <h4>Entrepreneur</h4> -->
                </div>
              </div>
            </div><!-- End testimonial item -->

          </div>
          <div class="swiper-pagination"></div>
        </div>

      </div>

    </section><!-- /Testimonials Section -->

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

</body>

</html>