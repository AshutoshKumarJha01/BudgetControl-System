<?php 
	
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST');


$data=json_decode(file_get_contents("php://input"),true);
require('../database/connect.php');

$id=$data['login'];
$date=$data['date'];

$query="SELECT amount,category,user_id,dat FROM income_detail WHERE user_id={$id} AND dat LIKE '{$date}%'";
$res=mysqli_query($con,$query) or die("Query Not Execute");

if(mysqli_num_rows($res)>=0){

	$output=mysqli_fetch_all($res,MYSQLI_ASSOC);

	$query1="SELECT amount,category,user_id,dat FROM spend_detail WHERE user_id={$id} AND dat LIKE '{$date}%'";
	$res1=mysqli_query($con,$query1) or die("Query Not Execute");
	$output1=mysqli_fetch_all($res1,MYSQLI_ASSOC);

	echo json_encode(array('Income'=>$output,'Spending'=>$output1));
}else{
	echo json_encode(array('Message' =>'No record Found'));
}

?>