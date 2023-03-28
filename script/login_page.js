 $(document).ready(function()
    {
        $("#reg").attr("disabled", true);
        $("#signout").click(function()
        {
            $("#in").hide();
            $("#out").show();
        });
        $("#signin").click(function()
        {
            $("#in").show();
            $("#out").hide();
        });
         $("#email").keyup(function(event){
            if($(this).val().length>0){
                if (validemail($(this).val()))
                {
                    $("#mailmsg").html("<h6 class='text-success'>Valid Email</h6>");
                    $("#email").css("border-color","green");
                    $("#reg").attr("disabled", false);
                }
                else
                {
                    $("#mailmsg").html("<h6 class='text-danger'>Invalid Email</h6>");
                    $("#email").css("border-color","red");
                    $("#reg").attr("disabled", true);
                }
            }else{
                $("#mailmsg").html("<h6 style='display:none;'></h6>");
                 $("#email").css("border-color","#ced4da");
                 $("#reg").attr("disabled", true);
            }
        });

        $("#password").keyup(function(event)
        {
            if($(this).val().length>0){
                    if (validpass($(this).val())) {
                        $("#passmsg").html("<h6 class='text-success'>Valid Password</h6>");
                        $("#password").css("border-color","green");
                        $("#reg").attr("disabled", false);
                    }
                    else
                    {
                        $("#passmsg").html("<h6 class='text-danger'>Invalid Password</h6>");
                        $("#password").css("border-color","red");
                        $("#reg").attr("disabled", true);
                    }
            }else{
                 $("#passmsg").html("<h6 style='display:none;'></h6>");
                 $("#password").css("border-color","#ced4da");
                 $("#reg").attr("disabled", true);
            }
        });

        $("#reg").click(function(e)
            {
                e.preventDefault();
                var email = $("#email").val();
                var name = $("#name").val();
                var psw = $("#password").val();
                var select = $("#sellist").val();

                if (email=="" || name=="" || psw=="" || select=="") {
                    swal({
                         title:"All Input Field Required!",
                        icon: "warning",
                    });

                }
                else
                {
                        $.ajax({
                            url: "reg.php",
                            type: "POST",
                            data: {name:name,email:email,psw:psw,sellist:select},
                            success: function(data){
                                
                                if(data=="exist")
                                {
                                        swal({
                                              title:"Email Already Exist!",
                                              icon: "warning",
                                        });
                                }
                                else if(data=="success")
                                {
                                    swal({
                                              title: "Registration Successfully!",
                                              icon: "success"}).then (function()
                                              {
                                                location.reload();
                                            });

                                }
                                else
                                {
                                    swal({
                                              title: "Failed To Insert!",
                                              icon: "warning",
                                            });
                                }
                            }
                        });

                }
                return false;
            });
    
       $("#sign").click(function(e)
            {
                e.preventDefault();
                var email = $("#email2").val();
                var psw = $("#password2").val();

                if (email=="" || psw=="") {
                     swal({
                         title:"All Input Field Required!",
                        icon: "warning",
                    });
                }
                else
                {
                $.ajax({
                    url: "login.php",
                    type: "POST",
                    data: {email:email,psw:psw},
                    success: function(data){
                        if(data=="login")
                        {
                                    swal({
                                          title: "Finance",
                                          text: "Are You sure to login With Finance World",
                                          icon: "warning",
                                          buttons: true,
                                          dangerMode: true,
                                        })
                                        .then((willDelete) => {
                                          if (willDelete) {
                                            swal("Welcome to Login With Finance World", {
                                              icon: "success",
                                            }).then(()=>{
                                                location.href='home1.php';
                                            });
                                          } else {
                                            swal("Finance World waiting for you", {
                                              icon: "warning",
                                            }).then(()=>{
                                                location.href='logout.php';
                                            });
                                          }
                                        });
                        }
                        else
                        {
                            swal({
                                  title: "Failed To Login!",
                                  icon: "warning",
                                });
                        }
                    }
                });
            }
                return false;
            });
   });
     function validemail(emails)
        {
             var reg = /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
             if (reg.test(emails)) 
             {
                return true;
             }
             else
             {
                return false;  
             }
        }
        
        function validpass(pass)
        {
            var password_regex1=/([a-z].*[A-Z])|([A-Z].*[a-z])([0-9])+([!,%,&,@,#,$,^,*,?,_,~])/;
            var password_regex2=/([0-9])/;
            var password_regex3=/([!,%,&,@,#,$,^,*,?,_,~])/;

            if(pass.length<8 || password_regex1.test(pass) == false || password_regex2.test(pass)==false || password_regex3.test(pass)==false) 
            {
                return false;
            }
            else
            {
                return true;
            }
        }