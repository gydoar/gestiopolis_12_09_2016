<?php 
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'blog23/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php'); //Cargar el core de WordPress
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/file.php'); //Cargar las funciones de archivos de WordPress
require_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor. 'wp-admin/includes/media.php'); //Cargar las funciones de medios de WordPress

$step = ( isset($_POST['step']) && (string)$_POST['step'] ) ? $_POST['step'] : false;

if($step){
  switch ($step) {
    case 'uno': //Se sube el archivo
      $file = ( !empty($_FILES['document_file'])) ? $_FILES['document_file'] : false;
      if($file){
        $arch = pathinfo($file['name']);
        $extension = $arch['extension'];
        if($extension == 'pdf' || $extension == 'doc' || $extension == 'docx' || $extension == 'xls' || $extension == 'ppt' || $extension == 'pptx' || $extension == 'odt' || $extension == 'ott' || $extension == 'rtf' || $extension == 'txt' || $extension == 'odp' || $extension == 'csv' || $extension == 'ods' || $extension == 'pps' || $extension == 'PDF' || $extension == 'DOC' || $extension == 'DOCX' || $extension == 'XLS' || $extension == 'PPT' || $extension == 'PPTX' || $extension == 'ODT' || $extension == 'OTT' || $extension == 'RTF' || $extension == 'TXT' || $extension == 'ODP' || $extension == 'CSV' || $extension == 'ODS' || $extension == 'PPS'){
          $upload = wp_handle_upload($file, array('test_form' => false));
          $my_post = array(
              'post_title' => 'Sin título',
              'post_content' => 'Sin contenido',
              'post_status' => 'draft',
              'post_type' => 'post',
            );
          $post_ID = wp_insert_post($my_post);
          
          if(!isset($upload['error']) && isset($upload['file'])) {
            
            $filetype   = wp_check_filetype(basename($upload['file']), null);
            $title      = sanitize_file_name(basename($upload['file']));
            $ext        = strrchr($title, '.');
            $title      = ($ext !== false) ? substr($title, 0, -strlen($ext)) : $title;
            $attachment = array(
                'post_mime_type'    => $filetype['type'],
                'post_title'        => addslashes($title),
                'post_content'      => '',
                'post_status'       => 'inherit',
                'post_parent'       => $post_ID
            );

            $attach_id  = wp_insert_attachment($attachment, $upload['file']);
            
            $htmlpath = preg_replace('"\.'.$extension.'$"', '', $upload['file']);
            $archivo = pathinfo($upload['file']);
            $uppath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $htmlpath);
            exec('zip -r '.$htmlpath.'/'.sanitize_file_name($archivo['filename']).'.zip '.$upload['file'].'', $outzip);
            update_post_meta($post_ID, 'all2html_docu', $upload['url']);
            update_post_meta($post_ID, 'all2html_id', $attach_id);
            update_post_meta($post_ID, 'all2html_ext', $extension);
            update_post_meta($post_ID, 'all2html_path', $htmlpath);
            update_post_meta($post_ID, 'all2html_arch', $archivo);
            update_post_meta($post_ID, 'all2html_upf', $upload['file']);
            update_post_meta($post_ID, 'all2html_zip', $uppath.'/'.sanitize_file_name($archivo['filename']).'.zip');
            update_post_meta($post_ID, 'all2html_outzip', $outzip);
            update_post_meta($post_ID, 'all2html_postID', $post_ID);
            update_post_meta($post_ID, 'all2html_ok', 'ok');
            echo $post_ID;
          }
        } else {
          echo 'error';
        }
      }else {
        echo 'error';
      }
      break;
    case 'dos': // Se convierte el archivo o se copia el pdf a la carpeta
      $post_ID = ( isset($_POST['postid']) && (int)$_POST['postid'] ) ? $_POST['postid'] : false;
      if($post_ID && get_post_meta($post_ID, "all2html_ok", true) == 'ok'){
        $htmlpath = get_post_meta($post_ID, "all2html_path", true);
        $archivo = get_post_meta($post_ID, "all2html_arch", true);
        $extension = get_post_meta($post_ID, "all2html_ext", true);
        $upl_file = get_post_meta($post_ID, "all2html_upf", true);
        if (wp_mkdir_p($htmlpath)) {
          $pdfpath = $htmlpath.'/'.sanitize_file_name($archivo['filename']).'.pdf';
          $pdfoptpath = $htmlpath.'/'.sanitize_file_name($archivo['filename']).'-o.pdf';
          update_post_meta($post_ID, 'all2html_pdfpath', $pdfpath);
          update_post_meta($post_ID, 'all2html_pdfoptpath', $pdfoptpath);
          if($extension != 'pdf'){
            exec('unoconv -l &', $outpt);
            sleep(3);
            $command = 'unoconv --format pdf --output %s %s 2>&1';
            $command = sprintf($command, $htmlpath, $upl_file);
            exec($command, $output);
            $output = implode("\n", $output);
            update_post_meta($post_ID, 'output_convpdf', $output);
            $pdfurl = str_replace($_SERVER['DOCUMENT_ROOT'], '', $pdfpath);
            $title      = sanitize_file_name(basename($upl_file));
            $ext        = strrchr($title, '.');
            $title      = ($ext !== false) ? substr($title, 0, -strlen($ext)) : $title;
            $attachment2 = array(
                'post_mime_type'    => 'application/pdf',
                'post_title'        => 'pdf-'. addslashes($title),
                'post_content'      => '',
                'post_status'       => 'inherit',
                'post_parent'       => $post_ID
            );
            $attach_key = 'document_file_id';
            $attach_id_pdf  = wp_insert_attachment($attachment2, $pdfpath);
            update_post_meta($post_ID, 'all2html_pdf', $pdfurl);
            update_post_meta($post_ID, 'all2html_id_pdf', $attach_id_pdf);
          }else {
            $copiar = 'cp '.$upl_file.' '.$htmlpath.' 2>&1';
            exec($copiar, $outcopy);
            $outcopy = implode("\n", $outcopy);
            update_post_meta($post_ID, 'output_copiar', $outcopy);
            update_post_meta($post_ID, 'all2html_pdf', str_replace($_SERVER['DOCUMENT_ROOT'], '', $pdfpath));
          }
        }
        echo $post_ID;
      }
      break;  
    case 'tres': //Se optimiza el PDF
      $post_ID = ( isset($_POST['postid']) && (int)$_POST['postid'] ) ? $_POST['postid'] : false;
      if($post_ID && get_post_meta($post_ID, "all2html_ok", true) == 'ok'){
        $pdfpath = get_post_meta($post_ID, "all2html_pdfpath", true);
        $pdfoptpath = get_post_meta($post_ID, "all2html_pdfoptpath", true);
        $opt = "/usr/local/bin/gs -dNOPAUSE -dBATCH -dSAFER -sDEVICE=pdfwrite -dCompatibilityLevel=1.4 -dPDFSETTINGS=/screen -dAutoRotatePages=/None -sOutputFile='".$pdfoptpath."' ".$pdfpath." 2>&1";
        exec($opt, $outopt); //ejecuta el comando $opt en Linux
        update_post_meta($post_ID, 'output_optpdf', $outopt);
        echo $post_ID;
      }
      break;
    case 'cuatro': // Se genera el HTML cortado
      $post_ID = ( isset($_POST['postid']) && (int)$_POST['postid'] ) ? $_POST['postid'] : false;
      if($post_ID && get_post_meta($post_ID, "all2html_ok", true) == 'ok'){
        $pdfoptpath = get_post_meta($post_ID, "all2html_pdfoptpath", true);
        $htmlpath = get_post_meta($post_ID, "all2html_path", true);
        $archivo = get_post_meta($post_ID, "all2html_arch", true);
        $uppath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $htmlpath);
        $cmd = 'pdf2htmlEX --fit-width 872 --hdpi 72 --vdpi 72 --embed cFijo --no-drm 1 --optimize-text 1 --data-dir '.$_SERVER['DOCUMENT_ROOT'].'/pdf2htmlEX --dest-dir '.$htmlpath.' --external-hint-tool=ttfautohint '. $pdfoptpath .' 2>&1';
        exec($cmd, $outcmd); //ejecuta el comando $cmd en Linux
        $outcmd = implode("\n", $outcmd);
        update_post_meta($post_ID, 'output_pdf2html', $outcmd);
        update_post_meta($post_ID, 'all2html_html', $uppath.'/'.sanitize_file_name($archivo['filename']).'-o.html');
        update_post_meta($post_ID, 'all2html_css', $uppath.'/'.sanitize_file_name($archivo['filename']).'-o.css');
        $generatephp = 'cp '.$htmlpath.'/'.sanitize_file_name($archivo['filename']).'-o.html '.$htmlpath.'/'.sanitize_file_name($archivo['filename']).'-o.php 2>&1';
        exec($generatephp, $outphp);
        $outphp = implode("\n", $outphp);
        update_post_meta($post_ID, 'output_php', $outphp);
        update_post_meta($post_ID, 'all2html_php', $uppath.'/'.sanitize_file_name($archivo['filename']).'-o.php');
        $html_plain = file_get_contents($htmlpath.'/'.sanitize_file_name($archivo['filename']).'-o.php');
        $content = preg_replace ('/<img class=\"(.*?)\" alt=\"\" src=\"(.*?)\"\/>/s', '<img class="$1" alt="" src="'.$uppath.'/$2"/>', $html_plain);
        $filename = $htmlpath.'/'.sanitize_file_name($archivo['filename']).'-i.php';
        $handle = fopen($filename, 'x+');
        fwrite($handle, $content);
        fclose($handle);
        update_post_meta($post_ID, 'all2html_htmlcontent', $uppath.'/'.sanitize_file_name($archivo['filename']).'-i.php');
        preg_match('/<div id=\"pf3\" class\=\"pf w0 h0\" data\-page\-no\=\"3\">(.*?)<\/div>/s', $html_plain, $matches);
        $excerpt = strip_tags($matches[1]);
        update_post_meta($post_ID, 'all2html_excerpt', $excerpt);
        update_post_meta($post_ID, 'all2html_hash', genRandomString($pdfoptpath));
        echo $post_ID;
      }
      break;
    case 'cinco': //Se genera el HTML full
      $post_ID = ( isset($_POST['postid']) && (int)$_POST['postid'] ) ? $_POST['postid'] : false;
      if($post_ID && get_post_meta($post_ID, "all2html_ok", true) == 'ok'){
        $pdfoptpath = get_post_meta($post_ID, "all2html_pdfoptpath", true);
        $htmlpath = get_post_meta($post_ID, "all2html_path", true);
        $uppath = str_replace($_SERVER['DOCUMENT_ROOT'], '', $htmlpath);
        $archivo = get_post_meta($post_ID, "all2html_arch", true);
        if(wp_mkdir_p($htmlpath.'/fullhtml')){
          $full_html = 'pdf2htmlEX --fit-width 1240 --embed cfijo --no-drm 1 --optimize-text 1 --dest-dir '.$htmlpath.'/fullhtml --external-hint-tool=ttfautohint '. $pdfoptpath .' 2>&1';
          exec($full_html, $outfull);
          $outfull = implode("\n", $outfull);
          update_post_meta($post_ID, 'output_full', $outfull);
          update_post_meta($post_ID, 'all2html_fullhtml', $uppath.'/fullhtml/'.sanitize_file_name($archivo['filename']).'-o.html');
        }
        if ( function_exists('w3tc_pgcache_flush_post') ) {
          w3tc_pgcache_flush_post( $post_ID );
        }
        if (file_exists($htmlpath.'/'.sanitize_file_name($archivo['filename']).'-o.php')) {
          echo $post_ID;
        }else {
          echo 'error';
        }
      }
      break;
    case 'seis': //Se modifica el post con el título
      $post_ID = ( isset($_POST['postid']) && (int)$_POST['postid'] ) ? $_POST['postid'] : false;
      $title = ( isset($_POST['post_title']) && (string)$_POST['post_title'] ) ? wp_strip_all_tags($_POST['post_title']) : false;
      $category = ( isset($_POST['post_category']) && (int)$_POST['post_category'] ) ? $_POST['post_category'] : false;
      $desc = ( isset($_POST['post_desc']) && (string)$_POST['post_desc'] ) ? wp_strip_all_tags($_POST['post_desc']) : '';
      if($post_ID && $title && $category){
        $my_post = array(
          'ID'            => $post_ID,
          'post_status'   => 'publish',
          'post_title'    => $title,
          'post_content'  => $desc,
          'post_category' => array($category)
        );
        wp_update_post( $my_post );
        echo '<a href="'.get_permalink($post_ID).'">'.get_permalink($post_ID).'</a>|&lt;iframe width=&quot;800&quot; height=&quot;566&quot; src=&quot;'.home_url('/').'embed/'.get_post_meta($post_ID, "all2html_hash", true).'&quot; frameborder=&quot;0&quot; allowfullscreen&gt;&lt;/iframe&gt;';
      }
      break;
    default:
      echo '<h2>¡No deberías estar aquí!</h2>';
      break;
  }
}else {
  echo '<h2>¡No deberías estar aquí!</h2>';
}
?>