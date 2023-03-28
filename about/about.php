<?php 
  session_start();
?>
<html>
<head>
  <title>Finance - About </title>
  <?php include("../header/header_links.php"); ?>
  <link rel="stylesheet" href="../CSS/style.css">
      <style type="text/css">
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
          .aboutus_head_text{
            color:#094079;
            padding: 10px;
            border-radius: 10px;
          }
      </style>
</head>
</head>
<body>

     <?php require_once("../header/page_topnav.php"); ?>
     <br>
<div class="container" id="aboutus">
    <h3 class="text-center aboutus_head_text">About  Us</h3><hr>
    <div class="row">
      <div class="col-md-8 col-sm-6">
        <h3>Why Importance ?</h3>
        <p>
        It's very important to become financially literate in order to make the most of your income and savings. Financial literacy helps you distinguish between good and bad financial advice and make savvy decisions.

        Few schools offer courses on managing your money, so it is important to learn the basics through free online articles, courses, blogs, podcasts, or at the library.

        The new concept, smart personal finance involves developing strategies that include budgeting, creating an emergency fund, paying off debt, using credit cards wisely, saving for retirement, and more
        </p>
        <h3>Finance</h3>
        <p>
        Personal finance, as a term, covers the concepts of managing your money, saving, and investing. It also includes banking, budgeting, mortgages, investments, insurance, retirement planning, and tax planning. One can consider that personal finance comprises the entire industry that provides financial services to individuals and advises them about financial and investment opportunities.

        Personal finance, as a term, covers the concepts of managing your money, saving, and investing. It also includes banking, budgeting, mortgages, investments, insurance, retirement planning, and tax planning. One can consider that personal finance comprises the entire industry that provides financial services to individuals and advises them about financial and investment opportunities.
        </p>
        <img src="../image/finance_img.jpg" alt="" class="img-fluid">
      </div>
      <div class="col-md-4 col-sm-6 text-center">
        <img src="../image/finance_tips_trick.png" alt="" class="img-fluid">
        
        <p>
        Savings and Investments: Banking offers you a variety of ways to save and invest to grow wealth. There are valuable options that cater to all your needs beyond just the savings and current accounts. Savings can help keep you afloat at the times of financial crisis or sudden unemployment. On the other hand, investments in mutual funds can help you grow wealth exponentially over time.
        </p>
      </div>
    </div>
  </div><br>
<?php if(isset($_SESSION['name'])):?>
  <?php require_once("../header/page_footer.php");?>
<?php endif;?>
</body>
</html>