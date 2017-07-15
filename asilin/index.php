<?php
session_start();
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 06/05/2017
 * Time: 22:22
 */
require_once  'vendor/autoload.php';
include "views/includes/login.inc.php";
include "views/includes/signup.inc.php";
include_once 'views/contactus.php';
function cleanInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Home</title>
    <?php include_once 'views/head.php' ?>
    </head>
    <body><div id="top"></div>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->

<section id="header" class="bg-color0">
    <div class="container"><div class="row">

     

      <div class="col-sm-12 mainmenu_wrap"><div class="main-menu-icon visible-xs"><span></span><span></span><span></span></div>
          <?php
          include_once 'views/header_menu.php';
          ?>
      </div>
      
    </div></div>
</section>


<section id="mainslider" style="margin-top: 50px"  >

    <div class="containerLogin">

        <div class="row tagLogin mobile-hide">
            <div class="col-md-12">

                <form class="form" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>" id="login-nav">
                    <?php if($loginError != ''):?>
                        <div class="alert alert-danger alert-dismissable" role="alert" style="margin-top: 5px;">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $loginError; ?>
                        </div>
                    <?php endif;?>
                    <div class="form-group">
                        <label class="sr-only" for="loginUsername">Username</label>
                        <input type="text" class="form-control" name="loginUsername" id="loginUsername" required>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="loginPassword">Password</label>
                        <input type="password" name="loginPassword" class="form-control" id="loginPassword" required>
                        <div class="help-block text-right"><a href="views/forgot_password.php">Forgot the password ?</a></div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="btn btn-primary btn-block" value="Sign in">
                    </div>
                    <div class="checkbox">
                        <label for="keepLoggedIn">
                            <input type="checkbox" name="keepLoggedIn" id="keepLoggedIn"> keep me logged-in
                        </label>
                    </div>

                </form>
            </div>
            <div class="bottom text-center">
                New here ? <a href="views/signup.php"><b>Join Us</b></a>
            </div>
        </div>
        <div class="tagIntro mobile-hide-intro">
            <h3>We create awareness, campaign,  partner and offer consultancy services for the E-learning services in
                Africa.</h3>
        </div>
        <img src="public/assets/img/bg2.jpg">
    </div>

</section>

<div id="box_wrap">


<section class="title_sectionk" id="title_about">
  <div class="container">
      <div class="row">
          <div class="col-sm-12  text-center">
              <h3 class="block-header">About Us</h3>
              <h3></h3>
          </div>
      </div>
      <div class="col-sm-12 desktop-hide-introm">

         <h3> We are an independent private organization that has been set up to
          campaign, create awareness, partner and offer consultancy services for the E-learning services in
          Africa.</h3>
      </div>
      <div class="row">

    <div class="col-sm-4">
      <img src="public/assets/img/elearning.jpg" alt="" class="img-circle">
    </div>
    <div class="col-sm-8">
        <div>
            <h4 style="text-align: center;"><i class="rt-icon-link-outline" ></i></h4>
            <h4 style="text-align: center;"> We compile innovative e-learning programs, services and experiences, designed to bring your professional and personal life in alignment with your educational needs at your pace.</br></br></h4>
        </div>

        <div>
            <h4 style="text-align: center;"><i class="rt-icon-graduate"></i> </h4>
            <h4>We offer guidance on career choices across all levels educational needs within communities with individuals and families, organizations and industries.<br><br></h4>

        </div>


      <div>
          <h4 style="text-align: center;"><i class="rt-icon-support"></i> </h4>
          <h4>We assist, individuals and organizations acquire the right skills set to be on the knowledgeable edge with the fast evolving Internet opportunities in the global society.<br> <br> </h4>
      </div>
       </div>
  </div></div>
</section>

<section id="features" class="color_section">
  <div class="container">
    
    <div class="row">


    </div>      
    <div class="row">
      <div class="block col-sm-12 col-sm-offset-3">
        
        <div class="left_icons to_slide_left">
          <div class="single_teaser_left">
              <i class="rt-icon-megaphone"></i>
          </div>
          <div class="single_teaser_right">
              <h3>You are new here? Create an account Now  <a href="views/signup.php" class="joinBtn" style="color: white;">Join US</h3></a></div>
        </div>
      </div>



    </div>  
    
  </div>
</section>

<section id="services" class="grey_section">
  <div class="container">
    <div class="row">
      <div class="col-sm-12 text-center">
          <h2 class="block-header">Our Objectives</h2>
          <h3></h3>
        </div>
    </div>
    
    <div class="row">
      
      <div class="block col-sm-3">
        <div class="single_teaser icons style1">
          <div class="icons_introimg image-icon">
            <i class="rt-icon-graduate"></i>
          </div>
          <h3><a href="#">Enhance access to education</a></h3>
          <p class="introtext">By providing access to learning opportunities through a non-formal, community-based e-learning program as an alternative means of education for youths and adults who are unable to avail through the formal school system</p>

        </div>
      </div>      
      <div class="block col-sm-3">
        <div class="single_teaser icons style1">
          <div class="icons_introimg image-icon">
            <i class="rt-icon-cog2"></i>
          </div>
          <h3><a href="#">Orientation and reduce the digital divide</a></h3>
          <p class="introtext">Orient the existing educators on the effective use of e-learning resources and  reduce the digital divide by providing access to ICT for disadvantaged youth and adults in Africa.</p>

        </div>
      </div>      
      <div class="block col-sm-3">
        <div class="single_teaser icons style1">
          <div class="icons_introimg image-icon">
            <i class="rt-icon-support"></i>
          </div>
          <h3><a href="#">Support </a></h3>
          <p class="introtext">Support the efforts of the government to effectively integrate e-learning in the teaching and learning processes and support the development of relevant 21st Century skills.</p>

        </div>
      </div>      
      <div class="block col-sm-3">
        <div class="single_teaser icons style1">
          <div class="icons_introimg image-icon">
            <i class="rt-icon-device-laptop"></i>
          </div>
          <h3><a href="#">Avail option of interactive e-learning platforms</a></h3>
          <p class="introtext">Research and avail option of interactive e-learning platforms for out-of-school youth  and adults through relevant and interactive computer-based multimedia learning resources</p>

        </div>
      </div>

    </div>
  </div>
</section>


<section class="title_section color_section">
  <div class="container"><div class="row">
    <div class="col-sm-8">
      <h3>“The education delivery approach in Africa has to shift from one that is highly dependent on physical infrastructure such as schools and colleges, physical learning materials, and in class education delivery to one that makes extensive use of interactive education technology.” Ambient Insight</h3>
     </div>
    <div class="col-sm-4">
      <a href="views/signup.php" class="theme_btn"><i class="rt-icon-ok"></i> Join Us</a>
    </div>
  </div></div>
</section>


    <section id="contact" class="darkgrey_section">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <h2 class="block-header">Contact Us</h2>
                    <p>You can contact us through the form below</p>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <?php
                    if (empty($success) && !empty($error)) {
                        ?>
                        <div class="alert alert-danger alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $error?>
                        </div>
                        <?php
                    } elseif (empty($error) and !empty($success)) {
                        ?>
                        <div class="alert alert-success alert-dismissable">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            <?php echo $success ?>
                        </div>

                        <?php
                    } else {
                        echo "";
                    }
                    ?>
                    <div class="contact-form">
                        <form class="contact-form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
                            <p class="contact-form-name">
                                <label for="contactName">Name <span class="required">*</span></label>
                                <input type="text" aria-required="true" size="30" value="" name="contactName" id="contactName" class="form-control" placeholder="Name">
                            </p>
                            <p class="contact-form-email">
                                <label for="contactEmail">Email <span class="required">*</span></label>
                                <input type="email" aria-required="true" size="30" value="" name="contactEmail" id="contactEmail" class="form-control" placeholder="Email">
                            </p>
                            <p class="contact-form-message">
                                <label for="contactMessage">Message</label>
                                <textarea aria-required="true" rows="8" cols="45" name="contactMessage" id="contactMessage" class="form-control" placeholder="Message"></textarea>
                            </p>
                            <p class="contact-form-submit text-center vertical-margin-81">
                                <input type="submit" value="Send" id="contact_form_submit" name="contact_submit" class="theme_btn">
                            </p>
                        </form>
                    </div>
                </div>

                <div class="block widget_text col-sm-3">
                    <h3>About Us</h3>
                    <p>Asili Africa E-learning Centre<br>
                        Nairobi<br>
                        <span><strong>Phone:</strong> </span>(123) 456-7890<br>
                        <span><strong>Email:</strong> </span>
                        <a href="#">info@asilie-learning.com</a><br>
                        We campaign, create awareness, partner and offer consultancy services for the E-learning services.
                    </p>
                    <p>
                        <a class="socialico-twitter" href="#" title="Twitter">#</a>
                        <a class="socialico-facebook" href="#" title="Facebook">#</a>
                        <a class="socialico-google" href="#" title="Google">#</a>
                        <a class="socialico-linkedin" href="#" title="Lindedin">#</a>

                    </p>
                </div>

                <div class="block widget_nav_menu col-sm-3">
                    <h3>Useful Links</h3>
                    <ul class="nav menu">
                        <li><a href="#title_about">About Us</a></li>
                        <li><a href="#join_us">Join Us</a></li>
                        <li><a href="#mainslider">Login In</a></li>

                    </ul>
                </div>


            </div>
        </div>
    </section>
<section id="copyright" class="dark_section">
  <div class="container"><div class="row">
    
    <div class="col-sm-12"><p class="text-center">&copy; Copyright 2017. Asili Africa E-learning Centre</p></div>

  </div></div>
</section>

</div><!-- EOF #box_wrap -->

<div id="gallery_container"></div>

<div class="preloader">
  <div class="preloaderimg"></div>
</div>
    <!--footer scripts-->
    <?php include_once 'views/footer.php';?>
    <script src="/public/assets/js/jquery-1.11.3.min.js"></script>
    <script src="/public/assets/js/bootstrap.js"></script>
    <script>
        $(document).ready(function (e) {
         e.preventDefault;
        });
    </script>
    <script>
    </script>
       
    </body>
</html>