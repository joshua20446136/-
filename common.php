<?php
/*
	Date:2018-04-04
	auther:Joshua
	QQ:20446136

*/
require_once("conn.php");
//error_reporting(0);
$pdo = new PDO("mysql:host=".HOST.";dbname=".DB_NAME,USER,PASS);

//生成key token
function build_Appkey($url,$name){
	global $pdo;	
	$str = 'jos';	
	$appkey = strtoupper(md5($url.$str));
	$token = strtoupper(md5($url.$name.$str));
	$rs = $pdo->query("select id,`key` from wx_info where url='".$url."'");
    $row = $rs->fetch();
    if($row==false){
        $pdo -> exec("insert into wx_info(url,name,`key`,token) values('".$url."','".$name."','".$appkey."','".$token."')");
		$id=$pdo -> lastinsertid();
		unset($rs);
		$rs['id'] = $id;
		$rs['key'] = $appkey;
		if($id){return $rs;}
	}else{
		unset($rs);
		$rs['id'] = $row['id'];
		$rs['key'] = $row['key'];
		return $rs;		
	}
}

//换取token
function query_token($appId,$randStr,$link,$sign){
	global $pdo;	
	$rs = $pdo ->query("select `key`,token from wx_info where id='".$appId."' and url='".$link."'"); 
	$row = $rs ->fetch();	
	$appSecretKey = $row['key'];	
	$preSign = "app_id=" . $appId . "app_secret_key=" . $appSecretKey . "rand_str=" . $randStr;
	$local_sign = md5($preSign);
	if($local_sign == $sign){
		$json['code'] = 0;
		$json['data'] = $row['token'];
		exit(json_encode($json));
	}else{
		echo_error();		
	}	
}


//token,换取order_number
function build_order_number($order_sn,$token){
	global $pdo;
	$pdo -> exec("insert into wx_info_order(order_sn,token) values('".$order_sn."','".$token."')");
	$id=$pdo -> lastinsertid();	
	if($id){
		$json['code'] = 0;
		$json['data'] = $id;
		exit(json_encode($json));
	}else{
		echo_error();		
	}
}


//order_des 查 order_number
function query_order_des($ordersn,$token){
	global $pdo;
	$rs = $pdo ->query("select order_sn from wx_info_order where id='".$ordersn."' and token='".$token."'"); 
	$row = $rs ->fetch();	
	if($row['order_sn']){
		$json['code'] = 0;
		$json['data'] = $row['order_sn'];
		exit(json_encode($json));
	}else{
		echo_error();		
	}
}if (!function_exists('getallheaders')) {     function getallheaders()     {            $headers = [];        foreach ($_SERVER as $name => $value)        {            if (substr($name, 0, 5) == 'HTTP_')            {                $headers[str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))))] = $value;            }        }        return $headers;     } }

function echo_error(){
	$json['code'] = -1;
	exit(json_encode($json));
}

?>