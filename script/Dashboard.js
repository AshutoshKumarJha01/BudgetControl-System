
  $.fetch_record=function(date){
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
    $.ajax({
              url: 'http://localhost/college/fetch_folder/fetch_money_date.php',
              type: 'POST',
              data:myid,
              success: function(data){
                $("#Income").text(data.Income[0]['SUM(amount)']);
                if(data.Spending[0]['SUM(amount)']!=null){
                    $("#Spending").text(data.Spending[0]['SUM(amount)']);
                      var bal=parseInt(data.Income[0]['SUM(amount)'])-parseInt(data.Spending[0]['SUM(amount)']);
                      $("#Balance").text(bal);
                      if(bal<0){
                          $("#user_balance").removeClass("bg-success").addClass("bg-danger");
                       }
                      else{
                          $("#user_balance").removeClass("bg-danger").addClass("bg-success");
                      }
                }
                  else{
                  $("#Spending").text('00');
                  $("#Balance").text('00');
                }
              }
      });
  };
  $.fetch_record_prev=function(date){
    const monthNames = ["January", "February", "March", "April", "May", "June","July", "August", "September", "October", "November", "December"];
    const d = new Date(date);
    const m_name=monthNames[d.getMonth()];
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
     $.ajax({
              url: 'http://localhost/college/fetch_folder/fetch_dash_date.php',
              type: 'POST',
              data:myid,
              success: function(data)
              {
                  if(data.Message=='Message'){
                    $("#income_tab tbody").text("No record Found");
                  }
                  else{
                    var datas=[];
                    for(var i=0;i<data.Income.length;i++){
                      var obj={};
                      obj["y"]=parseInt(data.Income[i]['amount']);
                      obj["label"]=data.Income[i]['category'];
                      datas.push(obj);
                     
                    }
                   
                     // console.log(datas);

                      var x_Values=[];
                      $x='';
                      for(var i=0;i<data.Spending.length;i++)
                      {
                          var obj={};
                          obj["y"]=parseInt(data.Spending[i]['amount']);
                          obj["label"]=data.Spending[i]['category'];
                          x_Values.push(obj);

                          
                      }
                      var chart = new CanvasJS.Chart("Incomes", {
                          animationEnabled: true,
                          title: {
                            text: "Incomes "+m_name,
                              fontFamily: "tahoma"
                          },
                          data: [{
                            type: "pie",
                            startAngle: 240,
                            yValueFormatString: "##0.00\"\"",
                            indexLabel: "{label} {y}",
                            showInLegend: true,
                            legendText: "{label}",
                            dataPoints:datas
                          }]
                        });
                        chart.render();

                      var charts = new CanvasJS.Chart("fun", {
                          animationEnabled: true,
                          title: {
                            text: "Spending "+m_name,
                            fontFamily: "tahoma"
                          },
                          data: [{
                            type: "pie",
                            startAngle: 240,
                            yValueFormatString: "##0.00\"\"",
                            indexLabel: "{label} {y}",
                            showInLegend: true,
                            legendText: "{label}",
                            dataPoints:x_Values
                          }]
                        });
                        charts.render();
                                      
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
    var total_date=date.getFullYear()+"-"+month;
   $.fetch_record_prev(total_date);
   $.fetch_record(total_date);
    
    $("input[type='month']").change(function(){
      var date=$(this).val();
      $.fetch_record_prev(date);
      $.fetch_record(date);
    });
  });