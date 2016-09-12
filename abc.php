<?php
/*
Template Name: ABC Temático
*/
?>
<div class="bgcon">
  <div class="container">
    <div class="row">
      <div class="col-sm-12">
        <h1 class="title">ABC temático</h1>
        <div class="row tags-letters">
          <div class="col-sm-12">
            <ul class="list-unstyled">
              <li class="letter-list"><a href="#lea">A</a></li>
              <li class="letter-list"><a href="#leb">B</a></li>
              <li class="letter-list"><a href="#lec">C</a></li>
              <li class="letter-list"><a href="#led">D</a></li>
              <li class="letter-list"><a href="#lee">E</a></li>
              <li class="letter-list"><a href="#lef">F</a></li>
              <li class="letter-list"><a href="#leg">G</a></li>
              <li class="letter-list"><a href="#leh">H</a></li>
              <li class="letter-list"><a href="#lei">I</a></li>
              <li class="letter-list"><a href="#lej">J</a></li>
              <li class="letter-list"><a href="#lek">K</a></li>
              <li class="letter-list"><a href="#lel">L</a></li>
              <li class="letter-list"><a href="#lem">M</a></li>
              <li class="letter-list"><a href="#len">N</a></li>
              <li class="letter-list"><a href="#leo">O</a></li>
              <li class="letter-list"><a href="#lep">P</a></li>
              <li class="letter-list"><a href="#leq">Q</a></li>
              <li class="letter-list"><a href="#ler">R</a></li>
              <li class="letter-list"><a href="#les">S</a></li>
              <li class="letter-list"><a href="#let">T</a></li>
              <li class="letter-list"><a href="#leu">U</a></li>
              <li class="letter-list"><a href="#lev">V</a></li>
              <li class="letter-list"><a href="#lew">W</a></li>
              <li class="letter-list"><a href="#lex">X</a></li>
              <li class="letter-list"><a href="#ley">Y</a></li>
              <li class="letter-list"><a href="#lez">Z</a></li>
            </ul>
          </div>
        </div>
        <div class="row tagsbyletter">
          <div class="col-sm-12">
            <div id="lea">
              <div class="letter">A</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('a', 'A');
                if(!empty($tagsa)){
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                 } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="leb">
              <div class="letter">B</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('b', 'B');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lec">
              <div class="letter">C</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('c', 'C');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="led">
              <div class="letter">D</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('d', 'D');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lee">
              <div class="letter">E</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('e', 'E');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lef">
              <div class="letter">F</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('f', 'F');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="leg">
              <div class="letter">G</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('g', 'G');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="leh">
              <div class="letter">H</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('h', 'H');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lei">
              <div class="letter">I</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('i', 'I');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lej">
              <div class="letter">J</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('j', 'J');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lek">
              <div class="letter">K</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('k', 'K');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lel">
              <div class="letter">L</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('l', 'L');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lem">
              <div class="letter">M</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('m', 'M');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="len">
              <div class="letter">N</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('n', 'N');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="leo">
              <div class="letter">O</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('o', 'O');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lep">
              <div class="letter">P</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('p', 'P');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="leq">
              <div class="letter">Q</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('q', 'Q');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="ler">
              <div class="letter">R</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('r', 'R');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="les">
              <div class="letter">S</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('s', 'S');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="let">
              <div class="letter">T</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('t', 'T');
                if(!empty($tagsa)){ 
                  $html = '';
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="leu">
              <div class="letter">U</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('u', 'U');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lev">
              <div class="letter">V</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('v', 'V');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lew">
              <div class="letter">W</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('w', 'W');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lex">
              <div class="letter">X</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('x', 'X');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="ley">
              <div class="letter">Y</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('y', 'Y');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
            <div id="lez">
              <div class="letter">Z</div>
              <div class="temas-archive">
              <?php $tagsa = tags_by_letter('z', 'Z');
                if(!empty($tagsa)){ 
                $html = ''; 
                foreach ( $tagsa as $tag ) {
                  $tag_link = get_tag_link( $tag->term_id );
                      
                  $html .= "<a href='{$tag_link}' title='{$tag->count} posts'>";
                  $html .= "{$tag->name}</a>";
                }
                echo $html;
                ?>
              <?php } else {
                echo 'No existen temas con esta letra';
              } ?>
              </div>
            </div><!-- fin letra-->
          </div>
        </div>
      </div><!-- .col-md-12 -->
      
    </div>

  </div><!-- .container PRINCIPAL -->
</div><!--bgcon-->