<?php 
	
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST');


$data=json_decode(file_get_contents("php://input"),true);
require('../database/connect.php');

$id=$data['login'];

$query="SELECT SUM(amount) FROM income_detail WHERE user_id={$id}";
$res=mysqli_query($con,$query) or die("Query Not Execute");

if(mysqli_num_rows($res)>0){

	$output=mysqli_fetch_all($res,MYSQLI_ASSOC);
	$balance=$output[0]['SUM(amount)'];
	$q1="UPDATE income_detail SET balance='$balance' WHERE user_id={$id} ORDER BY id DESC LIMIT 1";
	mysqli_query($con,$q1);

	$query1="SELECT SUM(amount) FROM spend_detail WHERE user_id={$id}";
	$res1=mysqli_query($con,$query1) or die("Query Not Execute");
	$output1=mysqli_fetch_all($res1,MYSQLI_ASSOC);

	$balance2=$output1[0]['SUM(amount)'];
	$bal=$balance-$balance2;
	$q2="UPDATE spend_detail SET balance='$bal' WHERE user_id={$id} ORDER BY id DESC LIMIT 1";
	mysqli_query($con,$q2);

	echo json_encode(array('Income'=>$output,'Spending'=>$output1));
}else{
	echo json_encode(array('Message' =>'No record Found'));
}

?>