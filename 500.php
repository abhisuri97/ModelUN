<!-- PHP Wrapper - 500 Server Error -->
<html><head><title>500 Server Error</title></head>
<body>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,300,900' rel='stylesheet' type='text/css'>
    <style>
    body { 
  background: url(koala.gif) no-repeat center center fixed; 
  -webkit-background-size: cover;
  -moz-background-size: cover;
  -o-background-size: cover;
  background-size: cover;
}
}
    </style>

    <h1 style="font-family:'Open Sans'; font-size: 200px; text-align:center; vertical-align: middle;color: #FFF; margin-top: 0px;margin-bottom: 0px" >400</h1>
    <p style="font-family:'Open Sans'; font-size: 20px; text-align:center; vertical-align: middle;color: #FFF; margin-top: 0px;margin-bottom: 0px">Bad request...you didn't see anything<br><br><br><br> <a href="http://www.smhmun.org" style="color: #FFF">Return from whence you came</a></p>
    <?
  echo "URL: http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."<br>\n";
  $fixer = "checksuexec ".escapeshellarg($_SERVER['DOCUMENT_ROOT'].$_SERVER['REQUEST_URI']);
  echo `$fixer`;
?>
    

    


</body></html>
