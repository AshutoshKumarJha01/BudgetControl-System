<?php
require('../database/connect.php');
session_start();

if (!isset($_SESSION['id'])) {
    echo "<h5 class='text-center text-danger mt-5'>Yoc can't access this page directly!</h5>";
}
else{
    $login=$_SESSION['id'];
    }

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>Finance - Debit & Credit </title>
	<?php require_once("../header/header_links.php");?>
     <link rel="stylesheet" type="text/css" href="../CSS/style.css">
     <style type="text/css">
         body{
            background: none;
         }
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
     </style>
</head>
<body>

<?php 

if (isset($_GET['id']) && isset($_GET['date'])){
    
   $recordId = $_GET['id'];
    $c_date= date('Y-m', time());
    if($c_date==$_GET['date']){
        
        echo '<script>
            swal({
                text:"You cannot clear the same month record!",
                icon:"warning"
                }).then(function(){
                    window.location.href="http://localhost/college/transaction/debit.php";
                });
            </script>';
    }else{
        echo '<script>
            swal({
                text:"Are you want to clear",
                icon:"success"
                }).then(function(){';
        $delete = "DELETE FROM income_detail WHERE id='$recordId'";
        mysqli_query($con,$delete);
          echo 'window.location.href="http://localhost/college/transaction/debit.php";
                });
            </script>';
    }
}
 if (isset($_GET['id2']) && isset($_GET['date2'])){

            $recordId2 = $_GET['id2'];
                $c_date= date('Y-m', time());
            if($c_date==$_GET['date2']){
                
                echo '<script>
                    swal({
                        text:"You cannot clear the same month record!",
                        icon:"warning"
                        }).then(function(){
                            window.location.href="http://localhost/college/transection/debit.php";
                        });
                    </script>';
            }else{
                echo '<script>
                    swal({
                        text:"Are you sure want to clear",
                        icon:"success"
                        }).then(function(){';
            $delete2 = "DELETE FROM spend_detail WHERE id='$recordId2'";
            mysqli_query($con,$delete2);
             echo 'window.location.href="http://localhost/college/transection/debit.php";
                });
            </script>';
    }
}
?>

<?php if(isset($_SESSION['name'])):?>
    <?php require_once("../header/page_topnav.php");?><br>
	<div class="container-fluid">
        <div class="row">
            <div class="col-md-6 col-lg-6 col-sm-6 scrollbar">
                <h4 class="text-center">Income Transaction</h4><hr>
                <table class='table table-striped table-bordered text-center'>
                    <thead>
                        <tr class="table-info">
                            <th>Category</th>
                            <th>Details</th>
                            <th>Income</th>
                            <th>Remaining Balance</th>
                            <th>Date</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql="SELECT id,category,details,amount,balance,dat FROM income_detail WHERE user_id='$login' ORDER BY dat DESC";
                        $query=mysqli_query($con,$sql);
                        while ($array =mysqli_fetch_assoc($query)){
                            echo "<tr><td>".$array['category']."</td><td>".$array['details']."</td><td class='text-success'>".$array['amount']."</td><td>".$array['balance']."</td><td>".date( 'd F Y h:i a ', strtotime($array['dat']))."</td><td><a href='debit.php?id=".$array['id']."&date=".date('Y-m', strtotime($array['dat']))."' class='btn btn-danger'>Clear</a></td></tr>"; 
                        }?>
                    </tbody>
                </table>
            </div>
            <?php 
            $sql2="SELECT id,category,details,amount,balance,dat FROM spend_detail WHERE user_id='$login' ORDER BY dat DESC";
            $query2=mysqli_query($con,$sql2);
            ?>
            <div class="col-md-6 col-sm-6 col-lg-6 scrollbar">
                <h4 class="text-center">Spending Transaction</h4><hr>
                <table class='table table-striped table-bordered text-center'>
                    <thead>
                        <tr class="table-info">
                            <th>Category</th>
                            <th>Details</th>
                            <th>Spending</th>
                            <th>Remaining Balance</th>
                            <th>Date</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($array2 = mysqli_fetch_assoc($query2)){
                            echo "<tr><td>".$array2['category']."</td><td>".$array2['details']."</td><td class='text-danger'>".$array2['amount']."</td><td>".$array2['balance']."</td><td>".date( 'd F Y h:i a ', strtotime($array2['dat']))."</td><td><a href='debit.php?id2=".$array2['id']."&date2=".date('Y-m', strtotime($array2['dat']))."' class='btn btn-danger'>Clear</a></td></tr>"; 
                        }?>
                    </tbody>
                </table>
                <?php
                if (mysqli_num_rows($query2)<1) {
                            echo "<h6 class='text-danger text-center'>No Record Found</h6>";
                        }
                ?>
            </div>
        </div>
    </div><br>
    <?php require_once("../header/page_footer.php");?>
<?php else :?>
  <div style="justify-content: center;display: flex;align-items: center;height: 100vh;">
    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
      <div class="card-header">You Cant Access This Page</div>
        <div class="card-body">
          <h5 class="card-title">Debit Page</h5>
          <p class="card-text">This is do for Security Reason so Welcome Again</p>
        </div>
      </div>
</div>
<?php endif;?>
</body>
</html>