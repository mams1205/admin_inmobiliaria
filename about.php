<?php
  include('conexion_bd.php');

  $sql = "SELECT COUNT(*)
          FROM Prop_H
          WHERE estatus = 'A'";
  $resultado = mysqli_query($conexion, $sql);

  // Verificar si la consulta fue exitosa
  if ($resultado) {
  // Obtener el número de filas desde el resultado
    $row = mysqli_fetch_row($resultado);
    
    // Almacenar el resultado en una variable
    $count = $row[0];  // El resultado del COUNT(*) estará en la primera posición del arreglo
    
  } else {
  // Si ocurre un error en la consulta
  echo "Error al ejecutar la consulta: " . mysqli_error($conexion);
  }
?>

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
              <h1>¿Quiénes Somos?</h1>
              <p class="mb-0">Con más de 15 años de Experiencia. Te ofrecemos toda la información necesaria para que tu inversión siempre sea segura y con el máximo de rendimiento, ya que, para invertir en una casa, departamento, local, oficina, terreno o cualquier tipo de propiedad se requiere de conocimiento sobre precios, las zonas en desarrollo, el mercado, la plusvalía y los trámites.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li class="current">¿Quiénes Somos?</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- About Section -->
    <section id="about" class="about section">

      <div class="container">

        <div class="row gy-4">

          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="100">
            
            <h3>Profesionales Certificados</h3>
            <p style="text-align: justify;">
            Contamos con un equipo de expertos altamente calificados, especializados en brindar asesoría en la comercialización de bienes inmuebles.
            Nuestros profesionales están certificados por CONOCER en los siguientes estándares de competencia:
            </p>
            <ul>
              <li><i class="bi bi-check-circle"></i> <span>EC0110.02: Asesoría en Comercialización de Bienes Inmuebles.</span></li>
              <li><i class="bi bi-check-circle"></i> <span>EC1564: Prestación de servicios de asesoría en comercialización de inmuebles comerciales e industriales.</span></li>
            </ul>
            <h3>Nuestra Misión</h3>
            <p style="text-align: justify;">
            Somos un grupo de expertos en servicios integrales de intermediación inmobiliaria, que brinda al cliente transparencia y profesionalismo.
            </p>
            <h3>Nuestra Visión</h3>
            <p style="text-align: justify;">
            Ser una inmobiliaria destacada en el medio. Lideres en servicios inmobiliarios, siempre a la vanguardia en el sector.
            </p>
            <h3>Nuestros Valores</h3>
            <p>
              <ul style="list-style-type: disc; padding-left: 20px">
                <li>INTEGRIDAD</li>
                <li>PRODUCTIVIDAD</li>
                <li>PROFESIONALISMO</li>
                <li>COMPROMISO</li>
                <li>TRANSPARENCIA</li>
                <li>TRABAJO EN EQUIPO</li>
                <li>INNOVACIÓN</li>
              </ul>
            </p>
          </div>

          <div class="col-lg-6 about-images" data-aos="fade-up" data-aos-delay="200">
            <div class="row gy-4">
              <div class="col-lg-6">
                <img src="assets/img/ofi_1.jpg" class="img-fluid" alt="">
              </div>
              <div class="col-lg-6">
                <div class="row gy-4">
                  <div class="col-lg-12">
                    <img src="assets/img/ofi_2.jpg" class="img-fluid" alt="">
                  </div>
                  <div class="col-lg-12">
                    <img src="assets/img/ofi_3.jpg" class="img-fluid" alt="">
                  </div>
                </div>
              </div>
            </div>

          </div>

        </div>

      </div>
    </section><!-- /About Section -->

    <!-- Stats Section -->
    <section id="stats" class="stats section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="bi bi-emoji-smile color-blue flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
                <p>Casos de Éxito</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="fa-solid fa-clock color-green flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="30" data-purecounter-duration="1" class="purecounter"></span>
                <p>Velocidad de venta/renta</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
            <i class="fa-solid fa-calendar-days color-green flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="15" data-purecounter-duration="1" class="purecounter"></span>
                <p>Años de Experiencia</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item d-flex align-items-center w-100 h-100">
              <i class="fa-solid fa-house color-green flex-shrink-0"></i>
              <div>
                <span data-purecounter-start="0" data-purecounter-end="<?php echo $count?>" data-purecounter-duration="1" class="purecounter"></span>
                <p>Propiedades en Portafolio</p>
              </div>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>

    </section><!-- /Stats Section -->

    <!-- Features Section -->
    <section id="features" class="features section">

      <div class="container">

        <div class="row justify-content-around gy-4">
          <div class="features-image col-lg-6" data-aos="fade-up" data-aos-delay="100"><img src="assets/img/floor-plan.jpg" alt="">
          </div>
          <div class="col-lg-5 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                <p style="text-align: justify;">En nuestro grupo siempre habrá un asesor inmobiliario que te pueda orientar sobre cuáles son los lugares más viables para vivir, para iniciar un negocio de compra-venta de inmuebles o para comprar y rentar.</p>
                <p style="text-align: justify;">Cualquiera que sea tu motivo, la inversión inmobiliaria sigue siendo una de las mejores, pues se considera segura, rentable y de bajo riesgo, siempre y cuando se elija el inmueble correcto.</p>
                <h3 style="text-align: center;">¡CONTÁCTANOS YA!</h3>
              </div>
          </div><!-- End Icon Box -->
          </div>
        </div>

      </div>
      

    </section><!-- /Features Section -->

    <section id="asesores" class="asesores"> <!---INICIO ASESORES SECTION-->
      <div class = "container" style="text-align: center; ">
        <h1 style="font-weight: bold;">¡Conoce a nuestro equipo!</h1>
            <div class="row d-flex align-items-stretch">
                <div class="col-sm-3 p-2 p-sm-3">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/S_perez_2.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">Teresa Castro</h4>
                      <a href="https://wa.me/524426790056" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/asesor2.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Juan Martínez
                      </h4>
                      <a href="https://wa.me/527228744584" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/asesor3.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Sandra Pérez
                      </h4>
                      <a href="https://wa.me/527224954273" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/asesor4.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Santiago Peña
                      </h4>
                      <a href="https://wa.me/524421099242" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>
                
            </div>
            <div class="row d-flex align-items-stretch">
                <div class="col-sm-3 p-2 p-sm-3">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/asesor5.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Teresita Velasco
                      </h4>
                      <a href="https://wa.me/524428222174" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3"">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/asesor6.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Estela Pitayo
                      </h4>
                      <a href="https://wa.me/524622884175" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3"">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/asesor7.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Emanuel Sanchez
                      </h4>
                      <a href="https://wa.me/525518970380" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3"">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/asesor8.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Cristina Durango
                      </h4>
                      <a href="https://wa.me/524428222174" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3"">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/jacob.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Jacob Rodríguez
                      </h4>
                      <a href="https://wa.me/524427072947" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3"">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/erika_alvarado.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Ericka Alvarado
                      </h4>
                      <a href="https://wa.me/528112864900" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

                <div class="col-sm-3 p-2 p-sm-3"">
                  <div class="card">
                    <div class="card-header" style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 20px;">Asesor </div>
                    <div class="card-body text-center">
                      <img src='assets/img/team/vero_garcia.jpg' alt="Imagen" 
                          class="img-fluid rounded-circle" 
                          style="width: 200px; height: 225px; border-radius: 50%; object-fit: cover;">
                      <h4 class="card-title" style="font-weight: bold; font-size: 25px; color:#185A69; ">
                        Verónica García
                      </h4>
                      <a href="https://wa.me/524421527529" target="_blank" class="btn btn-success" 
                        style="background-color: #00A8A8; color: white; font-weight: bold; font-size: 16px; padding: 10px 15px; border-radius: 5px; text-decoration: none; display: inline-flex; align-items: center; gap: 8px;">
                          <i class="fa-brands fa-whatsapp"></i> WhatsApp
                      </a>
                    </div>
                  </div>               
                </div>

            </div>
      </div>
    </section><!---fIN ASESORES SECTION-->

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