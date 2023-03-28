<?php 
	session_start();
 //session_regenerate_id(true);
?>
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
            <h4 id="bud_msg"></h4>
          <canvas id="myChart" class="income_listing_myChart" style="width:100%;"></canvas>
          <span id="text_per"></span>
          <div class="d-flex justify-content-between" style="padding: 10px;">
            <div>
              <div><b>Budget (<i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>)</b></div>
              <div><b>Income Balance (<i class="fas fa-<?php echo $_SESSION['currency']; ?>-sign"></i>)</b></div>
            </div>
            <div>
              <div id="budget"></div>
              <div id="balance"></div>
            </div>
          </div>
      </div>
    </div>
  </div>

<script type="text/javascript">
  var amount='';
  $.fetch_record=function(date){
    
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
    $.ajax({
              url: 'http://localhost/college/fetch_folder/fetch_money_date.php',
              type: 'POST',
              data:myid,
              success: function(data){
                amount=data.Income[0]['SUM(amount)'];
                 $("#Income_bal").html(amount);
                 $("#Total_income_date").html("Total Income ("+date+")");             
              }
      });
  };
     

   $.check_budget_initi=function(date){
    $("#text_per").css({"background-color":"transparent","top":"-20%","left": "45%"});
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
    $.ajax({
              url: 'http://localhost/college/check_budget.php',
              type: 'POST',
              data:myid,
              success: function(data){
                console.log(data.Budget.length);
                if(data.Budget.length>0){
                    var yValues = [];
                  if(amount<parseInt(data.Budget[0]['amount'])){
                      var net_per=parseInt(amount*100/parseInt(data.Budget[0]['amount']));
                  }else{
                      var net_per=parseInt(parseInt(data.Budget[0]['amount'])*100/amount);
                  }
                  $("#budget").html(parseInt(data.Budget[0]['amount']));
                  $("#balance").html(parseInt(parseInt(data.Budget[0]['amount'])-amount));

                  if(parseInt(parseInt(data.Budget[0]['amount'])-amount)<0){
                          var barColors = [
                          "green",
                          "silver"
                        ];
                        $("#text_per").css({"color":"green"});
                         $("#text_per").html(""+parseInt(100-parseInt(net_per))+"%");
                         $("#balance").css({"color":"green"});
                         $("#bud_msg").html("% of Income extra gain With respect to (Budget Amount)");
                         yValues.push(parseInt(net_per-100));
                         //yValues.push(parseInt(100-parseInt(net_per-100)));
                  }
                  else{
                        var barColors = [
                          "green",
                          "silver"
                        ];
                         $("#text_per").html(net_per+"%");
                         yValues.push(net_per);
                         yValues.push(parseInt(net_per-100));
                         $("#bud_msg").html("% of Income gain With respect to (Budget Amount)");
                         $("#balance").css({"color":"green"});
                  }
                  $("#Budget").html(parseInt(data.Budget[0]['amount']));
                  new Chart("myChart", {
                      type: "doughnut",
                      data: {
                        
                        datasets: [{
                          backgroundColor: barColors,
                          data: yValues,
                           borderWidth: 0
                        }]
                      },
                      options: {
                        segmentShowStroke: false
                      }
                    });
                  }else{
                      $("#text_per").css({"top":"0px","background-color":"#fff","width":"100%","height":"100%","left":"0px"});
                    $("#text_per").html("No record Found");
                    $("#Budget").html("00");
                  }
                
              }
      });
  };
   $(document).ready(function(){
    //$.fetch_record();
    var date = new Date();
        var month='';
        if(date.getMonth()<=9 && date.getMonth()>0){
          month="0"+parseInt(date.getMonth()+1);
        }else{
          month=parseInt(date.getMonth()+1);
        }
        var new_date=date.getFullYear()+"-"+month;
        $.fetch_record(new_date);
        $.check_budget_initi(new_date);
  });
    $("input[type='month']").change(function(){
      var date=$(this).val();
      $.check_budget_initi(date);
      $.fetch_record(date);
    });
</script>  
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