var my_date_format = function(input){
        var d = new Date(Date.parse(input.replace(/-/g, "/")));
        //var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var date = d.getDate();
        //var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
        return (date);  
};


/*
---------------------------------------
FETCH TOTAL EXPENSE PARTICULAR MONTH 
--------------------------------------
*/
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
                amount=data.Budget[0]['amount'];
                $("#Budget").html(amount);
                $("#Expense_bal").html(data.Spending[0]['SUM(amount)']);
                 $("#Total_income_date").html("Total Expenses ("+date+")");
              }
      });
  };

/*
---------------------------------------
GRAPH DATA SHOW IN 
--------------------------------------
*/
  $.fetch_visual_record=function(date){
    var spend=[100];
    var  xValues=[1];
    
    var id=$("#use_id").val();
    var obj={login:id,date:date};
    var myid=JSON.stringify(obj);
    $.ajax({
              url: 'http://localhost/college/fetch_folder/fetch_dash_date.php',
              type: 'POST',
              data:myid,
              success: function(data){
                var x=0;
                var len=0;
                for(var i=0;i<data.Spending.length;i++){
                  if(xValues.includes(Number(my_date_format(data.Spending[i]['dat'])))){
                      
                      spend[len+1]=spend[len+1]+parseInt(Number(data.Spending[i]['amount']));
                      
                  }else{
                      spend.push(Number(data.Spending[i]['amount']));
                      spend=spend.sort(function compare(a,b)  
                          {  
                            return a-b;  
                          });
                      xValues.push(Number(my_date_format(data.Spending[i]['dat'])));
                      xValues=xValues.sort(function compare(a,b)  
                          {  
                            return a-b;  
                          }); 
                  }
                  
                  
                }

                 new Chart("myChart", {
                        type: "bar",
                        data: {
                          labels: xValues,
                          datasets: [{
                            data: spend,
                            label:'Spending',
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
                                      labelString: 'Dates of Expenses',
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
                                      labelString: 'Expenses Money '
                                    },
                                    ticks: {
                                      display:true,
                                            fontSize: 15,
                                             callback: function(value, index, values) {
                                                return "" + value;
                                            }
                                        }
                              }]
                          }
                        }
                     
                  });
                
              }
      });
  };


/*
---------------------------------------
STARTING WITH CURRENT month 
--------------------------------------
*/

$(document).ready(function(){
		var date = new Date();
        var month='';
        if(date.getMonth()+1<=9 && date.getMonth()+1>0){
          month="0"+parseInt(date.getMonth()+1);
        }else{
          month=parseInt(date.getMonth()+1);
        }
        var new_date=date.getFullYear()+"-"+month;
		$("input[type='month']").val(new_date);
    $.fetch_record(new_date);
    $.fetch_visual_record(new_date);
	});
 $("input[type='month']").change(function(){
      var date=$(this).val();
      $.fetch_visual_record(date);
      $.fetch_record(date);
});

 
 /*const settings = {
    "async": true,
    "crossDomain": true,
    "url": "https://mboum.com/api/v1/ne/news/?apikey=u3CrZnCI6T3cGg6a6gw9adu4nWQfiKTtyz0FXzL7EvkBzcqmH3ZPTwClLLjt",
    "method": "GET",
    "headers": {
        "X-Mboum-Secret": "u3CrZnCI6T3cGg6a6gw9adu4nWQfiKTtyz0FXzL7EvkBzcqmH3ZPTwClLLjt"
    }
};

$.ajax(settings).done(function (response) {
    console.log(response);
});*/