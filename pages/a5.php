<?php
//index.php

$error = '';
$name = '';
$email = '';
$subject = '';
$message = '';

function clean_text($string)
{
 $string = trim($string);
 $string = stripslashes($string);
 $string = htmlspecialchars($string);
 return $string;
}

if(isset($_POST["submit"]))
{
 if(empty($_POST["name"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Name</label></p>';
 }
 else
 {
  $name = clean_text($_POST["name"]);
  if(!preg_match("/^[a-zA-Z ]*$/",$name))
  {
   $error .= '<p><label class="text-danger">Only letters and white space allowed</label></p>';
  }
 }
 if(empty($_POST["email"]))
 {
  $error .= '<p><label class="text-danger">Please Enter your Email</label></p>';
 }
 else
 {
  $email = clean_text($_POST["email"]);
  if(!filter_var($email, FILTER_VALIDATE_EMAIL))
  {
   $error .= '<p><label class="text-danger">Invalid email format</label></p>';
  }
 }
 if(empty($_POST["subject"]))
 {
  $error .= '<p><label class="text-danger">Subject is required</label></p>';
 }
 else
 {
  $subject = clean_text($_POST["subject"]);
 }
 if(empty($_POST["message"]))
 {
  $error .= '<p><label class="text-danger">Message is required</label></p>';
 }
 else
 {
  $message = clean_text($_POST["message"]);
 }
 if($error == '')
 {
  require 'PHPMailerAutoload.php';
  $mail = new PHPMailer;
  $mail->IsSMTP();        //Sets Mailer to send message using SMTP
  $mail->Host = 'smtp.gmail.com';  //Sets the SMTP hosts
  $mail->Port = '587';        //Sets the default SMTP server port
  $mail->SMTPAuth = true;       //Sets SMTP authentication. Utilizes the Username and Password variables
  $mail->Username = 'moodandme7@gmail.com';     //Sets SMTP username
  $mail->Password = 'harshita*';     //Sets SMTP password
  $mail->SMTPSecure = 'tls';       //Sets connection prefix. Options are "", "ssl" or "tls"
  $mail->From = $_POST["email"];     //Sets the From email address for the message
  $mail->FromName = $_POST["name"];    //Sets the From name of the message
  $mail->AddAddress('moodandme7@gmail.com', 'Mood');//Adds a "To" address
  $mail->AddCC($_POST["email"], $_POST["name"]); //Adds a "Cc" address
  $mail->WordWrap = 900;       //Sets word wrapping on the body of the message to a given number of characters
  $mail->IsHTML(true);       //Sets message type to HTML
  $mail->Subject = $_POST["subject"];    //Sets the Subject of the message
  $mail->Body = $_POST["message"];    //An HTML or plain text message body
  if($mail->Send())        //Send an Email. Return true on success or false on error
  {
   $error = '<label class="text-success">Thank you for your feedback/thoughts.</label>';
  }
  else
  {
   $error = '<label class="text-danger">There is an Error</label>';
  }
  $name = '';
  $email = '';
  $subject = '';
  $message = '';
 }
}

?>

<!DOCTYPE html>
<!--
Template Name: Gogopo
Author: <a href="https://www.os-templates.com/">OS Templates</a>
Author URI: https://www.os-templates.com/
Licence: Free to use under our free template licence terms
Licence URI: https://www.os-templates.com/template-terms
-->
<html lang="">
<!-- To declare your language - read more here: https://www.w3.org/International/questions/qa-html-language-declarations -->
<head>
<title>Mood</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
<link href="../layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<style>
/* Button used to open the contact form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 1;
  position: absolute;
  bottom: 123px;
  left: 117px;
  width: 280px;
}

/* The popup form - hidden by default */
.form-popup {
  display: none;
  position: absolute;
  bottom: 0;
  left: 20px;
  border: 3px solid white;
  z-index: 9;
  background-color: #1B2026;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: #1B2026;
}

/* Full-width input fields */
.form-container input[type=text], .form-container input[type=password] {
  width: 70%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background-color: #1B2026;
}

/* When the inputs get focus, do something */
.form-container input[type=text]:focus, .form-container input[type=password]:focus {
  background-color: 1B2026;
  outline: none;
}

/* Set a style for the submit/login button */
.form-container .btn {
  background-color: #ffffff;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 5;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 5;
}
</style>
</head>
<body id="top">
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- Top Background Image Wrapper -->
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
          
          <li><a href="about.php">About Us</a></li>
          <li><a class="drop" href="#">Mood Prediction</a>
            <ul>
              <li><a href="http://127.0.0.1:7000/"target="_blank">Pictorial</a></li>
              <li><a href="http://127.0.0.1:5000/"target="_blank">Twitter Feed</a></li>
			  <li><a href="http://127.0.0.1:8000/"target="_blank">Voice</a></li>
            </ul>
          </li>
		  <li><a href="doctors.php">Doctors Near Me</a></li>
		  <li><a href="faq.php">FAQs</a></li>
		  <li><a href="gallery.php">Gallery</a></li> 
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
      <li><a href="#">Articles</a></li>
    </ul>
    <!-- ################################################################################################ -->
  </div>
  <!-- ################################################################################################ -->
</div>
<!-- End Top Background Image Wrapper -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <main class="hoc container clear"> 
    <!-- main body -->
    <!-- ################################################################################################ -->
    <div class="content"> 
      <!-- ################################################################################################ -->
      <h1>Mindfulness</h1>
	  
	  <img class="imgl borderedbox inspace-5" src="../images/demo/art/22.jpg" alt="">
	  
     <p>Mindfulness is a process whose goal is not limited to stress reduction but to bring our attention to physical, mental and emotional processes going on at present state. It’s a state that defines how much active and attentive we are at present. Apart from this, mindfulness also means accepting our thoughts without judging them, living in present rather than dwelling over the past.</p> 
<p>Mindfulness was mainly initiated by Jon Kobat-Zann who created a program, mindfulness-based stress reduction(MBSR). The program is wisely accepted in schools, hospitals, prisons and many other areas. There are various ways to develop mindfulness meditation. One of them involves to be aware of one’s natural breathing process by simply sitting cross legged on the floor or a cushion, and bringing attention to movement of abdomen when breathing in and out. The other method is body-scan meditation  where attention is brought to various parts of body. It can be practised by anyone whether he/she is a child or an adult provided that he/she should be regular, i.e, 10mins should be devoted everyday.</p>
 <p>Benefits of mindfulness are not only reducing depression symptoms and anxiety but reducing drug addiction also. Sometimes, we may find ourselves in a situation where our brain is continuously thinking over something, that is not important with respect to the present moment, leading to lack of focus at a meeting or an exam. Through regular meditation we can increase our concentration power. It is also a solution to treat heart disease, lower blood pressure, alleviate gastrointestinal difficulties. Researches have even shown that mindfulness helps in shaping the physical structure of our brain. 
</p>

<img class="imgr borderedbox inspace-5" src="../images/demo/art/29.jpg" alt="">
<b>Following are some people whose teachings can help you through a tough time:</b>
<div class="instructors">
                	<h4></h4>
                    <div class="row">
                    	<div class="col-sm-4">
                        	<div class="instructors-box">
                            	<div class="img"><img src="images/yoga/yoga-1.jpg" alt=""></div>
                                 <div class="name"><b>Yogiraj Gurunath</b></div>
                                <p>He is not a Deity but a beacon of positivity, to give humanity the courage to find Self Peace and therefore cumulatively promote Earth Peace.</p>
                                <div class="link"><a target="_blank" href="http://siddhanath.org/">More Info</a></div> 
                            </div>
                        </div>
                        <div class="col-sm-4">
                        	<div class="instructors-box">
                            	<div class="img"><img src="images/yoga/yoga-2.jpg" alt=""></div>
                                <div class="name"><b>Sri Sri Ravi Shankar</b></div>
                                <p>The Art of Living offers stress-elimination programs, which helped millions around the world to overcome stress, depression and violent tendencies.</p>
                                <div class="link"><a target="_blank" href="https://www.artofliving.org/">More Info</a></div> 
                            </div>
                        </div>
                        <div class="col-sm-4">
                        	<div class="instructors-box">
                            	<div class="img"><img src="images/yoga/yoga-3.jpg" alt=""></div>
                                <div class="name"><b>Sri Sadhguru</b></div>
                                <p> He works tirelessly towards the physical, mental, and spiritual well-being of all.His scientific methods for self-transformation are both direct and powerful. </p>
                                <div class="link"><a target="_blank" href="http://www.ishafoundation.org/">More Info</a></div> 
                            </div>
                        </div>
						<div class="col-sm-4">
                        	<div class="instructors-box">
                            	<div class="img"><img src="images/yoga/yoga-4.jpg" alt=""></div>
                                 <div class="name"><b>Sri Swami Sivananda Saraswati</b></div>
                                <p>He guided thousands of spiritual seekers, disciples and aspirants all over the world, inspiring people to practice yoga and lead a divine life.</p>
                                <div class="link"><a target="_blank" href="http://www.biharyoga.net">More Info</a></div> 
                            </div>
                        </div>
						<div class="col-sm-4">
                        	<div class="instructors-box">
                            	<div class="img"><img src="images/yoga/yoga-5.jpg" alt=""></div>
                                 <div class="name"><b>Swami Ramdev</b></div>
                                <p>He preaches that God resides in every human being and that the body is a temple of God. he has been conducting Yoga Science all across the country.</p>
                                <div class="link"><a target="_blank" href="http://www.divyayoga.com/">More Info</a></div> 
                            </div>
                        </div>
						<div class="col-sm-4">
                        	<div class="instructors-box">
                            	<div class="img"><img src="images/yoga/yoga-6.jpg" alt=""></div>
                                 <div class="name"><b>Rishikesh Yog Peeth</b></div>
                                <p>Rishikesh Yog Peeth has been involved in spreading the awareness of holistic living with the help of Vedic wisdom in the form of Yoga and Ayurveda.</p>
                                <div class="link"><a target="_blank" href="https://www.rishikeshyogpeeth.com">More Info</a></div> 
                            </div>
                        </div>
                        
                    </div>
                </div>
					
					

					
					
      
      
      <!-- ################################################################################################ -->
    </div>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<div class="wrapper row4">
  <footer id="footer" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="one_third first">



      <h6 class="heading">Share your Thoughts</h6>


        Do you have something you want to get it off your chest? Enter your e-mail below.
      </br>
      <button class="open-button" onclick="openForm()">Feedback</button>

      <div class="form-popup" id="myForm">
           <form method="post">
          <h1>Write to us!</h1>

          <?php echo $error; ?>

            <div class="form-group">
             <!--<label>Enter Name</label>-->
             <input type="text" name="name" placeholder="Enter Name" class="form-control"><?php echo $name; ?>
            </div>
            <br>
            <div class="form-group">
             <!--<label>Enter Email</label>-->
             <input type="text" name="email" class="form-control" placeholder="Enter Email"><?php echo $email; ?>
            </div>
            <br>
            <div class="form-group">
             <!--<label>Enter Subject</label>-->
             <input type="text" name="subject" class="form-control" placeholder="Enter Subject"><?php echo $subject; ?>
            </div>
            <br>
            <div class="form-group">
             <!--<label>Enter Message</label>-->
             <input type="text" name="message" class="form-control" placeholder="Enter Message"><?php echo $message; ?>
            </div>
            <br>
            <div class="form-group" align="center">
             <input type="submit" name="submit" value="Submit" class="btn btn-info" />
             <button type="button" class="btn cancel" onclick="closeForm()">Close</button>

            </div>

        </form>
      </div>

      <script>
      function openForm() {
        document.getElementById("myForm").style.display = "block";
      }

      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }
      </script>
       <!--<input type="checkbox" >I want to recieve monthly updates.</br> -->

</div>
	<div class="one_third">
      <h6 class="heading">Subscribe our Newsletter</h6>

      <form method="post" action="../class/send_mail.php">
        Do you want weekly updates? Enter your e-mail below.<input type="text" name="mail_to">
      </br>
       <!--<input type="checkbox" >I want to recieve monthly updates.</br> -->

  </br>
  <name= mail_sub"></br>



	 <button type="submit" class="btn btn-success btn-lg">May the Help be with You</button>




      </form>



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
</body>
</html>
