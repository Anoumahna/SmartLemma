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
<link href="layout/styles/layout.css" rel="stylesheet" type="text/css" media="all">
<link href="news.css" rel="stylesheet" type="text/css" media="all">
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
<div class="bgded" style="background-image:url('images/demo/backgrounds/back.jpg');">
  <!-- ################################################################################################ -->
  <div class="wrapper row1">
    <header id="header" class="hoc clear">
      <!-- ################################################################################################ -->
      <div id="logo" class="fl_left">
        <h1><a href="index.php">MOOD</a></h1>
      </div>
      <nav id="mainav" class="fl_right">
        <ul class="clear">
          <li class="active"><a href="index.php">Home</a></li>
		  <li><a href="pages/about.php">About Us</a></li>
          <li><a class="drop" href="#">Mood Prediction</a>
            <ul>
              <li><a href="http://127.0.0.1:7000/"target="_blank">Pictorial</a></li>
              <li><a href="http://127.0.0.1:5000/"target="_blank">Twitter Feed</a></li>
			  <li><a href="http://127.0.0.1:8000/"target="_blank">Voice</a></li>
            </ul>
          </li>
		  <li><a href="pages/doctors.php">Doctors Near Me</a></li>
		  <li><a href="pages/faq.php">FAQs</a></li>
		  <li><a href="pages/gallery.php">Gallery</a></li>
        </ul>
      </nav>
      <!-- ################################################################################################ -->
    </header>
  </div>
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <!-- ################################################################################################ -->
  <div class="wrapper">
    <article id="pageintro" class="hoc clear">
      <!-- ################################################################################################ -->
      <div class="transbox">
        <h3 class="heading">"The man who removes a mountain begins by carrying away small stones.”</h3>
        <p>- Chinese Proverb</p>
      </div>
      <!-- ################################################################################################ -->
    </article>
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
    <article class="group">
      <div class="one_quarter first">
        <img src="images/demo/backgrounds/33.jpeg">
      </div>
      <div class="three_quarter">
        <p>MOOD is a platform for people to know that health and medical care don't just limit to the social well-being of a person.</p>
        <p class="btmspace-30">Mental health and the emotional well-being of a person are equally important[&hellip;]</p>
        <footer><a class="btn" href="pages/about.php">Read More &raquo;</a></footer>
      </div>
    </article>
    <!-- ################################################################################################ -->
    <!-- / main body -->
    <div class="clear"></div>
  </main>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay light" style="background-image:url('images/demo/backgrounds/b1.jpg');">
  <section class="hoc container clear">
    <!-- ################################################################################################ -->
    <ul class="nospace group">
      <li class="one_third first">
        <h3 class="heading">Here are some tests to analyse what you could be going through: </h3>
      </li>
      <li class="one_third">
        <figure><a href="pages/depression_test.php"><img class="btmspace-10" src="images/demo/dep.jpg" alt=""></a>
          <figcaption>
            <h6 class="heading font-x1">Depression Test</h6>
            <footer><a href="pages/depression_test.php">Take Test</a></footer>
          </figcaption>
        </figure>
      </li>
      <li class="one_third">
        <figure><a href="pages/adhd_test.php"><img class="btmspace-10" src="images/demo/adhd.jpg" alt=""></a>
          <figcaption>
            <h6 class="heading font-x1">ADHD Test</h6>
            <footer><a href="pages/adhd_test.php">Take Test</a></footer>
          </figcaption>
        </figure>
      </li>
	  <br><br>
      <li class="one_third first">
        <figure><a href="pages/rel_test.php"><img class="btmspace-10" src="images/demo/rel.jpg" alt=""></a>
          <figcaption>
            <h6 class="heading font-x1">Relationship Test</h6>
            <footer><a href="pages/rel_test.php">Take Test</a></footer>
          </figcaption>
        </figure>
      </li>
	  <li class="one_third">
        <figure><a href="pages/bipolar_test.php"><img class="btmspace-10" src="images/demo/16.jpg" alt=""></a>
          <figcaption>
            <h6 class="heading font-x1">Bipolar Test</h6>
            <footer><a href="pages/bipolar_test.php">Take Test</a></footer>
          </figcaption>
        </figure>
      </li>
	  <li class="one_third">
        <figure><a href="pages/schizophrenia_test.php"><img class="btmspace-10" src="images/demo/17.jpg" alt=""></a>
          <figcaption>
            <h6 class="heading font-x1">Schizophrenia Test</h6>
            <footer><a href="pages/bipolar_test.php">Take Test</a></footer>
          </figcaption>
        </figure>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/19.jpg');">
  <section class="hoc container clear">
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading">From the Editor's Desk</h6>
      <p>Understanding Mental Health</p>
    </div>
    <ul class="nospace group elements">
      <li class="one_third first">
        <article><a href="pages/a1.php"><i class="fa fa-chain-broken"></i></a>
          <h6 class="heading">Learning Disability and Mental Health</h6>
          <p>The experiences resulting from having a learning disability increases the likelihood of having a mental health problem [&hellip;]</p>
          <footer><a href="pages/a1.php">View Details &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="pages/a2.php"><i class="fa fa-ambulance"></i></a>
          <h6 class="heading">Children Young People And Families</h6>
          <p>10% of children and young people have a mental health problem [&hellip;]</p>
          <footer><a href="pages/a2.php">View Details &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="pages/a3.php"><i class="fa fa-area-chart"></i></a>
          <h6 class="heading">Mental Health In The Workplace</h6>
          <p>Mental health problems are the leading cause of sickness absence in the UK [&hellip;]</p>
          <footer><a href="pages/a3.php">View Details &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third first">
        <article><a href="pages/a4.php"><i class="fa fa-clock-o"></i></a>
          <h6 class="heading">Mental Health in Later Life</h6>
          <p>The total cost of dementia to the UK is £26.3 billion [&hellip;]</p>
          <footer><a href="pages/a4.php">View Details &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="pages/a5.php"><i class="fa fa-gamepad"></i></a>
          <h6 class="heading">Mindfulness</h6>
          <p>Evidence shows mindfulness is an effective intervention for relapse prevention for mental health problems [&hellip;]</p>
          <footer><a href="pages/a5.php">View Details &raquo;</a></footer>
        </article>
      </li>
      <li class="one_third">
        <article><a href="pages/a6.php"><i class="fa fa-thumbs-up"></i></a>
          <h6 class="heading">Prevention Resources and Tools</h6>
          <p>The best way to deal with a crisis is to prevent it from happening in the first place [&hellip;]</p>
          <footer><a href="pages/a6.php">View Details &raquo;</a></footer>
        </article>
      </li>
    </ul>
    <!-- ################################################################################################ -->
  </section>
</div>


<div class="wrapper bgded overlay" style="background-image:url('images/demo/backgrounds/aa.jpg');">
  <section class="hoc container clear">
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading">NEWS LETTER</h6>
    </div>

	<div class="row">
	<?php
		$xml=simplexml_load_file("https://psychcentral.com/news/feed?category_name=professional") or die("Error: Cannot connect");$i=1;
		foreach($xml->channel->item as $item) {
		if ($i <= 8)
		{
	?>
	<div class="news">
    <div class="col-sm-6 col-md-3">


			<a href="<?php echo $item->link ;?>" target="_blank" title="<?php echo $item->title ; ?>" ><?php /* echo $item->title ; */  if (strlen($item->title) > 70 ) { echo  substr($item->title,0,50)."..."; } else { echo $item->title; }   ?></a>
			<?php echo $item->pubDate ;?>

			<?php $desc = $item->description;
				$desc = preg_replace("/<div.*>/","",$desc); echo  substr($desc,0,180)."...";  ?>
				<a href="<?php echo $item->link ;?>" target="_blank" class="read-more">Read More</a>
			<?php  }
			$i++;
			}?>
		</div>
		</div>
	</div>
    <!-- ################################################################################################ -->
  </section>
</div>

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row3">
  <section class="hoc container clear">
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h6 class="heading">Behind The Scenes</h6>
      <p>Meet the team behind the hardwork of MOOD</p>
    </div>
    <div class="group">
      <figure class="one_quarter first"><a href="#"><img class="btmspace-30" src="images/demo/t3.jpeg" alt=""></a>
        <figcaption>
          <h6 class="heading font-x1">Anoushka Mahna</h6>

          <footer>
            <ul class="faico clear">
              <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
            </ul>
          </footer>
        </figcaption>
      </figure>
      <figure class="one_quarter"><a href="#"><img class="btmspace-30" src="images/demo/t5.jpeg" alt=""></a>
        <figcaption>
          <h6 class="heading font-x1">Harshita Badhawn</h6>

          <footer>
            <ul class="faico clear">
              <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
            </ul>
          </footer>
        </figcaption>
      </figure>
      <figure class="one_quarter"><a href="#"><img class="btmspace-30" src="images/demo/t2.jpeg" alt=""></a>
        <figcaption>
          <h6 class="heading font-x1">Harshita Kukreja</h6>

          <footer>
            <ul class="faico clear">
              <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
            </ul>
          </footer>
        </figcaption>
      </figure>
      <figure class="one_quarter"><a href="#"><img class="btmspace-30" src="images/demo/t6.jpg" alt=""></a>
        <figcaption>
          <h6 class="heading font-x1">Sara Khurana</h6>

          <footer>
            <ul class="faico clear">
              <li><a class="faicon-twitter" href="#"><i class="fa fa-twitter"></i></a></li>
              <li><a class="faicon-linkedin" href="#"><i class="fa fa-linkedin"></i></a></li>
              <li><a class="faicon-google-plus" href="#"><i class="fa fa-google-plus"></i></a></li>
              <li><a class="faicon-vk" href="#"><i class="fa fa-vk"></i></a></li>
            </ul>
          </footer>
        </figcaption>
      </figure>
    </div>
    <!-- ################################################################################################ -->
    <div class="clear"></div>
  </section>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper bgded overlay coloured" style="background-image:url('images/demo/backgrounds/back2.jpg');">
  <div class="hoc container testimonials clear">
    <!-- ################################################################################################ -->
    <div class="sectiontitle">
      <h3 class="heading">In Their Words</h3>
      <p>What our users feel</p>
    </div>
    <article class="one_half first"><img src="images/demo/u1.jpg" alt="">
      <blockquote>The team at MOOD is the most helpful team I could ever ask for. They understood what I needed and delivered the same in a satisfying manner.</blockquote>
      <h6 class="heading">John Doe</h6>
	  </article>
    <article class="one_half"><img src="images/demo/u2.jpg" alt="">
      <blockquote>MOOD has given me a new direction in my life. I have rediscovered myself with their help and I certainly feel alive again.</blockquote>
      <h6 class="heading">Jane Doe</h6>
      </article>
    <!-- ################################################################################################ -->
  </div>
</div>
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->

<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<!-- ################################################################################################ -->
<div class="wrapper row4">
  <footer id="footer" class="hoc clear">
    <!-- ################################################################################################ -->
    <div class="one_third first">



      <h6 class="heading">Share your Thoughts</h6>


        Do you have something you want to get it off your chest? Enter your e-mail below.
      </br>
      <button class="open-button" onclick="openForm()">Write To Us</button>

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

      <form method="post" action="class/send_mail.php">
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
