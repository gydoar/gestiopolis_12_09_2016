<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'Gestiopolis/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');

$year = ( isset($_POST['year']) && (string)$_POST['year'] ) ? $_POST['year'] : false;
$month = ( isset($_POST['month']) && (string)$_POST['month'] ) ? $_POST['month'] : false;

if($year && $month){ ?>
<div class="row">
  <div class="col-sm-12">
    <div class="row">
      <div class="col-sm-6">
        <a href="#" class="cat-bg-0">
          <span class="eje-meta"><span><?php echo count_posts('allarchive', $year, $month); ?></span> posts</span>
          <i class="fa icon-cat-0"></i>
          <span class="eje-nombre">Todo</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-0">
            	<?php
            	$args0 = array(
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month)
							);
							// The Query
							$query0 = new WP_Query( $args0 );

							// The Loop
							if ( $query0->have_posts() ) {
								echo '<ul>';
								while ( $query0->have_posts() ) {
									$query0->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 20 ); ?>" class="cat-bg-20">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 20); ?></span> posts</span>
          <i class="fa icon-cat-20"></i>
          <span class="eje-nombre">Administración</span>
          <br class="clearfix">
          <span class="eje-tagline">Todo es susceptible de mejorar</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-20">
            	<?php
            	$args20 = array(
								'cat' => 20,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query20 = new WP_Query( $args20 );

							// The Loop
							if ( $query20->have_posts() ) {
								echo '<ul>';
								while ( $query20->have_posts() ) {
									$query20->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 15 ); ?>" class="cat-bg-15">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 15); ?></span> posts</span>
          <i class="fa icon-cat-15"></i>
          <span class="eje-nombre">Autoayuda</span>
          <br class="clearfix">
          <span class="eje-tagline">Yo puedo</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-15">
            	<?php
            	$args15 = array(
								'cat' => 15,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query15 = new WP_Query( $args15 );

							// The Loop
							if ( $query15->have_posts() ) {
								echo '<ul>';
								while ( $query15->have_posts() ) {
									$query15->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 16 ); ?>" class="cat-bg-16">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 16); ?></span> posts</span>
          <i class="fa icon-cat-16"></i>
          <span class="eje-nombre">Contabilidad</span>
          <br class="clearfix">
          <span class="eje-tagline">Comprobar, medir, evaluar, formular</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-16">
            	<?php
            	$args16 = array(
								'cat' => 16,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query16 = new WP_Query( $args16 );

							// The Loop
							if ( $query16->have_posts() ) {
								echo '<ul>';
								while ( $query16->have_posts() ) {
									$query16->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 17 ); ?>" class="cat-bg-17">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 17); ?></span> posts</span>
          <i class="fa icon-cat-17"></i>
          <span class="eje-nombre">Economía</span>
          <br class="clearfix">
          <span class="eje-tagline">Recursos escasos. Asignación eficiente</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-17">
            	<?php
            	$args17 = array(
								'cat' => 17,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query17 = new WP_Query( $args17 );

							// The Loop
							if ( $query17->have_posts() ) {
								echo '<ul>';
								while ( $query17->have_posts() ) {
									$query17->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 18 ); ?>" class="cat-bg-18">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 18); ?></span> posts</span>
          <i class="fa icon-cat-18"></i>
          <span class="eje-nombre">Emprendimiento</span>
          <br class="clearfix">
          <span class="eje-tagline">A pensar en grande</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-18">
            	<?php
            	$args18 = array(
								'cat' => 18,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query18 = new WP_Query( $args18 );

							// The Loop
							if ( $query18->have_posts() ) {
								echo '<ul>';
								while ( $query18->have_posts() ) {
									$query18->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 19 ); ?>" class="cat-bg-19">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 19); ?></span> posts</span>
          <i class="fa icon-cat-19"></i>
          <span class="eje-nombre">Finanzas</span>
          <br class="clearfix">
          <span class="eje-tagline">Minimizar riesgos. Maximizar retornos</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-19">
            	<?php
            	$args19 = array(
								'cat' => 19,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query19 = new WP_Query( $args19 );

							// The Loop
							if ( $query19->have_posts() ) {
								echo '<ul>';
								while ( $query19->have_posts() ) {
									$query19->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 3 ); ?>" class="cat-bg-3">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 13); ?></span> posts</span>
          <i class="fa icon-cat-3"></i>
          <span class="eje-nombre">Marketing</span>
          <br class="clearfix">
          <span class="eje-tagline">Satisfacer necesidades. Entregar valor</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-13">
            	<?php
            	$args13 = array(
								'cat' => 13,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query13 = new WP_Query( $args13 );

							// The Loop
							if ( $query13->have_posts() ) {
								echo '<ul>';
								while ( $query13->have_posts() ) {
									$query13->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 23 ); ?>" class="cat-bg-23">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 23); ?></span> posts</span>
          <i class="fa icon-cat-23"></i>
          <span class="eje-nombre">Medio Ambiente</span>
          <br class="clearfix">
          <span class="eje-tagline">La naturaleza es sabia</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-23">
            	<?php
            	$args23 = array(
								'cat' => 23,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query23 = new WP_Query( $args23 );

							// The Loop
							if ( $query23->have_posts() ) {
								echo '<ul>';
								while ( $query23->have_posts() ) {
									$query23->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 21 ); ?>" class="cat-bg-21">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 21); ?></span> posts</span>
          <i class="fa icon-cat-21"></i>
          <span class="eje-nombre">Talento</span>
          <br class="clearfix">
          <span class="eje-tagline">Felicidad = Productividad</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-21">
            	<?php
            	$args21 = array(
								'cat' => 21,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query21 = new WP_Query( $args21 );

							// The Loop
							if ( $query21->have_posts() ) {
								echo '<ul>';
								while ( $query21->have_posts() ) {
									$query21->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 56 ); ?>" class="cat-bg-56">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 56); ?></span> posts</span>
          <i class="fa icon-cat-56"></i>
          <span class="eje-nombre">Tecnología</span>
          <br class="clearfix">
          <span class="eje-tagline">En favor de la evolución humana</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-56">
            	<?php
            	$args56 = array(
								'cat' => 56,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query56 = new WP_Query( $args56 );

							// The Loop
							if ( $query56->have_posts() ) {
								echo '<ul>';
								while ( $query56->have_posts() ) {
									$query56->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
      <div class="col-sm-6">
        <a href="<?php echo get_category_link( 24 ); ?>" class="cat-bg-24">
          <span class="eje-meta"><span><?php echo count_posts('catsarchive', $year, $month, 24); ?></span> posts</span>
          <i class="fa icon-cat-24"></i>
          <span class="eje-nombre">Otros temas</span>
          <br class="clearfix">
          <span class="eje-tagline">De todo un poco</span>
          <div class="rb-overlay">
            <span class="rb-close">cerrar</span>
            <div class="rb-content cat-bg-24">
            	<?php
            	$args24 = array(
								'cat' => 24,
								'post_type'   => 'post',
								'post_status' => 'publish',
								'posts_per_page' => 30,
								'orderby' => 'date',
								'order' => 'DESC',
								'year' => intval($year),
								'monthnum' => intval($month),
							);
							// The Query
							$query24 = new WP_Query( $args24 );

							// The Loop
							if ( $query24->have_posts() ) {
								echo '<ul>';
								while ( $query24->have_posts() ) {
									$query24->the_post();
									echo '<li><a href="'.get_permalink().'" title="' . get_the_title() . '">' . get_the_title() . '</a></li>';
								}
								echo '</ul>';
							} else {
								echo '<h2>No existen artículos para esta categoría en ésta fecha</h2>';
							}
							/* Restore original Post Data */
							wp_reset_query();
							wp_reset_postdata(); ?>
            </div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div>
<?php }else{
	echo 'No deber&iacute;as estar aqu&iacute;';
} 
?>