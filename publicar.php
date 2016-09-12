<?php
/*
Template Name: Publicar
*/
?>
<?php
    if ( function_exists( 'wpcf7_enqueue_scripts' ) ) {
        wpcf7_enqueue_scripts();
    }
 
    if ( function_exists( 'wpcf7_enqueue_styles' ) ) {
        wpcf7_enqueue_styles();
    }
?>

<?php while (have_posts()) : the_post(); ?>
<div class="bgcon">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="title">Publicar en gestiopolis</h1>
        <div class="row">
          <div class="col-sm-offset-2 col-sm-8 aboutsections">
            <div class="row">
              <div class="col-sm-offset-2 col-sm-8">
                <div class="form-con">
                  <p>Selecciona el documento que deseas cargar</p>
                  <?php echo do_shortcode('[contact-form-7 id="325591" title="Formulario de aportes"]'); ?>
                  <p class="bg-info">Archivos compatibles: pdf, doc, docx, xls, ppt, pptx, odt, ott, rtf, txt, odp, csv, ods, pps</p>
                </div>
              </div>
            </div>
            <!-- start carousel -->
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                  <h4 class="panel-title">
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                      ¿Porqué deberías publicar?
                    </a>
                  </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <h3 class="raz-alt">Algunas razones altruistas</h3>
                    <ol>
                      <li><strong>Compartir conocimiento es la mejor forma de multiplicar la riqueza</strong>. Recuerda la célebre frase de <a target="_blank" href="http://en.wikipedia.org/wiki/Derek_Bok">Derek Bok</a> <em>&quot;Si cree que la educación es cara, pruebe con la ignorancia&quot;</em>.</li>
                      <li><strong><a target="_blank" href="http://www.youtube.com/watch?v=ZEetqIL65iQ">Compartir ideas</a> potencia el desarrollo</strong> de las personas, las organizaciones y de la sociedad en su conjunto.</li>
                      <li><strong>Contribuirás a multiplicar el talento empresarial de Hispanoamérica</strong>. La región lo necesita para alcanzar el <a target="_blank" href="http://www.eclac.cl/cgi-bin/getProd.asp?xml=/publicaciones/xml/1/45171/P45171.xml&amp;xsl=/dds/tpl/p9f.xsl&amp;base=/tpl/top-bottom.xslt">desarrollo deseado</a>.</li>
                      <li><strong>Avivarás la llama de la mayor revolución del conocimiento humano</strong> desde la <a target="_blank" href="http://es.wikipedia.org/wiki/Imprenta#Historia_de_la_imprenta_moderna">invención de la imprenta</a>.</li>
                    </ol>
                    <h3 class="raz-ego">Algunas razones egoístas</h3>
                    <ol>
                      <li><strong>Compartir tu conocimiento con millones te hace sobresalir entre millones</strong>. Mensualmente 4,3 millones de lectores acceden a las páginas de GestioPolis para buscar información sobre diferentes tópicos alrededor de un tema central <strong>Los Negocios</strong>. Con tus publicaciones te estarás construyendo un nombre entre personas de negocios de habla hispana en todo el mundo.</li>
                      <li><strong>Impresiona a tu próximo empleador</strong>, ya sea que estés tras tu primer empleo o buscando escalar posiciones, agrega tus publicaciones a tu currículum y demuestra que eres la persona mejor preparada para el cargo.</li>
                      <li><strong>En la carta de solicitud de ingreso al programa de posgrado que sueñas,</strong> acompaña tus argumentos con una demostración de tu conocimiento indicando las URL de tus publicaciones.</li>
                      <li><strong>Lo que sabes es tu mejor tarjeta de presentación</strong>. Dale una oportunidad a tu conocimiento, deja que te consiga nuevos clientes.</li>
                      <li><strong>Eres un ser humano extraordinario</strong>, seguro que sabes algo que a muchos otros les ha de interesar.</li>
                      <li><strong>Acuérdate del Karma</strong>, hay que devolver de vez en cuando <?php convert_smilies(';-)') ?></li>
                      <li>En el formulario se puede agregar un campo &#39;razón de publicación&#39; de selección múltiple</li>
                    </ol>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingTwo">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                      ¿Qué tipo de material publicamos?
                    </a>
                  </h4>
                </div>
                <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                  <div class="panel-body">
                    <p>Todas las colaboraciones serán bienvenidas, siempre que traten <strong> <a target="_blank" href="<?php echo home_url( '/abc-tematico/' ); ?>">temas de economía y empresa</a></strong> o se relacionen con ellos, <strong>tanto en formato escrito</strong> (p. ej.: ensayos, trabajos de investigación, revisiones de literatura, monografías, tesis, estudios de caso, presentaciones, artículos, proyectos, libros, cursos, manuales, tutoriales, resúmenes, white papers, hojas de cálculo...) <strong>como en audio o video</strong> (p. ej.: entrevistas, audiolibros, screencasts, presentaciones de diapositivas con audio, conferencias, lecciones, cursos...) e imágenes en el caso de infografías.</p>
                    <h3>Es posible que NO publiquemos el material cuando:</h3>
                    <ol>
                      <li>NO versa sobre <strong><a target="_blank" href="<?php echo home_url( '/abc-tematico/' ); ?>">temas relacionados con negocios</a></strong>, los cuales constituyen la línea editorial de GestioPolis, aunque en ocasiones publicamos recursos de otras temáticas como educación o derecho, el material enfocado en negocios tendrá prelación.</li>
                    </ol>
                    <h3>Definitivamente NO publicaremos el material cuando:</h3>
                    <ol>
                      <li>Contiene únicamente o mayormente información comercial sobre una persona, empresa, sitio web, producto o servicio. </li>
                      <li>Expresa de manera parcializada y sin ningún tipo de análisis la crítica o preferencia por cierto movimiento o personaje político.</li>
                      <li>En el caso de documentos escritos: tiene mala redacción, su ortografía es muy deficiente o es demasiado corto (menos de una página normal tamaño carta a espacio y medio y letra 12, aprox. 28 renglones).</li>
                      <li>No se ajusta a nuestros <strong><a target="_blank" href="<?php echo home_url( '/terminos-de-uso/' ); ?>">términos de uso</a></strong>.</li>
                    </ol>
                  </div>
                </div>
              </div>
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingThree">
                  <h4 class="panel-title">
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                      Preguntas frecuentes
                    </a>
                  </h4>
                </div>
                <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                  <div class="panel-body">
                    <ol>
                      <li><strong>¿A quién pertenecen los derechos del material publicado?</strong><br><br>
                      Siempre serás el dueño de tu obra. El material será publicado bajo la licencia <a target="_blank" href="http://creativecommons.org/licenses/by-nc-sa/3.0/deed.es">CC BY-NC-SA 3.0</a>, lo cual quiere decir que tu eres el dueño de tu obra y que le otorgas a otros el permiso de compartirla, copiarla, distribuirla, ejecutarla, comunicarla públicamente y hacer obras derivadas de ella, siempre que te reconozcan como el autor original, la compartan bajo la misma licencia y no la usen para fines comerciales o de lucro. En cualquier momento puedes solicitar que tu obra se ponga fuera de línea, además puedes indicar si quieres que se publique bajo una licencia de derechos de autor diferente, por ejemplo, <a target="_blank" href="http://es.wikipedia.org/wiki/Todos_los_derechos_reservados">todos los derechos reservados</a>.</li>
                      <li><strong>¿El autor recibe algún pago monetario por publicar?</strong><br> <br>
                      No las publicaciones se hacen <a target="_blank" href="http://es.wikipedia.org/wiki/Ad_honorem">Ad Honorem</a>. Quienes comparten sus conocimientos a través del portal obtienen el reconocimiento que implica publicar en un medio que ha alcanzado popularidad por la calidad de sus 
                      contenidos, con cifras cercanas a 4,3 millones de visitas mensuales y 1,2 millones de suscriptores.</li>
                      <li><strong>¿Modificará GestioPolis el material que envíen los autores?</strong><br><br>
                      En algunos casos nuestro equipo de edición lo optimizará para la internet, eso quiere decir que es posible que, por ejemplo, se modifique el título, algunas partes del texto (en el caso de material escrito) o que se incluyan enlaces. Siempre tendrás la oportunidad de expresar si estás de acuerdo o no con las modificaciones, si quieres que se reviertan y/o sugerir cambios o actualizaciones adicionales.</li>
                      <li><strong>¿Es posible enviar material ya publicado en otra página web?</strong><br><br>
                      Sí, aunque preferiríamos que GestioPolis fuera el sitio en el que originalmente se pone en línea, lo publicaremos siempre que cumpla con las condiciones ya descritas.</li>
                      <li><strong>¿Cómo sabe el autor en qué etapa del proceso de publicación se encuentra el material que envió?</strong><br><br>
                      Te mantendremos informado vía email, al recibir el material, al revisarlo, al publicarlo y si se da el caso, al realizar modificaciones solicitadas por ti.</li>
                      <li><strong>Si tienes inquietudes diferentes a estas por favor <a about="_blank" href="<?php echo home_url( '/contacto/' ); ?>">comunícate con nosotros</a>.</strong></li>
                    </ol>
                  </div>
                </div>
              </div>
            </div>
            <!--end carousel -->
          </div>
        </div><!-- .row -->
      </div><!-- .col-sm-12 -->
      
    </div>

  </div><!-- .container PRINCIPAL -->
</div>
<?php endwhile; ?>
