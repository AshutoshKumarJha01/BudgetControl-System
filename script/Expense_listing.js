
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
                amount=data.Spending[0]['SUM(amount)'];
                $("#Income_bal").html(amount);
                 $("#Total_income_date").html("Total Spend ("+date+")");
              }
      });
  };
     
   $.check_budget_initi=function(date){
    $("#text_per").css({"background-color":"transparent","top": "40%","left": "45%"});
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
    $.ajax({
              url: 'http://localhost/college/check_budget.php',
              type: 'POST',
              data:myid,
              success: function(data){
                if(data.Budget.length>0){
                    var yValues = [];
                    
                    $("#Budget").text(parseInt(data.Budget[0]['amount']));
                  var net_per=parseInt(amount*100/parseInt(data.Budget[0]['amount']));
                  
                  $("#balance").html(parseInt(parseInt(data.Budget[0]['amount'])-amount));
                    if(parseInt(parseInt(data.Budget[0]['amount'])-amount)<0){
                        var barColors = [
                        "red",
                        "silver"
                      ];
                      $("#text_per").css({"color":"red"});
                       $("#text_per").html(""+parseInt(100-net_per)+"%");
                       $("#balance").css({"color":"red"});
                       yValues.push(parseInt(net_per-100));
                       yValues.push(parseInt(100-parseInt(net_per-100)));
                  }else{
                      var barColors = [
                        "green",
                        "silver"
                      ];
                       $("#text_per").html(net_per+"%");
                       yValues.push(net_per);
                       yValues.push(parseInt(net_per-100));
                       $("#balance").css({"color":"green"});
                  }
                  $("#budget").html(parseInt(data.Budget[0]['amount']));
    
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
                     
                    $("#text_per").css({"top": "0px","background-color":"#fff","width":"100%","height":"100%","left":"0px"});
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