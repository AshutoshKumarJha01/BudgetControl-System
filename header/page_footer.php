  <div class="footer">
    <div class="container-fluid" id="footer">
        <div class="row">
            <div class="col-md-4 col-sm-6">
                
                 <div class="caption">
                     
                     <ul>
                         <h3>Financial Management</h3><br>
                        <li><a href="http://localhost/college/about/about.php">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                         <li><a href="#">Blog</a></li>
                         <li><a href="#">Our Services</a></li>
                         <li><a href="#">Terms & conditions</a></li>
                         <li><a href="#">Privacy</a></li>
                     </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                
                 <div class="caption">
                    <ul>
                        <h3>My Account</h3><br>
                            <li>Indias best Finance Management System</li>  
                     </ul>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                
                 <div class="caption">
                     <ul>
                         <h3>Finance World </h3><br>
                        <li>Contact: +91-123-000000</li>
                         <li>Email: Finance@gmail.com</li>
                         <li>Address: India </li>
                         <li></li>
                         <li></li>
                         <li></li>
                         <?php if(isset($_SESSION['name'])):?>
                            <h3>Your Information </h3>
                            <?php  echo '<p style="border: 1px solid #fff;width: 100%;padding: 10px;">'.$_SESSION['name'];?>
                        <?php endif;?>
                           
                     </ul>
                </div>
            </div>
        </div>
        <hr>
    </div>
    </div>
    
 <div class="footer">
            <p class="text-center">Copyright © Financial World. All Rights Reserved|Contact Us: +91-987654321</p>
 </div>