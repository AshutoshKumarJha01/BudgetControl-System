<html>
    <head>
    <?php require_once('./header/header_links.php');?>
    <link rel="stylesheet" href="CSS/login_page.css">
    <script type="text/javascript" src="script/login_page.js"></script>
    <style type="text/css">
        .form-control:focus,.form-control:active{
            outline: none !important;
            box-shadow: none;
        }
        .form-control::placeholder{
                color: #fff;
        }
        .form-group{
            margin: 7px;
        }
        .form-group a{
            text-decoration: none;
        }
        .form-control:focus + .form-label,
        .form-control:not(:placeholder-shown) + .form-label
        {   
            transform: translateY(-3.0em) scale(.8);
        }
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
    <?php require_once("./header/page_topnav.php");?>
    <div class="content">
        <div class="container d-flex justify-content-center main">
        <div id="out">
            <form>
                    <div class="form-group">
                        <input type="text" id="name" class="form-control" placeholder="xyz" autocomplete="off"><label class="form-label">Username</label>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" id="email" placeholder="xyz" autocomplete="off">
                        <label class="form-label">Email</label>
                            <span id="mailmsg"></span>
                    </div>
                    <div class="form-group">
                        <input type="password" id="password" class="form-control" placeholder="xyz" autocomplete="off">
                        <label class="form-label">Password</label>
                        <span id="passmsg"></span>
                    </div>
                    <div class="form-group">
                        <select class="form-control" id="sellist">
                            <option value="" disabled selected>Currency</option>
                            <option value="INR">INR</option>
                            <option value="USD">USD</option>
                            <option value="RUB">RUB</option>
                            <option value="Yen">Yen</option>
                            <option value="Other">Other</option>
                          </select>
                    </div><br>
                    <div class="form-group text-center">
                        <input type="submit" name="submit" class="btn btn-primary" value="Sign Up" id="reg">
                    </div><br>
                <div class="form-group">
                    <p><small>Already Registered ? </small><span><a href="#" id="signin">&nbsp;Login Now</a></span></p>
                </div>
            </form>
        </div>
    <div id="in">
        <form>
                <div class="form-group">
                    <input type="email" class="form-control" id="email2" placeholder="xyz" autocomplete="off">
                    <label class="form-label">Email</label>
                </div>
                <div class="form-group">
                    <input type="password" id="password2" class="form-control" placeholder="xyz" autocomplete="off">
                    <label class="form-label">Password</label>
                </div><br>
                <div class="form-group text-center">
                    <input type="submit" name="submit" class="btn btn-primary" value="Log In" id="sign">
                </div>
                <div class="form-group">
                    <p><small>Not member yet?</small><span><a href="#" id="signout">&nbsp;Register</a></span></p>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require_once("./header/page_footer.php"); ?>
</body>
</html>
