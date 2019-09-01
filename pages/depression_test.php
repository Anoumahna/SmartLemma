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
	<title>Depression Test</title>
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
      <li><a href="#">Depression Test</a></li>
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
                    <h2>Depression Test</h2>
                    <!--<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>-->
                </div>
				<b>Goldberg’s Depression Scale</b>
                    <p>
The following is an adaptation of Dr. Goldberg’s Depression Screening Questionnaire developed in 1993. You may self score this test with the instructions at the bottom of the screening questions. A simple screening test such as this will not provide a diagnosis or treatment for symptoms of depression or other mood disorders. It is best if you use the results to identify possible symptoms and for seeking professional assistance.</p>
<p>Dr. Ivan Goldberg was a well-known and respected psychiatrist in New York City for over fifty years. He was best known for innovative treatments of medication resistant depression and bipolar disorder. He served on the staff of the National Institute of Mental Health, in the Departments of Psychiatry at the Columbia-Presbyterian Medical Center and Columbia University’s College of Physicians and Surgeons.</p>
<p class="headline">
When answering the questions think back over the last ten to fourteen days and reflect on the relevance of each statement for your personal experience.</p>
                <div class="row">
                    
                    	<form method="post">
                            
                                1. I do things slowly.
								<br>
                                <div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="0" id="one" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">No, not at all</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="1" id="two" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Just a little</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="2" id="three" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Somewhat</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="3" id="four" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Moderately</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="4" id="five" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Quite a lot</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="5" id="six" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Very much</label>
                                </div>
                                 
                        </form>
						<br><br>
						
						<form method="post">
                            
                                2. My future seems hopeless.
								<br>
                                <div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="0" id="seven" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">No, not at all</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="1" id="eight" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Just a little</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="2" id="nine" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Somewhat</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="3" id="ten" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Moderately</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="4" id="eleven" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Quite a lot</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="5" id="twelve" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Very much</label>
                                </div>
                                 
                        </form>
						<br><br>
						
						<form method="post">
                            
                                3. It is hard for me to concentrate on reading or other tasks.
								<br>
                                <div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="0" id="thirt" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">No, not at all</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="1" id="fourt" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Just a little</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="2" id="fift" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Somewhat</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="3" id="sixt" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Moderately</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="4" id="sevent" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Quite a lot</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="5" id="eightt" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Very much</label>
                                </div>
                                 
                        </form>
						<br><br>
						
						<form method="post">
                            <div class="qustion_box">
                                4. The pleasure and joy has gone out of my life.
								<br>
                                <div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="0" id="nint" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">No, not at all</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="1" id="twenty" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Just a little</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="2" id="tone" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Somewhat</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="3" id="ttwo" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Moderately</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="4" id="tthree" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Quite a lot</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="5" id="tfour" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Very much</label>
                                </div>
                                 
                        </form>
						<br><br>
						
						<form  method="post">
                            <div class="qustion_box">
                                5. I have difficulty making decisions.
								<br>
                                <div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="0" id="tfive" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">No, not at all</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="1" id="tsix" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Just a little</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="2" id="tseven" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Somewhat</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="3" id="teight" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Moderately</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="4" id="tnine" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Quite a lot</label>
                                </div>
								<div style="float: left;clear: none;">
                                    	<input style="float: left;clear: none;" name="radio-opt1" value="5" id="thirty" type="radio" class="radio"/>
											<label style="float:left;clear: none;display: block;" for="0">Very much</label>
                                </div>
                                 
                        </form>
						<br><br>
						
						
						
						
						
						<div class="submit-test">
                            	<a href="#" class="submit_adhd_btn btn" onclick="myFunction()">Submit</a>
                            </div>
                    </div>
                
       
		<p id="demo"> </p>
		<p id="result1"> </p>
		<p id="result2"> </p>
		<p id="result3"> </p>
		<p id="result4"> </p>
		<p id="result5"> </p>
		
		<div id="result6" style="display:none;" >
			<h2>Find doctors in the Portland area to treat you!</h2>
			<form id="findDoc">
				<label for="medicalIssue">Enter your Medical Issue:</label>
				<input id="medicalIssue" type="text" required>
				<button type="submit" class="btn btn-warning">Submit</button>
				<button type="refresh" id="refresh"class="btn btn-primary">Refresh</button>
			</form>
			
			<div class = "col-md-8">
				<h3 id="recommend">Based on your input we recommend the following doctors:</h3>
				<br>
				<table class="table">
				<thead>
				<tr>
				<th>Name</th>
				<th>Title</th>
				<th>Specialty</th>
				<th>Practice Name</th>
				<th>Address</th>
				</tr>
				</thead>
				<tbody id="table-body">
				<tr>
				</tbody>
				</table>
			</div>
		</div>
		</div>
		<script>
		var result=0;
		
		function myFunction() {
		var x = document.getElementById("one").checked;
		
		if(x)
		{
			result+=0;
		}
		x = document.getElementById("two").checked;
		if(x)
		{
			result+=1;
		}
		x = document.getElementById("three").checked;
		if(x)
		{
			result+=2;
		}
		x = document.getElementById("four").checked;
		if(x)
		{
			result+=3;
		}
		x = document.getElementById("five").checked;
		if(x)
		{
			result+=4;
		}
		x = document.getElementById("six").checked;
		if(x)
		{
			result+=5;
		}
		x = document.getElementById("seven").checked;
		if(x)
		{
			result+=0;
		}
		x = document.getElementById("eight").checked;
		if(x)
		{
			result+=1;
		}
		x = document.getElementById("nine").checked;
		if(x)
		{
			result+=2;
		}
		x = document.getElementById("ten").checked;
		if(x)
		{
			result+=3;
		}
		x = document.getElementById("eleven").checked;
		if(x)
		{
			result+=4;
		}
		x = document.getElementById("twelve").checked;
		if(x)
		{
			result+=5;
		}
		x = document.getElementById("thirt").checked;
		if(x)
		{
			result+=0;
		}
		x = document.getElementById("fourt").checked;
		if(x)
		{
			result+=1;
		}
		x = document.getElementById("fift").checked;
		if(x)
		{
			result+=2;
		}
		x = document.getElementById("sixt").checked;
		if(x)
		{
			result+=3;
		}
		x = document.getElementById("sevent").checked;
		if(x)
		{
			result+=4;
		}
		x = document.getElementById("eightt").checked;
		if(x)
		{
			result+=5;
		}
		x = document.getElementById("nint").checked;
		if(x)
		{
			result+=0;
		}
		x = document.getElementById("twenty").checked;
		if(x)
		{
			result+=1;
		}
		
		x = document.getElementById("tone").checked;
		if(x)
		{
			result+=2;
		}
		x = document.getElementById("ttwo").checked;
		if(x)
		{
			result+=3;
		}
		x = document.getElementById("tthree").checked;
		if(x)
		{
			result+=4;
		}
		x = document.getElementById("tfour").checked;
		if(x)
		{
			result+=5;
		}
		x = document.getElementById("tfive").checked;
		if(x)
		{
			result+=0;
		}
		x = document.getElementById("tsix").checked;
		if(x)
		{
			result+=1;
		}
		x = document.getElementById("tseven").checked;
		if(x)
		{
			result+=2;
		}
		x = document.getElementById("teight").checked;
		if(x)
		{
			result+=3;
		}
		x = document.getElementById("tnine").checked;
		if(x)
		{
			result+=4;
		}
		x = document.getElementById("thirty").checked;
		if(x)
		{
			result+=5;
		}
		
		var str="You have a total score of "+result;
		document.getElementById("demo").innerHTML = str;
		var str1="0–2, No depression likely.";
		var str2="3–5, Possible symptoms that may be due to depression or other medical issues.";
		var str3="6–8, Mild to Moderate Depression.";
		var str4="9–13, Moderate to Severe Depression.";
		var str5="14 and up Severely Depressed.";
		document.getElementById("result1").innerHTML = str1;
		document.getElementById("result2").innerHTML = str2;
		document.getElementById("result3").innerHTML = str3;
		document.getElementById("result4").innerHTML = str4;
		document.getElementById("result5").innerHTML = str5;
		document.getElementById('result6').style.display = "block";
		
		
}
		
		
		
		</script>
        
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
