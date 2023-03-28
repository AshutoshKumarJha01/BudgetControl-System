<?php 
require('../database/connect.php');

?>
<!doctype html>
<html>
    <head>
    <meta charset="utf-8">
    <title>Setting</title>
    <?php require_once("../header/header_links.php");?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../CSS/style.css">
     <style type="text/css">
        .bg-info{
          color: #fff;
          padding: 20px;
          margin: 5px;
        }
        .footer{
    padding: 20px;
    background:rgb(73, 112, 144);
    color:#fff;
}
.footer .caption ul,li{
    list-style: none;
    padding: 1px;
    text-align: left;
}
.footer .caption li a{
    color: #fff;
    font-size: 15px;
    text-decoration: none;
}
.footer .col-md-4{
    background-color: transparent;
}
     s </style>
    </head>
    <body>
<?php
session_start();
if(isset($_POST['submit'])) 
{
    $old_pass=mysqli_real_escape_string($con, $_POST['old']);
    
    $new_pass=mysqli_real_escape_string($con, $_POST['new']);
    $new_pass_crypt=password_hash($new_pass, PASSWORD_DEFAULT);
    $retype_pass=mysqli_real_escape_string($con, $_POST['retype']);
    $retype_pass_crypt=password_hash($retype_pass, PASSWORD_DEFAULT);
    $id=$_SESSION['id'];
    $query=mysqli_query($con,"SELECT password,id FROM user_info WHERE id='$id'");
    if(mysqli_num_rows($query)>0){
        $check=mysqli_fetch_assoc($query);
        $verify=password_verify($old_pass,$check['password']);
        if($verify==1){
             if ($new_pass==$retype_pass) 
            {
                $update_psw = mysqli_query($con,"UPDATE user_info SET password='$new_pass_crypt' WHERE id='$id'");
                if ($update_psw==true) 
                {
                    echo '<script>
                        swal({
                            text:"password change sucessfully!",
                            icon:"success"
                            }).then(function(){
                                window.location.href="http://localhost/college/logout.php";
                            });
                        </script>';
                }
            }
            else
            {
                    echo '<script>
                        swal({
                            text:"Retype Password!",
                            icon:"warning"
                            });
                    </script>';
            }

        }else{
              echo '<script>
                    swal({
                        text:"Old password not match!",
                        icon:"warning"
                        });
                </script>';
        }
    }else{
        echo "no rows";
    }
}?>
    <?php if(isset($_SESSION['name'])):?>
    <?php require_once("../header/page_topnav.php");?>
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3 col-sm-6" style="margin-top: 50px;border: 1px solid rgba(0,0,0,0.1);padding: 40px;">
                <form method="post">
                    <h5 class="text-success text-center">Change Password</h5><br>
                    <div class="form-group">
                            <input type="password" class="form-control input-lg" placeholder="Old Password" name="old" required="true">
                    </div>
                    <div class="form-group">
                            <input type="password" class="form-control input-lg" placeholder="New Password" name="new" required="true">
                    </div>
                    <div class="form-group">
                            <input type="password" class="form-control input-lg" placeholder="Re-type New Password" name="retype" required="true">
                    </div>
                            <input type="submit" class="btn btn-primary btn-lg" value="Change" name="submit">
                </form>
            </div>
        </div>
    </div>
    </div><br>
    <?php require_once("../header/page_footer.php");?>

    <?php else :?>
        <?php
  if (!isset($_SESSION['id'])) {
    echo "<h5 class='text-center text-danger mt-5'>Yoc can't access this page directly!</h5>";
}?>
<?php endif; ?>
    </body>
</html>