<?php
include('database/connect.php');
session_start();
                $email=$_POST["email"];
                $psw=$_POST["psw"];
                $check="SELECT id,name,password,currency FROM user_info WHERE email='$email'";
                $confirm=mysqli_query($con,$check);
                if (mysqli_num_rows($confirm)>0) {
                        $row=mysqli_fetch_assoc($confirm);
                        $verify=password_verify($psw,$row['password']);
                        if ($verify==1) {
                                $_SESSION['id']=$row['id'];
                                $_SESSION['name']=$row['name'];
                                if($row['currency']=="USD"){
                                   $_SESSION['currency']="dollar";     
                                }
                                else if($row['currency']=="INR"){
                                    $_SESSION['currency']="rupee";    
                                }
                                else if($row['currency']=="Yen"){
                                    $_SESSION['currency']="yen";    
                                }
                                else if($row['currency']=="RUB"){
                                    $_SESSION['currency']="rub";    
                                }
                                echo("login");
                        }
                }
?>