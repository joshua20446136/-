<?php
/*
	Date:2018-04-04
	auther:Joshua
	QQ:20446136
*/
require_once("common.php");
header('Content-Type:application/json; charset=utf-8');

$op = $_GET['op'] ? $_GET['op'] : '0';
if('auth' == $op){
	$app_id = $_GET['app_id'];
	$rand_str = $_GET['rand_str'];
	$sign = $_GET['sign'];
	$link = $_GET['link'];
	$name = $_GET['name'];
	if($app_id && $rand_str && $sign && $link && $name){
		query_token($app_id ,$rand_str ,$link ,$sign);
	}else{
		echo_error();	
	}
}elseif('order' == $op){
	$order_sn = $_POST['order_sn'];
	$header = getallheaders();	//var_dump($_SERVER );
	$auth = explode(' ', $header['Authorization']);
	$token = $auth[1];
	if($order_sn && $token){
		build_order_number($order_sn ,$token);
	}else{
		echo_error();	
	}
}elseif('pay' == $op){	
	$header = getallheaders();
	$auth = explode(' ', $header['Authorization']);
	$token = $auth[1];
	$order_secret = $_GET['order_secret'];
	if($token && $order_secret){
		query_order_des($order_secret,$token);
	}else{
		echo_error();
	}
}else{
	echo_error();
}
?>