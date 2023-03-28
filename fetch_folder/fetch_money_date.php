<?php 
	
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST');


$data=json_decode(file_get_contents("php://input"),true);
require('../database/connect.php');

$id=$data['login'];
$date=$data['date'];

$query="SELECT SUM(amount) FROM income_detail WHERE user_id={$id} AND dat LIKE '{$date}%'";
$res=mysqli_query($con,$query) or die("Query Not Execute");

$bud_query="SELECT amount FROM user_budget WHERE user_id={$id} AND to_date LIKE '{$date}%'";
$bud_res=mysqli_query($con,$bud_query) or die("Query Not Execute");

if(mysqli_num_rows($res)>0){

	$output=mysqli_fetch_all($res,MYSQLI_ASSOC);
	$bud_output=mysqli_fetch_all($bud_res,MYSQLI_ASSOC);

	$query1="SELECT SUM(amount) FROM spend_detail WHERE user_id={$id} AND dat LIKE '{$date}%'";
	$res1=mysqli_query($con,$query1) or die("Query Not Execute");
	$output1=mysqli_fetch_all($res1,MYSQLI_ASSOC);

	echo json_encode(array('Income'=>$output,'Spending'=>$output1,'Budget'=>$bud_output));
}else{
	echo json_encode(array('Message' =>'No record Found'));
}

?>