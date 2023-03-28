<?php 
require('database/connect.php');?>
<?php if (!isset($_SESSION['email'])):?>
    <p style="color:red;">You can't access this page directly!</p>

<?php else:?>
<?php 
$name='';
if(isset($_POST['submit'])){
    for($i=1;$i<=$_SESSION['no_people'];$i++){
        $name=$name." ".$_POST['people_name'.$i.''];
    }
    if(mysqli_query($con,"INSERT INTO trip_detail(title,user_email,boarding,destination,initial_budget,no_of_people,person_name) values('".$_POST['title']."','".$_SESSION['email']."','".$_POST['from_date']."','".$_POST['to_date']."','".$_SESSION['budget']."','".$_SESSION['no_people']."','".$name."')")){
        header('location:home.php');
    }
    else {
        echo "error";
    }

}
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
        .navbar-dark{
    background-color: #24355C;
}
        .navbar-dark .navbar-nav .nav-link{
    font-weight: 700;
    font-family: monospace;
    text-transform: uppercase;
}
.navbar-dark .navbar-nav .nav-item{
    margin: 0 15px;
}
  	</style>
</head>
<body>
	 <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
          <a class="navbar-brand" href="home.php"><b>Ctrl Budget</b></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav" >
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="about.php"><i class="fas fa-exclamation-circle"></i>&nbsp;about us</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="setting.php"><i class="fa fa-cog"></i>&nbsp;setting</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="logout.php?logout"><i class="fa fa-power-off"></i>&nbsp;logout</a>
              </li>
            </ul>
          </div>
      </div>
    </nav>
    <div class="add_new_plane">
    <div class="container">
    	<div class="row final_plan_form">
    		<div class="col-md-6 col-sm-6 m-auto">
    			<div class="panel panel-info mt-3">
                    <div class="panel-heading">
                        <h3 class="text-center">Trip Detail</h3>
                    </div>
    				<div class="panel-body">
    					<form method="post" action="">
    						<div class="form-group">
    							<label for="initial_budget">Title</label>
    							<input type="text" name="title" class="form-control" placeholder="eg. trip to delhi">
    						</div>
    						<div class="form-row">
							    <div class="form-group col-md-6">
							      <label for="date_from">From</label>
							      <input type="date" class="form-control" name="from_date">
							    </div>
							    <div class="form-group col-md-6">
							      <label for="date_to">To</label>
							      <input type="date" class="form-control" name="to_date">
							    </div>
							  </div>	
							  <div class="form-row">
							    <div class="form-group col-md-8">
							      <label for="date_from">Initial Budget</label>
							      <input type="number" class="form-control" disabled="" value="<?php echo $_SESSION['budget'];?>">
							    </div>
							    <div class="form-group col-md-4">
							      <label for="date_to">No Of People</label>
							      <input type="number" class="form-control" name="no_of_people"  disabled="" value="<?php echo $_SESSION['no_people'];?>">
							    </div>
							  </div>		
    						<div class="form-group">
    							<?php for($i=1;$i<=$_SESSION['no_people'];$i++){?>
    								<label for="">Person <?php echo $i;?></label>
    								<input type="text" name="people_name<?php echo $i;?>" class="form-control" placeholder="People <?php echo $i;?> name">
    							<?php }?>
    						</div>
    						<div class="form-group">
    							<input type="submit" name="submit" class="btn btn-primary btn-block" value="Submit">
    						</div>
    					</form>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
   </div>
</body>
</html>
<?php endif; ?>