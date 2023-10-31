<?php  
$requestParams = array(
'command' => 'PURCHASE',
'access_code' => 'JXONDL8f6aptape4sGtd',
'merchant_identifier' => '8e600dde',
'merchant_reference' => 'sss-gashdbgashdabshd',
'amount' => '100000',
'currency' => 'AED',
'language' => 'en',
'customer_email' => 'ahmad.TEST@payfort.com',
'order_description' => 'iPhone 6-S',
'return_url'=>'https://rivatrip.com/tours/abcdef'
);
$shaString = '';
// sort an array by key
ksort($requestParams);
foreach ($requestParams as $key => $value) {
    $shaString .= "$key=$value";
}
print_r($shaString);
exit();
// make sure to fill your sha request pass phrase
$shaString = "200qU.mRa6sxDKf27pMLdv+}" . $shaString . "200qU.mRa6sxDKf27pMLdv+}";
$signature = hash("SHA256", $shaString);
// echo $signature;
// exit();
// your request signature
$requestParams['signature'] = $signature;

$redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
echo "<html xmlns='https://www.w3.org/1999/xhtml'>\n<head></head>\n<body>\n";
echo "<form action='$redirectUrl' method='post' name='frm'>\n";
foreach ($requestParams as $a => $b) {
    echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
}
echo "\t<script type='text/javascript'>\n";
echo "\t\tdocument.frm.submit();\n";
echo "\t</script>\n";
echo "</form>\n</body>\n</html>";

?>