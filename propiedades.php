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
        and
        (h.fechabaja IS NULL OR h.fechabaja > DATE(NOW()) - INTERVAL -15 DAY AND h.estatus = 'B')
        AND h.estatus != 'S'
        ORDER BY h.idpropiedad ASC";
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
// mysqli_close($conexion);
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
              <h1>Propiedades Disponibles </h1>
              <p class="mb-0">Explora nuestro portafolio y encuentra el espacio ideal para tu próximo hogar o inversión.</p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.html">Inicio</a></li>
            <li class="current">Propiedades</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Real Estate Section -->
<section id="real-estate" class="real-estate section">
  <div class="container">
    <div class="row gy-4">
      <div class="col-md-3 bg-light p-4">
      <form action="", method="GET">
        <h4 style="border: 2px solid #0000; padding: 10px; background-color: #00A8A8; border-radius: 8px; text-align: center; color: white">
          Busqueda Por Filtros </h4>
        <h5>Venta/Renta</h5>
            <select name="venta_renta" id="venta_renta" class="form-select">
            <?php if(isset($_GET['venta_renta'])){
              $venta_renta = $_GET['venta_renta'];
              if ($venta_renta == 'V') {
                $venta_renta_concep = 'Venta';
              }else{
                $venta_renta_concep= 'Renta';
              }
            ?>
              <option value="<?php echo $venta_renta; ?>"><?php echo $venta_renta_concep; ?></option>
              <?php
              if ($venta_renta != 'V') {
                  echo '<option value="V">Venta</option>';
              }
              if ($venta_renta != 'R') {
                  echo '<option value="R">Renta</option>';
              }
              ?>
            </select> 
            <?php  
            }else{
              $venta_renta = ""
            ?>
             <option value="" disabled selected>Selecciona una opción</option>
              <option value="V">Venta</option>
              <option value="R">Renta</option>
            </select> 
            <?php 
            }
            ?>    
        <br>
        <h5>Ubicación</h5>
        <label for="estado" style="margin-top: 10px; display: block;">Estado</label>
        <!-- estado -->
          <?php
            if(isset($_GET['estado']))
              {
                $select_estado = $_GET['estado'];
                echo '
                    <select name="estado" id="estado" class="form-select">
                      <option value="' . htmlspecialchars($select_estado) . '">' . htmlspecialchars($select_estado) . '</option>
                    </select>';
              }
            else
            {
              $select_estado = "";
              $sql_estado = "SELECT DISTINCT(estado) as estado
                            FROM Prop_H
                            WHERE estatus ='A'";
              $res_estado = mysqli_query($conexion, $sql_estado);
              ?>
              <select name="estado" id="estado" class = "form-select">
                <option value="">Seleccione un estado</option>
                <?php
                // Generar las opciones dinámicamente
                if ($res_estado->num_rows > 0) {
                    while($row_estado = mysqli_fetch_assoc($res_estado)){
                      echo '<option value="' . $row_estado['estado'] . '">' . $row_estado['estado'] . '</option>';
                    }

                } else {
                    echo '<option value="">No hay categorías disponibles</option>';
                }
            }
              ?>
            </select>
        <!-- municipio -->
        <label for="municipios" style="margin-top: 10px; display: block;">Municipio</label>
        <?php
            if(isset($_GET['opciones_municipios'])){
              $select_municipio = $_GET['opciones_municipios'];

              echo '  <select name="opciones_municipios" id="opciones_municipios" class="form-select">
                            <option value="' . htmlspecialchars($select_municipio) . '">' . htmlspecialchars($select_municipio) . '</option>';
              echo'   </select>';
            }else{
            ?>
            <select name="opciones_municipios" id="opciones_municipios" class="form-select">
              <option value = ''>Seleccionar Estado Primero</option>
            </select>
            <?php
            $select_municipio= "";
            }
            ?>
           <!-- colonia -->
        <label for="colonia" style="margin-top: 10px; display: block;">Colonia</label>
        <?php
            if(isset($_GET['opciones_colonia'])){
              $select_colonia = $_GET['opciones_colonia'];

              echo '  <select name="opciones_colonia" id="opciones_colonia" class="form-select">
                            <option value="' . htmlspecialchars($select_colonia) . '">' . htmlspecialchars($select_colonia) . '</option>';
              echo'   </select>';
            }else{
            ?>
            <select name="opciones_colonia" id="opciones_colonia" class="form-select">
              <option value = ''>Seleccionar Municipio Primero</option>
            </select>
            <?php
            $select_colonia= "";
            }
            ?>
        <br>

        <h5>Sector/Inmueble</h5>
        <label for="sector" style="margin-top: 10px; display: block;">Sector</label>
          <!-- <form id = "combo" name = "combo" action = "inmueble_opcion.php" method = "POST"> -->
            <?php
              if(isset($_GET['sector'])){
                $sector = $_GET['sector'];
                
                  if ($sector == 'R') {
                    $tipo_sector = 'Residencial';
                  } elseif ($sector == 'C') {
                    $tipo_sector = 'Comercial';
                  } else {
                    $tipo_sector = 'Industrial';
                  }
                
                echo '  <select name="sector" id="sector" class="form-select">
                            <option value="' . htmlspecialchars($sector) . '">' . htmlspecialchars($tipo_sector) . '</option>';
                        if ($sector != 'R') {
                            echo '<option value="R">Residencial</option>';
                        }
                        if ($sector != 'C') {
                            echo '<option value="C">Comercial</option>';
                        }
                        if ($sector != 'I') {
                            echo '<option value="I">Industrial</option>';
                        }

                echo    '</select>';
                }
              else{
                $sector = "";
            ?>
                <select name="sector" id="sector" class="form-select">
                  <option value="" disabled selected>Selecciona un sector</option>
                  <option value="R">Residencial</option>
                  <option value="C">Comercial</option>
                  <option value="I">Industrial</option>
                </select>
            <?php
             }
            ?>
             <label for="tipo_inmueble" style="margin-top: 10px; display: block;">Tipo de Inmueble</label>
            <?php
             if(isset($_GET['tipo_inmueble'])){
              $select_inmueble = $_GET['tipo_inmueble'];
              $clave_inmueble = substr($select_inmueble, 0, 1);

              echo '  <select name="tipo_inmueble" id="tipo_inmueble" class="form-select">
                            <option value="' . htmlspecialchars($select_inmueble) . '">' . htmlspecialchars($select_inmueble) . '</option>';
              echo'   </select>';
            }else{
            ?>
            <select name="tipo_inmueble" id="tipo_inmueble" class="form-select">
              <option value = ''>Seleccionar Sector Primero</option>
              
            </select>
            <?php
            $clave_inmueble = "";
            }
            ?>
        <!-- </form> -->
        
        <br>
        <h5>Precio</h5>
          <?php if(isset($_GET['precio-desde'])){
            $precio_desde = $_GET['precio-desde'];
          }else{
            $precio_desde = "";
          }
          ?>
          <?php if(isset($_GET['precio-hasta'])){
            $precio_hasta = $_GET['precio-hasta'];
          }else{
            $precio_hasta = "";
          }
          ?>
          <input type="text" class="form-control" name="precio-desde" id="precio-desde" placeholder="Desde" value="<?php echo htmlspecialchars($precio_desde); ?>">
          <input type="text" class="form-control" name="precio-hasta" id="precio-hasta" placeholder="Hasta" value="<?php echo htmlspecialchars($precio_hasta); ?>">
        <br>
        <h5>Otros Filtros</h5>
          <label for="cuartos">Cuartos</label>
            <select name="cuartos" id="cuartos" class="form-select">
              <?php if(isset($_GET['cuartos'])){
                $cuartos = $_GET['cuartos'];
              ?>
              <option value="<?php echo $cuartos; ?>"><?php echo $cuartos; ?></option>
            </select> 
            <?php  
            }else{
            ?>
              <option value="" disabled selected>Selecciona una opción</option>
              <option value="1">+1</option>
              <option value="2">+2</option>
              <option value="3">+3</option>
              <option value="4">+4</option>
              <option value="5">+5</option>
              </select>
            <?php
            $cuartos = "";
            }
            ?>
          <label for="banios"style="margin-top: 10px; display: block;">Baños</label>
            <select name="banios" id="banios" class="form-select">
              <?php if(isset($_GET['banios'])){
                $banios = $_GET['banios'];
              ?>
              <option value="<?php echo $banios; ?>"><?php echo $banios; ?></option>
            </select>
            <?php
            }else{
            ?>
              <option value="" disabled selected>Selecciona una opción</option>
              <option value="1">+1</option>
              <option value="2">+2</option>
              <option value="3">+3</option>
              <option value="4">+4</option>
              <option value="5">+5</option>
            </select>
            <?php
            $banios = "";
            }
            ?>
          <label for="estacionamiento" style="margin-top: 10px; display: block;">Estacionamiento</label>
            <select name="estacionamiento" id="estacionamiento" class="form-select">
              <?php if(isset($_GET['estacionamiento'])){
                $estacionamiento = $_GET['estacionamiento'];
              ?>
               <option value="<?php echo $estacionamiento; ?>"><?php echo $estacionamiento; ?></option>
              </select>
              <?php
                }else{
              ?>
                <option value="" disabled selected>Selecciona una opción</option>
                <option value="1">+1</option>
                <option value="2">+2</option>
                <option value="3">+3</option>
                <option value="4">+4</option>
                <option value="5">+5</option>
            </select>
            <?php
              $estacionamiento = "";
              }
            ?>
          <label for = "amenidades" style="margin-top: 10px; display: block;">Amenidades</label>
          <?php
          $alberca = "";
          if(isset($_GET['alberca'])){
            $alberca = $_GET['alberca'];
          } 
          ?>
            <input type="checkbox" id="alberca" name="alberca" value="S"
            <?php if ($alberca == 'S') { echo 'checked'; } ?>>
            <label for="alberca">Alberca</label><br>

          <?php
          $gym = "";
          if(isset($_GET['gym'])){
            $gym = $_GET['gym'];
          } 
          ?>
            <input type="checkbox" id="gym" name="gym" value="S"
            <?php if ($gym == 'S') { echo 'checked'; } ?>>
            <label for="gym">Gym</label><br>
          
          <?php
          $parques = "";
          if(isset($_GET['parques'])){
            $parques = $_GET['parques'];
          } 
          ?>
            
            <input type="checkbox" id="parques" name="parques" value="S"
            <?php if ($parques == 'S') { echo 'checked'; } ?>>

            <label for="parques">Parques</label><br>
          
          <?php
          $patio = "";
          if(isset($_GET['patio'])){
            $patio = $_GET['patio'];
          } 
          ?>
            <input type="checkbox" id="patio" name="patio" value="S"
            <?php if ($patio == 'S') { echo 'checked'; } ?>>
            <label for="patio">Patio</label><br>
            <?php
          $terraza = "";
          if(isset($_GET['terraza'])){
            $terraza = $_GET['terraza'];
          } 
          ?>
            <input type="checkbox" id="terraza" name="terraza" value="S"
            <?php if ($terraza == 'S') { echo 'checked'; } ?>>
            <label for="terraza">Terraza</label><br>
          <?php
          $vigilancia = "";
          if(isset($_GET['vigilancia'])){
            $vigilancia = $_GET['vigilancia'];
          } 
          ?>
            <input type="checkbox" id="vigilancia" name="vigilancia" value="S"
            <?php if ($vigilancia == 'S') { echo 'checked'; } ?>>
            <label for="vigilancia">Vigilancia</label><br>

        <br>
        <div class = "row">
          <div class = "col">
        <button 
          type="submit"
          class="btn"
          style="background-color: #00A8A8; color: white; font-size: 16px; font-weight:bold;">
          Aplicar Filtros
        </button>

        <a 
          href="<?php echo strtok($_SERVER['REQUEST_URI'], '?'); ?>" 
          class="btn" 
          style="background-color: white; color: #00A8A8; font-size: 16px; font-weight:bold; border: 2px solid #00A8A8;">
          Limpiar Filtros
        </a>
        </div>
        </div>
      </form>
    </div>

    <div class = "col-md-9">
    <div class="row gy-4">
      <?php
      if(isset($_GET['venta_renta'])  || isset($_GET['sector']) || isset($_GET['tipo_inmueble'])
        || isset($_GET['precio-desde']) || isset($_GET['precio-hasta'])|| isset($_GET['cuartos'])
        || isset($_GET['banios'])|| isset($_GET['estacionamiento']) || isset($_GET['alberca'])
        || isset($_GET['gym']) || isset($_GET['parques']) || isset($_GET['patio'])
        || isset($_GET['terraza']) || isset($_GET['vigilancia']) || isset($_GET['estado']) || isset($_GET['opciones_municipios']))
      {
        $precio_desde = preg_replace('/[^\d.-]/', '', $precio_desde);
        $precio_hasta = preg_replace('/[^\d.-]/', '', $precio_hasta);
        
        if($precio_desde == ""){
          $precio_desde = 0;
        }
        if($precio_hasta == ""){
          $precio_hasta = 200000000;
        }
        if($cuartos == ""){
          $cuartos = 0;
        }
        if($banios == ""){
          $banios = 0;
        }
        if($estacionamiento == ""){
          $estacionamiento = 0;
        }


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
                           
                            AND h.operacion like '%$venta_renta%'
                            AND h.colonia like '%$select_colonia%'
                            AND h.municipio like '%$select_municipio%'
                            AND h.estado like '%$select_estado%'
                            AND h.sector like'%$sector%'
                            AND h.tipoprop like '%$clave_inmueble%'
                            AND (h.precio > '$precio_desde' AND h.precio <= '$precio_hasta')
                            AND (d.hab >= '$cuartos' or d.hab IS NULL)
                            AND (d.wc >= '$banios' or d.wc IS NULL)
                            AND (d.autos >= '$estacionamiento' or d.autos IS NULL)
                            AND d.alberca like '%$alberca%'
                            AND d.gym like '%$gym%'
                            AND d.parques like '%$parques%'
                            AND d.patio like '%$patio%'
                            AND d.terraza like '%$terraza%'
                            AND d.vigilancia like '%$vigilancia%'
                            and
                            (h.fechabaja IS NULL OR h.fechabaja > DATE(NOW()) - INTERVAL -15 DAY AND h.estatus = 'B')
                            AND h.estatus != 'S'
                            
                        ORDER BY h.idpropiedad ASC";
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
        </div>
      <?php
                }
      }
      else{
      ?>
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
      <?php } 
      }
      mysqli_close($conexion); ?>
    </div> <!-- Fin de la fila -->
  </div>
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

  <!-- jquery files -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>



<script>
function format_currency(e) {
    // Elimina todo excepto números y comas/puntos
    let value = e.target.value.replace(/[^0-9]/g, '');
    
    // Formatea el número como moneda
    let formattedValue = new Intl.NumberFormat('es-MX', {
        style: 'currency',
        currency: 'MXN',
        minimumFractionDigits: 2
    }).format(value / 100); // Divide entre 100 para incluir centavos
    
    e.target.value = formattedValue;
};
// Agregar el eventListener a ambos campos
document.getElementById('precio-desde').addEventListener('input', format_currency);
document.getElementById('precio-hasta').addEventListener('input', format_currency);
</script>


  <!-- JQuery para opciones de inmuebles -->
  <script>
    $(document).ready(function(){
      $("#sector").change(function(){
        
        $("#sector option:selected").each(function(){
          tipo_sector = $(this).val();
          console.log(tipo_sector)
          $.post("inmueble_opcion.php", {tipo_sector: tipo_sector},
            function(data){
              $("#tipo_inmueble").html(data);
            });
        });
      })
    });
  </script>
  <!-- JQuery para municipios -->
<script>
    $(document).ready(function(){
      $("#estado").change(function(){
        
        $("#estado option:selected").each(function(){
          selection_estado = $(this).val();
          console.log(selection_estado)
          $.post("municipios_opcion.php", {selection_estado: selection_estado},
            function(data){
              $("#opciones_municipios").html(data);
              console.log(data)
            });
        });
      })
    });
  </script>
  <!-- JQuery para colonias -->
<script>
    $(document).ready(function(){
      $("#opciones_municipios").change(function(){
        
        $("#opciones_municipios option:selected").each(function(){
          selection_municipio = $(this).val();
          $.post("colonia_opcion.php", {selection_municipio: selection_municipio},
            function(data){
              $("#opciones_colonia").html(data);
              console.log(data)
            });
        });
      })
    });
  </script>


</body>

</html>