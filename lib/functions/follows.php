<?php 
/****************
Mostrar el número de seguidores de una categoría, etiqueta o autor
****************/
function follows_count($itemid, $type = 'cat') {
	global $wpdb;
	$follow_count = $wpdb->get_var($wpdb->prepare("SELECT COUNT(item_id) FROM {$wpdb->prefix}follows WHERE item_type = %s AND item_id = %d", $type, $itemid));
	return $follow_count;
}
/****************
Indica si el usuario esta siguiendo el ítem
****************/
function is_user_following($userid, $itemid, $type = 'cat'){
	global $wpdb;
	$user_following = $wpdb->get_var($wpdb->prepare("SELECT COUNT(follow_id) FROM {$wpdb->prefix}follows WHERE item_type = %s AND item_id = %d AND user_id = %d", $type, $itemid, $userid));
	if($user_following != 0){return true;}else{return false;}
}
/****************
Imprime los items que está siguiendo el usuario 
con los links para modificar el tiempo de email 
o link para dejar de seguir
****************/
function get_user_follows($userid, $type = 'cat'){
	global $wpdb;
	switch ( $type ) :
		case 'cat' :
			$sql ="SELECT user_id, name, item_id, email_send FROM {$wpdb->prefix}follows, {$wpdb->prefix}terms WHERE item_type = 'cat' AND user_id = '$userid' AND term_id = item_id";
			$type_name_n = 'ninguna Categoría';
			$type_name_pl = 'Categorías';
			break;
		case 'tag' :
			$sql ="SELECT user_id, name, item_id, email_send FROM {$wpdb->prefix}follows, {$wpdb->prefix}terms WHERE item_type = 'tag' AND user_id = '$userid' AND term_id = item_id";
			$type_name_n = 'ninguna Etiqueta';
			$type_name_pl = 'Etiquetas';
			break;
		case 'author' :
			$sql ="SELECT user_id, display_name AS name, item_id, email_send FROM {$wpdb->prefix}follows, {$wpdb->prefix}users WHERE item_type = 'author' AND user_id = '$userid' AND ID = item_id";
			$type_name_n = 'ningún Autor';
			$type_name_pl = 'Autores';
			break;
		default :
			$sql ="SELECT user_id, name, item_id, email_send FROM {$wpdb->prefix}follows, {$wpdb->prefix}terms WHERE item_type = 'cat' AND user_id = '$userid' AND term_id = item_id";
			$type_name_n = 'ninguna Categoría';
			$type_name_pl = 'Categorías';
			break;
	endswitch;
	$follows = $wpdb->get_results($sql);
	if ($follows){
		echo '<h3>'.$type_name_pl.' que sigues</h3>';
		echo '<table><thead><tr><th class="nombre">Nombre</th><th class="enviar_email">Enviar Email</th><th>Seguimiento</th></tr></thead><tbody>';	
		foreach ($follows as $follow) {
			$item_name = stripslashes($follow->name);
			$item_id = $follow->item_id;
			$send = $follow->email_send;
			if($send == 'd'){$actived=' active';$activew=$activen='';}else if($send == 'w'){$activew=' active';$actived=$activen='';}else if($send == 'n'){$activen=' active';$activew=$actived='';}else{$actived=$activew=$activen='';}
			echo '<tr style="cursor:pointer;" id ="'.$type.'_'.$item_id.'"><td><h3 class="alinearLeft">'.$item_name.'</h3></td>';
			echo '<td class="digest '.$type.'_'.$item_id.'"><a href="javascript:;" onclick="update_email_send(\''.get_bloginfo('template_directory').'/lib/functions/followsj.php\',\''.$userid.'\',\''.$item_id.'\',\'d\',\''.$type.'\')" name="emailse" class="email_send'.$actived.'">Diario</a> | <a href="javascript:;" onclick="update_email_send(\''.get_bloginfo('template_directory').'/lib/functions/followsj.php\',\''.$userid.'\',\''.$item_id.'\',\'w\',\''.$type.'\')" name="emailse" class="email_send'.$activew.'">Semanal</a> | <a href="javascript:;" onclick="update_email_send(\''.get_bloginfo('template_directory').'/lib/functions/followsj.php\',\''.$userid.'\',\''.$item_id.'\',\'n\',\''.$type.'\')" name="emailse" class="email_send'.$activen.'">No Enviar</a></td>';
			echo '<td class="follow"><a href="javascript:;" onclick="drop_follow(\''.get_bloginfo('template_directory').'/lib/functions/followsj.php\',\''.$userid.'\',\''.$item_id.'\',\''.$type.'\')" class="drop_follow">Dejar de Seguir</a></td></tr>';		
		}
		echo '</tbody></table>';	
	}else {
		echo '<h3>No sigues '.$type_name_n.'</h3>';
	}//end if follows
}
/****************
Trae los ids de los items que está siguiendo el usuario
****************/
function get_user_follows_ids($userid, $type = 'cat'){
	global $wpdb;
	$sql ="SELECT item_id FROM {$wpdb->prefix}follows WHERE item_type = '$type' AND user_id = '$userid'";
	$follows = $wpdb->get_results($sql);
	$follows = objectToArray($follows);
	for ($i=0; $i<count($follows); $i++){
	   $follow[$i] = $follows[$i];
	   $followids .= $follow[$i]["item_id"];
	   if ($i<(count($follows)-1)){
		   $followids .= ', ';
	   }
	}
	return $followids;
}
/****************
Funciones de administración de Follows
****************/
function get_total_users() {
	global $wpdb;
	$users_count = $wpdb->get_var("SELECT COUNT(DISTINCT user_id) FROM {$wpdb->prefix}follows");
	return $users_count;
}
function get_total_follows($type='total') {
	global $wpdb;
	switch ( $type ) :
		case 'total' :
			$total_follows = $wpdb->get_var("SELECT COUNT(follow_id) FROM {$wpdb->prefix}follows");
			break;
		case 'cat' :
			$total_follows = $wpdb->get_results($wpdb->prepare("SELECT COUNT(item_id) AS follows_count, item_id, name FROM {$wpdb->prefix}follows, {$wpdb->prefix}terms WHERE item_type=%s AND term_id = item_id GROUP BY (item_id) ORDER BY follows_count DESC LIMIT 15", 'cat'));
			break;
		case 'tag' :
			$total_follows = $wpdb->get_results($wpdb->prepare("SELECT COUNT(item_id) AS follows_count, item_id, name FROM {$wpdb->prefix}follows, {$wpdb->prefix}terms WHERE item_type=%s AND term_id = item_id GROUP BY (item_id) ORDER BY follows_count DESC LIMIT 15", 'tag'));
			break;
		case 'author' :
			$total_follows = $wpdb->get_results($wpdb->prepare("SELECT COUNT(item_id) AS follows_count, item_id, display_name FROM {$wpdb->prefix}follows, {$wpdb->prefix}users WHERE item_type=%s AND ID = item_id GROUP BY (item_id) ORDER BY follows_count DESC LIMIT 15", 'author'));
			break;
	endswitch;
	return $total_follows;
}
function get_total_emails($type='total') {
	global $wpdb;
	switch ( $type ) :
		case 'total' :
			$total_emails = $wpdb->get_var("SELECT SUM(send_count) FROM {$wpdb->prefix}follows");
			break;
		case 'cat' :
			$total_emails = $wpdb->get_var($wpdb->prepare("SELECT SUM(send_count) FROM {$wpdb->prefix}follows WHERE item_type=%s", 'cat'));
			break;
		case 'tag' :
			$total_emails = $wpdb->get_var($wpdb->prepare("SELECT SUM(send_count) FROM {$wpdb->prefix}follows WHERE item_type=%s", 'tag'));
			break;
		case 'author' :
			$total_emails = $wpdb->get_var($wpdb->prepare("SELECT SUM(send_count) FROM {$wpdb->prefix}follows WHERE item_type=%s", 'author'));
			break;
	endswitch;
	return $total_emails;
	
}
function most_follows_by_users() {
	global $wpdb;
	$most_follows = $wpdb->get_results("SELECT COUNT(user_id) AS follows_count, user_id, display_name FROM {$wpdb->prefix}follows, {$wpdb->prefix}users WHERE ID = user_id GROUP BY (user_id) ORDER BY follows_count DESC LIMIT 15");
	return $most_follows;
}
function last_users_follow() {
	global $wpdb;
	$last_users = $wpdb->get_results("SELECT COUNT(user_id) AS follows_count, user_id, display_name FROM {$wpdb->prefix}follows, {$wpdb->prefix}users WHERE ID = user_id GROUP BY (user_id) ORDER BY user_registered DESC LIMIT 15");
	return $last_users;
}
function get_analytics_emails($type) {
	global $wpdb;
	switch ( $type ) :
		case 'view' :
			$last_emails = $wpdb->get_results("SELECT display_name, name, email_send, views_date as edate FROM {$wpdb->prefix}follows, {$wpdb->prefix}terms, {$wpdb->prefix}users WHERE ID = user_id AND term_id = item_id AND email_send IN ('w','d') AND views_count = '1' ORDER BY views_date DESC LIMIT 20");
			break;
		case 'send' :
			$last_emails = $wpdb->get_results("SELECT display_name, name, email_send, send_time as edate FROM {$wpdb->prefix}follows, {$wpdb->prefix}terms, {$wpdb->prefix}users WHERE ID = user_id AND term_id = item_id AND email_send IN ('w','d') AND send_count > 0 ORDER BY send_time DESC LIMIT 20");
			break;
	endswitch;
	return $last_emails;
}
function follows_settings_add_admin() {
	add_menu_page('Follows', 'Follows', 'manage_options', 'my-top-follow-analytics', 'follows_analytics',get_bloginfo('template_directory').'/assets/img/arrow_refresh.png','3');
	add_submenu_page( 'my-top-follow-analytics', 'Estadísticas de Usuarios', 'Usuarios', 'manage_options', 'my-users-follows-analytics', 'follows_users_analytics');
	add_submenu_page( 'my-top-follow-analytics', 'Estadísticas de Ítems', 'Ítems', 'manage_options', 'my-items-follows-analytics', 'follows_items_analytics');
	add_submenu_page( 'my-top-follow-analytics', 'Estadíticas de Emails', 'Emails', 'manage_options', 'my-emails-follows-analytics', 'follows_emails_analytics');
	
}
add_action('admin_menu', 'follows_settings_add_admin');
function follows_analytics() {
?>	
	<div id="wrap2">
    <h2>Estadísticas Generales</h3>	
    <ul>
        <li><strong>Usuarios inscritos:</strong> <?php echo get_total_users();?><li>
        <li><strong>Items seguidos:</strong> <?php echo get_total_follows();?><li>
        <li><strong>Emails enviados:</strong> <?php echo get_total_emails();?><li>
        <li><strong>Emails de categorías enviados:</strong> <?php echo get_total_emails('cat');?><li>
        <li><strong>Emails de etiquetas enviados:</strong> <?php echo get_total_emails('tag');?><li>
        <li><strong>Emails de autores enviados:</strong> <?php echo get_total_emails('author');?><li>
    </ul>
	</div>
<?php	
}
function follows_users_analytics() {
?>	
	<div id="wrap2">
    <h2>Estadísticas de usuarios</h2>
    <div class="left" style="width:30%; margin:0 20px 15px 0;">
    <h3>Usuarios con más follows</h3>
    <table width="100%" class="wp-list-table widefat fixed">
    	<thead>
        <tr>
        <th class="manage-column column-cb check-column"></th>
        <th class="manage-column"><strong>Nombre</strong></th>
        <th class="manage-column column-tags"><strong>Follows</strong></th>
        </tr>
        </thead>
        <?php
                $i = 1;
				$followsu = most_follows_by_users();
				foreach($followsu as $followu)
                {
                    $id = $followu->user_id;
					$user_name = $followu->display_name;
					$follow_count = $followu->follows_count;
		?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $user_name;?></td>
        <td><?php echo $follow_count;?></td>
        </tr>
				<?php $i++; } ?>
        </table>
    </div>
    <div class="left" style="width:30%; margin:0 20px 15px 0;">
    <h3>Últimos usuarios inscritos</h3>
    <table width="100%" class="wp-list-table widefat fixed">
    	<thead>
        <tr>
        <th class="manage-column column-cb check-column"></th>
        <th class="manage-column"><strong>Nombre</strong></th>
        <th class="manage-column column-tags"><strong>Follows</strong></th>
        </tr>
        </thead>
        <?php
                $i = 1;
				$lastusers = last_users_follow();
				foreach($lastusers as $lastuser)
                {
                    $id = $lastuser->user_id;
					$user_name = $lastuser->display_name;
					$follow_count = $lastuser->follows_count;
					$post_date = $lastuser->post_date;
		 ?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $user_name;?></td>
        <td><?php echo $follow_count;?></td>
        </tr>
				<?php $i++; } ?>
        </table>
    </div>	
	</div>
<?php	
}
function follows_items_analytics() {
?>	
	<div id="wrap2">
    <h2>Estadísticas de ítems</h2>
    <div class="left" style="width:30%; margin:0 20px 15px 0;">
    <h3>Categorías con más follows</h3>
    <table width="100%" class="wp-list-table widefat fixed">
    	<thead>
        <tr>
        <th class="manage-column column-cb check-column"></th>
        <th class="manage-column"><strong>Nombre</strong></th>
        <th class="manage-column column-tags"><strong>Follows</strong></th>
        </tr>
        </thead>
        <?php
                $i = 1;
				$cats = get_total_follows('cat');
				foreach($cats as $cat)
                {
                    $id = $cat->item_id;
					$cat_name = $cat->name;
					$follow_count = $cat->follows_count;
		?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $cat_name;?></td>
        <td><?php echo $follow_count;?></td>
        </tr>
				<?php $i++; } ?>
        </table>
    </div>
    <div class="left" style="width:30%; margin:0 20px 15px 0;">
    <h3>Etiquetas con más follows</h3>
    <table width="100%" class="wp-list-table widefat fixed">
    	<thead>
        <tr>
        <th class="manage-column column-cb check-column"></th>
        <th class="manage-column"><strong>Nombre</strong></th>
        <th class="manage-column column-tags"><strong>Follows</strong></th>
        </tr>
        </thead>
        <?php
                $i = 1;
				$tags = get_total_follows('tag');
				foreach($tags as $tag)
                {
                    $id = $tag->item_id;
					$tag_name = $tag->name;
					$follow_count = $tag->follows_count;
		?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $tag_name;?></td>
        <td><?php echo $follow_count;?></td>
        </tr>
				<?php $i++; } ?>
        </table>
    </div>
    <div class="left" style="width:30%; margin:0 20px 15px 0;">
    <h3>Autores con más follows</h3>
    <table width="100%" class="wp-list-table widefat fixed">
    	<thead>
        <tr>
        <th class="manage-column column-cb check-column"></th>
        <th class="manage-column"><strong>Nombre</strong></th>
        <th class="manage-column column-tags"><strong>Follows</strong></th>
        </tr>
        </thead>
        <?php
                $i = 1;
				$authors = get_total_follows('author');
				foreach($authors as $author)
                {
                    $id = $author->item_id;
					$author_name = $author->display_name;
					$follow_count = $author->follows_count;
		?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $author_name;?></td>
        <td><?php echo $follow_count;?></td>
        </tr>
				<?php $i++; } ?>
        </table>
    </div>	
	</div>
<?php	
}
function follows_emails_analytics() {
?>	
	<div id="wrap2">
    <h2>Estadísticas de emails</h2>
    <div class="left" style="width:45%; margin:0 20px 15px 0;">
    <h3>Últimos emails enviados</h3>
    <table width="100%" class="wp-list-table widefat fixed">
    	<thead>
        <tr>
        <th class="manage-column column-cb check-column"></th>
        <th class="manage-column"><strong>Nombre</strong></th>
        <th class="manage-column"><strong>Ítem</strong></th>
        <th class="manage-column"><strong>Envío</strong></th>
        <th class="manage-column"><strong>Enviado el</strong></th>
        </tr>
        </thead>
        <?php
                $i = 1;
				$lemails = get_analytics_emails('send');
				foreach($lemails as $lemail)
                {
                    $user_name = $lemail->display_name;
					$item_name = $lemail->name;
					$send = $lemail->email_send;
					$date = $lemail->edate;
					$send = $send == 'd' ? 'Diario' : 'Semanal';
		?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $user_name;?></td>
        <td><?php echo $item_name;?></td>
        <td><?php echo $send;?></td>
        <td><?php echo mysql2date(get_option('date_format') .' '. get_option('time_format'), $date) ?></td>
        </tr>
				<?php $i++; } ?>
        </table>
    </div>
    <div class="left" style="width:45%; margin:0 20px 15px 0;">
    <h3>Últimos emails vistos (Tracking)</h3>
    <table width="100%" class="wp-list-table widefat fixed">
    	<thead>
        <tr>
        <th class="manage-column column-cb check-column"></th>
        <th class="manage-column"><strong>Nombre</strong></th>
        <th class="manage-column"><strong>Ítem</strong></th>
        <th class="manage-column"><strong>Envío</strong></th>
        <th class="manage-column"><strong>Visto el</strong></th>
        </tr>
        </thead>
        <?php
                $i = 1;
				$vemails = get_analytics_emails('view');
				foreach($vemails as $vemail)
                {
                    $user_name = $vemail->display_name;
					$item_name = $vemail->name;
					$send = $vemail->email_send;
					$date = $vemail->edate;
					$send = $send == 'd' ? 'Diario' : 'Semanal';
		?>
        <tr>
        <td><?php echo $i;?></td>
        <td><?php echo $user_name;?></td>
        <td><?php echo $item_name;?></td>
        <td><?php echo $send;?></td>
        <td><?php echo mysql2date(get_option('date_format') .' '. get_option('time_format'), $date) ?></td>
        </tr>
				<?php $i++; } ?>
        </table>
    </div>
    </div>
<?php	
}
?>