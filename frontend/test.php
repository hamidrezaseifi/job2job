<?php

$emailbody = 'Ihre Registrierung bei Job2Job

Wir heißen Sie herzlich willkommen bei Job2Job,

um Ihre Registrierung abzuschließen, klicken Sie bitte auf folgenden Link:

';

$emailaddr = 'verification@job2job-gmbh.de';
$empfaenger = 'hamidrezaseifi@gmail.com';
$betreff = 'test email';

$header = '-f ' . $emailaddr . '\r\nReply-To: ' . $emailaddr . '\r\nContent-Type: text/html; charset=UTF-8\r\nX-Mailer: PHP/' . phpversion();

/*if(mail($empfaenger, $betreff, $emailbody)){
    echo 'empfaenger: ' . $empfaenger;
    echo '<hr>';
    echo 'betreff: ' . $betreff;
    echo '<hr>';
    echo 'emailbody: ' . $emailbody;
    echo '<hr>';
    echo 'header: ' . $header;
    echo '<hr>';
    
}
else{
    echo 'error in sending email';
}*/

$verifydatab = "2019-11-08 14:59:40";

$verifydatab = strlen($verifydatab > 10) ? substr($verifydatab, 0 , 10) : $verifydatab;


$date = date_create_from_format('Y-m-d', $verifydatab);

print_r($date);

