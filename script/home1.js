   var my_date_format = function(input){
        var d = new Date(Date.parse(input.replace(/-/g, "/")));
        var month = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
        var date = d.getDate() + " " + month[d.getMonth()] + ", " + d.getFullYear();
        var time = d.toLocaleTimeString().toLowerCase().replace(/([\d]+:[\d]+):[\d]+(\s\w+)/g, "$1$2");
        return (date + " " + time);  
    };
  $.fetch_record=function(){
    var id=$("#use_id").val();
    var obj={login:id};
    var myid=JSON.stringify(obj);
    $.ajax({
              url: 'http://localhost/college/fetch_folder/fetch_money.php',
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
                  
                }else{
                  $("#Spending").text('00');
                  $("#Balance").text('00');
                }
              }
      });
  };

   $.fetch_record_prev=function(){
    var id=$("#use_id").val();
    var obj={login:id};
    var myid=JSON.stringify(obj);
     $.ajax({
              url: 'http://localhost/college/fetch_folder/fetch_data_prev.php',
              type: 'POST',
              data:myid,
              success: function(data)
              {
                  if(data.Message=='Message'){
                    $("#income_tab tbody").text("No record Found");
                  }
                  else{
                    
                    for(var i=0;i<data.Income.length;i++){
                      
                        $x='<div class="fun text-center"><div class="card p-3"><blockquote class="blockquote mb-0 card-body">';
                        $x=$x+'<p>Details - '+data.Income[i]['details']+'</p>';
                        $x=$x+'<p>Category - '+data.Income[i]['category']+'</p>';
                        $x=$x+'<footer class="blockquote-footer">';
                        $x=$x+'<small class="text-muted">';
                        $x=$x+'Amount Income In this Category is <cite title="Source Title"><b>'+data.Income[i]['amount']+'</b></cite>';
                        $x=$x+'</small>';
                        $x=$x+'<p class="card-text"><small class="text-muted">Last updated on '+my_date_format(data.Income[i]['dat'])+'</small></p>';
                        $x=$x+'</footer></blockquote></div></div>';
                        //alert(data.Income);
                        $("#add_rec").append($x);
                    }
                   //console.log(data.Income);
                      for(var j=0;j<data.Spending.length;j++)
                      {
                         //$("#count_numbers").val(data.Spending.length);
                          $y='<div class="funs text-center"><div class="card p-3"><blockquote class="blockquote mb-0 card-body">';
                          $y=$y+'<p>Details - '+data.Spending[j]['details']+'</p>';
                          $y=$y+'<p>Category - '+data.Spending[j]['category']+'</p>';
                          $y=$y+'<footer class="blockquote-footer">';
                          $y=$y+'<small class="text-muted">';
                          $y=$y+'Amount Spendinng In this Category is <cite title="Source Title"><b>'+data.Spending[j]['amount']+'</b></cite>';
                          $y=$y+'</small>';
                          $y=$y+'<p class="card-text"><small class="text-muted">Last updated on '+my_date_format(data.Spending[j]['dat'])+'</small></p>';
                          $y=$y+'</footer></blockquote></div></div>';
                          
                          $("#add_spending").append($y);
                      }
                     //console.log(data.Spending);
                                      
                  }
          }            
    });
  };
  $(document).ready(function(){
    $.fetch_record();
    $.fetch_record_prev();
  });
    $("#records").click(function(e){
      e.preventDefault();

      var cat=$("#category").val();
      var rad=$("input[name='rcd']:checked").val();
      var details=$("#details").val();
      var amount=$("#amt").val();
      var date=$("#date").val();
      
      if (cat=="" || rad=="" || details=="" || amount=="" || date=="") {

          swal({
                  title: "All Filed Are Required!",
                  icon: "warning",
          });
      }
      else if(rad=="Spending"){
        $.ajax({
                            url: "spend.php",
                            type: "POST",
                            data: {cat:cat,details:details,amount:amount,date:date},
                            success: function(data){
                              if (data=="success") {
                                location.reload();
                                $.fetch_record_prev();
                              }
                              else{
                                swal({
                                        title:data,
                                        icon: "warning",
                                    });
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
                              if (ssdata=="success") {
                                location.reload();
                                $.fetch_record_prev();
                              }
                              else{
                                swal({
                                        title:data,
                                        icon: "warning",
                                    });
                              }
                            }
                         });
        }
        return false;
    });
    $('#record input[type="radio"]').on('change', function() {
        if($(this).val()=="Income"){
          $x='<option value="" disabled selected>Please Select Income</option>';
          $x=$x+'<option value="Government Aid">Government Aid</option>';
          $x=$x+'<option value="Investment">Investment</option>';
          $x=$x+'<option value="Salary">Salary</option>';
          $x=$x+'<option value="Scholarship">Scholarship</option>';
          $x=$x+'<option value="Other">Other</option>';
          $("#category").html($x);
        }else{
            $x='<option value="" disabled selected>Please Select Expense</option>';
            $x=$x+'<option value="Food">Food</option>';
            $x=$x+'<option value="Education">Education</option>';
            $x=$x+'<option value="Health Care">Health Care</option>';
            $x=$x+'<option value="Bill and utilities">Bill and utilities</option>';
            $x=$x+'<option value="Entertainment">Entertainment</option>';
            $x=$x+'<option value="other">Other</option>';
          $("#category").html($x);
        }
    });
  


    
  
  
