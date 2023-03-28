<?php if(isset($_SESSION['name'])):?>
 


<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-info">
        <h5 class="modal-title" id="exampleModalLongTitle">Profile Of <?php echo $_SESSION['name'];?></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php $id=$_SESSION['id']; ?>
        <?php $current_url="http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];?>
        <?php if($current_url=='http://localhost/college/home1.php'):?>
          <?php require('database/connect.php');?>
        <?php else:?>
          <?php require('../database/connect.php');?>
        <?php endif;?>
        <?php  $query="SELECT * FROM user_info WHERE id='$id'";
            $res=mysqli_query($con,$query) or die("Query Not Execute");
          ?>
        <?php while($num=$res->fetch_assoc()):?>
          <form>
            <div class="form-group">
              <label for="exampleFormControlInput1">Your Name</label>
                <input type="text" name="name" class="form-control" value="<?php echo $num['name'];?>">
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Your Email</label>
                <input type="email" name="name" class="form-control" value="<?php echo $num['email'];?>" disabled>
            </div>
            <div class="form-group">
              <label for="exampleFormControlInput1">Your Currency</label>
                <input type="text" name="name" class="form-control" value="<?php echo $num['currency'];?>">
            </div>
          </form>
        <?php endwhile;?>
      </div>
    </div>
  </div>
</div>


  <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="home1.php"><b>Finance World</b></a>
              <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarNav" >
                <ul class="navbar-nav ml-auto">
                  <li class="nav-item active">
                      <a class="nav-link" href="http://localhost/college/home1.php">Home<span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="http://localhost/college/transaction/debit.php">Transection</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="http://localhost/college/Expenses/Expense.php">Spending</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="http://localhost/college/Incomes/income.php">Incoming</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="LinkDropdownDemo" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;<?php echo($_SESSION['name']);?></a>
                        <div class="dropdown-menu" aria-labelledby="LinkDropdownDemo">
                          <a class="dropdown-item" href="#"  data-toggle="modal" data-target="#exampleModalCenter">Profile</a>
                           <a class="dropdown-item" href="http://localhost/college/about/about.php">About us</a>
                          <a class="dropdown-item" href="http://localhost/college/transaction/setting.php">Change Password</a>
                          <a class="dropdown-item" href="http://localhost/college/logout.php">Log Out</a>
                        </div>
                    </li>
                  </ul>
                 
              </div>
          </div>
    </nav>

<?php else:?>
 <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="#"><b>Financial World</b></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav ml-auto">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="http://localhost/college/about/about.php">about us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login_page.php">login</a>
              </li>
            </ul>
          </div>
      </div>
    </nav>
<?php endif;?>