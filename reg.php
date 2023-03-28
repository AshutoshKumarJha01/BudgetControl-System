<?php
        require('database/connect.php');

                $email=mysqli_real_escape_string($con, $_POST['email']);
                $name=mysqli_real_escape_string($con, $_POST['name']);
                $psw=mysqli_real_escape_string($con, $_POST['psw']);
                $str_psw=password_hash($psw, PASSWORD_DEFAULT);
                $curr=mysqli_real_escape_string($con, $_POST['sellist']);
                
                $check="select * from user_info where email='$email'";
                $confirm=mysqli_query($con,$check);
                if (mysqli_num_rows($confirm)>0) {
                        echo "exist";
                }
                else
                {
                        $sql="insert into user_info(name,email,password,currency) values('$name','$email','$str_psw','$curr')";
                        $result=mysqli_query($con,$sql);
                        if($result==1)
                        {
                                echo "success";
                        }
                }
?>
