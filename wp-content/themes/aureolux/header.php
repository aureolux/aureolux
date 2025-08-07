<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <!-- Header/Navegación -->
    <header class="site-header">
      <div class="container">
        <div class="header-content">
          <div class="logo">AUREOLUX</div>
          <nav class="nav-menu">
            <a href="#beneficios">Beneficios</a>
            <a href="#tecnologia">Tecnología</a>
            <a href="#testimonios">Testimonios</a>
            <a href="#faq">FAQ</a>
          </nav>
          <button class="btn-primary" onclick="scrollToPreorder()">Reservar Ahora</button>
        </div>
      </div>
    </header>
