<?php
require('database.php');?>
  <?php if (!isset($_SESSION['email'])):?>
    <p style="color:red;">You can't access this page directly!</p>

<?php else:?>
<?php 
$id=$_GET['id'];$total_spent_money=0;$indivisual_share=0;
$title='';$Budget='';$remaining_budget=0;$total_people=0;
$name='';$total=0;
$total_expension_prod=0;
  $query=mysqli_query($con,"SELECT * FROM trip_detail WHERE id='$id'");
  $num=mysqli_num_rows($query);


    $query1=mysqli_query($con,"SELECT * FROM expensive_user WHERE user_id='$id'");
    $total_expension_prod=mysqli_num_rows($query1);
    while($get_total=mysqli_fetch_assoc($query1)){
      $total_spent_money=$total_spent_money+$get_total['amount_spent'];
    }

if(isset($_POST['add'])){

  if(mysqli_query($con,"INSERT INTO expensive_user(user_id,title,date,amount_spent,order_by,user_bill) VALUES('".$id."','".$_POST['expansive_name']."','".$_POST['paying_date']."','".$_POST['amount']."','".$_POST['user_name']."','".$_POST['bill_file']."')")){
    header('location:display_budget.php?id='.$id);
    echo '<script>alert("'.$amount.'");</script>';
}
}
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  

  <style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap');
      *{
        font-family: 'Open Sans', sans-serif;
      }
      .panel-info>.panel-heading{
        background: #205063;
        color: #fff;
      }
      input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
       margin: 0;
    }
    .flex_div{
      display: flex;
      justify-content: space-between;
    }
    .panel-info{
      border: 1px solid rgba(0,0,0,0.3);
      background: #fff;
      width: 100%;
      margin: 10px;
    }
    .expansive{
      padding: 20px;
      margin: 30px;
    }
    #main_left, #main_right{
      display: block;
    }
    .row
    {
      min-height: 570px;
    }
  </style>
    </head>
    <body background="image/5.jpg" style="background-position: center;">
        <nav class="navbar  navbar-inverse grade" style="margin-bottom: auto;">
        <div class="container">
            <div class="navbar-header">
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#myNavbar" aria-controls="myNavbar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
                <a class="navbar-brand" href="home.php">Ctrl Budget</a>
            </div>
            <div class="collapse navbar-collapse" id="myNavbar">
               
            <ul class="nav navbar-nav navbar-right">
                <li><a href="about.phps"><span class="glyphicon glyphicon-info-sign"></span>&nbsp; About Us</a></li>
                <li><a href="setting.php"><span class="glyphicon glyphicon-cog"></span>&nbsp; Change Password</a></li>
                <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span>&nbsp; Logout</a></li>
            </ul>
            </div>
        </div>
    </nav>
    <div class="container">
      <div class="row">
            <div class="col-md-7 col-sm-6 main_left">
           <?php while($row=mysqli_fetch_assoc($query)):?>
            <div class="panel-info">
              <div class="panel-heading">
                <div class="flex_div">
                  <?php $name=$row['person_name'];?>
                   <?php $_SESSION['title']=$row['title'];?>
                   <?php $title=$row['title']; ?>
                  <div><h4><?php echo $row['title'];?></h4></div>
                  <?php $total_people=$row['no_of_people'];?>
                  <div><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $row['no_of_people'];?></div>
                </div>
              </div>
              <div class="panel-body">
                <div class="flex_div">
                  <div>Budget</div>
                  <div>&#x20B9; <?php echo $row['initial_budget'];?></div>
                  <?php $budget=$row['initial_budget'];?>
                </div><hr>
                <div class="flex_div">
                  <div>Remaining Amount</div>
                  <?php $remaining_budget=$row['initial_budget']-$total_spent_money;?>
                  <div><?php 
                        if($remaining_budget>0):?>
                          <p style="color: green;">&#x20B9; <?php echo $remaining_budget;?></p>
                          <?php else: ?>
                            <p style="color: red;">OverSpent By &#x20B9; <?php echo $remaining_budget;?></p>
                         <?php endif; ?></div>
                  
                </div><hr>
                <div class="flex_div">
                  <div>Date</div>
                  <?php $start_date=strtotime($row['boarding']); $end_date=strtotime($row['destination']);?>
                  <div><?php echo date('d M',$start_date);?>&nbsp;-&nbsp;<?php echo date('d M Y',$end_date);?></div>
                </div>
              </div>
            </div>
             <?php endwhile; ?>

             <?php $query1=mysqli_query($con,"SELECT * FROM expensive_user WHERE user_id='$id'");?>
         <?php while($row1=mysqli_fetch_assoc($query1)):?>
            <div class="col-md-5">
            <div class="panel-info">
              <div class="panel-heading">
                <div class="flex_div">
                  <div><?php echo $row1['title'];?></div>
                </div>
              </div>
              <div class="panel-body">
                <div class="flex_div">
                  <div>Amount</div>
                  <?php $_SESSION['total_spent_money']=$_SESSION['total_spent_money']+$row1['amount_spent'];?>
                  <div>&#x20B9; <?php echo $row1['amount_spent'];?></div>
                </div><hr>
                <div class="flex_div">
                  <div>Paid By</div>
                  <div><?php echo $row1['order_by'];?></div>
                </div><hr>
                <div class="flex_div">
                  <div>Paid On</div>
                  <?php $start_date=strtotime($row1['date']);?>
                  <div><?php echo date('d M Y',$start_date);?></div>
                </div><hr>
                <?php if($row1['user_bill']==''):?>
                  <p style="text-align: center;color:red;">You Don't Have Bill</p>
                  <?php else :?>
                    <a href="#bill" style="text-align: center;color:green;">Show Bill</a>
                <?php endif;?>
              </div>
            </div>
          </div>
        <?php endwhile;?>
        </div>


        <div class="col-md-1 col-sm-6 main_right">
        </div>
        <div class="col-md-4 col-sm-6 main_right">
          <button class="btn btn_primary expansive" id="expansive">Expensive Distribution</button>
          <div class="panel panel-info" style="margin: 20px;">
            <div class="panel-heading">
                <h3 style="text-align: center;">Add New Expense</h3>
            </div>
            <div class="panel-body">
              <form method="post" action="">
                <div class="form-group">
                  <label for="initial_budget">Title</label>
                  <input type="text" name="expansive_name" class="form-control"  placeholder="Expense Name" required="true">
                </div>
                <div class="form-group">
                  <div class="person_name">
                    <label for="">Date </label>
                    <input type="date" name="paying_date" class="form-control" placeholder="Add Date" required="true">
                  </div>
                </div>
                <div class="form-group">
                  <div class="person_name">
                    <label for="">Amount Spent </label>
                    <input type="number" name="amount" class="form-control" placeholder="Amount Spent" required="true"><br>
                    <select class="form-control" name="user_name">
                        <option>Choose</option>
                        <?php $array=explode(" ",$name);?>
                        <?php foreach($array as $key){?>
                          <?php if($key!=''):?>
                          <option value="<?php echo $key;?>"><?php echo $key;?></option>
                        <?php endif;?>
                        <?php }?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <div class="person_name">
                    <label for="">Upload Bill</label>
                    <input type="file" name="bill_file" class="form-control" placeholder="Upload your bill">
                  </div>
                </div>
                <div class="form-group">
                  <input type="submit" name="add" class="btn btn-primary btn-block" value="Add">
                </div>
              </form>
            </div>
          </div>
        </div>
      <div class="col-md-6 col-sm-6 col-md-offset-3 expansive_show" style="display: none;">
          <div class="panel-info">
              <div class="panel-heading">
                <div class="flex_div">
                  <div><h4><?php echo $title;?></h4></div>
                  <div><span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;<?php echo $total_people;?></div>
                </div>
              </div>
              <div class="panel-body">
                <div class="flex_div">
                  <div>Budget</div>
                    <div>&#x20B9; <?php echo $budget;?></div>
                    </div><hr>
                    <?php $query1=mysqli_query($con,"SELECT amount_spent,order_by FROM expensive_user WHERE user_id='$id'");?>

                   <?php while($expensive_people=mysqli_fetch_assoc($query1)):?>
                      
                            <?php $total=$total+$expensive_people['amount_spent'];?>
                            <div class="flex_div">
                              <div><?php echo $expensive_people['order_by'];?></div>
                              <div>&#x20B9; <?php echo $expensive_people['amount_spent']; ?></div>
                            </div><hr>
                   <?php endwhile; ?>
                <div class="flex_div">
                  <div>Total Spent Amount</div>
                  <div>&#x20B9; <?php echo $total_spent_money;?></div>
                </div><hr>
                <div class="flex_div">
                  <div>Remaining Amount</div>
                  <div><?php 
                        if($remaining_budget>0):?>
                          <p style="color: green;">&#x20B9; <?php echo $remaining_budget;?></p>
                          <?php else: ?>
                            <p style="color: red;">OverSpent By &#x20B9; <?php echo $remaining_budget;?></p>
                         <?php endif; ?></div>
                </div><hr>
                <div class="flex_div">
                  <div>Individual Share</div>
                  <?php if((int)$total_spent_money>0):?>
                  <?php  $indivisual_share=number_format((int)$total_spent_money/(int)$total_expension_prod,0);?>
                  <div>&#x20B9; <?php echo $indivisual_share;?></div>
                  <?php else: ?>
                    <div>&#x20B9; 0</div>
                  <?php endif;?>
                </div><hr>
                 <?php $query1=mysqli_query($con,"SELECT amount_spent,order_by FROM expensive_user WHERE user_id='$id'");?>

                   <?php while($expensive_people=mysqli_fetch_assoc($query1)):?>
                            <div class="flex_div">
                              <div><?php echo $expensive_people['order_by'];?></div>
                              <div><?php if($indivisual_share-(int)$expensive_people['amount_spent']>0):?>
                                 <p style="color: green;">Get Back &#x20B9; <?php echo $indivisual_share-(int)$expensive_people['amount_spent'];?></p>
                            <?php else: ?>
                            <p style="color: red;">Owes &#x20B9; <?php echo $indivisual_share-(int)$expensive_people['amount_spent'];?></p>
                              <?php endif; ?></div>
                            </div><hr>
                   <?php endwhile; ?>
                <div style="text-align: center;">
                  <button class="btn btn-primary" id="expansive_back"><span class=" glyphicon glyphicon-arrow-left"></span> Back</button>
                </div>
              </div>
            </div>
      </div>
      </div>
    </div>
         <footer>
            <p>Copyright © Control Budget. All Rights Reserved|Contact Us: +91-8448444853</p>
        </footer>
    </body>
</html>
<script>
  $(document).ready(function(){
    $("#expansive").click(function(){
      $(".main_left").hide();
      $(".main_right").hide();
      $(".expansive_show").show();
    });
    $("#expansive_back").click(function(){
        $(".main_left").show();
      $(".main_right").show();
      $(".expansive_show").hide();
    });
  });
</script>
<?php endif;?>