<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'Gestiopolis/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');

$idcat = ( isset($_POST['idcat']) && (int)$_POST['idcat'] ) ? $_POST['idcat'] : false;
$type = ( isset($_POST['type']) && (string)$_POST['type'] ) ? $_POST['type'] : false;
if($idcat && $type && $type == 'reci'){
?>
<div class="row">
  <div class="col-sm-3">
    <span class="title cat-col-<?php echo $idcat; ?>">Recientes</span>
    <!--<a href="#" class="btn btn-seguir"><i class="icon-plus-sign"></i> Seguir</a>-->
  </div>
</div><!-- .row -->
<div class="row cat-id-<?php echo $idcat; ?>">
  <?php $args1=array( 'posts_per_page'=>4, 'cat'=> $idcat);//Empieza query del último post
      $query1 = new WP_Query($args1);
        if( $query1->have_posts() ) { while ($query1->have_posts()) : $query1->the_post(); 
          $category = get_the_category($post->ID); 
          ?>
  <div class="col-sm-3">
    <article id="post-<?php echo $post->ID; ?>" class="post">
      <div class="wrapper-img">
        <img src="<?php echo get_post_meta($post->ID, "Thumbnail", true); ?>" alt="<?php the_title(); ?>" class="img-responsive">
        <span class="compartir"><i class="fa fa-share"></i></span>
        <div class="meta-content">
          <div class="meta"><i class="fa fa-eye"></i> <?php if(function_exists('the_views')) { the_views(); } ?> <i class="fa fa-heart"></i> 46 <i class="fa fa-comment"></i> <?php comments_number('0','1','%'); ?></div>
          <div class="botones-compartir" id="compartir-<?php echo $post->ID; ?><?php echo $post->ID; ?>">
            <div class="platform bc-facebook" id="fb-compartir-<?php echo $post->ID; ?><?php echo $post->ID; ?>"></div>
            <div class="platform bc-twitter" id="tweet-compartir-<?php echo $post->ID; ?><?php echo $post->ID; ?>"></div>
            <div class="platform bc-linkedin" id="linkedin-compartir-<?php echo $post->ID; ?><?php echo $post->ID; ?>"></div>
            <div class="platform bc-gplus" id="gplus-compartir-<?php echo $post->ID; ?><?php echo $post->ID; ?>"></div>
          </div>
        </div>
      </div>
      <div class="wrapper-title">
        <h2 class="entry-title"><a id="titulo-<?php echo $post->ID; ?>" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>" rel="bookmark"><span><?php the_title(); ?></span></a></h2>
      </div>
    </article>
  </div>
  <?php endwhile;?>
  <?php } 
  wp_reset_query(); 
  wp_reset_postdata(); ?>
</div><!-- .row -->
<div class="row">
  <ul class="col-sm-12">
    <li><i class="fa fa-file-text-o"></i> <?php echo count_posts('cats', '2000', '01', $idcat); ?> publicaciones</li>
    <?php 
      $args = array('categories' => $idcat);
      $tags = get_category_tags($args);
    ?>
    <li><i class="fa fa-tags"></i> <?php echo count($tags); ?> temas</li>
    <li><i class="fa fa-group"></i> <?php autcat($idcat); ?> autores</li>
    <li class="pull-right"><a href="<?php echo get_category_link( $idcat ); ?>" class="btn cat-bg-<?php echo $idcat; ?>"><i class="fa icon-cat-<?php echo $idcat; ?>"></i> <?php echo get_cat_name($idcat);?></a></li>
  </ul>
</div><!-- .row -->
<?php } else if($idcat && $type && $type == 'abcg') {?>
<div class="row">
  <div class="col-sm-12 letters clearfix">
    <a href="#" class="" id="">A</a><a href="#" class="" id="">B</a><a href="#" class="" id="">C</a><a href="#" class="" id="">D</a><a href="#" class="" id="">E</a><a href="#" class="" id="">F</a><a href="#" class="" id="">G</a><a href="#" class="" id="">H</a><a href="#" class="" id="">I</a><a href="#" class="" id="">J</a><a href="#" class="" id="">K</a><a href="#" class="" id="">L</a><a href="#" class="" id="">M</a><a href="#" class="" id="">N</a><a href="#" class="" id="">O</a><a href="#" class="" id="">P</a><a href="#" class="" id="">Q</a><a href="#" class="" id="">R</a><a href="#" class="" id="">S</a><a href="#" class="" id="">T</a><a href="#" class="" id="">U</a><a href="#" class="" id="">V</a><a href="#" class="" id="">W</a><a href="#" class="" id="">X</a><a href="#" class="" id="">Y</a><a href="#" class="" id="">Z</a><a href="#" class="" id="">#</a>
  </div>
</div><!-- .row -->
<div class="row cat-id-<?php echo $idcat; ?>">
  <div class="col-sm-12">
    <div class="scrollabc">
    <div class="scrollbar"><div class="track"><div class="thumb"><div class="end"></div></div></div></div>
    <div class="viewport">
      <div class="overview">
        <h4>A</h4>
        <ul class="tagslist">
          <li><a href="#">abastecimiento</a></li>
          <li><a href="#">abc</a></li>
          <li><a href="#">abm</a></li>
          <li><a href="#">acceso a internet</a></li>
          <li><a href="#">actitud estratégica</a></li>
          <li><a href="#">actitud positiva</a></li>
          <li><a href="#">actividad económica</a></li>
          <li><a href="#">actividad financiera</a></li>
          <li><a href="#">actividad operativa</a></li>
          <li><a href="#">activos intangibles</a></li>
          <li><a href="#">acuaponia</a></li>
          <li><a href="#">adaptación al cambio</a></li>
          <li><a href="#">abastecimiento</a></li>
          <li><a href="#">abc</a></li>
          <li><a href="#">abm</a></li>
          <li><a href="#">acceso a internet</a></li>
          <li><a href="#">actitud estratégica</a></li>
          <li><a href="#">actitud positiva</a></li>
          <li><a href="#">actividad económica</a></li>
          <li><a href="#">actividad financiera</a></li>
          <li><a href="#">actividad operativa</a></li>
          <li><a href="#">activos intangibles</a></li>
          <li><a href="#">acuaponia</a></li>
          <li><a href="#">adaptación al cambio</a></li>
          <li><a href="#">abastecimiento</a></li>
          <li><a href="#">abc</a></li>
          <li><a href="#">abm</a></li>
          <li><a href="#">acceso a internet</a></li>
          <li><a href="#">actitud estratégica</a></li>
          <li><a href="#">actitud positiva</a></li>
          <li><a href="#">actividad económica</a></li>
          <li><a href="#">actividad financiera</a></li>
          <li><a href="#">actividad operativa</a></li>
          <li><a href="#">activos intangibles</a></li>
          <li><a href="#">acuaponia</a></li>
          <li><a href="#">adaptación al cambio</a></li>
          <li><a href="#">abastecimiento</a></li>
          <li><a href="#">abc</a></li>
          <li><a href="#">abm</a></li>
          <li><a href="#">acceso a internet</a></li>
          <li><a href="#">actitud estratégica</a></li>
          <li><a href="#">actitud positiva</a></li>
          <li><a href="#">actividad económica</a></li>
          <li><a href="#">actividad financiera</a></li>
          <li><a href="#">actividad operativa</a></li>
          <li><a href="#">activos intangibles</a></li>
          <li><a href="#">acuaponia</a></li>
          <li><a href="#">adaptación al cambio</a></li>
          <li><a href="#">abastecimiento</a></li>
          <li><a href="#">abc</a></li>
          <li><a href="#">abm</a></li>
          <li><a href="#">acceso a internet</a></li>
          <li><a href="#">actitud estratégica</a></li>
          <li><a href="#">actitud positiva</a></li>
          <li><a href="#">actividad económica</a></li>
          <li><a href="#">actividad financiera</a></li>
          <li><a href="#">actividad operativa</a></li>
          <li><a href="#">activos intangibles</a></li>
          <li><a href="#">acuaponia</a></li>
          <li><a href="#">adaptación al cambio</a></li>
          <li><a href="#">abastecimiento</a></li>
          <li><a href="#">abc</a></li>
          <li><a href="#">abm</a></li>
          <li><a href="#">acceso a internet</a></li>
          <li><a href="#">actitud estratégica</a></li>
          <li><a href="#">actitud positiva</a></li>
          <li><a href="#">actividad económica</a></li>
          <li><a href="#">actividad financiera</a></li>
          <li><a href="#">actividad operativa</a></li>
          <li><a href="#">activos intangibles</a></li>
          <li><a href="#">acuaponia</a></li>
          <li><a href="#">adaptación al cambio</a></li>
        </ul>
      </div>
    </div>
</div>
  </div>
</div><!-- .row -->
<div class="row">
  <ul class="col-sm-12">
    <li class="pull-right"><a href="#" class="btn cat-bg-<?php echo $idcat; ?>"><i class="icon-cat-<?php echo $idcat; ?>"></i> Emprendimiento</a></li>
  </ul>
</div><!-- .row -->
<?php } else { echo "No deberías estar aquí";} ?>