<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="nl" lang="nl">
<head>
 	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
 	<meta name="description" content="First ever online upload site for MUN." />
 	<meta name="keywords" content="MUN,SMH, SMHMUNIII,Abhinav Suri" />
  <meta charset="UTF-8">
<meta name="google" content="notranslate">
<meta http-equiv="Content-Language" content="en">
 	<title>SMH MUN III Uploader</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,900' rel='stylesheet' type='text/css'>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Regular Bootstrap Load in ... -->
                <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

        <link href="../css/bootstrap.min.css" rel="stylesheet">
        <link href="../css/owl.carousel.css" rel="stylesheet">
        <link href="../style.css" rel="stylesheet">
        <link href="../css/responsive.css" rel="stylesheet">
        <script src="../js/modernizr.custom.js"></script>
                <link rel="stylesheet" href="../css/animate.css">

        <link rel="stylesheet" href="../morphext.css">
        <script src="../morphext.min.js"></script>
        <style>a {font-weight: bold}</style>
        
</head>
<body id="bigWrapper" data-spy="scroll" data-target=".navbar-default" data-offset="100">
<header id="head">
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58393513-1', 'auto');
  ga('send', 'pageview');

</script>
<link rel="stylesheet" href="../css/animate.css">
<script src="../activebar.js"></script>
        <link rel="stylesheet" href="../morphext.css">
        <script src="../morphext.min.js"></script>
        
<nav class="navbar navbar-default navbar-fixed-top" role="navigation" data-spy="affix" data-offset-top="50">
                <div class="container-fluid">
                    <!--Le mobile stuff-->
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        
                        <style>
                            .dateinbar
                            {
                                font-family: Open Sans;
                                font-weight:300;
                                color: rgb(119, 119, 119);
                            }
                            @-webkit-keyframes animx {
                                  0%   { opacity: 0; left: 100px}
                                  100% { opacity: 1; left: 0px}
                                }
                                @-moz-keyframes animx {
                                   0%   { opacity: 0; left: 100px}
                                  100% { opacity: 1; left: 0px}
                                }
                                @-o-keyframes animx {
                                  0%   { opacity: 0; left: 100px}
                                  100% { opacity: 1; left: 0px}
                                }
                                @keyframes animx {
                                  0%   { opacity: 0; left: 100px}
                                  100% { opacity: 1; left: 0px}
                                }
                            .titleinbar
                            {
                                -webkit-animation: animx 1s ; /* Safari 4+ */
                                  -moz-animation:    animx 1s ; /* Fx 5+ */
                                  -o-animation:      animx 1s ; /* Opera 12+ */
                                  animation:         animx 1s ;
                                  } 
                        </style>
                       <a class="navbar-brand" href= "index.html"> <img src="../img/logo.png" class="imagebrand" height="50px" style="padding-right: 20px"></a>  
                    </div>
                   
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse navbar-right" id="navbar-collapse">
                        <ul class="nav navbar-nav" id="menulist">
                        	<li class=""><a class="item" href="index.php">Home</a></li>
                          <li class=""><a class="item" href="http://appsforaptitude.org/SMHMUN/index.html" target="_blank">Timer</a></li>

                          <?php 
                          if(isset($_SESSION['signed_in'])) {
                            if($_SESSION['user_level']==0) 
                            {
                              echo '<li class=""><a class="item" href="summary.php">Upload</a></li>';
                            }
                          }
                              ?>
                            
                            <li class=""><a data-scroll href="../index.html">Main Site</a></li>
                           
                            <li class="phpspec"><?php
		if(!isset($_SESSION)) {
     		session_start();
		}
		if(isset($_SESSION['signed_in']))
		{
      if($_SESSION['user_level'] == 2) 
                { echo '<li class=""><a class="item" href="create_topic.php">Add Committee</a></li>';};

			echo '<li class="phpspec"><a class="item">' . htmlentities($_SESSION['user_name']) . '</li><li class="phpspec"><a class="item" href="signout.php">Sign out</a></li>';
		}
		else
		{
			echo '<a class="item" href="signin.php">Sign in</a></li><li class="phpspec"><a class="item" href="signup.php">create an account</a></li>';
		}?></li>
                         </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
    </header>
    <section id="upload" style="text-align: justify;
   text-justify: inter-word;">
    	<div class="container-fluid">

              <style>
			  .col-centered {float:none; margin: 0 auto}
			  .welcome-separator .col-centered p {font-weight: 400}
			  </style>  
    <div class="col-md-9 text-center col-centered">
    <h1>Paper Upload</h1>

	<div id="menu">
		
		
		<div id="userbar">
		

		</div>
	</div>
		<div id="content">