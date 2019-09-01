<?php  
include 'header.php';
include 'footer.php';
session_start();

 if(isset($_COOKIE['serendipity'])) {
		$pieces = explode("$", $_COOKIE['serendipity']);
		$_SESSION['ddr_id'] = $pieces[0];
		$_SESSION['ddr_name'] = $pieces[1];
		$_SESSION['ddr_mail'] = $pieces[2];if($pieces[3] == "dr"){ $_SESSION['dr_check'] = $pieces[3]; } else { $_SESSION['user_check'] = $pieces[3];}
	}

?>

<!DOCTYPE html>
<html>
<head>
<style>
.size2
{
	
	float:right;
	
	
	
}


.permalink
{
	position:absolute;
	bottom: 20px;
	left: 20px;
	
}
</style>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0"> 
    
     
    <title>Mental Health Awareness</title>
    
     
    <link rel="shortcut icon" href="images/Favicon.ico">
    
     
    <link href="css/bootstrap.css" rel="stylesheet"> 
    <link href="css/owl.carousel.css" rel="stylesheet"> 
    <link href="css/font-awesome.css" rel="stylesheet">
    <link href="css/jquery.selectbox.css" rel="stylesheet"> <!-- select box -->
    <link href="css/docs.css" rel="stylesheet"> 
    
    <link href="https://fonts.googleapis.com/css?family=Arima+Madurai:100,200,300,400,500,700,800,900%7CPT+Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
    
<body>
    <div class="wapper">
    	 
    	<?php headers(); ?>
        <!-- <header id="header" class="style">
            <nav id="nav-main">
                <div class="navbar navbar-inverse">
                    <div class="navbar-header">
                        <a href="index" class="navbar-brand"><img src="images/logo2.png" alt=""></a>
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="search-box">
                        <i class="fa fa-search"></i>
                    </div>
                    <div class="cart-box">
                        <a href="cart"><i class="fa fa-shopping-basket"></i></a>
                    </div>
                    <div class="navbar-collapse collapse">
					<div class="quck-right">
						<div class="right-link"><a href="#"><i class="fa fa-handshake-o"></i>Help Center</a></div>
						<div class="right-link"><a href="#"><i class="fa fa-headphones"></i>Online Support</a></div>
						<?php
if(isset($_SESSION['ddr_id']))
{
	?>
			<div class="right-link"><div class="dropdown">
    <a class="dropdown-toggle" href="#" data-toggle="dropdown">Hi <?php echo $_SESSION['ddr_name'] ?>&nbsp;<span class="caret"></span></a>
    <ul class="dropdown-menu">
      <li><a href="#">Profile</a></li>
      <li><a href="#">Settings</a></li>
      <li class="divider"></li>
      <li><a href="#" class="logout">Logout</a></li>
    </ul>
  </div></div>

	<?php
   /* echo "Hi ".$_SESSION['ddr_name']. "<a style='margin-left:20px;' href='logout.php'>Logout</a>"; */
}
else{
			?>
			<div class="right-link"><a href="#" id="log_reg"><i class="fa  fa-user"></i>Login \ Register</a></div>
<?php
}
?>
						
					</div>
                            <ul class="nav navbar-nav">
                                <li class="active">
                                	<a href="index">Home </a>
                                    </li>
                                <li><a href="doctors">Doctors</a></li>
                                <li><a href="forums">Forums</a></li>
                                <li><a href="about-us">About Us</a></li>
                                <li class="sub-menu">
                                	<a href="event">Event</a>
                                    <ul>
                                    	<li><a href="event">Event</a></li>
                                         
                                        
                                    </ul>
                                </li>

                                <li><a href="contact-us">Contact Us </a></li>
                            </ul>
                        </div>
                </div>
            </nav>
        </header> -->
        <section class="banner style">
        	<div class="left-slider">
            	<div class="item">
                	<img src="images/banner/index2-sliderImg1.jpg" alt="">
                    <div class="slide-info">
                        <p>When an idea exclusively occupies the mind, it is transformed into an actual physical or mental state. ”</p>
						<h2>- Swami Vivekananda</h2>
                    </div>
                </div>
                <div class="item">
                	<img src="images/banner/index2-sliderImg2.jpg" alt="">
                    <div class="slide-info">
                        <p>Believe in yourself and all that you are. Know that there is something inside you that is greater than any obstacle. ” </p>
						<h2>- Christian D. Larson</h2>
                    </div>
                </div>
                <div class="item">
                	<img src="images/banner/index2-sliderImg3.jpg" alt="">
                    <div class="slide-info">
                        <p>The man who removes a mountain begins by carrying away small stones. ” </p>
						<h2>- Chinese Proverb</h2>
                    </div>
                </div>
            </div>
        </section>
        <section class="safe-environment">
        	<div class="container">
            	<div class="row">
                	<div class="col-sm-12 col-md-4">
                    	<div class="section-title">
                        	<h2><a href="question?exam=Personality evaluation test">Personality evaluation test </br>   
							<img src="images/hat.jpg"></a></h2>
							
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6">
                    	<p>“Every finger of the hand is different “- all must have heard this but often while trying to merge with the social group we forget who we truly are. This can lead to serious disorder and catastrophic situation. </p>
						
                    </div>
					
                     <div class="col-md-4 col-sm-6">
                    	<p>We here believe that everyone is special and unique in their  own way. Keeping the spirit of uniqueness we  have specially created a series of questions  that helps you identify your personality.</p>
						
						<div class="size2">
						
                                	<a href="#" ><i class="fa fa-facebook"></i></a>
                                    <a href="#" ><i class="fa fa-twitter"></i></a>
                                    <a href="#" ><i class="fa fa-google-plus"></i></a>
                                </div>
																
                    </div>
					
                </div>
            </div>
        </section>
        <section class="test-section">
        	<div class="container">
            	
                <div class="row">
                	<div class="col-sm-6 col-md-4">
                    	<div class="test-box">
                            <div class="name">Online Depression Test</div>
                            <p>If you are unsure whether you are depressed take our Depression Test to help evaluate your recent mood.</p>
							
                            <a href="dipression_test" class="read-more">Take test</a>
							<div class="size3">
						
                                	<a href="#" ><i class="fa fa-facebook"></i></a>
                                    <a href="#" ><i class="fa fa-twitter"></i></a>
                                    <a href="#" ><i class="fa fa-google-plus"></i></a>
                            </div>
							
                        </div>
						
						
                    </div>
					<div class="col-sm-6 col-md-4">
                    	<div class="test-box">
                            <div class="name">Online Bipolar Test</div>
                            <p>Based on the Goldberg Bipolar Spectrum Screening test this test will only give an indication of whether you are showing some of the symptoms of Bipolar Disorder.</p>
                            <a href="bipolar_test" class="read-more">Take test</a>
							<div class="size3">
						
                                	<a href="#" ><i class="fa fa-facebook"></i></a>
                                    <a href="#" ><i class="fa fa-twitter"></i></a>
                                    <a href="#" ><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
					<div class="col-sm-6 col-md-4">
                    	<div class="test-box">
                            <div class="name">Online ADHD Test</div>
                            <p>Find out if you are experiencing the most common symptoms of ADHD using our online test.</p>
                            <a href="adhd_test" class="read-more">Take test</a>
							<div class="size3">
						
                                	<a href="#" ><i class="fa fa-facebook"></i></a>
                                    <a href="#" ><i class="fa fa-twitter"></i></a>
                                    <a href="#" ><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
					<div class="col-sm-6 col-md-4">
                    	<div class="test-box">
                            <div class="name">Online Relationship Test</div>
                            <p>Find out if you are experiencing the most common symptoms of Anxiety using our online test.</p>
                            <a href="relationship_test" class="read-more">Take test</a>
							<div class="size3">
						
                                	<a href="#" ><i class="fa fa-facebook"></i></a>
                                    <a href="#" ><i class="fa fa-twitter"></i></a>
                                    <a href="#" ><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
					<div class="col-sm-6 col-md-4">
                    	<div class="test-box">
                            <div class="name">Schizophrenia Test</div>
                            <p>Are you a genius or does your IQ require some improvement? Take our IQ test to evaluate immediately.</p>
                            <a href="schizophrenia-test" class="read-more">Take test</a>
							<div class="size3">
						
                                	<a href="#" ><i class="fa fa-facebook"></i></a>
                                    <a href="#" ><i class="fa fa-twitter"></i></a>
                                    <a href="#" ><i class="fa fa-google-plus"></i></a>
                            </div>
                        </div>
                    </div>
					<div class="col-sm-6 col-md-4">
                    	<div class="test-box">
                            <div class="name"><a href="#">EQ test</a></div>
							<div class="size3">
						
                                	<a href="#" ><i class="fa fa-facebook"></i></a>
                                    <a href="#" ><i class="fa fa-twitter"></i></a>
                                    <a href="#" ><i class="fa fa-google-plus"></i></a>
                            </div>
                            <p>Ever felt like drowning in the raging wrath of problems. Take our test to know how well you can deal with the situations that put you and everything you believe to test</p>
                            <a href="https://greatergood.berkeley.edu/quizzes/ei_quiz" target="_blank" class="read-more">Take test</a>
                        </div>
                    </div>
					
                    
                </div>
            </div>
        </section>
        <section class="our-studies">
        	<div class="container">
            	<div class="section-title">
                	<h2>Our work</h2>
                </div>
                <div class="row">
                	<div class="col-sm-6 col-md-4 studies-set">
                    	<a href="children_young_people_and_families"><div class="studies-box color1">
                        	<div class="name">Children, young people and families</div>
                            <p>10% of children and young people have a mental health problem.</p>
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="mental_health_in_the_workplace"><div class="studies-box color2">
                        	<div class="name">Mental health in the workplace</div>
                            <p>Mental health problems are the leading cause of sickness absence in the UK.</p> 
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="mental_health_in_later_life"><div class="studies-box color3">
                        	<div class="name">Mental health in later life</div>
                            <p>The total cost of dementia to the UK is £26.3 billion.</p> 
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="learning_disability_and_mental_health"><div class="studies-box color4">
                        	<div class="name">Learning disabilities and mental health</div>
                            <p>The experiences resulting from having a learning disability increases the likelihood of having a mental health problem.</p> 
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="sleeping"><div class="studies-box color5">
                        	<div class="name">Sleeping</div>
                            <p>We work to influence key policy decisions on mental health in all of the UK's legislatures.</p> 
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="research"><div class="studies-box color6">
                        	<div class="name">Research</div>
                            <p>We have a long history of providing high-quality, transformational mental health research.</p> 
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="challenging_mental_health_inequalities"><div class="studies-box color7">
                        	<div class="name">Challenging mental health inequalities</div>
                            <p>The socioeconomically disadvantaged are 2-3 times more likely to develop mental health problems.</p> 
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="prevention_resources_and_tools"><div class="studies-box color8">
                        	<div class="name">Prevention resources and tools</div>
                            <p>The best way to deal with a crisis is to prevent it from happening in the first place.</p> 
                        </div></a>
                    </div>
                    <div class="col-sm-6 col-md-4 studies-set">
                    	<a href="mindfulness"><div class="studies-box color9">
                        	<div class="name">Mindfulness</div>
                            <p>Evidence shows mindfulness is an effective intervention for relapse prevention for mental health problems.</p> 
                        </div></a>
                    </div>
                    
                </div>
            </div>
        </section>
		<?php
if(!isset($_SESSION['ddr_id']))
{
	?>
        <section class="sign-upBox" style="background-image:url(images/parallax/sign-upBg.jpg);">
        	<img src="images/parallax/sign-upBg.jpg" alt="">
            <div class="sign-upText">
            	<h3><span>Like what you’re learning</span>Get Started Today!</h3>
                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry lorem Ipsum has been the industry's standard dummy </p>
                <div class="sign-btn">
                	<a href="login-register">Sign Up</a>
                </div>
            </div>
        </section>
		<?php 
}
		?>
        <section class="news-section">
        	<div class="container">
            	<div class="section-title">
                	<h2>Latest News</h2>
                </div>
                <div class="row">
                	
					<?php
					$xml=simplexml_load_file("https://psychcentral.com/news/feed?category_name=professional") or die("Error: Cannot connect");$i=1;
      foreach($xml->channel->item as $item) {
		   if ($i <= 8)
		  {
?>
       <div class="col-sm-6 col-md-3">
	   <div class="news-box">
	   <div class="name"><a href="<?php echo $item->link ;?>" target="_blank" title="<?php echo $item->title ; ?>" ><?php /* echo $item->title ; */  if (strlen($item->title) > 70 ) { echo  substr($item->title,0,50)."..."; } else { echo $item->title; }   ?></a></div>
	   <div class="date"><?php echo $item->pubDate ;?></div>
	   
	   <div class="desc"><?php $desc = $item->description;
    $desc = preg_replace("/<div.*>/","",$desc); echo  substr($desc,0,180)."...";  ?></div>
	   <a href="<?php echo $item->link ;?>" target="_blank" class="read-more">Read More</a>
	   </div>
	   </div>
		  <?php  }
		  $i++;
}?>
					
					
					
					
					
                    	
                </div>
            </div>
        </section>
        <section class="about-team">
        	<div class="container">
            	<div class="section-title">
                	<h2>Our Team</h2>
                </div>
                <div class="reviews-slider">
                	<div class="item">
                    	<div class="about-team-box">
                            <div class="img"><img src="images/team/team-1.jpg" alt=""></div>
                            <p>"A sophomore having Computer Science as major, pursuing from IGDTUW, Delhi. She likes to learn as many things as possible and ensures to giver her best." </p>
                            <div class="name">- Soumya Jain</div>
                        </div>
                	</div>
                    <div class="item">
                    	<div class="about-team-box">
                            <div class="img"><img src="images/team/team-2.jpg" alt=""></div>
                            <p>"A computer science sophomore. Visionary and enthusiastic with a will to achieve goal. A hard worker who believes in making the iron hot by striking."</p>
                            <div class="name">- Anoushka</div>
                        </div>
                	</div>
                    
                    <div class="item">
                    	<div class="about-team-box">
                            <div class="img"><img src="images/team/team-3.jpg" alt=""></div>
                            <p>"She is currently pursuing her btech degree in computer science from IGDTUW. She believes in hardwork , perseverance and team work."</p>
                            <div class="name">- Harshita</div>
                        </div>
                	</div>
                    <div class="item">
                    	<div class="about-team-box">
                            <div class="img"><img src="images/team/team-4.jpg" alt=""></div>
                            <p>"A sophomore pursuing B.Tech (CSE) from IGDTUW, New Delhi. She is a code enthusiast with a learning spirit. Loves decoding the logic and has high curiosity levels!"</p>
                            <div class="name">- Anubha Gupta</div>
                        </div>
                	</div>
					<div class="item">
                    	<div class="about-team-box">
                            <div class="img"><img src="images/team/team-5.jpg" alt=""></div>
                            <p>"Harshita Kukreja, pursuing B.Tech in Computer Science from IGDTUW. Currently in her second year of study. Hardworking, resilient and strong willed."</p>
                            <div class="name">- Harshita Kukreja</div>
                        </div>
                	</div>
					<div class="item">
                    	<div class="about-team-box">
                            <div class="img"><img src="images/team/team-6.jpg" alt=""></div>
                            <p>"With passion to delve into all aspects of design, Shruti Kalra loves pushing boundaries to create a better outcome."</p>
                            <div class="name">- Shruti Kalra</div>
                        </div>
                	</div>
                </div>
            </div>
        </section> 
		
        <section class="newsletter-block" style="background-image:url(images/parallax/newsletter-bg.jpg);">
        	<div class="container">
            	<label>SUBSCRIBE WEEKLY NEWSLETTER</label>
                <div class="input-box">
                	<input type="email" class="subscribe_newsletter_mail" placeholder="Email Id for subcribe">
                    <input type="submit" class="subscribe_newsletter" value="Submit">
                </div>
            </div>
        </section>
        <?php footer(); ?>
        
    </div>
     
     
    
    <script type="text/javascript" src="js/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script type="text/javascript" src="js/owl.carousel.js"></script>
    <script type="text/javascript" src="js/jquery.form-validator.min.js"></script>
    <script type="text/javascript" src="js/jquery.selectbox-0.2.js"></script>
    <script type="text/javascript" src="js/placeholder.js"></script>
    <script type="text/javascript" src="js/coustem.js"></script>
</body>
</html>

