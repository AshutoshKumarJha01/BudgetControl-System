<?php 
	session_start();
 //session_regenerate_id(true);
?>
<!DOCTYPE html>
<html>
<head>
	   <?php require_once("header/header_links.php"); ?>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
      <style type="text/css">
        <?php include('CSS/style.css');?>
      </style>
    </head>
  <body>
  <?php if(isset($_SESSION['name'])):?>
    <?php require_once("header/page_topnav.php"); ?>
  <br>
  <input type="hidden" name="use_id" id="use_id" value="<?php echo $_SESSION['id'];?>">
  <div class="container">
     <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text">Select Month</span>
      </div>
      <input type="month" cclass="form-control">
    </div>
    
    <div class="row">
      <div class="col-md-6 col-sm-6">
        <div class="col-md-6 rounded float-left bg-primary" style="color: #fff;padding: 10px;margin: 5px;">
          <div class="col-3_row text-center">
                <h6> Budget Amount</h6>
                <h2><i class="fas fa-money-check"></i></h2>
                <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Budget"></span></h5>
          </div>
        </div>
        <div class="col-md-6 rounded float-left bg-primary" style="color: #fff;padding: 10px;margin: 5px;">
          <div class="col-3_row text-center">
                <h6 id="Total_income_date"></h6>
                <h2><i class="fas fa-money-check"></i></h2>
                <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Income_bal"></span></h5>
          </div>
        </div>
      </div>
      <div class="col-md-6 col-sm-6 text-center" style="background-color: #fff;z-index: -100;border-radius: 20px;">
            <h4>% of uses Expense Budget</h4>
          <canvas id="myChart" class="income_listing_myChart" style="width:100%;"></canvas>
          <span id="text_per"></span>
          <div class="d-flex justify-content-between" style="padding: 10px;">
            <div>
              <div><b>Budget</b> (<i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>)</div>
              <div><b>Expense Balance</b> (<i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>)</div>
            </div>
            <div>
              <div id="budget"></div>
              <div id="balance"></div>
            </div>
          </div>
      </div>
    </div>
  </div>
<script type="text/javascript" src="script/Expense_listing.js"></script>  
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