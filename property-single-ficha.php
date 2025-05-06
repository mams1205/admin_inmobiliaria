<?php
include('conexion_bd.php');

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
          h.liga_mapa as maps,
          a.Celular as cel_asesor
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
$calle = $propiedades[0]['calle'];
$num_ext = $propiedades[0]['noext'];
$cel_asesor = $propiedades[0]['cel_asesor'];

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
                <li><a href="property-single.php?ID=<?php echo $SelID; ?>"> Propiedad <?php echo $cve_propiedad; ?></a></li>
                <li class="current">Ficha Técnica Propiedad <?php echo $cve_propiedad; ?></li>
            </ol>
            </div>
        </nav>
        </div><!-- End Page Title -->

        

        <section id="ficha_tecnica" class="ficha_tecnica section">
            <div class="container">
            <form id ="ficha-form" action="" method ="POST">
                <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    <div class="card" style = "border: none; background-color: transparent;">
                    <div class="card-body">
                        <!-- Titulo -->
                        <div class="row">
                        <div class="col-md-10 mb-3">
                            <label for="titulo" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" value = "<?php echo htmlspecialchars($titulo)?>" >
                        </div>
                        </div>
                        <!-- Descripcion -->
                        <div class="row">
                        <div class="col-md-10 mb-3">
                            <label for="desc" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Descripción</label>
                            <textarea class="form-control" id="descripcion" name="descripcion" rows="8" maxlength="200"><?php echo htmlspecialchars($descripcion); ?></textarea> 
                        </div>
                        </div>
                        <!-- checkbox -->
                        <div class = "row">
                        <div class="col-md-10 mb-3">
                            <label for="info_adi" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Información Adicional</label>
                            <br>
                            <!-- <input type="checkbox" id="ubi_exact" name="ubi_exact" value = "ubi_exact_S">
                            <label for="ubi_exact">Mostrar ubicación exacta en el mapa</label><br> -->
                            <input type="checkbox" id="dire_completa" name="dire_completa" value = "dire_comp_S">
                            <label for="dire_completa">Mostrar direccion completa </label><br>
                            <input type="checkbox" id="info_contact" name="info_contact" value = "contacto_S">
                            <label for="info_contact">Mostrar información de contacto</label><br>
                        </div>
                        </div>
                        <div class = "row">
                        <div class="col-md-10 mb-3">
                            <label for="img_prop" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Imágenes de la propiedad</label>
                            <br>
                            <?php
                                for ($i = 0; $i < count($propiedades); $i++) {
                                    $ruta_foto = $propiedades[$i]['ruta_foto'];
                            ?>
                                    <input type="checkbox" id="my_checkbox_<?php echo $i; ?>" name="imagenes_select[]" value="<?php echo $i; ?>">
                                    <label  id = "label_img_<?php echo $i; ?>" 
                                            for="my_checkbox_<?php echo $i; ?>">
                                        <img src="<?php echo $ruta_foto; ?>" alt="">
                                    </label>
                            <?php
                                }
                            ?>
                        </div>
                        </div>
                    </div>
                    <div class="card-footer">
                    <button 
                      type = "submit"
                      class="btn"
                      style="background-color: #00A8A8; color: white; font-size: 16px; font-weight:bold;">
                      Crear Ficha
                    </button>
                    </div> 
                    </div>
                </div>
                </div>
                <div id="loadingOverlay" style="display:none; position: fixed; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.5); color: white; font-size: 20px; text-align: center; padding-top: 200px;">
                  Descargando Ficha Técnica, Por favor espere...
                </div>
            </form>
            </div>
        </section>
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src = "https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/exif-js/2.3.0/exif.min.js"></script>


  <script>
    document.getElementById('ficha-form').addEventListener('submit', function(e) {
        e.preventDefault(); // Prevenir el envío del formulario para evitar la recarga

        // Obtener todos los checkboxes seleccionados
        const checkboxes = document.querySelectorAll('input[name="imagenes_select[]"]:checked');

        // Si no se selecciona ninguna imagen
        if (checkboxes.length === 0) {
            alert("Seleccione al menos una imagen para poder generar la ficha técnica.");
            return;
        }

        if(checkboxes.length > 14){
          alert("Solo se pueden seleccionar hasta 14 imágenes. Intente nuevamente con otra selección");
          return;
        }

        
        // Crear un array para almacenar las rutas de las imágenes seleccionadas
        let imagenesSeleccionadas = [];

        // Iterar sobre los checkboxes seleccionados
        checkboxes.forEach(function(checkbox) {
            const indice = checkbox.value; // Obtener el valor del checkbox (índice de la imagen)
            const imagenLabel = document.getElementById('label_img_' + indice); // Obtener el label correspondiente
            const imagenSrc = imagenLabel.querySelector('img').src; // Obtener la fuente (src) de la imagen
            imagenesSeleccionadas.push(imagenSrc); // Agregar la ruta de la imagen al array
        });
               
        // const ubiexacta = document.getElementById('ubi_exact').checked;
        const direccionCompleta = document.getElementById('dire_completa').checked;
        const infoContacto = document.getElementById('info_contact').checked;

          
        const descripcion = document.getElementById('descripcion').value;
        const titulo = document.getElementById('titulo').value;
        const tituloLimpio = titulo.replace(/[^a-zA-Z0-9-_]/g, '_');
        const logoImageUrl = 'https://www.grupopro.com.mx/assets/img/logo_gpo_pro.jpg';  // logo

        //variables del titulo de la propiedad
        const tipoProp = "<?php echo $tipo_prop; ?>";
        const sector = "<?php echo $sector; ?>";
        const colonia = "<?php echo $colonia; ?>";

        //variables direccion
        const calle = "<?php echo $calle; ?>";
        const num_ext = "<?php echo $num_ext; ?>";
        const municipio = "<?php echo $municipio; ?>";
        const estado = "<?php echo $estado; ?>";

        //precio y operacion
        const precio = "<?php echo $precio_format ?>";
        // const precioFormateado = parseFloat(precio).toLocaleString('es-MX', { style: 'currency', currency: 'MXN' })
        const operacion = "<?php echo $operacion ?>";


        const titulo_propiedad = `${tipoProp} ${sector} en ${colonia}`;
        const direc_complete = `Calle ${calle} ${colonia} ${municipio},${estado}`;
        const precio_operacion = `$ ${precio} en ${operacion}`;
        const palabras = ["Habitaciones", "Baños", "Autos", 'm2 de Construcción', 'm2 de Terreno'];

        const m2_terr = "<?php echo $area ?>";
        const m2_const = "<?php echo $m2_const ?>";
        const num_habit = "<?php echo $habit ?>";
        const num_autos = "<?php echo $autos ?>";
        const num_wc = "<?php echo $wc ?>";

        //cel asesor
        const cel_asesor = "<?php echo $cel_asesor; ?>"

        // Función para mostrar el mensaje de descarga (overlay)
        function mostrarDescarga() {
            document.getElementById('loadingOverlay').style.display = 'block';  // Mostrar el overlay
        }

        // Función para ocultar el mensaje de descarga (overlay)
        function ocultarDescarga() {
            document.getElementById('loadingOverlay').style.display = 'none';  // Ocultar el overlay
        }

        // Función para obtener la orientación de la imagen cargada desde la ruta
        function obtenerOrientacionDesdeRuta(imagenSrc) {
          return new Promise((resolve, reject) => {
            const img = new Image();
            img.crossOrigin = "Anonymous";  // Necesario si las imágenes están en otro dominio
            img.onload = () => {
              EXIF.getData(img, function () {
                const orientation = EXIF.getTag(this, 'Orientation') || 1;  // Por defecto 1 (sin rotación)
                resolve(orientation);
              });
            };
            img.onerror = () => reject(new Error('Error al cargar la imagen: ' + imagenSrc));
            img.src = imagenSrc;
          });
        }

        // Función para convertir la orientación EXIF a grados de rotación
        function obtenerRotacion(orientation) {
          switch (orientation) {
            case 3: return 180;
            case 6: return 90;
            case 8: return 270;
            default: return 0;
          }
}

        // Usamos jsPDF directamente
        // Acceder a jsPDF
        const { jsPDF } = window.jspdf; // Asegurarse de acceder correctamente a la clase jsPDF

        // Crear el documento PDF
        const doc = new jsPDF();

        function genPDF() {
          mostrarDescarga();
            // Procesar todas las imágenes: obtener orientación y agregarlas al PDF
          Promise.all(
            imagenesSeleccionadas.map(imagenSrc =>
              obtenerOrientacionDesdeRuta(imagenSrc).then(orientation => ({ src: imagenSrc, orientation }))
            )
          ).then(imagenesConOrientacion => {
            const { jsPDF } = window.jspdf;
            const doc = new jsPDF();

            doc.addImage(logoImageUrl, 'JPG', 10, 10, 40, 20)

            //info contacto
            doc.setFontSize(10); // Establecer tamaño de fuente
            doc.setFont('helvetica', 'bold'); // Establecer fuente y estilo (negrita)
            doc.text('Grupo Pro Inmobiliario', 55,10)

            if (infoContacto === true){
              doc.setFontSize(10);
              doc.setFont('helvetica', 'normal'); // Establecer fuente y estilo (negrita)
              doc.text(`Celular: ${cel_asesor}`,55,15)
              doc.text('Oficina:  +52 442 822 2174', 55,20)
            }

            if (infoContacto === false){
              doc.setFontSize(10);
              doc.setFont('helvetica', 'normal'); // Establecer fuente y estilo (negrita)
              doc.text('Celular:',55,15)
              doc.text('Oficina:  +52 442 822 2174', 55,20)
            }

            //linea debajo del logo
            doc.setDrawColor(0, 168, 168); // Color del borde (negro)
            doc.setFillColor(0, 168, 168); // Color de relleno (azul claro)
            doc.rect(10, 33, 190, 1, 'FD'); // 'FD' indica Fill + Draw (relleno y borde)

            // Configurar estilos para el título
            doc.setFontSize(18); // Establecer tamaño de fuente
            doc.setFont('helvetica', 'bold'); // Establecer fuente y estilo (negrita)
            doc.text(titulo_propiedad, 10, 50);

            if (direccionCompleta === true){
              //configurar estilos para la direccion
              doc.setFontSize(10); // Establecer tamaño de fuente
              doc.setFont('helvetica', 'normal'); // Establecer fuente y estilo
              doc.text(direc_complete, 10, 56)
            }

            //precio
            doc.setFontSize(14); // Establecer tamaño de fuente
            doc.setFont('helvetica', 'bold'); // Establecer fuente y estilo (negrita)
            doc.text(precio_operacion, 10, 63)

            imagenesConOrientacion.forEach((imagen, index) => {
              const { src, orientation } = imagen;
              const rotacion = obtenerRotacion(orientation);

              const x = 135;
              const y = -55;  // Espaciado entre imágenes
              const width = 125;
              const height = 125;
              console.log(rotacion)

              
              // Agregar la imagen con la rotación calculada
              if(index === 0) {
                if(rotacion === 180){
                  doc.addImage(src, 'JPEG', 135, -55 , 125, 125, undefined, undefined, rotacion);
                }else{
                  doc.addImage(src, 'JPEG', 10, 70 , 125, 125)
                }
              } else if (index === 1) {
                if(rotacion === 180){
                  doc.addImage(src, 'JPEG', 200, 20 , 60, 50, undefined, undefined, rotacion);
                }else{
                  doc.addImage(src, 'JPEG', 140, 70 , 60, 50);
                }
              } else if (index === 2) {
                if(rotacion === 180){
                  doc.addImage(src, 'JPEG', 200, 20 + (index * 30), 60, 50, undefined, undefined, rotacion);
                }else{
                  doc.addImage(src, 'JPEG', 140, 70 + (index * 30), 60, 50);
                }
              }
              
            });

            doc.setFillColor(0, 168, 168); // Color de relleno (azul claro)
          let x = 10;
          let y = 200;
          let width = 45;
          let height = 10;

          //bucle para generar los cuadros
          for (let i = 0; i<5; i++){
            doc.rect(x, y +(i*(height+5)), width, height, 'FD');
          }

          // Texto a incluir en los rectángulos
          let amenidades = [
            `${num_habit} Habitaciones`,
            `${num_wc} Baños`,
            `${num_autos} Estacionamientos`,
            `${m2_const} m² Construcción`,
            `${m2_terr} m² Terreno`
          ];

          // Configuración de fuente y color para el texto
          doc.setFontSize(11); // Tamaño de fuente
          doc.setFont('helvetica', 'bold'); // Fuente y estilo
          doc.setTextColor(255, 255, 255); // Color blanco

          // Bucle para generar los rectángulos y centrar texto
          for (let i = 0; i < amenidades.length; i++) {
            let rectY = y + i * (height + 5); // Posición Y de cada rectángulo
                        
            // Calcular posición del texto
            let textWidth = doc.getTextWidth(amenidades[i]); // Ancho del texto
            let textX = x + (width - textWidth) / 2; // Centrado horizontalmente
            let textY = rectY + (height / 2) + 3; // Centrado verticalmente (ajustado)

            // Dibujar texto
            doc.text(amenidades[i], textX, textY);
          }  

          //Titulo descripcion
          doc.setFontSize(12); // Establecer tamaño de fuente
          doc.setFont('helvetica', 'bold'); // Establecer fuente y estilo (negrita)
          doc.setTextColor(0, 0, 0);
          doc.text('Descripción',60,201)
          //descripcion
          doc.setFontSize(8); // Establecer tamaño de fuente
          doc.setFont('helvetica', 'normal'); // Establecer fuente y estilo (negrita)
          doc.setTextColor(0, 0, 0);
          const max_width = 130;
          const max_height = 290;

          // Ajustar el texto dentro del maxHeight
          let splitText = doc.splitTextToSize(descripcion, max_width);
          let x_desc = 60;
          let y_desc = 206;

          // Iterar a través de las líneas de texto
          for (let i = 0; i < splitText.length; i++) {
            if (y_desc > max_height) {
              break; // Detener si se excede la altura máxima
            }
            doc.text(splitText[i], x_desc, y_desc, { maxWidth: max_width, align: 'justify' });
            y_desc += 3; // Aumentar la posición Y para la siguiente línea
          }

          //nueva pagina
          if (imagenesSeleccionadas.length > 3){
            doc.addPage()
            // Añadir texto al PDF
            doc.addImage(logoImageUrl, 'JPG', 10, 10, 40, 20)

            //comtacto
            doc.setFontSize(10); // Establecer tamaño de fuente
            doc.setFont('helvetica', 'bold'); // Establecer fuente y estilo (negrita)
            doc.text('Grupo Pro Inmobiliario', 55,10)

            if (infoContacto === true){
            doc.setFontSize(10);
            doc.setFont('helvetica', 'normal'); // Establecer fuente y estilo (negrita)
            doc.text(`Celular: ${cel_asesor}`,55,15)
            doc.text('Oficina:  +52 442 822 2174', 55,20)
            }

            if (infoContacto === false){
              doc.setFontSize(10);
              doc.setFont('helvetica', 'normal'); // Establecer fuente y estilo (negrita)
              doc.text('Celular:',55,15)
              doc.text('Oficina:  +52 442 822 2174', 55,20)
            }

            //linea debajo del logo
            doc.setDrawColor(0, 168, 168); // Color del borde (negro)
            doc.setFillColor(0, 168, 168); // Color de relleno (azul claro)
            doc.rect(10, 33, 190, 1, 'FD'); // 'FD' indica Fill + Draw (relleno y borde)

            // Configurar estilos para el título
            doc.setFontSize(18); // Establecer tamaño de fuente
            doc.setFont('helvetica', 'bold'); // Establecer fuente y estilo (negrita)
            doc.text(titulo_propiedad, 10, 50);

            if (direccionCompleta === true){
              //configurar estilos para la direccion
              doc.setFontSize(10); // Establecer tamaño de fuente
              doc.setFont('helvetica', 'normal'); // Establecer fuente y estilo
              doc.text(direc_complete, 10, 56)
            }

            //precio
            doc.setFontSize(14); // Establecer tamaño de fuente
            doc.setFont('helvetica', 'bold'); // Establecer fuente y estilo (negrita)
            doc.text(precio_operacion, 10, 63)
            imagenesConOrientacion.forEach((imagen, index) => {
              const { src, orientation } = imagen;
              const rotacion = obtenerRotacion(orientation);
              const filasY = [70, 123, 176,229]; // Primera, segunda y tercera fila

              // Determinar la fila en base al índice
              if (index >= 3 && index <= 15) {
                const fila = Math.floor((index - 3) / 3); // 0 para la primera, 1 para la segunda, 2 para la tercera fila
                const xPos = 10 + ((index - 3) % 3) * (60 + 5); // Posición horizontal
                const yPos = filasY[fila]; // Posición vertical

                if (rotacion === 180) {
                  doc.addImage(src, 'JPEG', xPos + 60, yPos - 50, 60, 50, undefined, undefined, rotacion);
                } else {
                  doc.addImage(src, 'JPEG', xPos, yPos, 60, 50);
                }
              }
            });
            
          }
          doc.save(`ficha_propiedad_${tituloLimpio}.pdf`);
          }).catch(error => {
            console.error('Error al procesar las imágenes:', error);
          });

          ocultarDescarga();

        }

        genPDF();
        });
  </script>

</body>

</html>

