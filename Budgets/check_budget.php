<?php 
	
header('Content-Type:application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Method: POST');


$data=json_decode(file_get_contents("php://input"),true);
require('../database/connect.php');

$id=$data['login'];
$date=$data['date'];

$query="SELECT from_date,to_date,amount FROM user_budget WHERE user_id={$id} AND to_date LIKE '{$date}%'";
$res=mysqli_query($con,$query) or die("Query Not Execute");

if(mysqli_num_rows($res)>0){
	$output="SUCCESS";
	
	$output1=mysqli_fetch_all($res,MYSQLI_ASSOC);
	echo json_encode(array('Message'=>$output,'Budget'=>$output1));
}else{
	echo json_encode(array('Message' =>'UNSUCCESS'));
}

?>