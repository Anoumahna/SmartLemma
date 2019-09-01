
<!DOCTYPE html>
<html lang="">
<head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">  
     
    <link rel="stylesheet" href="build/css/vendor.css">
	<link rel="stylesheet" href="build/css/styles.css">
	<script src="build/js/vendor.min.js"></script>
	<script src="build/js/app.js"></script>
	<link href="https://fonts.googleapis.com/css?family=Alegreya" rel="stylesheet">
	<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
	<title>Subscribe</title>
</head>
    
<body id="top">
	<div class="bgded" style="background-image:url('../images/demo/backgrounds/back.jpg');"> 
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear"> 
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="../index.php">MOOD</a></h1>
      </div>
      <nav id="mainav" class="fl_right">
        <ul class="clear">
          <li><a href="../index.php">Home</a></li>
          
          <li><a href="about.html">About Us</a></li>
          <li><a class="drop" href="#">Mood Prediction</a>
            <ul>
              <li><a href="http://127.0.0.1:7000/"target="_blank">Pictorial</a></li>
              <li><a href="http://127.0.0.1:5000/"target="_blank">Twitter Feed</a></li>
            </ul>
          </li>
		  <li><a href="doctors.html">Doctors Near Me</a></li>
		  <li><a href="faq.html">FAQs</a></li>
		  <li><a href="gallery.html">Gallery</a></li> 
        </ul>
      </nav>
      <!-- ################################################################################################ -->
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div id="breadcrumb" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <ul>
      <li><a href="../index.php">Home</a></li>
      <li><a href="#">Subscribe</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

    <div class="wrapper row3" style="background-color:rgb(138, 255, 191);">
    	<main class="hoc container clear"> 
       <div class="content"> 
        
        
        	
                <div class="test-title">
                    <h2>Thanks for subscribing to us.</h2>
                    <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->
                </div>
				
				
     
				
                	
	
    <div class="clear"></div>
  </main>
        
    </div>
	
	<?php
    $mailto = $_POST['mail_to'];
    require 'PHPMailerAutoload.php';
   $mail = new PHPMailer();
   $mail ->IsSmtp();
   $mail ->SMTPDebug = 0;
   $mail ->SMTPAuth = true;
   $mail ->SMTPSecure = 'ssl';
   $mail ->Host = "smtp.gmail.com";
   $mail ->Port = 465; // or 587
   $mail ->IsHTML(true);
   $mail ->Username = "moodandme7@gmail.com";
   $mail ->Password = "harshita*";
   $mail ->SetFrom("moodandme7@gmail.com");
   $mail ->Body = '<img src="https://www.healthymepa.com/wp-content/uploads/2016/07/V1-MentalHealth-894x1024.png" alt="Hotel" /><br/>

  <img src="https://www.healthyshetland.com/site/assets/files/1169/mental-health-awareness-week.jpg" alt="Hotel" /><br/>

		';
   $mail ->AddAddress($mailto);
	$mail ->Subject = 'May the Help be with You';
   if(!$mail->Send())
   {
     echo "Mail Not Sent";
   }
   else
   {
       echo "Mail Sent";
   }
?>
	
	
	
	<div class="wrapper row4">
  <footer id="footer" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <div class="one_third first">
      <h6 class="heading">Connect with us</h6>
      <p class="nospace btmspace-30">Want to get daily updates? Subscribe to our newsletter and we'll be sure to add you to our family.</p>
      <form method="post" action="#">
        <fieldset>
          <legend>Newsletter:</legend>
          <input class="btmspace-15" type="text" value="" placeholder="Name">
          <input class="btmspace-15" type="text" value="" placeholder="Email">
          <button type="submit" value="submit">Submit</button>
        </fieldset>
      </form>
    </div>
    <div class="one_third">
      <h6 class="heading">Blog Articles</h6>
      <ul class="nospace linklist">
        <li>
          <article>
            <h2 class="nospace font-x1"><a href="#">Realize it before it is too late</a></h2>
            <time class="font-xs block btmspace-10" datetime="2045-04-06">Friday, 26<sup>th</sup> October, 2018</time>
            <p class="nospace">How to look for signs of mental health issues [&hellip;]</p>
          </article>
        </li>
        <li><a href="#">Because they need your help</a></li>
        <li><a href="#">Do not let them down</a></li>
      </ul>
    </div>
    <div class="one_third">
      <h6 class="heading">Visit us</h6>
      <ul class="nospace btmspace-30 linklist contact">
        <li><i class="fa fa-map-marker"></i>
          <address>
          221B, Baker Street, London, WC2N 5DU
          </address>
        </li>
        <li><i class="fa fa-phone"></i> +00 (123) 456 7890</li>
        <li><i class="fa fa-envelope-o"></i> info@domain.com</li>
      </ul>
      <ul class="faico clear">
        <li><a class="faicon-facebook" href="#"><i class="fa fa-facebook"></i></a></li>
        <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
        <li><a class="faicon-dribble" href="#"><i class="fa fa-dribbble"></i></a></li>
        <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
        <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
        <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
      </ul>
    </div>
    <!-- ################################################################################################ -->
  </footer>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row5">
  <div id="copyright" class="hoc clear"> 
    <!-- ################################################################################################ -->
    <p class="fl_left">Copyright &copy; 2018 - All Rights Reserved - <a href="#">MOOD</a></p>
    
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<a id="backtotop" href="#top"><i class="fa fa-chevron-up"></i></a>
<!-- JAVASCRIPTS -->
<script src="layout/scripts/jquery.min.js"></script>
<script src="layout/scripts/jquery.backtotop.js"></script>
<script src="layout/scripts/jquery.mobilemenu.js"></script>

     
     <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
	<script type="text/javascript" src="js/jquery.base64.js"></script>
    <script type="text/javascript" src="js/jquery.form-validator.min.js"></script>
    <script type="text/javascript" src="js/placeholder.js"></script>
    <script type="text/javascript" src="js/coustem.js"></script>
</body>
</html>




