<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 14/06/2017
 * Time: 11:14
 */
include_once 'contactus.php';
?>


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
                    
                    
                   We campaign, create awareness, partner and offer consultancy services for the E-learning services.
                </p>
                
            </div>

            <div class="block widget_nav_menu col-sm-3">
                <h3>Contact Information</h3>
                <ul class="nav menu">
                 <span><strong>Location:</strong> </span>Nairobi<br>
                <span><strong>Phone:</strong> </span>+254724168727<br>
                    <span><strong>Email:</strong> </span>
                   <span> <a href="mailto:info@asilie-learning.com?Subject=Enquiry%20from%20Website" target="_top">info@asilie-learning.com</a> </span><br>
                    <span><li>
                    <br/>
                    <a class="socialico-twitter" href="#" title="Twitter">#</a>
                    <a class="socialico-facebook" href="#" title="Facebook">#</a>
                    <a class="socialico-google" href="#" title="Google">#</a>
                    <a class="socialico-linkedin" href="#" title="Lindedin">#</a>

                </li></span>

                </ul>
            </div>


        </div>
    </div>
</section>
