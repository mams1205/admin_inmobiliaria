<!-- header.php -->
<?php
  $currentPage = basename($_SERVER['PHP_SELF']);
?>


<header id="header" class="header d-flex align-items-center fixed-top">
  <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

    <a href="index.php" class="logo d-flex align-items-center">
      <img src="assets/img/logo_head.png" alt="Logo" style="width: 300px; height: 100%; object-fit: cover;">
    </a>

    <nav id="navmenu" class="navmenu">
    <ul>
        <li><a href="index.php" class="<?= ($currentPage == 'index.php') ? 'active' : '' ?>">Inicio</a></li>
        <li><a href="about.php" class="<?= ($currentPage == 'about.php') ? 'active' : '' ?>">¿Quiénes somos?</a></li>
        <li class="dropdown">
          <a href="#" class="<?= in_array($currentPage, ['propiedades.php', 'propiedades_venta.php', 'propiedades_renta.php']) ? 'active' : '' ?>">
            <span>Propiedades</span> <i class="bi bi-chevron-down toggle-dropdown"></i>
          </a>
          <ul>
            <li><a href="propiedades.php" class="<?= ($currentPage == 'propiedades.php') ? 'active' : '' ?>">Propiedades Disponibles</a></li>
            <li><a href="propiedades_venta.php" class="<?= ($currentPage == 'propiedades_venta.php') ? 'active' : '' ?>">Propiedades en Venta</a></li>
            <li><a href="propiedades_renta.php" class="<?= ($currentPage == 'propiedades_renta.php') ? 'active' : '' ?>">Propiedades en Renta</a></li>
          </ul>
        </li>
        <li><a href="socios_comerciales.php" class="<?= ($currentPage == 'socios_comerciales.php') ? 'active' : '' ?>">Socios Comerciales</a></li>
        <li><a href="contact.php" class="<?= ($currentPage == 'contact.php') ? 'active' : '' ?>">Contacto</a></li>
        <li><a href="https://www.grupopro.com.mx/indexppal.php">Login</a></li>
      </ul>
      <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
    </nav>
    
  </div>
</header>
