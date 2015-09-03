<?php
echo "<h2>Testing Postfix...</h2>";
$to = 'suriabhinav1997@gmail.com';
$subject = 'This is the subject!';
$body = 'This is the email body. sup 626';
$from = 'From: From Address <abhinavsuri@appsforaptitude.org>' . "\r\n";
mail($to, $subject, $body, $from);
?>