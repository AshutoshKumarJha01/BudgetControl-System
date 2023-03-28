<?php 
	session_start();
 //session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
	
      <?php require_once("header/header_links.php");?>   
      <style type="text/css">
        <?php include('CSS/style.css');?>
      </style>
    </head>
  <body>
  <?php if(isset($_SESSION['name'])):?>
    <?php require_once("header/page_topnav.php");?>
  <br>
  <div class="container main">
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Select Month</span>
      </div>
      <input type="month" cclass="form-control">
    </div>
    
        <div class="row" style="color: #fff;">
          <input type="hidden" name="use_id" id="use_id" value="<?php echo $_SESSION['id'];?>">
            <div class="col-md-3 rounded float-left bg-primary">
              <div class="col-3_row text-center">
                <h2><i class="fa fa-plus"></i></h2>
                 <h6> Income</h6>
                 <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign">&nbsp;</i><span id="Income"></span></h5>
              </div>
            </div>
            <div class="col-md-3 rounded mx-auto bg-success" id="user_balance">
               <div class="col-3_row text-center" style="color: #fff;">
                    <h2><i class="fas fa-money-check"></i></h2>
                    <h6>Balance</h6>
                    <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Balance"></span></h5>
              </div>
            </div>
            <div class="col-md-3 rounded float-right bg-warning">
               <div class="col-3_row text-center">
                <h2><i class="fa fa-minus"></i></h2>
                 <h6>Spending</h6>
                 <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Spending"></span></h5>
              </div>
            </div>
          </div>
  </div><br>
  <div class="container" style="height: 100vh;">
    <div class="row">
        <div class="col-md-6 col-sm-6 text-center">
          <div id="Incomes"></div>
          
        </div>
        <div class="col-md-6 col-sm-6 text-center">
          <div id="fun"></div>
        </div>
    </div>
  </div>
  <br>
  <?php require_once("header/page_footer.php");?>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script type="text/javascript" src="script/home1.js"></script>
<script type="text/javascript" src="script/Dashboard.js"></script>
<?php else :?>
 <div style="justify-content: center;display: flex;align-items: center;height: 100vh;">
    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
      <div class="card-header">You Cant Access This Page</div>
        <div class="card-body">
          <h5 class="card-title">Dashboard Page</h5>
          <p class="card-text">This is do for Security Reason so Welcome Again</p>
        </div>
      </div>
</div>
<?php endif; ?>
</body>
</html>