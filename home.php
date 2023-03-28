<?php 
include('database/connect.php');?>
<!-- <?php //if (!isset($_SESSION['email'])):?>
    <p style="color:red;">You can't access this page directly!</p> -->
<!-- <?php //else:?> -->
   <?php  $user_email=$_SESSION['email'];
   $query=mysqli_query($con,"SELECT currency FROM user_info WHERE email='$user_email'");
   $currency=mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html>
<head>
			<meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
      <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  	<style type="text/css">
  	body{
  		background: rgb(224,224,224);
  	}
  	.navbar-dark{
    	background-color: #24355C;
	}
	.navbar-dark .navbar-nav .nav-link{
	    font-weight: 700;
	    font-family: monospace;
	    color: #fff !important;
	}
	.navbar-dark .navbar-nav .nav-item{
	    margin: 0 15px;
	}
	#new_plan{
		background: transparent;
		border: none;
		outline: none;
		height: 20vh;
	}
	.col-md-4{
		background: #fff;
		height: 32vh;
		border-radius: 5px;
		font-size: 15px;
	}
	.col-md-5{
		border-radius: 5px;
        padding: 10px 10px;
        justify-content: center;
  		align-items: center;
  		background: #fff;	
  		font-size: 15px;
 }
    input[type="submit"]
    {
        background: #2196f3;
        color: #fff;
        border: none;
        width: 120px;
        cursor: pointer;
        padding: 4px 4px;
        border-radius: 20px;
        margin-left: 35%;
    }
    .form-control{
    	font-size: 15px;
    }
 </style>
 <script type="text/javascript">
 	$(document).ready(function(){
 		$("#records").click(function(e){
 			e.preventDefault();
 			var cat=$("#category").val();
 			var rad=$("input[name='rcd']:checked").val();
 			var details=$("#details").val();
 			var amount=$("#amt").val();
 			var date=$("#date").val();

 			if (cat=="" || rad=="" || details=="" || amount=="" || date=="") {
 				alert("Please Fill All The Details");
 			}
 			if(rad=="Spending"){
 				$.ajax({
                            url: "spend.php",
                            type: "POST",
                            data: {cat:cat,details:details,amount:amount,date:date},
                            success: function(data){
                            	if (data=="success") {
                            		location.reload();
                            	}
                            	else{
                            		alert(data);
                            	}
                            }
                         });
 			}
 				else{
 					$.ajax({
                            url: "income.php",
                            type: "POST",
                            data: {cat:cat,details:details,amount:amount,date:date},
                            success: function(data){
                            	if (data=="success") {
                            		location.reload();
                            	}
                            	else{
                            		alert(data);
                            	}
                            }
                         });
 				}
 				return false;
 		});
 	});
 </script>
</head>
<body>
	<nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
         	<a class="navbar-brand" href="home.php"><b>Ctrl Budget</b></a>
          		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span>
          		</button>
          		<div class="collapse navbar-collapse" id="navbarNav" >
            		<ul class="navbar-nav">
            			<li class="nav-item active">
                			<a class="nav-link" href="home.php">Home<span class="sr-only">(current)</span></a>
              			</li>
              			<li class="nav-item">
                			<a class="nav-link" href="about.php">Dashboard</a>
              			</li>
              			<li class="nav-item">
                			<a class="nav-link" href="setting.php">Spending Listing</a>
              			</li>
              			<li class="nav-item">
                			<a class="nav-link" href="setting.php">Incoming Listing</a>
              			</li>
              		</ul>
              		<ul class="navbar-nav ml-auto">
              			<li class="nav-item dropdown">
                			<a class="nav-link dropdown-toggle" type="button" id="navbarDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>&nbsp;<?php echo($_SESSION['name']);?></a>
                			<div class="dropdown-menu"aria-labelledby="LinkDropdownDemo">
				          		<a class="dropdown-item" href="#">Profile</a><hr>
				          		<a class="dropdown-item" href="setting.php">Change Password</a><hr>
				          		<a class="dropdown-item" href="logout.php?logout">Log Out</a>
				        	</div>
              			</li>
              		</ul>
            	</div>
      		</div>
    </nav>
    	<div class="container main">
    				<div class="row">
    					<div class="col-md-4 offset-md-1 mt-3">

    						<table class="table">
    							<h3 class="text-center"><i>August 2021</i></h3>
    							<tbody>
    								<tr>
    									<td><i class="fa fa-plus"></i>&nbsp; Income:</td>
    									<td><?php echo($currency['currency']);if(isset($_SESSION['income'])){echo($_SESSION['income']);}?>.00</td>
    								</tr>
    								<tr>
    									<td><i class="fa fa-minus"></i>&nbsp; Spending:</td>
    									<td><?php echo($currency['currency']);if(isset($_SESSION['spend'])){echo($_SESSION['spend']);}?>.00</td>
    								</tr>
    								<tr>
    									<td><i class="fa fa-money"></i>&nbsp; Balance:</td>
    									<td><?php echo($currency['currency']);if(isset($_SESSION['balance'])){echo($_SESSION['balance']);}?>.00</td>
    								</tr>
    							</tbody>
    						</table>

    					</div>
    		<!-- this is the form where user create thier record(spending & income)-->

    		<div class="col-md-5 offset-md-1 mt-3">
    			<form>
    				<h3 class="text-center"><i>Create Record</i></h3><br>
    				<div class="form-group row">
					    <label class="col-sm-4 col-form-label">Record Type</label>
					    <div class="col-sm-8">
					      <input type="radio" name="rcd" value="Spending"><label>&nbsp;Spending</label>&nbsp;
					      <input type="radio" name="rcd" value="Income"><label>&nbsp;Income</label>
					    </div></div>
					    <div class="form-group row">
					    	<label class="col-sm-4 col-form-label">Income Category</label>
					    	<div class="col-sm-8">
					      	<select id="category" class="form-control">
                            <option value="" disabled selected>Please Select</option>
                            <option value="Government Aid">Government Aid</option>
                            <option value="Investment">Investment</option>
                            <option value="Salary">Salary</option>
                            <option value="Scholarship">Scholarship</option>
                            <option value="Other">Other</option>
                          </select>
						</div>
					    </div>
    				<div class="form-group row">
					    <label class="col-sm-4 col-form-label">Details</label>
					    <div class="col-sm-8">
					      <input type="text" class="form-control" id="details">
						</div>
					</div>
					  <div class="form-group row">
					    <label class="col-sm-4 col-form-label">Amount</label>
					    <div class="col-sm-8">
					      <input type="number" class="form-control" id="amt">
					    </div></div>
					    <div class="form-group row">
					    <label class="col-sm-4 col-form-label">Date</label>
					    <div class="col-sm-8">
					      <input type="date" class="form-control" id="date">
					    </div></div>
					    <input type="submit" id="records" value="submit">
           		</form>
    		</div>
    	</div>
    </div>
  </body>
	</html><?php// endif;?>