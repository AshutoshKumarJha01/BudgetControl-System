<?php 
	session_start();
 //session_regenerate_id(true);
  date_default_timezone_set("Asia/Calcutta");
  $Message='';
  if(isset($_POST['create_plan'])){

       if($_POST['init_budget']==''){
          $Message='Please choose Any Initial Budget';
        }
        else if($_POST['init_budget']<100){
          $Message="Initial Budget Must Be greater than 100 !";
        }
       else if($_POST['from_date']==''){
          $Message="please Select Date !";
        }
        else{
          require('database/connect.php');
          $id=$_SESSION['id'];
          $amount=$_POST['init_budget'];
          $from_date=$_POST['from_date'];
          $to_date=date('Y-m-t h:i');
          $query="INSERT INTO user_budget(user_id,amount,from_date,to_date) VALUES('$id','$amount','$from_date','$to_date')";
            $res=mysqli_query($con,$query) or die("Query Not Execute");
            if($res==true){
              header('location:Home1.php');
            }
        }

  }
?>

<html>
<head>
	   <?php require_once("header/header_links.php");?>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
     <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>
      <link rel="stylesheet" type="text/css" href="CSS/style.css">
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


<div class="modal fade bd-example-modal-md" tabindex="-1" id="myModal" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md modal-dialog-centered">
    <div class="modal-content">
      <form class="form" method="post" style="padding: 20px;">
                <?php if($Message!=''):?>
              
                    <div class="alert alert-warning">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                      <strong>Warning!</strong> <?php echo $Message; ?>!
                    </div>
                <?php endif;?>
                    <div class="form-group">
                      <span>Initial Budget</span>
                       <input type="number" class="form-control" name="init_budget" placeholder="Initial Budget (Ex 4000)" value="<?php if(isset($_POST['init_budget'])){ echo $_POST['init_budget'];}?>">
                      
                  </div>
                   <div class="form-group">
                      <span>Select Date</span>
                       <input type="date" class="form-control" name="from_date">
                      
                  </div>
                  <div class="form-group">
                      <span>Valid Upto date</span>
                       <input type="text" class="form-control" name="to_date"  value="<?php echo date('t-m-Y');?>" disabled>
                      
                  </div>
                    <div class="col-auto text-center">
                      <button type="submit" class="btn btn-info" name="create_plan">Create Budget</button>
                    </div>
                </form>
    </div>
  </div>
</div>


    <?php if(isset($_SESSION['name'])):?>
      <?php require_once("header/page_topnav.php");?><br>
  <div class="container">
    <div class="row show_details_home" style="color: #fff;">
          <input type="hidden" name="use_id" id="use_id" value="<?php echo $_SESSION['id'];?>">
            <div class="col-md-3 rounded float-left bg-primary">
              <div class="col-3_row text-center">
                <h6>Total Income</h6>
                <h2><i class="fa fa-plus"></i></h2>
                 <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i> <span id="Income"></span></h5>
              </div>
            </div>
            <div class="col-md-3 rounded mx-auto bg-success" id="user_balance">
               <div class="col-3_row text-center" style="color: #fff;">
                    <h6>Total Balance</h6>
                    <h2><i class="fas fa-money-check"></i></h2>
                    <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Balance"></span></h5>
              </div>
            </div>
            <div class="col-md-3 rounded float-right bg-warning">
               <div class="col-3_row text-center">
                <h6>Total Spending</h6>
                <h2><i class="fa fa-minus"></i></h2>
                 <h5><i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>&nbsp;<span id="Spending"></span></h5>
              </div>
            </div>
          </div>      
  </div><br>
    <div class="container main">
        <div class="row">
<!-- this is the form where user create there record(spending & income)-->
            <div style="width: 100%;" class="text-center">
              <button class="btn btn-info" id="inc_exp_togle">Add New Income/New Expenses</button>
            </div>
              <div class="col-md-6 offset-md-3 add_spe_inc_form mt-3" id="inc_exp_show" style="display: none;">
                <form method="post" id="record">
                  <h3 class="text-center">Create Record</h3><br>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><b>Record Type</b></label>
                        <div class="col-sm-8">
                          <input type="radio" name="rcd" value="Spending"><label>&nbsp;Spending</label>&nbsp;
                          <input type="radio" name="rcd" value="Income"><label>&nbsp;Income</label>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><b>Income Category</b></label>
                        <div class="col-sm-8">
                          <select id="category" class="form-control shadow-none">
                            
                          </select>
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><b>Details</b></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control shadow-none" id="details">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><b>Amount(<i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>)</b></label>
                        <div class="col-sm-8">
                          <input type="number" class="form-control shadow-none" id="amt">
                        </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-sm-4 col-form-label"><b>Date</b></label>
                        <div class="col-sm-8">
                          <input type="date" class="form-control shadow-none" id="date">
                        </div>
                    </div>
                    <input type="submit" id="records" value="submit">
                </form>
              </div>
           </div>
    </div><br>
     <div class="container" style="background: #fff;padding: 20px;">
        <div class="row text-center">
          <h3 style="width: 100%;padding:10px;box-shadow: 0px 0px 30px rgba(127, 137, 161, 0.3);">Visual Spending/Income</h3>
          <input type="hidden" name="use_id" id="use_id" value="<?php echo $_SESSION['id'];?>">
          <b><span id="visual_msg" style="color:red"></span></b>
          <canvas id="myChart" style="width:100%;"></canvas>
        </div>
      </div><br>
  <div class="container-fluid" style="background: #fff;padding: 10px;">
   <nav>
      <div class="nav nav-tabs" id="nav-tab" role="tablist">
        <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true"><b>Spending List</b></a>
        <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false"><b>Income List</b></a> 
      </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
      <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
       <div class="col-md-12 my-container" id="add_spending"><br>
            
              <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <button onclick="plusSlide(-1)" class="btn btn-info">&#8249;</button>
                </div>
                <input type="number" class="text-center" id="numbers" style="width: 10%;">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addons"><span id="count_numbers"></span></span>
                    </div>
                <div class="input-group-append">
                  <button onclick="plusSlide(1)" class="btn btn-info">&#8250;</button>
                </div>
              </div>
              
              
                <div class="funs">
                  <div class="card p-3 text-center">
                    <blockquote class="blockquote mb-0 card-body">
                      <p>With the help of arrow in top of slide to get the particular spending data.</p>
                      <footer class="blockquote-footer">
                        <small class="text-muted">
                          Someone famous in <cite title="Source Title">Source Title</cite>
                        </small>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </footer>
                    </blockquote>
                  </div>
                </div>
          </div>
      </div>
      <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
          <div class="col-md-12 my-container" id="add_rec"><br>
              <div class="input-group mb-3 d-flex">
                <div class="input-group-prepend">
                  <button onclick="plusSlides(-1)" class="btn btn-info">&#8249;</button>
                </div>
                <input type="number" class="text-center" id="number" style="width: 10%;">
                    <div class="input-group-append">
                      <span class="input-group-text" id="basic-addon2"><span id="count_number"></span></span>
                    </div>
                <div class="input-group-append">
                  <button onclick="plusSlides(1)" class="btn btn-info">&#8250;</button>
                </div>
              </div>
              
                <div class="fun">
                  <div class="card p-3 text-center">
                    <blockquote class="blockquote mb-0 card-body">
                      <p>With the help of arrow in top of slide to get the particular Income Previous data.</p>
                      <footer class="blockquote-footer">
                        <small class="text-muted">
                          Someone famous in <cite title="Source Title">Source Title</cite>
                        </small>
                        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
                      </footer>
                    </blockquote>
                  </div>
                </div>
          </div>
      </div>
    </div>
  </div><br> 
<br>
  <?php require_once("header/page_footer.php");?>
  <script type="text/javascript" src="http://localhost/college/script/home1.js"></script>
  <script type="text/javascript">
      /* Here Spending Slides script For Slide a records */

     var slideIndexs = 1;
          var slides=document.getElementsByClassName("funs");
          showSlide(slideIndexs);

          function plusSlide(n) {
              showSlide(slideIndexs += n);

            } 
        function showSlide(n){
          
           if (n >= slides.length) {slideIndexs = slides.length}    
            if (n < 1) {slideIndexs = 1}
          for (i = 0; i < slides.length; i++) {
              slides[i].style.display = "none";  
          }
          slides[slideIndexs-1].style.display = "block";  
           document.getElementById("numbers").value=slideIndexs;
           document.getElementById("count_numbers").innerHTML=slides.length; 
       }
    
    /* Here Income Slides script For Slide a records */

     var slideIndex = 1;
          showSlides(slideIndex);

          function plusSlides(n) {
              showSlides(slideIndex += n);
            } 
          function currentSlide(n) {
            showSlides(slideIndex = n);
          }
        function showSlides(n){
          var slide=document.getElementsByClassName("fun");
           if (n >= slide.length) {slideIndex = slide.length}    
            if (n < 1) {slideIndex = 1}
          for (i = 0; i < slide.length; i++) {
              slide[i].style.display = "none";  
          }
          slide[slideIndex-1].style.display = "block";  
           document.getElementById("number").value=slideIndex;
           document.getElementById("count_number").innerHTML=slide.length; 
       }
   /* Get The slide NUmber From the user and call to currentSlide Function */ 

    $('#number').on('input', function() {
      if($(this).val()!=''){
          currentSlide($(this).val());
      }
      
  });

  /* This Toggle for open a spending and Income insert data form */
    $("#inc_exp_togle").click(function(){
      $("#inc_exp_show").slideToggle("slow");
    });


  /* This function for Get the correct date formate*/
 var my_date_format = function(input){
        var d = new Date(Date.parse(input.replace(/-/g, "/")));
        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var date =  month[d.getMonth()] ;
        return (date + " ");  
    };

/* Function Definition for Fetch data from current month record For Line Graph Draw*/

$.fetch_record_date_home1=function(date){
    const monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
    var allMonths = ['Jan','Feb','Mar', 'Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'];
    const sorter = (a, b) => {
                          return allMonths.indexOf(a) - allMonths.indexOf(b);
                      };
                      
    const d = new Date(date);
    const m_name=monthNames[d.getMonth()];
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
     $.ajax({
              url: 'http://localhost/college/fetch_folder/fetch_home1_date.php',
              type: 'POST',
              data:myid,
              success: function(data)
              {
                console.log(data.Income.length);
                  if(data.Income.length=='0' && data.Spending.length=='0'){
                    $("#visual_msg").text("No Record Found");
                    //$("#income_tab tbody").text("No Record Found");
                    
                  }
                  else{
                     var xValues=[];
                      var income=[];
                      var k=0;
                      for(var i=0;i<data.Income.length;i++){
                        //console.log(data.Income[i]['dat']);
                        if(xValues.indexOf(""+my_date_format(data.Income[i]['dat'])+"")==-1){
                          xValues.sort(sorter);
                          xValues.push(my_date_format(data.Income[i]['dat']));
                            income.push(data.Income[i]['amount']);
                            if(i>0){
                              k=k+1;
                            }
                         

                        }else{
                            income[k]=parseInt(income[k])+parseInt(data.Income[i]['amount']);
                            //console.log(data.Income[i]['dat']);
                        }
                       
                      }
                      var spend=[];
                      var k=0;
                      xValues.sort(sorter);
                      
                      for(var i=0;i<data.Spending.length;i++){
                        if(my_date_format(data.Spending[i]['dat'])===xValues[k]){
                          if(i==0){
                                    spend.push(Number(data.Spending[i]['amount']));
                          }else{
                            spend[k]=parseInt(spend[k])+parseInt(data.Spending[i]['amount']);
                          }
                        }else{
                            if(xValues.indexOf(""+my_date_format(data.Spending[i]['dat'])+"")==-1){
                              xValues.sort(sorter);
                               xValues.push(my_date_format(data.Spending[i]['dat']));
                                spend.push(Number(data.Spending[i]['amount']));
                                if(i>0){
                                    k=k+1;
                                }
                            }else{
                              k=k+1;
                              spend.push(Number(data.Spending[i]['amount']));
                          
                            }
                            
                        }
                       
                      }
                      
                  
                      new Chart("myChart", {
                        type: "bar",
                        data: {
                          labels: xValues,
                          datasets: [{
                            data: spend,
                            label:'Spending',
                            backgroundColor: "orange",
                            fill: false
                          },{
                            data: income,
                            label:'Amount',
                            backgroundColor: "lightgreen",
                            fill: false
                          }]
                        },
                        options: {
                          legend: {display: false},
                            scales: {
                              xAxes: [{
                                  gridLines: {
                                      drawOnChartArea: false
                                  },
                                  scaleLabel: {
                                      display: true,
                                      labelString: '(Month)',
                                      scaleFontSize: 10
                                    },
                                    ticks: {
                                            fontSize: 15,
                                            min:1
                                        }
                              }],
                              yAxes: [{
                                  gridLines: {
                                      drawOnChartArea: false
                                  },
                                   scaleLabel: {
                                      display: true,
                                      labelString: '(Amount in <?php echo $_SESSION['currency']; ?>)'
                                    },
                                    ticks: {
                                      display:true,
                                            fontSize: 15,
                                             callback: function(value, index, values) {
                                                return "$" + value;
                                            }
                                        }
                              }]
                          }
                        }
                     
                  });
              }
            }               
        });
  };



 $.check_budget_initi=function(date){
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
    $.ajax({
              url: 'http://localhost/college/Budgets/check_budget.php',
              type: 'POST',
              data:myid,
              success: function(data){
                console.log(data);
                if(data.Message=="SUCCESS"){
                  
                }else{
                  $('#myModal').modal({ show: true ,backdrop: 'static', keyboard: false});
                }
              }
      });
  };

/* Auto call when page refresh or reload with current month and year */
     $(document).ready(function(){
        var date = new Date();
        var month='';
        if(date.getMonth()+1<=9 && date.getMonth()+1>0){
          month="0"+parseInt(date.getMonth()+1);
        }else{
          month=parseInt(date.getMonth()+1);
        }
        var new_date=date.getFullYear()+"-"+month;
        $.check_budget_initi(new_date);

        var total_date=date.getFullYear();
       $.fetch_record_date_home1(total_date);
       $('[data-toggle="popover"]').popover();

       
       $(function(){
            var dtToday = new Date();
            var month = dtToday.getMonth()+1;
            var day = 1;
            var year = dtToday.getFullYear();
            if(month < 10)
                month = '0' + month.toString();
            if(day < 10)
                day = '0' + day.toString();
            
            var minDate= year + '-' + month + '-' + day;
            var maxDate=year + '-' + month + '-' + new Date(year, month, 0).getDate();
            
            $('#date').attr('min', minDate);
            $('#date').attr('max', maxDate);
        });
});
</script>
<?php else :?>
  <div style="justify-content: center;display: flex;align-items: center;height: 100vh;">
    <div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
      <div class="card-header">You Cant Access This Page</div>
        <div class="card-body">
          <h5 class="card-title">Home Page</h5>
          <p class="card-text">Please login first</p>
        </div>
      </div>
</div>
<?php endif; ?>
</body>
</html>