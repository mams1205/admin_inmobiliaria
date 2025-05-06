<?php
include('conexion_bd.php');
// Realizar una consulta
$sql = "SELECT
          Nombre,
          RutaFoto,
          eMail
        From asesores
        WHERE Estatus = 'A';";
$resultado = mysqli_query($conexion, $sql);

//array vacio
$asesores =[];
/// Verificar si la consulta devolvió resultados
if (mysqli_num_rows($resultado) > 0) {
  // Recorrer y mostrar cada fila de la tabla
  while ($fila = mysqli_fetch_assoc($resultado)) {
    $asesores[]=$fila; //se agrega la fila al array

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
              <h1>¡Únete a Nuestro Equipo!</h1>
              <p class="mb-0">¿Listo para dar un paso adelante en tu carrera? En Grupo Pro, buscamos personas apasionadas y comprometidas para unirse a nuestro equipo.</p>
              <br>
              <p class="mb-0"> ¡Completa nuestro formulario y comienza tu camino con nosotros hoy mismo! </p>
            </div>
          </div>
        </div>
      </div>
      <nav class="breadcrumbs">
        <div class="container">
          <ol>
            <li><a href="index.php">Inicio</a></li>
            <li class="current">Bolsa de Trabajo</li>
          </ol>
        </div>
      </nav>
    </div><!-- End Page Title -->

    <!-- Agents Section -->
    <section id="agents" class="agents section">
      <div class="container">
      <form id ="agents-form" action="forma_agentes.php" method ="POST">
        <div class="row">
          <div class="col-lg-8 offset-lg-2">
            <div class="card" style = "border: none; background-color: transparent;">
              <div class="card-body">
                <div class="row">
                  <!-- Nombre -->
                  <div class="col-md-4 mb-3">
                    <label for="name" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Nombre (s)</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                  </div>
                  <!-- Apellido -->
                  <div class="col-md-4 mb-3">
                    <label for="apellido" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Apellido</label>
                    <input type="text" class="form-control" id="apellido" name="apellido" required>
                  </div>
                  <!-- Género -->
                  <div class="col-md-4 mb-3">
                    <label for="genero" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Género</label>
                    <select class="form-control" id="genero" name="genero" required>
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="hombre">Hombre</option>
                      <option value="mujer">Mujer</option>
                      <option value="otro">Otro</option>
                      <option value="no_dice">Prefiero no decirlo</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <!-- Edad -->
                  <div class="col-md-4 mb-3">
                    <label for="edad" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Edad</label>
                    <input type="number" class="form-control" id="edad" name="edad" required>
                  </div>
                  <!-- Escolaridad máxima -->
                  <div class="col-md-4 mb-3">
                    <label for="estudios" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Escolaridad máxima</label>
                    <select class="form-control" id="estudios" name="estudios" required>
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="primaria">Primaria</option>
                      <option value="secundaria">Secundaria</option>
                      <option value="preparatoria">Preparatoria/Bachillerato</option>
                      <option value="licenciatura">Licenciatura</option>
                      <option value="maestria">Maestría</option>
                      <option value="doctorado">Doctorado</option>
                    </select>
                  </div>
                  <!-- Nivel de inglés -->
                  <div class="col-md-4 mb-3">
                    <label for="ingles" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">¿Cómo calificas tu nivel de inglés?</label>
                    <select class="form-control" id="ingles" name="ingles" required>
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="basico">Básico</option>
                      <option value="intermedio">Intermedio</option>
                      <option value="avanzado">Avanzado</option>
                      <option value="nativo">Es mi lengua madre</option>
                      <option value="no_hablo">No lo hablo en absoluto</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <!-- Nivel de español para extranjeros -->
                  <div class="col-md-12 mb-3">
                    <label for="extranjero" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Si eres extranjero, ¿qué nivel de español tienes?</label>
                    <select class="form-control" id="extranjero" name="extranjero">
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="basico">Básico</option>
                      <option value="intermedio">Intermedio</option>
                      <option value="avanzado">Avanzado</option>
                      <option value="nativo">Es mi lengua madre</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <!-- Ciudad -->
                  <div class="col-md-4 mb-3">
                    <label for="vives" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">¿En qué parte de la ciudad vives?</label>
                    <input type="text" class="form-control" id="vives" name="vives">
                  </div>
                  <!-- Correo Electrónico -->
                  <div class="col-md-4 mb-3">
                    <label for="mail" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Correo Electrónico</label>
                    <input type="email" class="form-control" id="mail" name="mail" required>
                  </div>
                  <!-- Celular -->
                  <div class="col-md-4 mb-3">
                    <label for="celular" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">Celular (10 dígitos)</label>
                    <input type="tel" class="form-control" id="celular" name="celular"
                    pattern="^\d{10}$" title="El número debe tener exactamente 10 dígitos" required>
                  </div>
                </div>
                <div class="row">
                  <!-- Computadora personal -->
                  <div class="col-md-4 mb-3">
                    <label for="computadora" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">¿Tienes computadora personal?</label>
                    <select class="form-control" id="computadora" name="computadora">
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <!-- Automóvil propio -->
                  <div class="col-md-4 mb-3">
                    <label for="carro" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">¿Tienes automóvil propio?</label>
                    <select class="form-control" id="carro" name="carro">
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                  <!-- Método de contacto -->
                  <div class="col-md-4 mb-3">
                    <label for="metodo_contacto" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">¿Cómo te enteraste de nosotros?</label>
                    <select class="form-control" id="metodo_contacto" name="metodo_contacto">
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="facebook">Facebook</option>
                      <option value="instagram">Instagram</option>
                      <option value="whatsapp">WhatsApp</option>
                      <option value="recomendacion">Recomendación</option>
                      <option value="otro">Otro</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <!-- Esquema de pago -->
                  <div class="col-md-12 mb-3">
                    <label for="comisiones" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;">¿Aceptas un esquema de pago por comisión?</label>
                    <select class="form-control" id="comisiones" name="comisiones">
                      <option value="" disabled selected>Selecciona una opción</option>
                      <option value="si">Sí</option>
                      <option value="no">No</option>
                    </select>
                  </div>
                </div>
                <div class="row">
                  <!-- Justificación -->
                  <div class="col-md-12 mb-3">
                    <label for="justificacion" style = "font-family: Roboto, sans-serif; font-weight: bold; font-size: 16px;" >¿Por qué quieres unirte a GrupoPro?</label>
                    <textarea class="form-control" id="justificacion" name="justificacion" rows="4" maxlength="200"></textarea>
                  </div>
                </div>
              </div>
              <div class="card-footer text-center" style = "border: none; background-color: transparent;">

                <div id="loading" style="display: none;">Loading...</div>
                <div id="error-message" style="color: green; display: none;">Tu solicitud no ha podido ser enviada, intentalo de nuevo más tarde o contáctanos al +52 442 822 2174!</div>
                <div id="success-message" style="color: green; display: none;">Exito Tu solicitud ha sido enviada, pronto nos pondremos en contacto contigo!</div>
                <div id="prueba-message" style="color: green; display: none;">Prueba!</div>

                <button type="submit" class="btn" name = "Enviar" style="background-color: #00A8A8; color: white; width: 150px;">
                  <i class="fa-solid fa-paper-plane"></i>
                    Enviar
                </button>
              </div>
            </div>
          </div>
        </div>
        </form>
      </div>
    </section><!-- /Agents Section -->

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