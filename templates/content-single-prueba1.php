<?php while (have_posts()) : the_post(); ?>
  <div class="container cposts">
    <div class="row">
      <div class="hidden-xs hidden-sm col-md-3 sidebarcol">
        <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Adsense 300 x 600 Posts -->
<ins class="adsbygoogle"
     style="display:inline-block;width:300px;height:600px"
     data-ad-client="ca-pub-2753881743271989"
     data-ad-slot="8839025323"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
        <?php //get_template_part('templates/sidebar-post'); ?>
      </div><!--.col-sm-3-->
      <div class="col-sm-12 col-md-9 maincol">
        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
          <h1 class="entry-title title"><?php the_title(); ?></h1>
          <div class="row"><!-- Empieza row de contenido y meta datos -->
            <div class="col-sm-12 col-md-10">
          <time class="entry-date published hidden" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date('d.m.Y'); ?></time>
          <time class="entry-date updated hidden" datetime="<?php echo get_the_modified_time('c'); ?>"><?php echo get_the_modified_date('d.m.Y'); ?></time>
          <?php if(is_user_logged_in() && current_user_can( 'manage_options')){ ?>
          <?php get_template_part('templates/post-front-edit'); ?>
          <?php } ?>
          <?php if (get_post_meta($post->ID, "all2html_htmlcontent", true) != "") {?>
          <div class="adsce">
            <div id='div-gpt-ad-1433261534384-5'>
            <script type='text/javascript'>
            googletag.cmd.push(function() { googletag.display('div-gpt-ad-1433261534384-5'); });
            </script>
            </div>
          </div>
          <?php 
          if (0 == 1) { ?>
          <div id="toolbar">
            <div class="btn-toolbar" role="toolbar">
              <div class="btn-group btn-group-sm pull-left">
                <a type="button" class="btn btn-default prevpage" href="#" title="Página Anterior"><i class="fa fa-chevron-up"></i></a>
                <a type="button" class="btn btn-default nextpage" href="#" title="Página Siguiente"><i class="fa fa-chevron-down"></i></a>
              </div>&nbsp;&nbsp;
              Página <input class="pagen" value="0" name="gopage" maxlength="4" size="4"> de <span id="pages"></span>
              <div class="btn-group pull-right">
                  <a type="button" title="Descargar archivo" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-download-alt"></span> Descargar <span class="caret"></span></a>
                  <ul class="dropdown-menu list-unstyled" role="menu">
                    <li><a href="<?php echo get_post_meta($post->ID, 'all2html_docu', true); ?>">Original</a></li>
                    <?php if (get_post_meta($post->ID, "downloads_value", true) != '') { ?>
                    <li><a href="<?php echo get_post_meta($post->ID, 'downloads_value', true); ?>">Comprimido</a></li>
                    <?php } ?>
                    <?php if (get_post_meta($post->ID, "all2html_ext", true) != 'pdf') { ?>
                    <li><a href="<?php echo home_url(get_post_meta($post->ID, 'all2html_pdf', true)); ?>">PDF</a></li>
                    <?php } ?>
                  </ul>
              </div>
            </div>
          </div>
          <?php } ?>
          <div id="sidebar" style="display: none !important;">
            <div id="outline"></div>
          </div>
          <?php 
          $servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? '/Gestiopolis' : '';
          $content = file_get_contents($_SERVER['DOCUMENT_ROOT'].$servidor.get_post_meta($post->ID, "all2html_htmlcontent", true));
            echo insert_ads_all2html( $content );
          
          //include_once($_SERVER['DOCUMENT_ROOT'].$servidor.get_post_meta($post->ID, "all2html_htmlcontent", true)); //Carga el php convertido por pdf2htmlEX 
        ?>
          <div class="loading-indicator"><img alt="" src="<?php echo home_url( '/pdf2htmlEX/pdf2htmlEX-64x64.png' ); ?>"></div>
          <?php } else if ((get_post_meta($post->ID, "all2html_php", true) != "") && (get_post_meta($post->ID, "all2html_htmlcontent", true) == "")) {?>
          <h3>Se debe volver a procesar el archivo para poder ver correctamente este documento. Elimina primero el documento y luego procésalo de nuevo.</h3>
          <p><b><a href="<?php echo home_url('/'); ?>" id="deletePdf">ELIMINAR DOCUMENTO</a></b></p>
          <?php } ?>
          <div class="post-content clearfix">
            <div class="entry-content">
              <?php if ( get_post_meta($post->ID, "all2html_htmlcontent", true) == "" ) { ?>
                <div class="adsfr">
                  <div id='div-gpt-ad-1433261534384-0' style='height:250px; width:300px;'>
                  <script type='text/javascript'>
                  googletag.cmd.push(function() { googletag.display('div-gpt-ad-1433261534384-0'); });
                  </script>
                  </div>
                </div>
              <?php } ?>
              <?php the_content(); ?>
            </div>
            <div class="adsce">
              <div id='div-gpt-ad-1433261534384-4'>
              <script type='text/javascript'>
              googletag.cmd.push(function() { googletag.display('div-gpt-ad-1433261534384-4'); });
              </script>
              </div>
            </div>
           <?php if (get_post_meta($post->ID, "downloads_value", true) != '') { ?>
            <div class="download-box"><a class="download-link" href="<?php echo get_post_meta($post->ID, 'downloads_value', true); ?>"><span class="author-color"><i class="fa fa-cloud-download"></i></span> Descarga el archivo original</a></div>
            <?php } ?>
            <div id="suscripcion" class="suscripcion hidden">
              <div>
                <span class="author-color"><i class="fa fa-envelope"></i></span>
                <strong>Recibe los mejores contenidos en tu email</strong>
                <p>
                  <em>Nos aseguraremos de seleccionar especialmente para ti sólo lo mejor de las nuevas publicaciones cada semana</em>
                </p>
                  <div class="input-group">
                    <span class="input-group-addon" id="basic-addon1">@</span>
                    <input type="text" class="form-control" placeholder="Que se vea y funcione como http://azumbrunnen.me/frontkit/" aria-describedby="basic-addon1">
                  </div>
              </div>
            </div>
            <div class="compartelo">
              <h2><i class="fa fa-share"></i> Compártelo con tu mundo</h2>
              <ul class="list-unstyled">
                <li><a target="_blank" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&layout=link&appId=220995104693477" class="btn facebook"><i class="fa fa-facebook-square"></i> Facebook</a></li>
                <li><a target="_blank" href="https://twitter.com/intent/tweet?url=<?php echo urlencode(get_permalink());?>&amp;text=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
 ?>&amp;via=gestiopoliscom" class="btn twitter"><i class="fa fa-twitter-square"></i> Twitter</a></li>
                <li><a target="_blank" href="mailto:?subject=Revisa este artículo&amp;body=Hola! Revisa este artículo: <?php the_title(); ?> - <?php echo get_permalink(); ?>." class="btn email"><i class="fa fa-envelope"></i></a></li>
                <li><a target="_blank" href="https://plus.google.com/share?url=<?php echo urlencode(get_permalink()); ?>" class="btn google"><i class="fa fa-google-plus"></i></a></li>
                <li><a target="_blank" href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>&title=<?php echo htmlspecialchars(urlencode(html_entity_decode(get_the_title(), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
 ?>" class="btn linkedin"><i class="fa fa-linkedin"></i></a></li>
                <li><a href="#" class="btn more"><i class="fa fa-plus"></i></a></li>
              </ul>
            </div><!-- .compartelo -->
            <div id="autores" class="autores">
              <h2>Escrito por:</h2>
              <div itemprop="author" itemscope itemtype="http://schema.org/Person" class="author vcard">
                <?php if(get_post_meta($post->ID, "author-name_value", true) != "") : ?>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="url">
                  <?php echo get_author_color_id(); ?>
                  <strong itemprop="name" class="fn"><?php echo get_post_meta($post->ID, "author-name_value", true); ?></strong>
                </a>
                <p class="selectionShareable">
                  <em itemprop="description"><?php echo get_post_meta($post->ID, "author-bio_value", true); ?></em>
                </p>
                <?php else : ?>
                <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="url fn">
                  <?php echo get_author_color_id(); ?>
                  <strong itemprop="name"><?php echo get_the_author(); ?></strong>
                </a>
                <p class="selectionShareable">
                  <em itemprop="description"><?php echo get_the_author_meta('description'); ?></em>
                </p>
                <?php endif; ?>
              </div>
            </div>
            <div class="post-tags hidden-md hidden-lg">
              <h2><i class="fa fa-tags"></i> En este post se habla sobre</h2>
              <?php the_tags('<div class="temas-archive"> ','','</div>'); ?>
            </div><!-- .post-tags -->
            <div class="compartelo posts-home hidden-md hidden-lg">
              <div class="title-section"><h2>Te recomendamos</h2><i class="fa fa-caret-down"></i></div>
              <?php 
              $show = 12;
              $postsnot = array();
              $postsnot[] = $post->ID;
              $mainpost = $post->ID;
              $query1 = ci_get_related_posts_1( $post->ID, $show );
              //$countp = 1;
                  if( $query1->have_posts() ) { while ($query1->have_posts()) : $query1->the_post(); 
                    $postsnot[] = $post->ID;
                    if($mainpost != $post->ID){
                      get_template_part( 'templates/content', 'recommend' );
                    }
                    //$countp++; 
                   endwhile;?>
                  <?php } 
                  wp_reset_query(); 
                  wp_reset_postdata(); 
                  $show = $show - count($query1->posts);
                 if ($show > 0) {
                  $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $query2 = ci_get_related_posts_2( $post->ID, $postsnot, $show, $paged );
                    if( $query2->have_posts() ) { while ($query2->have_posts()) : $query2->the_post();get_template_part( 'templates/content', 'recommend' );
                     endwhile;
                    } 
                    wp_reset_query(); 
                    wp_reset_postdata();
                  }
                  ?>
            </div><!-- .recomendados -->
            <?php get_template_part('templates/entry-exlinks'); ?>
            <div class="quotes">
              <div>
                <span class="author-color"><i class="fa fa-thumb-tack"></i></span>
                <strong>Cita esta página</strong>
                <ul>
                  <li class="active"><a href="#apa" data-toggle="tab">APA</a></li>
                  <li><a href="#mla" data-toggle="tab">MLA</a></li>
                  <li><a href="#chicago" data-toggle="tab">CHICAGO</a></li>
                  <li><a href="#icontec" data-toggle="tab">ICONTEC</a></li>
                </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="apa">
                  <?php echo get_the_author_meta('last_name').' '.get_the_author_meta('first_name'); ?>. (<?php echo get_the_date('Y, F j'); ?>). <em><?php echo get_the_title(); ?></em>. Recuperado de <?php echo get_permalink(); ?> 
                </div>
                <div class="tab-pane" id="mla">
                  <?php echo get_the_author_meta('last_name').', '.get_the_author_meta('first_name'); ?>. "<?php echo get_the_title(); ?>". <em><?php echo get_bloginfo('name'); ?></em>. <?php echo get_the_date('j F Y'); ?>. Web. &lt;<?php echo get_permalink(); ?>&gt;.
                </div>
                <div class="tab-pane" id="chicago">
                  <?php echo get_the_author_meta('last_name').', '.get_the_author_meta('first_name'); ?>. "<?php echo get_the_title(); ?>". <em><?php echo get_bloginfo('name'); ?></em>. <?php echo get_the_date('F j, Y'); ?>. Consultado el <?php actual_date(); ?>. <?php echo get_permalink(); ?>.
                </div>
                <div class="tab-pane" id="icontec">
                  <?php echo get_the_author_meta('last_name').', '.get_the_author_meta('first_name'); ?>. <?php echo get_the_title(); ?> [en línea]. &lt;<?php echo get_permalink(); ?>&gt; [Citado el <?php actual_date(); ?>].
                </div>
              </div>
              <a href="javascript:;" id="copytext" class="btn btn-copiar" data-clipboard-target="apa">Copiar</a>
              <div class="hidden alert alert-success" role="alert">¡Texto copiado al portapapeles!</div>
            </div>
          </div><!-- .quotes -->

            
            <?php if (get_post_meta($post->ID, "image_url_value", true) != "") { ?>
            <div class="image-credit"><i class="fa fa-camera"></i> Imagen del encabezado cortesía de <a href="<?php echo get_post_meta($post->ID, "image_url_value", $single = true); ?>" target="_blank"><?php echo get_post_meta($post->ID, "image_author_t_value", true); ?></a> en Flickr</div>
            <?php } ?>
          </div>
          <footer>
            <?php wp_link_pages(array('before' => '<nav class="page-nav"><p>' . __('Pages:', 'roots'), 'after' => '</p></nav>')); ?>
          </footer>
          <div id="comments" class="comentarios">
            <a href="javascript:;" class="btn btn-block btn-primary btn-lg cerrado"><span>Tu opinión vale, comenta aquí</span><span style="display:none;">Oculta los comentarios</span></a>
            <div class="comments-wrapper">
              <h2><i class="fa fa-comments"></i> Comentarios</h2>
              <?php echo do_shortcode('[fbcomments]'); ?>
              <?php //comments_template('/templates/comments.php'); ?>
            </div>
          </div>
        </div><!-- fin col-md-10 -->
        <div class="col-sm-12 col-md-2">
          <div class="breadcredit">
            <?php get_template_part('templates/entry-meta'); ?>
            <?php the_tags('<div class="temas-uppost hidden-xs hidden-sm"> ','','</div>'); ?>
          </div>
        </div>
            
        </div><!-- fin de row de contenido y meta -->
        </article>
      </div><!--.col-sm-9-->
      
    </div><!-- fin de .row -->
    <div class="row title-section">
      <div class="col-sm-12">
        <?php
          $category = get_the_category($post->ID);
          $category_id = $category[0]->term_id;
        ?>
        <h2>También en <i class="fa icon-cat-<?php echo $category_id; ?> cat-col-<?php echo $category_id; ?>"></i> <?php echo $category[0]->name; ?></h2>
      </div>
    </div>
    <div class="row posts-home">
      <!--<div class="col-sm-12">-->
        <div id="recientes">
          <?php
            //$postp       = get_post( $post->ID );
            //$taxonomies = get_object_taxonomies( $postp, 'names' );
            $recent_args = array(
              'post_type'      => get_post_type( $post->ID ),
              'posts_per_page' => 12,
              'post_status'    => 'publish',
              'post__not_in'   => array($post->ID),
              'orderby'        => 'date',
              'paged'          => $paged,
              'cat'      => $category_id
            );
            $the_query = new WP_Query( $recent_args );

            if ( $the_query->have_posts() ) :
              while ( $the_query->have_posts() ) : $the_query->the_post();

                get_template_part( 'templates/content', 'recents' );
            
              endwhile;
              ?>
            <?php endif;
            wp_reset_query(); 
            wp_reset_postdata(); ?>
        </div><!-- #recientes -->
      <!--</div>-->
    </div>
  </div>
<?php endwhile; ?>