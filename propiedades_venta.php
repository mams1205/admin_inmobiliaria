<?php
include('conexion_bd.php');
// Realizar una consulta
$sql = "SELECT 
    h.idpropiedad,
    f.partida,
    f.ruta_foto, 
    CASE 
        WHEN h.operacion = 'V' THEN 'Venta' 
        WHEN h.operacion = 'R' THEN 'Renta' 
        ELSE 'Traspaso' 
    END AS operacion, 
    h.precio, 
    h.estado, 
    h.municipio, 
    h.colonia, 
    h.cp,
    h.estatus,
    CASE 
        WHEN d.m2terr IS NULL THEN '-' 
        ELSE d.m2terr 
    END AS m2terr,
    CASE 
        WHEN d.m2const IS NULL THEN '-' 
        ELSE d.m2const 
    END AS m2const,
    CASE 
        WHEN d.hab IS NULL THEN '-' 
        ELSE d.hab 
    END AS hab,
    CASE 
        WHEN d.wc IS NULL THEN '-' 
        ELSE d.wc 
    END AS wc,
    d.autos
    FROM 
        Prop_H h
    LEFT JOIN 
        Prop_D d ON h.idpropiedad = d.idpropiedad
    LEFT JOIN 
        Prop_F f ON h.idpropiedad = f.idpropiedad
    WHERE 
       f.orden = (
            SELECT MIN(f2.orden) 
            FROM Prop_F f2 
            WHERE f2.idpropiedad = f.idpropiedad
        )
        AND
          (h.fechabaja IS NULL OR h.fechabaja > DATE(NOW()) - INTERVAL -15 DAY AND h.estatus = 'B')
        AND h.estatus != 'S'  
        AND h.operacion = 'V'
    ORDER BY h.idpropiedad ASC;";
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

    <!-- Page Title -->
    <div class="page-title" data-aos="fade">
      <div class="heading">
        <div class="container">
          <div class="row d-flex justify-content-center text-center">
            <div class="col-lg-8">
              <h1>Propiedades en Venta </h1>
              <p class="mb-0">Explora nuestro portafolio y encuentra el espacio ideal para tu próximo hogar o inversión.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Inicio</a></li>
            <li class="current">Propiedades en Venta</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Real Estate Section -->
<section id="real-estate" class="real-estate section">
  <div class="container">
    <div class="row gy-4">
      <?php
      for ($i = 0; $i < count($propiedades); $i++) {
        $id_propiedad = $propiedades[$i]['idpropiedad']; // ID de la propiedad
        $operacion = $propiedades[$i]['operacion'];
        $precio = $propiedades[$i]['precio'];
        $precio_format = number_format($precio, 2, '.', ',');
        $estado = $propiedades[$i]['estado'];
        $municipio = $propiedades[$i]['municipio'];
        $colonia = $propiedades[$i]['colonia'];
        $cp = $propiedades[$i]['cp'];
        $area = $propiedades[$i]['m2terr'];
        $const = $propiedades[$i]['m2const'];
        $habit = $propiedades[$i]['hab'];
        $autos = $propiedades[$i]['autos'];
        $wc = $propiedades[$i]['wc'];
        $id_propiedad = $propiedades[$i]['idpropiedad'];
        $ruta_foto = $propiedades[$i]['ruta_foto'];
        $estatus = $propiedades[$i]['estatus']
      ?>
        <div class="col-xl-4 col-md-6" data-aos="fade-up" data-aos-delay="300"> <!-- Ajustar aquí -->
          <div class="card">
            <img src="<?php echo $ruta_foto; ?>"alt="" class="img-fluid">
            <div class="card-body">
            <?php
              if($estatus == 'P') {
                  // Cuando el estatus es 'P', se muestra el texto "Apartada"
                  ?>
                  <span class="apartado">Apartada</span>
                  <?php
              } 
              elseif($estatus == 'B') {
                  // Cuando el estatus es 'A', se muestra el texto "Activo"
                ?>
                  <span class="baja">Vendida</span>
                <?php
              }
            ?>
              <span class="sale-rent"><?php echo $operacion . ' | $' . $precio_format; ?></span>
              <h3><a href="property-single.php?ID=<?php echo $id_propiedad; ?>" class="stretched-link"><?php echo $cp; ?> <?php echo $colonia; ?></a></h3>
              <div class="card-content d-flex flex-column justify-content-center text-center">
                <div class="row propery-info">
                <div class="col">
                  <i 
                    class="fa-solid fa-chart-area">
                  </i>
                  </div>
                <div class="col">
                    <i 
                      class="fa-solid fa-house">
                    </i>
                  </div>
                  <div class="col">
                    <i 
                      class="fa-solid fa-bed">
                    </i>
                  </div>
                  <div class="col">
                    <i class="fa-solid fa-bath"></i>
                  </div>
                  <div class="col">
                    <i class="fa-solid fa-car"></i>
                  </div>
                </div>
                <div class="row">
                  <div class="col"><?php echo $area . 'm²'; ?></div>
                  <div class="col"><?php echo $const . 'm²'; ?></div>
                  <div class="col"><?php echo $habit; ?></div>
                  <div class="col"><?php echo $wc; ?></div>
                  <div class="col"><?php echo $autos; ?></div>
                </div>
              </div>
            </div>
          </div>
        </div> <!-- Fin de la tarjeta -->
      <?php } ?>
    </div> <!-- Fin de la fila -->
  </div> <!-- Fin del contenedor -->
</section>


    </section><!-- /Real Estate Section -->

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