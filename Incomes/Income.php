<?php 
	session_start();
?>
<html>
<head>
	<title>Finance - Expense </title>
	<?php include("../header/header_links.php"); ?>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
      <link rel="stylesheet" href="../CSS/style.css">
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
      </style>
</head>
<body>
<?php if(isset($_SESSION['name'])):?>

     <?php require_once("../header/page_topnav.php"); ?>
     <br>
     <input type="hidden" name="use_id" id="use_id" value="<?php echo $_SESSION['id'];?>">
     <div class="container">
     	<div class="input-group mb-3">
      		<div class="input-group-prepend">
        		<span class="input-group-text">Select Month/Year</span>
      		</div>
      		<input type="month" class="form-control">
    	</div>
     </div>

<div class="container">
     <div class="row d-flex justify-content-around">
        <div class="col-md-4 col-sm-6 rounded bg-info">
          <div class="col-3_row text-center">
                <h6> Budget Amount</h6>
                <h2><i class="fas fa-money-check"></i></h2>
                <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Budget"></span></h5>
          </div>
        </div>
        <div class="col-md-4 col-sm-6 rounded bg-info">
          <div class="col-3_row text-center">
                <h6 id="Total_income_date"></h6>
                <h2><i class="fas fa-money-check"></i></h2>
                <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Income_bal"></span></h5>
          </div>
        </div>
  	</div>
 </div>


<div class="container" style="padding: 20px;">
        <div class="row text-center">
          <h3 style="width: 100%;">Visualize Data</h3>
          <canvas id="myChart" style="width:100%;"></canvas>
        </div>
      </div><br>
 <?php require_once("../header/page_footer.php");?>
 <?php endif;?>
</body>
</html>
<script  src="../script/income.js" type="text/javascript"></script>
