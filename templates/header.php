<nav id="myNavmenu" class="navmenu navmenu-default navmenu-fixed-right offcanvas">
  <ul class="nav navmenu-nav gafrom from-nav-menu">
    <li><a title="GestioPolis - Conocimiento en Negocios" class="home-link" href="<?php echo esc_url(home_url('/')); ?>"><i class="fa fa-home"></i> Ir al inicio</a></li>
    <?php
    $args = array(
      'orderby' => 'name',
      'parent' => 0,
      'exclude'=> '1,2,97,105,106'
      );
    $categories = get_categories( $args );
    foreach ( $categories as $category ) {
      echo '<li><a title="Categoría '.$category->name.'" class="cat-' . $category->term_id . '" href="' . get_category_link( $category->term_id ) . '"><i class="fa icon-cat-'.$category->term_id.' cat-bg-'.$category->term_id.'"></i>  ' . $category->name . '</a></li>';
    }
    ?>
    <li class="contact-link"><a title="Contacto" href="<?php echo get_page_link(325586); ?>"><i class="fa fa-map-marker"></i> Contacto</a></li>
    <li class="dropdown more-link"><a title="Desplegar más enlaces" href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-plus"></i>Más&nbsp;&nbsp;<i class="fa fa-angle-double-down"></i></a>
      <ul id="explora_mas" class="dropdown-menu navmenu-nav">
        <li><a title="Acerca de" href="<?php echo get_page_link(325585); ?>">Acerca de</a></li>
        <li><a title="ABC Temático" href="<?php echo get_page_link(325588); ?>">ABC temático</a></li>
        <li><a title="Archivo" href="<?php echo get_page_link(325589); ?>">Archivo</a></li>
        <li><a title="Paute aquí" href="<?php echo get_page_link(334632); ?>">Paute aquí</a></li>
        <li><a title="Términos de uso" href="<?php echo get_page_link(325587); ?>">Términos de uso</a></li>
        <li class="copy">&copy;<?php echo date('Y'); ?> WebProfit Ltda.</li>
      </ul>
    </li>
  </ul>
</nav>
<header class="banner navbar navbar-inverse navbar-fixed-top gafrom from-navbar" role="banner">
  <div class="container">
    <div class="navbar-header">
      <a title="GestioPolis - Conocimiento en Negocios" class="navbar-brand hidden-xs gafrom from-logo" href="<?php echo esc_url(home_url('/')); ?>"><img width="179" height="48" class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo.png'); ?>" alt="<?php bloginfo('name'); ?>"></a>
      <a title="GestioPolis - Conocimiento en Negocios" class="navbar-brand visible-xs-block gafrom from-logo-mobile" href="<?php echo esc_url(home_url('/')); ?>"><img width="150" height="48" class="logo" src="<?php echo esc_url(get_template_directory_uri() . '/assets/img/logo-min.png'); ?>" alt="<?php bloginfo('name'); ?>"></a>
    </div>

    <nav role="navigation">
      <ul class="nav navbar-nav navbar-right gafrom from-navbar-right">
        <li id="nav_busca">
          <div id="sb-search" class="sb-search sb-search-open hidden-xs hidden-sm">
            <form id="searchbox" action="<?php echo home_url( '/' ); ?>" role="search" class="gafrom from-buscador">
              <input class="sb-search-input elasticpress-autosuggest" placeholder="Encuentra lo que necesitas Aquí" type="search" value="" name="s" id="search">
              <input class="sb-search-submit" type="submit" value="">
              <span class="sb-icon-search"><i class="fa fa-search"></i><span class="hidden-xs"> Busca</span></span>
            </form>
          </div>
          <div id="sb-search1" class="sb-search hidden-md hidden-lg">
            <form id="searchbox" action="<?php echo home_url( '/' ); ?>" role="search" class="gafrom from-buscador-mobile">
              <input class="sb-search-input elasticpress-autosuggest" placeholder="Encuentra lo que necesitas Aquí" type="search" value="" name="s" id="search">
              <input class="sb-search-submit" type="submit" value="">
              <span class="sb-icon-search"><i class="fa fa-search"></i><span class="hidden-xs"> Busca</span></span>
            </form>
          </div>
        </li>
        <li id="nav_publica"><a title="Publicar en GestioPolis" href="<?php echo get_page_link(325584); ?>"><i class="fa fa-cloud-upload"></i><span class="hidden-xs"> Publica</span></a></li>
        <li>
          <a title="Menú de navegación" id="nav-expander" class="nav-expander navbar-toggle" data-toggle="offcanvas" data-target="#myNavmenu" data-canvas="body">
            <i class="fa fa-bars white"></i><span class="hidden-xs">&nbsp;Menú</span>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</header>