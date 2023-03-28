<?php
        require('database/connect.php');
        session_start();
                $category=mysqli_real_escape_string($con, $_POST['cat']);
                $details=mysqli_real_escape_string($con, $_POST['details']);
                $amount=mysqli_real_escape_string($con, $_POST['amount']);
                $date=mysqli_real_escape_string($con, $_POST['date']);
                $id=$_SESSION['id'];
                $query=mysqli_query($con,"INSERT INTO income_detail(category,user_id,details,amount,dat) values('$category','$id','$details','$amount','$date')");
                        if ($query==1) {
                                //$_SESSION['income']+=$amount;
                                echo("success");
                        }
                        else{
                                echo($amount);
                        }
?>