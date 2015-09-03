<?php

//configs
$email_to ='MUN@smhall.org'; //put your email address here
$email_subject_prefix ='smhmun.org contact form: '; //put the email sibject line prefix here
$email_from ='do-not-reply@smhmun.org'; //put the email address that this form will be sent from
$email_from_nice ='SMH MUN Email'; //put in the 'nice' name for the email sender

//If the form is submitted
if(isset($_POST['submit'])) {

        //Check to make sure that the name field is not empty
        if(trim($_POST['contactname']) == '') {
                $hasError = true;
        } else {
                $name = trim($_POST['contactname']);
        }

        //Check to make sure that the subject field is not empty
        if(trim($_POST['subject']) == '') {
                $hasError = true;
        } else {
                $subject = $email_subject_prefix;
                $subject .= trim($_POST['subject']);
        }

        //Check to make sure sure that a valid email address is submitted
        if(trim($_POST['email']) == '')  {
                $hasError = true;
        } else if (!eregi("^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$", trim($_POST['email']))) {
                $hasError = true;
        } else {
            $email = trim($_POST['email']);
            
        }

        //Check to make sure comments were entered
        if(trim($_POST['message']) == '') {
                $hasError = true;
        } else {
                if(function_exists('stripslashes')) {
                        $comments = stripslashes(trim($_POST['message']));
                } else {
                        $comments = trim($_POST['message']);
                }
        }

        //Check to make sure comments were entered
        if($_POST['spam_prevention_test']) {
                $isSpam = true;
        }

        //If there is no error, send the email
        if(!isset($hasError) AND !isset($isSpam)) {
                $emailTo = $email_to; //Put your own email address here
                $body = "Name: $name \n\nEmail: $email \n\nSubject: $subject \n\nComments:\n $comments";
                $headers = 'From: '.$email_from_nice.' <'.$email_from.'>' . "\r\n" . 'Reply-To: ' . $email;

                mail($emailTo, $subject, $body, $headers);
                $emailSent = true;
        }
}
?>


<!DOCTYPE html>
<html lang="en" class="no-js">

    <head>

        <title>SMH-MUN III</title>
        <meta charset="utf-8" />
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
        <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

<META HTTP-EQUIV="Pragma" CONTENT="no-cache">
<META HTTP-EQUIV="Expires" CONTENT="-1">

        <!-- Regular Bootstrap Load in ... -->
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
<script src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.pack.js" type="text/javascript"></script>

        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/owl.carousel.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
        <link href="css/responsive.css" rel="stylesheet">
        <script src="js/modernizr.custom.js"></script>
            
        <!--Typical HTML5 Shim stuff...-->
            <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
            <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
            <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
<header id="head">
    <script>$("#head").load("header.html");</script>
    </header>
<script type="text/javascript">
$(document).ready(function(){
        $("#contactform").validate();
});
</script>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--/* contact SECTION */-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <section id="contact">
            <div class="container">
                <!--header-->
                
                <div class="row" >
                    
                    <div class="col-md-6 col-sm-6 col-xs-12">
<h1>Contact</h1>
                        <p class="bold">Don't hesitate to contact us.</p>
                        <p>
                            We are glad to address any questions, comments, or concerns you may have. Please fill out this secure contact form or reach out to us through any of the following:
                        </p>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 listwrapper">
                                <ul class="infoContact">
                                    <li><i class="fa fa-location-arrow"></i> 9401 Starcrest Drive</li>
                                    <li>San Antonio, TX </li>
                                    <li>78217 </li>
                                </ul>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6 listwrapper">
                                <ul class="infoContact">
                                    <li><i class="fa fa-phone"></i>  (210) 483-9100   </li>
                                </ul>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6 listwrapper">
                                <ul class="infoContact">
                                    <li><i class="fa fa-envelope-o"></i> <a href="mailto:mun@smhall.org">MUN@smhall.org</a></li>
                                </ul>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-6 listwrapper">
                                <ul class="infoContact">
                                  
                                </ul>
                            </div>

                        </div>
                        <style>
                            
                            .spam_prevention {display:none}
                        </style>

                    
                    </div>
 <!-- Do not change the code! -->
                    <p></p>
                    <div class="col-md-6 col-sm-6 col-xs-12 text-center">
                        <?php if(isset($isSpam)) { //If errors are found ?>
                <div class="alert alert-danger" role="alert">
 <b>Error:</b> 
 You have somehow filled out our invisible bot trap. Please email MUN@smhall.org if this problem persists.
</div>
        <?php } ?>
        <?php if(isset($hasError)) { //If errors are found ?>
               <div class="alert alert-danger" role="alert">
 <b>Error:</b> 
  Please enter valid information in form fields
</div>
        <?php } ?>
 <style>
     
 </style>
        <?php if(isset($emailSent) && $emailSent == true) { //If email is sent ?>
               <div class="alert alert-success" role="alert">
 <b>Email Sent:</b> 
  Thank you <b><?php echo $name;?></b> for contacting us. Your email was sent and we will get back to you shortly.
</div>
                       
        <?php } ?>   
                        <div id="result"></div>
                         <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" id="contactform">
                    <label for="name">
                        <input type="text" size="50" name="contactname" id="contactname" value="<?php echo $_POST['contactname']; ?>" class="required" placeholder="Enter your name"/>
 </label>
         
                        <label for="email">
                        <input type="text" size="50" name="email" id="email" value="<?php echo $_POST['email']; ?>" class="required email" placeholder="enter your email"/>
             </label>
                             
                             
                        <label for="subject">
                        <input type="text" size="50" name="subject" id="subject" value="<?php echo $_POST['subject']; ?>" class="required" placeholder="Subject"/>
                </label>
 
           
                        <label for="message">
                        <textarea rows="8" cols="69" name="message" id="message" class="required" placeholder="Enter your Message"><?php echo $_POST['message']; ?></textarea>
                             </label>
 <div class="spam_prevention" id="pot">
                        <label for="message"><strong>Spam prevention test:</strong><br/>If you're human leave this blank:</label>
                        <input name="spam_prevention_test" type="text" id="spam_prevention_test" class="spam_prevention_test" value="<?php echo $_POST['spam_p
revention_test']; ?>"/>
                </div>
                
            <input type="submit" value="Send Message" name="submit" class="submit btn-default btn-black"/>
        </form>
                    </div>

                  
                   <!-- Do not change the code! -->

<!-- Do not change the code! -->	
                 
                    
                    </div>


                </div>
        </section>
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--/* END contact SECTION */-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->

        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--/* googleMap SECTION */-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
        <!--/* googleMap SECTION */-->
        <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->


        

        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script type="text/javascript" src="js/scripts.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="js/custom.js"></script>
        <script src="js/googleMapInit.js"></script>
<div class="modal fade center2" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModal5Label" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
          
        <div class="modal-body" style="text-align:center">
           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button> 
          <h2>Coming Soon</h2>
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div>
	</body>
</html>