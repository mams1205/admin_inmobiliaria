<?php
include('conexion_bd.php');
// Abre un formulario HTML con el método POST y la codificación para archivos adjuntos.
echo '<form method="post" 
            enctype="multipart/form-data"
            action="property-single.php?ID='.$_GET['ID'].'" />';
//ID de las propiedades
$SelID = $_GET['ID'];

// Realizar una consulta
$sql = "SELECT 
          h.idpropiedad,
          h.idinterna,
          IF(h.sector = 'R', 'Residencial', 
              IF(h.sector = 'C', 'Comercial', 
                  'Industrial')) AS sector,
          CASE 
          WHEN sector = 'R' AND h.tipoprop ='C' THEN 'Casa'
          WHEN sector = 'R' AND h.tipoprop ='D' THEN 'Departamento'
          WHEN sector = 'R' AND h.tipoprop ='T' THEN 'Terreno'
          WHEN sector = 'C' AND h.tipoprop ='B' THEN 'Bodega'
          WHEN sector = 'C' AND h.tipoprop ='C' THEN 'Consultorio'
          WHEN sector = 'C' AND h.tipoprop ='L' THEN 'Local'
          WHEN sector = 'C' AND h.tipoprop ='C' THEN 'Casa'
          WHEN sector = 'C' AND h.tipoprop ='O' THEN 'Oficina'
          WHEN sector = 'C' AND h.tipoprop ='P' THEN 'Plaza'
          WHEN sector = 'C' AND h.tipoprop ='T' THEN 'Terreno'
          WHEN sector = 'I' AND h.tipoprop ='B' THEN 'Bodega'
          WHEN sector = 'I' AND h.tipoprop ='N' THEN 'Nave'
          WHEN sector = 'I' AND h.tipoprop ='T' THEN 'Terreno'
          END AS tipoprop,
          IF(h.operacion = 'V', 'Venta', 
              IF(h.operacion = 'R', 'Renta', 
                  'Traspaso')) AS operacion,
          h.precio,
          h.titulo,
          h.descripcion,
          h.estado,
          h.municipio, 
          h.colonia,
          h.calle,
          h.noext,
          h.noint,
          h.cp,
          d.m2terr,
          CASE 
            WHEN d.m2const IS NULL THEN '0' 
            ELSE d.m2const 
          END AS m2const,
          d.autos,
          d.hab,
          d.wc,
          h.nomasesor,
          f.ruta_foto,
          a.RutaFoto as foto_asesor,
          a.eMail as mail_asesor,
          h.video as video_casa,
          h.liga_mapa as maps
        FROM Prop_H h
        LEFT JOIN 
          Prop_D d ON h.idpropiedad = d.idpropiedad
        LEFT JOIN
          Prop_F f ON f.idpropiedad = d.idpropiedad
        LEFT JOIN
          asesores a ON a.CveAsesor = h.cveAsesor

        WHERE h.idpropiedad = $SelID
        ORDER BY(f.orden) ASC";
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
$id_propiedad = $propiedades[0]['idpropiedad']; // ID de la propiedad
$cve_propiedad = $propiedades[0]['idinterna'];
$operacion = $propiedades[0]['operacion'];
$precio = $propiedades[0]['precio'];
$sector = $propiedades[0]['sector'];
$precio_format = number_format($precio, 2, '.', ',');
$estado = $propiedades[0]['estado'];
$municipio = $propiedades[0]['municipio'];
$colonia = $propiedades[0]['colonia'];
$cp = $propiedades[0]['cp'];
$area = $propiedades[0]['m2terr'];
$habit = $propiedades[0]['hab'];
$autos = $propiedades[0]['autos'];
$wc = $propiedades[0]['wc'];
$tipo_prop = $propiedades[0]['tipoprop'];
$estado = $propiedades[0]['estado'];
$descripcion = $propiedades[0]['descripcion'];
$parrafos = explode("\n", $descripcion); // Dividir el texto en párrafos utilizando saltos de línea
$titulo = $propiedades[0]['titulo'];
$asesor = $propiedades[0]['nomasesor'];
$asesor_foto = $propiedades[0]['foto_asesor'];
$mail_asesor = $propiedades[0]['mail_asesor'];
$m2_const = $propiedades[0]['m2const'];
$link_video = $propiedades[0]['video_casa'];
$link_maps = $propiedades[0]['maps'];

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

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1> <?php echo $tipo_prop; ?> <?php echo $sector . ' en ' . $colonia; ?></h1>
              <p class="mb-0"><?php echo $titulo; ?></p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="propiedades.php">Propiedades Disponibles</a></li>
            <li class="current">Propiedad <?php echo $cve_propiedad; ?></li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Real Estate 2 Section -->
    <section id="real-estate-2" class="real-estate-2 section">

      <div class="container" data-aos="fade-up">

        <div class="portfolio-details-slider swiper init-swiper">
          <script type="application/json" class="swiper-config">
            {
              "loop": true,
              "speed": 600,
              "autoplay": {
                "delay": 5000
              },
              "slidesPerView": "auto",
              "navigation": {
                "nextEl": ".swiper-button-next",
                "prevEl": ".swiper-button-prev"
              },
              "pagination": {
                "el": ".swiper-pagination",
                "type": "bullets",
                "clickable": true
              }
            }
          </script>
          <div class="swiper-wrapper align-items-center">
          <?php
            for ($i = 0; $i < count($propiedades); $i++){
              $ruta_foto = $propiedades[$i]['ruta_foto'];
          ?>
            <div class="swiper-slide">
              <img src="<?php echo $ruta_foto; ?>" alt="">
            </div>
          <?php
            }
          ?>

            <!-- <div class="swiper-slide">
              <img src="assets/img/property-slide/property-slide-2.jpg" alt="">
            </div>

            <div class="swiper-slide">
              <img src="assets/img/property-slide/property-slide-3.jpg" alt="">
            </div> -->

          </div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          <div class="swiper-pagination"></div>
        </div>

        <div class="row justify-content-between gy-4 mt-4">

          <div class="col-lg-8" data-aos="fade-up">

            <div class="portfolio-description">
              <h2>Descripción de la Propiedad</h2>
              <?php
                foreach ($parrafos as $parrafo) {
                  if (trim($parrafo) !== '') { // Ignorar párrafos vacíos
                      echo "<p>" . htmlspecialchars($parrafo) . "</p>";
                  }
              }
              ?>

              <!-- <p> <?php //echo $descripcion;?></p> -->

              <div class="testimonial-item">
                <p>
                  <span>
                    Hola! Soy  <?php echo $asesor; ?>,  tu asesor inmobiliario de confianza. Estoy aquí para ayudarte a 
                    encontrar el hogar o inversión perfecta. Contáctame y cuéntame en qué puedo ayudarte. ¡Responderé a la brevedad!
                  </span>
                <p>
                <?php
                  $telefono = "5214428222174"; // Número de teléfono en formato internacional (521 para México)
                  $current_property = "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                  $mensaje = "Hola!!, estoy interesado en obtener más información sobre esta propiedad. $current_property"; // Mensaje predefinido
                  $url = "https://wa.me/$telefono?text=" . urlencode($mensaje);
                ?>
                <div>
                  <img src="<?php echo $asesor_foto; ?>" class="testimonial-img" alt="">
                  <h3><?php echo $asesor; ?></h3>
                  <h4>Asesor</h4>
                  <h4>
                    <a href="<?php echo $url; ?>" target="_blank" style="text-decoration: none; color: inherit;">
                      <i class="fa-solid fa-phone"></i> 442 822 2174 
                    </a>
                    <i class="fa-solid fa-envelope" style="margin-left: 15px;"></i> <?php echo $mail_asesor; ?>
                  </h4>
                </div>
                
              </div>
            </div><!-- End Portfolio Description -->

            <!-- Tabs -->
            <ul class="nav nav-pills mb-3">
              <li><a class="nav-link active" data-bs-toggle="pill" href="#real-estate-2-tab1">Video</a></li>
              <li><a class="nav-link" data-bs-toggle="pill" href="#real-estate-2-tab3">Ubicación</a></li>
            </ul><!-- End Tabs -->

            <!-- Tab Content -->
            <div class="tab-content">

              <div class="tab-pane fade show active" id="real-estate-2-tab1">
              <iframe style="border:0; width: 100%; height: 400px;" src="https://www.youtube.com/embed/<?php echo $link_video; ?>" frameborder="0" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                  

              </div><!-- End Tab 1 Content -->

              <div class="tab-pane fade" id="real-estate-2-tab2">
                <img src="assets/img/floor-plan.jpg" alt="" class="img-fluid">
              </div><!-- End Tab 2 Content -->

              <div class="tab-pane fade" id="real-estate-2-tab3">
              <?php if (empty($link_maps)): ?>
                <img src="assets/img/RenovandoXY.jpg" alt="" class="img-fluid">
              <?php else: ?>
                <iframe <?php echo $link_maps; ?> </iframe>
                <?php endif; ?>
              </div>  
              <!-- End Tab 3 Content -->

            </div><!-- End Tab Content -->
          </div>

          <div class="col-lg-3" data-aos="fade-up" data-aos-delay="100">
            <div class="portfolio-info">
              <h3>Detalles de la Propiedad</h3>
              <ul>
                <li><strong>ID Propiedad:</strong><?php echo $cve_propiedad; ?></li>
                <li><strong>Ubicación:</strong><?php echo $municipio . ', ' . $estado . ',' . $cp; ?></li>
                <li><strong>Tipo de Propiedad:</strong> <?php echo $tipo_prop; ?></li>
                <li><strong>Estado:</strong> <?php echo $operacion; ?></li>
                <li><strong>Terreno:</strong> <span><?php echo $area . 'm²'; ?></span></li>
                <li><strong>Construcción:</strong> <span><?php echo $m2_const . 'm²'; ?></span></li>
                <li><strong>Habitaciones:</strong> <?php echo $habit; ?> </li>
                <li><strong>Baños:</strong> <?php echo $wc; ?></li>
                <li><strong>Estacionamiento:</strong> <?php echo $autos; ?></li>
                <li><a 
                      href="property-single-ficha.php?ID=<?php echo $SelID; ?>"
                      class="btn"
                      style="background-color: #00A8A8; color: white; font-size: 16px; font-weight:bold;">
                      Generar Ficha Técnica
                    </a>
                </li>
              </ul>
            </div>
          </div>

        </div>

      </div>

    </section><!-- /Real Estate 2 Section -->

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