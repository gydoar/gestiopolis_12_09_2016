<?php
$servidor = $_SERVER['HTTP_HOST'] == 'localhost' ? 'blog23/' : '';
include_once($_SERVER['DOCUMENT_ROOT'].'/'.$servidor.'wp-load.php');
global $wpdb;
$userid= (int)$_POST['userid']; 
$itemid= (int)$_POST['itemid'];
$itemtype= (string)$_POST['itemtype'];
$req= (string)$_POST['req'];
if($req === 'drop'){
	$drop = $wpdb->query("DELETE FROM {$wpdb->prefix}follows WHERE user_id = '$userid' AND item_id = '$itemid' AND item_type = '$itemtype'");
	if ($drop){echo follows_count($itemid, $itemtype);}	
}else if($req === 'ins'){
	$uniquekey = substr(md5(uniqid(rand(), true)), 0,15);
	$insert = $wpdb->insert("{$wpdb->prefix}follows", array( 'user_id' => $userid, 'item_id' => $itemid, 'item_type' => $itemtype, 'send_time' => date("Y-m-d H:i:s"), 'uniquekey' => $uniquekey ), array( '%d', '%d', '%s', '%s', '%s' ) );
	if ($insert){echo follows_count($itemid, $itemtype);}
}else if($req === 'upd'){
	$emailsend= (string)$_POST['emailsend']; 
	$upd = $wpdb->update("{$wpdb->prefix}follows",array( 'email_send' => $emailsend),array('user_id' => $userid, 'item_id' => $itemid, 'item_type' => $itemtype),array('%s'),array('%d','%d','%s'));
}
?>