<?php
/*
Template Name: Archivo
*/

global $wpdb;

$collection = $wpdb->get_results("
  SELECT DISTINCT YEAR(p.post_date) AS post_year, MONTH(p.post_date) AS post_month
  FROM {$wpdb->posts} AS p
  WHERE p.post_type = 'post' AND p.post_status = 'publish'
  ORDER BY p.post_date DESC
", OBJECT );
?>

<div class="bgcon">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="title">Archivo</h1>
        <div class="row posts-home">
          <?php
            // Loop once to grab the years
            $oneyear = 1999;
            foreach ( $collection as $year ){
              if ( $oneyear === $year->post_year ) continue;
              echo '<div class="postw col-lg-3 col-md-4 col-sm-6">
              <article class="post">';
              echo '<h3><a href="'. get_year_link($year->post_year).'" title="Archivo de '.$year->post_year.'">'.$year->post_year.'</a></h3>';
              echo '<ul>';
              // Loop for a second time to grab the months inside a year
              foreach ( $collection as $month ){
                if ( $month->post_year != $year->post_year ) continue;
                echo '<li><a href="'.get_month_link( $year->post_year, $month->post_month ).'" title="Archivo de '.month_name($month->post_month).' de '.$year->post_year.'">'.month_name($month->post_month).'</a></li>';
                $oneyear = $year->post_year;
              }
              echo '</ul>
              </article>
              </div>';

            }
          ?>
        </div><!-- .row -->
      </div>
    </div>
  </div><!-- .container PRINCIPAL -->
</div>