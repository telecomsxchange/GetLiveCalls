<?php

// Set some URL options in PHP Variables to make it more readable 

$USERNAME = "BUYER USER NAME";  // Your TelecomsXChange Seller/Buyer User ID
$TYPE = "BUYER";  // User Type SELLER OR BUYER

//In this step we will have to add a security signature, that verifies seller/buyer permission to perform the API call.
//For this purpose we concatenate 'final API uri' and seller API signature. 
//The difference between previous steps is that we just add the string, without creating valid HTTP parameter for it, the resulting string we call 'secret string':

$token = "b28c5ab8181b05455d16c10e1b5f028e6a8328828470084b5ccfd1c2a5a346e9"; // Final Signature
$prefix = "1954"; // Country Code Filter - optional
$filters = "like=is+like&amp;prefix"; // Search Filters

// Store final URL in a PHP variable. 

$get_tcxc_live_calls = "
https://members.telecomsxchange.com/v_livecalls.php?$filters=$prefix&amp;show=all&amp;api=1&amp;ts=1433535761&amp;login=$USERNAME&amp;login_type=$TYPE&amp;sign=$token";


$handle=curl_init($get_tcxc_live_calls);
curl_setopt($handle, CURLOPT_VERBOSE, true);
curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
curl_setopt($handle, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($handle, CURLOPT_SSL_VERIFYHOST, false);

$content = curl_exec($handle);

echo $content;
